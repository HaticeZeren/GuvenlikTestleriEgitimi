<!DOCTYPE HTML>  
<html>
<head>
<style>
</style>
</head>
<body>   
<?php include "menu.php" ?>

<?php

$isim = $cinsiyet= "";
    
if ($_SERVER["REQUEST_METHOD"] == "GET") {
  if (!empty($_GET["isim"])) {
	 $isim = $_GET["isim"];
  } 
  
  if (!empty($_GET["cinsiyet"])) {
	  $cinsiyet = $_GET["cinsiyet"];
  } 
}
?>
<div class="row"  style="padding:20px;">
    <div class="col-sm-4" style="padding:20px;border:3px solid gray;">
	<h2>Reflected Cross Site Scripting (XSS)</h2><br></br>
      <form method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" style="border:1px solid gray;padding:20px;> 
<table ">
<tr>
 <td>İsim:  <input type="text" name="isim"> <br></br></td> 

</tr>
<tr>
  <td><input type="radio" name="cinsiyet" value="female">Female
  <input type="radio" name="cinsiyet" value="male">Male</td>
</tr>
<tr>
<td><br></br><input type="submit" name="Gönder" value="Submit"></td>

 </tr>
</table> 
</form>
<?php
echo "<h2>Çıktı:</h2>";
echo $isim;
echo "<br>";
echo $cinsiyet;
echo "<br>";
?>
    </div>
    <div class="col-sm-8" ">
	<div class="panel-group">
	
  <div class="panel panel-default" style="margin:10px;">
    <div class="panel-heading"><p style="font-size:120%;">XSS(Reflected) NEDİR ?</p></div>
    <div class="panel-body">
	<p>Açılımı Cross-Site Scripting olan XSS saldırıları Reflected XSS ve Stored XSS olmak üzere ikiye ayrılmaktadır.
	 Reflected XSS saldırısı bir web uygulamasının linkinde eğer parametre varsa ve bu parametrenin değeri sayfaya çıktı olarak "yansıtılıyorsa"
	 saldırganların bu mekanizmayı kullanarak kendi değerlerini sayfaya yansıttırması işlemine denir.Reflected kelimesi Türkçe'de "yansıtılmış" anlamına gelmektedir
	 kullanıcıdan gelen verinin ekrana yansıtıldığı bir işleyişe sahip web sitelerinde eğer metin kutusundan ya da link parametresinden gelen verilere karşı bir denetleme uygulanmazsa o siteler Reflected XSS saldırılarına maruz kalabilirler. Çünkü filtre yoksa kötü niyetli bir kullanıcı ilgili noktalara - metin kutusuna ya da link parametresine - javascript kodu girebilir. Javascript kodu girebilmesi demek şu demektir:
	 Saldırgan javascript dilinin verdiği tüm olanakları hedef site üzerinde deneyebilir. 
	 
	</p>
	</div>
  </div>
  
  <div class="panel panel-default" style="margin:10px;">
    <div class="panel-heading"><p style="font-size:120%;"> XSS ZAFİYETİNE HANGİ DURUM/DURUMLAR SEBEP OLUR?</p></div>
    <div class="panel-body">
	  <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#xss_zafiyet">KAYNAK KODU İNCELE</button>
      <div id="xss_zafiyet" class="collapse">
      <img src="xss_reflected.png" class="img-responsive">
	  <p>
	   <ul><li> Kaynak kodda görüldüğü üzere kullanıcının forma girdiği bilgiler form üzerinden $_GET global değişkeni ile alınıyor.
        ve herhangibir filtreleme olmadan değişkene atama yapılıyor yine aynı durum cinsiyet değişkeni içinde
        geçerlidir.Unutulmaması gereken birşey var ise o da asla istemci tarafına güvenmemektir. Kontrolü yapılmadan atanan değer 
        ekrana çıktı olarak yansıtılmaktadır.  kullanıcıdan gelen verinin ekrana yansıtıldığı bir işleyişe sahip web sitelerinde eğer metin kutusundan ya da link parametresinden gelen verilere karşı bir denetleme uygulanmazsa o siteler Reflected XSS saldırılarına maruz kalabilirler. Çünkü filtre yoksa kötü niyetli bir kullanıcı ilgili noktalara - metin kutusuna ya da link parametresine - javascript kodu girebilir. Javascript kodu girebilmesi demek şu demektir:
	   </li></ul> Saldırgan javascript dilinin verdiği tüm olanakları hedef site üzerinde deneyebilir. 		
	  </p>
      </div>

	</div>
  </div>
  
  <div class="panel panel-default" style="margin:10px;">
    <div class="panel-heading"><p style="font-size:120%;"> ZAFİYETİN SALDIRGAN TARAFINDAN SÖMÜRÜLMESİ ÖRNEĞİ</p></div>
    <div class="panel-body">
	 <p>
	 isim alanına 
	<pre><strong> <?php $data = htmlspecialchars("<script>alert('XSS')</script>"); echo "$data";?></strong></pre>ya da 
	 <pre><strong>URL:</strong><?php $data = htmlspecialchars(" http://localhost/yazlab3/xss.php?isim=<script>alert('XSS ZAFIYETI')</script>gender=Submit"); 
	  echo "$data";?></pre>
   herhangi biri girildiği takdirde ekrana javascript kodları yansıtılacaktır ve ardından tarayıcı bu kodları yorumlayıp ekrana bir popup penceresi getirecektir.
	 </p>
	 
	 <p>
	 checkbox kısmına sağ tıklayıp 'öğeyi denetle' seçeneğini tıklayın daha sonra açılacak pencerede 
	 aşağıdaki resimde olduğu gibi value='<strong> <?php $data = htmlspecialchars("  <script>alert('XSS')</script>");echo "$data";
	 ?></strong>' yazıp ENTER basın ve submit seçeneğine tıklayın popup penceresinin çıktığını göreceksiniz.
	 <img src="check.png" class="img-responsive">
	 </p>
	</div>
  </div>
  
  
   <div class="panel panel-default" style="margin:10px;">
    <div class="panel-heading"><p style="font-size:120%;">ALINACAK ÖNLEM NEDİR?</p></div>
    <div class="panel-body">
	<button type="button" class="btn btn-info" data-toggle="collapse" data-target="#xss_iyilestirme">KAYNAK KODDAKİ İYİLEŞTİRME</button>
      <div id="xss_iyilestirme" class="collapse">
       <img src="xss_duzeltme.png" class="img-responsive">
	   
	   <p><ul>
	   <li>16. ve 20. satırda XSS Reflected açığına karşı alınan önlem açıkca görülmektedir.
		htmlspecialchars() fonksiyonu kullanılarak istemci tarafından alınan girdilerde herhangibir
		javascript yada HTML kodunu etkisiz hale getirmektedir böylelikle saldırgan amacına ulaşamaz.
	    </li>
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
      </div>
	
	</div>
  </div>
  
  </div>
	
    </div>
  </div>
</body>
</html>