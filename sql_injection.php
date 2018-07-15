<!DOCTYPE HTML>  
<html>
<head>
<meta charset="UTF-8"/>
<style>
</style>
</head>
<body>  
<?php include "menu.php" ?>

<?php
$kullanici_adi = $sifre=  "";
if ($_SERVER["REQUEST_METHOD"] == "GET") {
if(isset($_GET['kullanici_adi']) && isset($_GET['sifre'])) {
   $kullanici_adi = $_GET['kullanici_adi'];
   $sifre = $_GET['sifre'];
 
   if(empty($kullanici_adi) || empty($sifre)) {
       echo' <div class="alert alert-warning"style="margin-top:40px;text-align:center;"><strong>Kullanıcı Adı veya Şifre  boş bırakılamaz</strong></div>';
   } 
}
}
/*if ($_SERVER["REQUEST_METHOD"] == "GET") {
	echo $_GET['submit'];
  if (!empty($_GET["kullanici_adi"])) {
     $kullanici_adi = $_GET["kullanici_adi"];  
	// $kullanici_adi =@mysql_real_escape_string( $kullanici_adi ); //kullanıcı değişkenini alırken hiç bir filtrleme yapılıyor
	 // artık o hileli kodlar işe yaramayacak!!
  }

  if (!empty($_GET["sifre"])) {
     $sifre = $_GET["sifre"];
  } 
  
  if(empty($kullanici_adi) || empty($sifre)){
       echo' <div class="alert alert-warning"style="margin-top:40px;text-align:center;"><strong>Kullanıcı Adı veya Şifre  boş bırakılamaz</strong></div>';
	}
 
}
*/
?>

<div class="row"  style="padding:20px;">
    <div class="col-sm-4" style="padding:20px;border:3px solid gray;">
	<h2>SQL İnjection</h2><br></br>
      <form method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
<table>
<tr>
 <td>Kullanıcı Adı: <p></p> <input type="text" name="kullanici_adi"> <br></br></td> 

</tr>
<tr>
 <td>Şifre: <p></p> <input type="password" name="sifre"> <br></br></td> 
</tr>

<tr>
<td><br></br><input type="submit" name="submit" value="Giris"></td>
 </tr>
</table> 
</form>
<?php

