<?php

$host      = "localhost";
$kullanici = "root";
$sifre     = "";
// baglanti
$baglanti = @mysql_connect( $host, $kullanici, $sifre ) or die("HATA : " . mysql_error());
if (!$baglanti) {
    die('Bağlanamadı: ' . mysql_error());
}
else if($baglanti){
	if(mysql_select_db("veritabani",$baglanti)){//veritabani1 bağlantı sağlanırsa veritabanı mevcut demektir.
	  echo "veritabani1 oluşturulmuş \n";
	  //mevcut veritabanında temizleme işlemi yapılacak!
	  $db = mysqli_connect($host, $kullanici, $sifre,"veritabani");
	  mysqli_query($db,"DELETE FROM yorumlar");
	  mysqli_query($db,"DELETE FROM sql_injection");
	  $sql1 = "INSERT INTO yorumlar (isim,email,mesaj)
      VALUES ('Hatice Zeren', 'hatice@gmail.com', 'XSS Zafiyetli site...')";
      mysqli_query($db, $sql1);
$sql2 = "INSERT INTO sql_injection (kullanici_adi,sifre,tel_no,adres,ad_soyad)
VALUES ('SolmazSena', '1234', '0541-000','Izmit','Sena Solmaz')";
$sql3 = "INSERT INTO sql_injection (kullanici_adi,sifre,tel_no,adres,ad_soyad)
VALUES ('ZerenHatice', '12345', '0541-000','Istanbul','Hatice Zeren')";
mysqli_query($db, $sql2);
mysqli_query($db, $sql3);

	}
	else{
		//veritabani1 oluşturulmamış oluşturuyoruz.
	echo "veritabani1 mevcut değil\n";
	
	$bul=@mysql_query("CREATE DATABASE veritabani");//veritabani1 oluşturuyoruz
    if($bul){
		//veritabanındaki iki tablo oluşturuluyor.
	$tablo_ilk="CREATE TABLE yorumlar (
    id int NOT NULL AUTO_INCREMENT,
    isim  varchar(255) NOT NULL,
	email varchar(255) ,
    mesaj  varchar(255) NOT NULL,
    PRIMARY KEY (id)
)";

$tablo_ikinci="CREATE TABLE sql_injection (
    id int NOT NULL AUTO_INCREMENT,
    kullanici_adi  varchar(255) NOT NULL,
	sifre varchar(255) NOT NULL,
    tel_no varchar(20),
	adres varchar(255) NOT NULL,
	ad_soyad varchar(255) NOT NULL,
    PRIMARY KEY (id)
)";
 $db = mysqli_connect($host, $kullanici, $sifre,"veritabani");
 if (mysqli_query($db, $tablo_ilk)) {
    echo "yorumlar tablosu oluşturuldu\n";
	$sql1 = "INSERT INTO yorumlar (isim,email,mesaj)
VALUES ('Hatice Zeren', 'hatice@gmail.com', 'XSS Zafiyetli site...')";
mysqli_query($db, $sql1);
echo "yorumlar tablosuna veriler yazıldı;\n";
 if(mysqli_query($db, $tablo_ikinci)){
 $sql2 = "INSERT INTO sql_injection (kullanici_adi,sifre,tel_no,adres,ad_soyad)
VALUES ('SolmazSena', '1234', '0541-000','Izmit','Sena Solmaz')";
$sql3 = "INSERT INTO sql_injection (kullanici_adi,sifre,tel_no,adres,ad_soyad)
VALUES ('ZerenHatice', '12345', '0541-000','Istanbul','Hatice Zeren')";
mysqli_query($db, $sql2);
mysqli_query($db, $sql3);
	 echo "sql_injection olusturuldu\n";
	 echo "sql_injection tablosu oluşturuldu\n";
} else {
    echo "Error creating table: " . mysqli_error($db);
}

	}
    else{
		echo "olmadi";
	}
	
	
 
	}
}
}
require 'kurulum.php';
?>