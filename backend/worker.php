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
        $stmt = $kon->query("SELECT * FROM bahan ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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
}

$bahan = new TableBahan();
$keranjang = new TableKeranjang();