if ($_SERVER["REQUEST_METHOD"] == "GET") {
				
$baglan=@mysql_connect("localhost","root","");
$veritabani=@mysql_select_db("veritabani",$baglan);

$veri=@mysql_query("SELECT *  FROM sql_injection  WHERE  kullanici_adi='$kullanici_adi' ",$baglan);
		 $db_ad=@mysql_result($veri,0,"kullanici_adi");
		$db_sifre=@mysql_result($veri,0,"sifre");
		 if(strcmp($db_ad,$kullanici_adi)!=0){
				echo' <div class="alert alert-warning"style="margin-top:40px;text-align:center;"><strong>Kullanıcı Adı Yanlış.</strong></div>';

			 }
			// elseif(!$db_sifre){
				else {
				 if(strcmp($db_sifre,$sifre)==0){
				 //mysql_close();
				// header ("Location:baglan.php");
				 }
				 else {
   echo' <div class="alert alert-warning"style="margin-top:40px;text-align:center;"><strong> Şifre  Yanlış.</strong></div>';

			 
				}
				}

echo "<h2>Çıktı:</h2>";
//veritabanından çekip ekrana yaz!!
 mysql_query("SET NAMES UTF8");//türkçe karakter sorunu için gereklidir.
$bul=@mysql_query("select * from sql_injection WHERE kullanici_adi='$kullanici_adi' AND sifre= '$sifre' ");

while($oku=@mysql_fetch_array($bul)){
	
	echo "Kullanıcı Adı:". $oku['kullanici_adi']."<br />";
	echo "Ad Soyad :".$oku['ad_soyad']."<br />";
	echo "Şifre:".$oku['sifre']."<br />";
	echo "Adres :".$oku['adres']."<br />";
	echo "Telefon:".$oku['tel_no']."<hr />";	
	
}
mysql_close($baglan);
}
?>
    </div>
    <div class="col-sm-8" >
	<div class="panel-group">
	
  <div class="panel panel-default" style="margin:10px;">
    <div class="panel-heading"><p style="font-size:120%;">SQL INJECTION NEDİR ?</p></div>
    <div class="panel-body">
	<p>
	SQL Injection, yani SQL Enjeksiyonu saldırısı bir web uygulamasına bağlı istemcinin gireceği input verisi aracılığıyla sunucudaki var olan SQL sorgusuna yeni SQL sorgusu ilave etmesine,
	diğer tabirle enjekte etmesine denir.SQL enjeksiyonu, veri tabanlı uygulamalara saldırmak için kullanılan bir tekniktir (diğer web saldırı mekanizmaları gibi). Bu saldırı bir güvenlik duvarını atlayabilir ve tam olarak yamalı bir sistemi etkileyebilir.
	Saldırgan, SQL girişi içerisindeki değişken girdileri ayrıştırmak için SQL ifadelerine gömülü olan kötü filtrelenmiş veya doğru şekilde kaçılmamış karakterlerden yararlanır.
	Saldırgan, eninde sonunda veritabanı sorgusu olan keyfi verileri, bir web uygulaması (örneğin bir oturum açma formu) aracılığıyla veritabanı tarafından yürütülen bir dizeye enjekte eder.
	SQL Injection saldırısı ile hedef sitenin hassas verilerine erişilebilir, hedef sitenin veritabanı modifiye edilebilir.
	 
	</p>
	</div>
  </div>
  
  <div class="panel panel-default" style="margin:10px;">
    <div class="panel-heading"><p style="font-size:120%;">  SQL INJECTION ZAFİYETİNE HANGİ DURUM/DURUMLAR SEBEP OLUR?</p></div>
    <div class="panel-body">
	  <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#xss_zafiyet2">KAYNAK KODU İNCELE</button>
      <div id="xss_zafiyet2" class="collapse">
      <img src="sql_injection.png" class="img-responsive">
	  <p>
	  <p></p>
	  15. satırda kullanıcıdan gelen veri $kullanici_adi değişkenine atanmaktadır. Daha sonrada  $kullanici_adi değişkeni SQL sorgusunda kullanılmaktadır. 
	  İşte güvenlik zafiyeti bu satırdan kaynaklanmaktadır.
	  $kullanici_adi değişkeni hiçbir denetlemeye tabi tutulmadan direk SQL sorgusuna dahil edilmiş. 
	  $kullanici_adi değişkeni içindeki sakıncalı karakterlerden ayıklanmadan SQL sorgusuna dahil edildiği için  SQL Injection yapabildik.
	  </p>
      </div>

	</div>
  </div>
  
  <div class="panel panel-default" style="margin:10px;">
    <div class="panel-heading"><p style="font-size:120%;"> ZAFİYETİN SALDIRGAN TARAFINDAN SÖMÜRÜLMESİ ÖRNEĞİ</p></div>
    <div class="panel-body">
	<p>
	<p>
	 Kullanıcı adı ve şifre alanına 
	<pre><strong> <?php $data = htmlspecialchars("kullanıcı adı ve şifre kısmına  'or' 1=1 giriniz  yada kullanici_adina yada şifre kısmına   'or'1' = '1'#  komutunu giriniz. "); echo "$data";?></strong></pre>ya da 
	 <pre><strong>URL:</strong><?php $data = htmlspecialchars(" http://localhost/yazlab3/sql_injection.php?kullanici_adi=%27or%271%27+%3D+%271%27%23+&sifre=&submit=Giris"); 
	  echo "$data";?></pre>
   </p>
   herhangi biri girildiği takdirde ekrana tüm kullanıcıların tüm bilgileri gelecektir.
	 <p>
 Ve başkalarının şifresini
	 , adresini, telefon numaraları gibi bilgilerine ulaşabiliriz. Bura daki kod parçacıklarının anlamı aslında 1=1 mi sorugusu sürekli true değeri döndürür.
	 Ve bize veritabanında ki tüm değerleri listeler. '1' = '1' ifadesinin bir anlamı vardır. O da şudur ki 1 sayısı daima 1 sayısına eşit olacağından bu kıyaslama sürekli true döneceği için WHERE koşulu veritabanından çekilecek kayıtlar konusunda herhangi bir kısıtlamada bulunamayacaktır.
	 Dolayısıyla veritabanından tüm satırlar çekilecektir. Yani arkaplandaki while döngüsü satır sayısı kadar dönecektir.
    Kodun sonundaki # işareti MySQL'de SQL sorgusunun geri kalanını yorum yap anlamına gelir. 
	 </p>
	</p>
	</div>
  </div>
  
  
   <div class="panel panel-default" style="margin:10px;">
    <div class="panel-heading"><p style="font-size:120%;">ALINACAK ÖNLEM NEDİR?</p></div>
    <div class="panel-body">
	<button type="button" class="btn btn-info" data-toggle="collapse" data-target="#xss_iyilestirme2">KAYNAK KODDAKİ İYİLEŞTİRME</button>
      <div id="xss_iyilestirme2" class="collapse">
       <img src="sql_injection2.png" class="img-responsive">
	    <p>
	  <p></p>
	 Görüldüğü üzere 6. satırda mysql sorguları için bir anlam ifade eden karakterlerin önüne ters slash koyan <strong>mysql_real_escape_string()</strong> fonksiyonu kullanılmış.
	 mysql_real_escape_string() fonksiyonu SQL sorguları için anlam ifade eden karakterlerin önüne ters slash işareti koyarak o anlam ifade eden karakterin sql için olan anlamını yok edecektir ve stringleştirecektir.
	  </p>
      </div>
	
	</div>
  </div>
  
  </div>
	
    </div>
  </div>
</body>
</html>