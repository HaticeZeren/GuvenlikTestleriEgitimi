<!DOCTYPE HTML>  
<html>
<head>
<style>
</style>
</head>
<body>  
<?php include "menu.php" ?>

<?php

$ip = $cikti = "";
if ($_SERVER["REQUEST_METHOD"] == "GET") {
  if (!empty($_GET["ip"])) {
	 $ip = $_GET["ip"];
  }
	 if(stristr( php_uname( 's' ), 'Windows NT' )){
		 
		//işletim sisteminin windows olup olamdığının kontrolü yapılıyor.
		 $komut=shell_exec( 'ping  ' . $ip );
		 //PHP'de shell_exec() fonksiyonu ile windowsda CMD komutlarını 
		 //çalıştırmamızı sağlıyor.Fakat görüldüğü üzere $ip değişkenine
		 //herhangibir filtreleme işlemi yapılmıyor
	 }
	 else {
		 //diğer işletim sistemlerinde
		 $komut=shell_exec( 'ping  -c 4 ' . $ip );
	 }
   
  
}
?>

<div class="row"  style="padding:20px;">
    <div class="col-sm-4" style="padding:20px;border:3px solid gray;">
	<h2>Komut Enjeksiyonu (Command Injection)</h2><br></br>
      <form method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" style="border:1px solid gray;padding:20px;> 
<table ">
<tr>
 <td>IP:  <input type="text" name="ip"> <br></br></td> 

</tr>
<tr>
<td><br></br><input type="submit" name="submit" value="Submit"></td>

 </tr>
</table> 
</form>
<?php
if(!empty($komut)){
echo "<h2>Çıktı:</h2>";
echo "<pre>$komut</pre>";
$komut="";
}
?>
    </div>
    <div class="col-sm-8" ">
	<div class="panel-group">
	
  <div class="panel panel-default" style="margin:10px;">
    <div class="panel-heading"><p style="font-size:120%;">KOMUT ENJEKSİYONU (Command Injection) NEDİR ?</p></div>
    <div class="panel-body">
	<p>
	Command Injection, yani komut enjeksiyonu saldırganın zafiyet barındıran bir uygulama üzerinden hedef sistemde dilediği komutları çalıştırabilmesine denir. Komut ile kastedilen şey Windows'ta CMD ve Linux'ta Terminal pencerelerine girilen sistem komutlarıdır.Command Injection saldırısı 
	büyük oranda yetersiz input denetleme mekanizması nedeniyle gerçekleşmektedir.
	</p>
	 
	</div>
  </div>
  
  <div class="panel panel-default" style="margin:10px;">
    <div class="panel-heading"><p style="font-size:120%;"> KOMUT ENJEKSİYONU ZAFİYETİNE HANGİ DURUM/DURUMLAR SEBEP OLUR?</p></div>
    <div class="panel-body">
	  <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#xss_zafiyet">KAYNAK KODU İNCELE</button>
      <div id="xss_zafiyet" class="collapse">
      <img src="komut.png" class="img-responsive">
	  <p><br />
	   <ul> <li> Formdan $_GET global değişkeni ile alınan IP değeri herhangibir bloklama/filtreleme
	   işlemine tabi tutulmadan 16. satırda görüldüğü üzere $ip değişkenine atanmıştır.Burada Komut enjeksiyonu 
	   zafiyetini ortaya çıkaran asıl nokta kullanıcıdan alınan herhangi bir filtereleme yapılmayan IP numarasının
	   21. satırda görüldüğü üzere <pre><strong>shell_exec( 'ping  ' . $ip );</strong></pre> fonksiyonu sayesinde saldırgan komut satırı
	   kodlama bilgisini  kullanarak var olan ping komutunun yanına kendi komutunu ekleyebilir.Böylelikle ping komutunu çalıştıran sunucu istemeden saldırganın gönderdiği komutu da çalıştıracaktır ve ekrana yansıtacağı çıktının içinde saldırganın eklediği komutun çıktısı da yer alacaktır.
	  </li></ul>
	  </p>
      </div>

	</div>
  </div>
  
  <div class="panel panel-default" style="margin:10px;">
    <div class="panel-heading"><p style="font-size:120%;"> ZAFİYETİN SALDIRGAN TARAFINDAN SÖMÜRÜLMESİ ÖRNEĞİ</p></div>
    <div class="panel-body">
	 <p>
	  Windows için saldırganın zafiyeti kullanarak nasıl istediği CMD komutlarını çalıştırabileceğine dair bir örnek yapalım.
	  <pre>127.0.0.1 && systeminfo </pre> metin kutusuna yapıştırınız.Komutta IP adresine && yardımıyla  <strong>systeminfo</strong>
	  komutunu göndermektedir.Bu şekilde saldırgan sistem bilgilerine erişimi sağlayan CMD komutunu komut enjeksiyonu zafiyeti olan web uygulamalarına enjekte etmektedir. Verilen çıktı bilgisinde 
      bu bilgileri rahatlıkla elde edebildiğimizi görmekteyiz.
	   <pre><strong>URL:</strong>http://localhost/yazlab3/command_enjection.php?ip=127.0.0.1%26%26systeminfo&submit=Submit</pre>
	   Formdan bilgiler GET metodu ile alındığından metin kutusuna veri yazmakla URL den veriyi göndermek aynı işlemi gerçekleştirir.
	   Tarayıcınızın link kısmına verilen URL yazdığınızda aynı çıktıyı elde edebilirsiniz.
	 </p>
	</div>
  </div>
  
  
   <div class="panel panel-default" style="margin:10px;">
    <div class="panel-heading"><p style="font-size:120%;">ALINACAK ÖNLEM NEDİR?</p></div>
    <div class="panel-body">
	<button type="button" class="btn btn-info" data-toggle="collapse" data-target="#xss_iyilestirme">KAYNAK KODDAKİ İYİLEŞTİRME</button>
      <div id="xss_iyilestirme" class="collapse">
       <img src="com_duz.png" class="img-responsive">
	   <p><br />
	   <ul>
       <li> 13. satırda  kara_liste olarak tanımlanmış bir Array(dizi) bulunmaktadır.Kara liste güvenlik önleminin çalışma mantığı:<strong> "Kara listede olanları sil, gerisini çek".</strong>
		şeklindedir.Görüldüğü üzere CMD/terminal komutlarını çalıştırmak için bağlayıcı etkisi olan simgeler listelenmiştir.
		30.satırda ise IP değişkeninde kara listede bulunan herhangibir karakter tespit edilip silinmektedir.
		Böylelikle saldırganın komut enjeksiyonu yapması engellenmek istenmiştir.
	   </li></ul>
	   </p>
      </div>
	
	</div>
  </div>
  
  </div>
	
    </div>
  </div>
</body>
</html>