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
   $kara_liste = array( //ip adresi içerisine enjekte edilmeye çalışılan
        "&",       // CMD de anlamı olan karakterler kara listeye alındı.
        ";", 
        "| ", 
        "-", 
        "$", 
        "(", 
        ")", 
        "`", 
        "||", 
    ); 
   
if ($_SERVER["REQUEST_METHOD"] == "GET") {
  if (!empty($_GET["ip"])) {
	 $ip = $_GET["ip"];
  }
  
    $ip= str_replace($kara_liste,"",$ip );
	// $ip değişkeninden siyah listede yer alan karakterleri silmektedir. 
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
<td><br></br><input type="submit" name="Gönder" value="Submit"></td>

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
	  
	  
      </div>

	</div>
  </div>
  
  <div class="panel panel-default" style="margin:10px;">
    <div class="panel-heading"><p style="font-size:120%;"> ZAFİYETİN SALDIRGAN TARAFINDAN SÖMÜRÜLMESİ ÖRNEĞİ</p></div>
    <div class="panel-body">
	
	
	</div>
  </div>
  
  
   <div class="panel panel-default" style="margin:10px;">
    <div class="panel-heading"><p style="font-size:120%;">ALINACAK ÖNLEM NEDİR?</p></div>
    <div class="panel-body">
	<button type="button" class="btn btn-info" data-toggle="collapse" data-target="#xss_iyilestirme">KAYNAK KODDAKİ İYİLEŞTİRME</button>
      <div id="xss_iyilestirme" class="collapse">
       <img src="#.png" class="img-responsive">
	   

      </div>
	
	</div>
  </div>
  
  </div>
	
    </div>
  </div>
</body>
</html>