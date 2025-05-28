<?php
class TableBahan{
    function create($nama, $deskripsi, $harga, $jenis, $foto){
        global $kon;
        $sql = "INSERT INTO bahan(nama, deskripsi, harga, jenis, foto) VALUES ('$nama', '$deskripsi', '$harga', '$jenis', '$foto')";
        $kon->exec($sql);
    }
    function destroy($d){
        global $kon;
        $sql = "DELETE FROM bahan WHERE id = " . $d;
        $kon->exec($sql);
    }
    function fetchAllBahan(){
        global $kon;
        $stmt = $kon->query("SELECT * FROM bahan ORDER BY id ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    function countEachDataCategory($cat){
        global $kon;
        $cat = "%$cat%";
        $stmt = $kon->prepare("SELECT * FROM bahan WHERE  jenis LIKE :cat");
        $stmt->bindParam(":cat", $cat);
        $stmt->execute();
        return count($stmt->fetchAll(PDO::FETCH_ASSOC));
    }
    function nuke(){
        global $kon;
        $kon->exec("DELETE FROM bahan");
    }
    function getBahanById($id) {
        global $kon;
        if (!$id) {
            header('Location: /');
            exit();
        } else {
            $stmt = $kon->prepare("SELECT * FROM bahan WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
        }

        return $stmt->fetch(PDO::FETCH_ASSOC); 
    }

    function update($id, $nama, $deskripsi, $harga, $jenis, $foto){
        global $kon;
        if (empty($nama) || empty($deskripsi) || empty($harga) || empty($jenis)) {
            header('Location: /');
            exit();
        }
        
        $stmt = $kon->prepare("UPDATE bahan SET nama = :nama, deskripsi = :deskripsi, harga = :harga, jenis = :jenis, foto = :foto WHERE id = :id");
        $stmt->bindParam(':nama', $nama);
        $stmt->bindParam(':deskripsi', $deskripsi);
        $stmt->bindParam(':harga', $harga, PDO::PARAM_INT);
        $stmt->bindParam(':jenis', $jenis);
        $stmt->bindParam(':foto', $foto);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    function search($search){
        global $kon;
        $stmt = $kon->prepare('SELECT * FROM bahan WHERE nama LIKE :search OR jenis LIKE :search ORDER BY id ASC');
        $search = "%$search%"; 
        $stmt->bindParam(':search', $search);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
class TableKeranjang{
    function create($bahan_id, $porsi= 1){
        global $kon;
        $sql = "INSERT INTO keranjang(bahan_id, porsi) VALUES ('$bahan_id', '$porsi')";
        $kon->exec($sql);
    }
    function destroy($d){
        global $kon;
        $sql = "DELETE FROM keranjang WHERE id = " . $d;
        $kon->exec($sql);
    }
    // Relasi dari bahan ke keranjang 
    function fetchAllData() {
        global $kon;
        $stmt = $kon->query("
            SELECT 
                k.id AS keranjang_id,
                k.porsi,
                b.id AS bahan_id,
                b.nama,
                b.harga,
                b.foto,
                b.jenis,
                (k.porsi * b.harga) AS total_harga
            FROM keranjang k
            JOIN bahan b ON k.bahan_id = b.id
            ORDER BY k.id DESC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    function nuke(){
        global $kon;
        $kon->exec("DELETE FROM keranjang");
    }
    function getDataById($id) {
        global $kon;
        if (!$id) {
            header('Location: /');
            exit();
        } else {
            $stmt = $kon->prepare("SELECT * FROM keranjang WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
        }

        return $stmt->fetch(PDO::FETCH_ASSOC); 
    }
    function findDataByFId($FId){
        global $kon;
        $stmt = $kon->prepare('SELECT * FROM keranjang WHERE bahan_id = :FId');
        $stmt->bindParam(':FId', $FId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function update($id, $bahan_id, $porsi){
        global $kon;
        if (empty($bahan_id) || empty($porsi)){
            header('Location: /');
            exit();
        }
        
        $stmt = $kon->prepare("UPDATE keranjang SET bahan_id = :bahan_id, porsi = :porsi WHERE id = :id");
        $stmt->bindParam(':bahan_id', $bahan_id, PDO::PARAM_INT);
        $stmt->bindParam(':porsi', $porsi, PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function updatePorsi($id, $porsi){
        global $kon;
        
        if (empty($id) || empty($porsi)) {
            header('Location: /');
            exit();
        }
        $stmt = $kon->prepare("UPDATE keranjang SET porsi = :porsi WHERE id = :id");
        $stmt->bindParam(':porsi', $porsi, PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

}

class TableRacikan {
    function create($nama){
        global $kon;
        $sql = "INSERT INTO racikan(nama) VALUES ('$nama')";
        $kon->exec($sql);
    }

    function destroy($id){
        global $kon;
        // Hapus detailnya dulu 
        $stmt = $kon->prepare("DELETE FROM detail_racikan WHERE racikan_id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        // Hapus racikan
        $stmt2 = $kon->prepare("DELETE FROM racikan WHERE id = :id");
        $stmt2->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt2->execute();
    }

    function fetchAll(){
        global $kon;
        $stmt = $kon->query("SELECT * FROM racikan ORDER BY id ASC");
        $racikanList = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($racikanList as &$racikan) {
            $stmtDetail = $kon->prepare("
                SELECT b.nama, b.foto 
                FROM detail_racikan dr
                JOIN bahan b ON dr.bahan_id = b.id
                WHERE dr.racikan_id = :racikan_id
            ");
            $stmtDetail->bindParam(':racikan_id', $racikan['id'], PDO::PARAM_INT);
            $stmtDetail->execute();
            $racikan['bahan'] = $stmtDetail->fetchAll(PDO::FETCH_ASSOC);
        }

        return $racikanList;
    }

    function getById($id){
        global $kon;
        $stmt = $kon->prepare("SELECT * FROM racikan WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}


class TableDetailRacikan {    
    function create($racikan_id, $bahan_id, $porsi = 1){
        global $kon;
        $stmt = $kon->prepare("INSERT INTO detail_racikan (bahan_id, racikan_id, porsi) VALUES (:bahan_id, :racikan_id, :porsi)");
        $stmt->bindParam(':bahan_id', $bahan_id, PDO::PARAM_INT);
        $stmt->bindParam(':racikan_id', $racikan_id, PDO::PARAM_INT);
        $stmt->bindParam(':porsi', $porsi, PDO::PARAM_INT);
        $stmt->execute();
    }
    function destroy($id){
        global $kon;
        $stmt = $kon->prepare("DELETE FROM detail_racikan WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }
    function getByRacikanId($racikan_id){
        global $kon;
        $stmt = $kon->prepare("
            SELECT dr.id, b.nama, b.harga, b.jenis, b.foto, dr.porsi
            FROM detail_racikan dr
            JOIN bahan b ON dr.bahan_id = b.id
            WHERE dr.racikan_id = :racikan_id
        ");
        $stmt->bindParam(':racikan_id', $racikan_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    function clearByRacikanId($racikan_id){
        global $kon;
        $stmt = $kon->prepare("DELETE FROM detail_racikan WHERE racikan_id = :racikan_id");
        $stmt->bindParam(':racikan_id', $racikan_id, PDO::PARAM_INT);
        $stmt->execute();
    }
    function updatePorsi($id, $porsi){
        global $kon;
        if (empty($id) || empty($porsi)) {
            header('Location: /');
            exit();
        }
        $stmt = $kon->prepare("UPDATE detail_racikan SET porsi = :porsi WHERE id = :id");
        $stmt->bindParam(':porsi', $porsi, PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}


$bahan = new TableBahan();
$keranjang = new TableKeranjang();
$racikan = new TableRacikan();
$detailRacikan = new TableDetailRacikan();