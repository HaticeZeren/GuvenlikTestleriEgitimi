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
$isim = $email  = $mesaj =  "";
if ($_SERVER["REQUEST_METHOD"] == "GET") {
  if (!empty($_GET["isim"])) {
     $isim = $_GET["isim"];
  }
  
  if (!empty($_GET["email"])) {
     $email = $_GET["email"];
  }
  if (!empty($_GET["mesaj"])) {
     $mesaj = $_GET["mesaj"];
  } 
}
?>
<?php 
$baglan=@mysql_connect("localhost","root","");
if($baglan){
	$veritabani=@mysql_select_db("veritabani",$baglan);
	if($veritabani){
		if(!empty($isim) && !empty($mesaj)){
	    mysql_query("SET NAMES UTF8");//türkçe karakter sorunu için gereklidir.
		$ekle=@mysql_query("INSERT INTO yorumlar ( isim,email,mesaj ) VALUES ( '$isim','$email','$mesaj' )");
		}
	}
}
mysql_close($baglan);
?>
<div class="row"  style="padding:20px;">
    <div class="col-sm-4" style="padding:20px;border:3px solid gray;">
	<h2>Stored Cross Site Scripting (XSS)</h2><br></br>
      <form method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
<table  cellpadding="5"  cellspacing="5">
<tr>
 <td>İsim:</td><td> <input type="text" name="isim"><br></br>
</td>
  

</tr>
<tr>
  <td>E-mail:</td><td> <input type="text" name="email"><br></br>
</td>
  

</tr>
<tr>
  <td>Mesaj:</td><td> <textarea name="mesaj" rows="5" cols="30"></textarea><br></br>
</td>
</tr>
<tr>
<td><input type="submit" name="Gönder" value="Submit"></td>
 </tr>
</table> 
</form>
<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
$baglan=@mysql_connect("localhost","root","");
$veritabani=@mysql_select_db("veritabani",$baglan);
echo "<h2>Çıktı:</h2>";
//veritabanından çekip ekrana yaz!!
 mysql_query("SET NAMES UTF8");//türkçe karakter sorunu için gereklidir.
$sorgu=mysql_query("select * from yorumlar");
while($yaz=mysql_fetch_array($sorgu)){
	echo "Gönderen :". $yaz['isim']."<br />";
	echo "email :".$yaz['email']."<br />";
	echo "Yorum :".$yaz['mesaj']."<hr />";
}
mysql_close($baglan);
}
?>
    </div>
    <div class="col-sm-8" ">
	<div class="panel-group">
	
  <div class="panel panel-default" style="margin:10px;">
    <div class="panel-heading"><p style="font-size:120%;">XSS(Stored) NEDİR ?</p></div>
    <div class="panel-body">
	<p>Açılımı Cross-Site Scripting olan XSS saldırıları Reflected XSS ve Stored XSS olmak üzere ikiye ayrılmaktadır.
	 Stored XSS saldırısı, bir web uygulamasının veri giriş noktalarında eğer denetleme/filtreleme/bloklama mekanizması 
	 yoksa saldırganın bu veri giriş noktasına javascript kodu girerek veritabanına kaydettirmesi işlemine denir. 
	 Bu XSS saldırısına Stored denmesinin nedeni saldırgan tarafından girilen kodun veritabanına kaydoluyor oluşundandır. 
	</p>
	</div>
  </div>
  
  <div class="panel panel-default" style="margin:10px;">
    <div class="panel-heading"><p style="font-size:120%;"> XSS ZAFİYETİNE HANGİ DURUM/DURUMLAR SEBEP OLUR?</p></div>
    <div class="panel-body">
	  <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#xss_zafiyet2">KAYNAK KODU İNCELE</button>
      <div id="xss_zafiyet2" class="collapse">
      <img src="xss_stored.png" class="img-responsive">
	  <p><ul><li>
	  17,21 ve 24. satırlarda istemci tarafından alınan bilgilere herhangibir filtreleme yapılmaksızın
	  değişkenlere ataması yapılmış 37. satırda da görüldüğü üzere SQL komutuyla veritabanına kayıt yapılmıştır.XSS Stored,
	  saldırganın bu veri giriş noktasına javascript kodu girerek veritabanına kaydettirmesi işlemine denir.
	 </li></ul> </p>
      </div>

	</div>
  </div>
  
  <div class="panel panel-default" style="margin:10px;">
    <div class="panel-heading"><p style="font-size:120%;"> ZAFİYETİN SALDIRGAN TARAFINDAN SÖMÜRÜLMESİ ÖRNEĞİ</p></div>
    <div class="panel-body">
	<p>
	 <p>
	 isim,email veya mesaj alanına 
	<pre><strong> <?php $data = htmlspecialchars("  <script>alert()</script>"); 
	  echo "$data";
	 ?></strong></pre>
	 <pre><strong>URL:</strong><?php $data = htmlspecialchars("http://localhost/yazlab3/xss_stored.php?isim=XSS&email=&mesaj=<script>alert()</script>&G%C3%B6nder=Submit"); 
	  echo "$data";?></pre>
   herhangi biri girildiği takdirde veritabanına javascript kodları kayıt edilmiş olup saldırgan amacına ulaşmış olacaktır.
	 </p>
	</p>
	</div>
  </div>
  
  
   <div class="panel panel-default" style="margin:10px;">
    <div class="panel-heading"><p style="font-size:120%;">ALINACAK ÖNLEM NEDİR?</p></div>
    <div class="panel-body">
	<button type="button" class="btn btn-info" data-toggle="collapse" data-target="#xss_iyilestirme2">KAYNAK KODDAKİ İYİLEŞTİRME</button>
      <div id="xss_iyilestirme2" class="collapse">
       <img src="xss_stored_duz.png" class="img-responsive">
	   <p><ul>
	    <li>25.satırda bulunan veri_duzelt() fonksiyonundaki trim();stripcslashes() ve htmlspecialchars();
		fonksiyonlarını kullanarak filtreleme yapmaktadır.</li>
	   </p><br />
	    <p><li>
	   htmlspecialchars() fonksiyonu nedir?
	   Html’deki bazı ön tanımlı karakterleri html entity’lerine dönüştürür.

Ön tanımlı karakterler ve html entity’leri aşağıdaki gibidir.
<ul>
<li>& (ampersand) işareti<strong> <?php echo htmlspecialchars("&amp;") ?></strong> olur.</li>
<li>” (çift tırnak) işareti <strong><?php echo htmlspecialchars("&quot; ") ?></strong> olur.</li>
<li>‘ (tek tırnak) işareti <strong><?php echo htmlspecialchars(" &#039;") ?></strong> olur.</li>
<li>< (küçüktür) işareti<strong> <?php echo htmlspecialchars("&lt;") ?></strong>  olur.</li>
<li>> (büyüktür) işareti <strong><?php echo htmlspecialchars("&gt;") ?></strong>  olur.</li>
</ul>
	   </li></ul></p>
	   
	   <ul>
	   <li>
	   trim() fonksiyonu stringin başındaki ve sonundaki boşlukları veya silinmesini istediğiniz karakterleri siler. Genellikle kullanıcının üye olurken, bilgilerinin başına veya sonuna yanlışlıkla eklenen boşluk karakterini temizlemek amacıyla kullanılır.
	   </li>
	   </ul>
	   
	   <ul>
	   <li>stripslashes() fonksiyonu bir değerdeki ters bölü (\) işaretini temizlemek için kullanılır.
	   </li>
	   </ul>
      </div>
	
	</div>
  </div>
  
  </div>
	
    </div>
  </div>
</body>
</html>