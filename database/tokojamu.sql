CREATE TABLE bahan (
  id INTEGER PRIMARY KEY,
  nama TEXT NOT NULL,
  deskripsi TEXT NOT NULL,
  harga INTEGER NOT NULL,
  jenis TEXT NOT NULL,
  foto VARCHAR(255)
);

INSERT INTO bahan(nama, jenis, deskripsi, harga, foto) VALUES
('Kunyit','Bahan utama','Antioksidan, antiradang, meningkatkan sistem imun, meredakan nyeri haid',1500,'asset/img/kunyit.png'),
('Jahe','Bahan utama','Menghangatkan tubuh, meredakan nyeri otot, meningkatkan imun, mencegah mual',1200,'asset/img/jahe.png'),
('Temulawak','Bahan utama','Melindungi hati, antiinflamasi, meningkatkan nafsu makan',2000,'asset/img/temulawak.png'),
('Kencur','Bahan utama','Meredakan nyeri, antibakteri, melancarkan pencernaan, meningkatkan nafsu makan',1500,'asset/img/kencur.png'),
('Serai','Bahan utama','Meredakan demam, melancarkan pencernaan, mengurangi stres',800,'asset/img/sereh.png'),
('Daun Pepaya','Bahan utama','Meningkatkan nafsu makan, membantu pencernaan dengan enzim papain',600,'asset/img/daun-pepaya.png'),
('Mengkudu','Bahan utama','Mengelola tekanan darah, pereda nyeri, memperbaiki pencernaan',2100,'asset/img/mengkudu.png'),
('Daun Beluntas','Bahan utama','Antibakteri, detoksifikasi, menghilangkan bau badan',800,'asset/img/daun-beluntas.png'),
('Asam Jawa','Bahan utama','Menurunkan suhu badan, menyegarkan, mendukung kesehatan hati',1000,'asset/img/asam-jawa.png'),
('Cengkeh','Rempah tambahan','Mengatasi sakit kepala, antibakteri',800,'asset/img/cengkeh.png'),
('Kayu Manis','Rempah tambahan','Menurunkan gula darah, meningkatkan metabolisme',800,'asset/img/kayu-manis.png'),
('Daun Pandan','Rempah tambahan','Memberi aroma harum, membantu pencernaan',800,'asset/img/daun-pandan.png'),
('Kapulaga','Rempah tambahan','Melancarkan peredaran darah, meningkatkan nafsu makan',500,'asset/img/kapulaga.png'),
('Bunga Lawang','Rempah tambahan','Memberi aroma khas, membantu pencernaan',500,'asset/img/bunga-lawang.png'),
('Daun Sirih','Rempah tambahan','Antiseptik, kesehatan mulut dan organ kewanitaan',500,'asset/img/sirih.png'),
('Gula Merah','Pemanis','Menambah rasa manis alami, sumber energi',1000,'asset/img/gula-merah.png'),
('Madu','Pemanis','Meningkatkan imun, mempercepat penyembuhan, menambah rasa manis',2000,'asset/img/madu.png'),
('Tebu','Pemanis','Menambah rasa manis alami, mempercepat penyembuhan',1000,'asset/img/tebu.png'),
('Lemon','Bahan tambahan','Menambah rasa segar, sumber vitamin C',1200,'asset/img/lemon.png'),
('Delima','Bahan tambahan','Antioksidan, meningkatkan stamina',3400,'asset/img/delima.png'),
('Soda','Bahan tambahan','Memberi sensasi segar dan rasa modern pada jamu',1000,'asset/img/soda.png'),
('Mint','Bahan tambahan','Memberi sensasi segar, antibakteri',800,'asset/img/mint.png'),
('Stevia','Pemanis','Menambah rasa manis alami, sumber energi',2000,'asset/img/stevia.png');
