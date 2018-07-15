<style>
</style>
</head>
<body>  
<?php include "menu.php" ?>


  


<div class="container" style="margin-top:30px;">
    <div class="panel panel-default">
      <div class="panel-body">
     
	 
	  <div class="row" >
    <div class="col-lg-1" ></div>
        <div class="col-lg-10" >
		<div class="icerik">

 <h1  align="center" style="color:#663300;">KURULUM DÖKÜMANTASYONU </h1>
<hr style="border-color:grey ; margin-left:-10px;"></hr>
<p style="margin-left:-30px;">  Projenin eksiksiz çalışabilmesi için aşağıda anlatılan adımların eksiksiz olarak yapılması gereklidir. Aksi halde projeden istenilen sonuç alınamaz, ya da
eksik çalışabilir. </br>
 </p>
            
<ul>
<li>
<h3 style="margin-left:-30px; color:#556B2F;">Kurulumun Yapılabileceği İşletim Sistemi</h3>
<p>
Aşagıdaki kurulum bilgileri <strong>Windows İşletim sistemi</strong> içindir.Uygulamadaki Komut Enjeksiyonu çalışmasındaki sömürü örnekleri İşletim sisteminin 
windows olduğu varsayılarak verilmiştir.
Uygulama <strong>lunix işletim sistemi</strong>ne localhost kurulumu yapılıp uygulamanın indirdiğiniz klasörünü localhosta yüklediğiniz takdirde Lunix işletim
sisteminde de çalışacaktır.Lunix işletim sistemine wamp server(Lamp Server) kurulumu için Aşağıda verilen linke  <a href="http://www.kodevreni.com/419-ubuntu-wamp-server-lamp-server-kurulumu/">Tıklayınız.</a>
</p>
</li>
<li style="margin-left:-30px; color:#556B2F;">
<h3>Web Sunucu Yazılımının Kurulumu </h3>

</li>
</ul>
<p> Bu projede sunucu için bizim kullandığımız kurulum: WampServer  <img src="wamp.png" class="img-responsive"  width="100" height="100"></br> WampServer, kendi bilgisayarımız üzerinden bir sunucu oluşturarak internet adresimiz varmış gibi web site yapmamıza yardımcı olan sunucudur. 
Wampserver windows için hazırlanmış olan bir paket kurulumudur ve xampp , apache gibi localhost programıdır. 
 Diğer programlardan farkı ise daha gelişmiş ve içerisinde Apache , Php , Mysql kurulumları bulunmaktadır. 
 </br> Wamp'ı indirmek için adrese <a href="http://www.wampserver.com/en/#download-wrapper"> buradan </a> ulaşabilirsiniz. Kendi bilgisaranızın bitine göre uygun olanı seçip indirebilirsiniz. 
 İnen .exe uzantılı dosyayı çalıştırıyoruz. Çıkan adımlarda dili ve nereye kaydedeceiğinizi soruyor onları belirleyip next diyoruz.Daha sonra Varsayılan internet tarayıcısını seçip next diyoruz.
 En son ise finish deyip bitiriyoruz. Masaüstüne gelen kısayolumuzu çalıştırdıktan sonra güvenlik duvarı uyarısı ile karşılaşabilirsiniz.
 Bu uyarıyı aldığınızda Wamp’ın güvenlik duvarını aşmasına izin vermelisiniz. Çünkü Wamp Server’ın lokal bir sunucu oluşturabilmesi için üstün yetkilere ihtiyacı vardır. İzin verdikten sonra ekranımızın sağ alt köşesinde wampserver'in simgesi belirecek.
 Bu simge ilk kırmızı yanar daha sonra sarı (bu hazırlandığını gösterir) ve sonra yeşil yanar ve wampserverımız çalışıyordur.
 Şimdi wampserver'in dosya konumunu açıp içerde www adlı bir klasör göreceksiniz. Aşağıdaki resimde gösterilmiştir:</br> 
 </br><img src="wamp2.png" class="img-responsive"  width="400" height="500"></br>
 Bizi localhost'ta sitemizi görebilmemiz için bu www klasörünün içine tüm dosyalarımızı atmamız gereklidir.
 Yoksa oluşturduğumuz web siteyi göremeyiz. Bu projenin çalışması içinde proje klasörü içindeki .php uzantılı dosyaları , ilgili resimleri www klasörünün içine atmamız gereklidir. 
  Localhost dediğimiz sistem, bir sunucu içerisinde yer alan ve web sitelerinin çalışması için olmazsa olmaz programları da bilgisayarına otomatik olarak kurarak kullanmanıza yarar. Fakat sadece kişisel bilgisayarla sınırlı bir servistir. Yani çalışmalarımızı kendimiz görebilmemiz için kullanmak amaçlıdır.
 Kurduğumuz wampserver ise paket programıdır ve bir hosting içerisinde kullanılan tüm yazılımlar otomatik olarak bilgisayarınıza da kurulacaktır. Sonuç olarak da localhost umuz bize wampserver aracılığı ile gelmiştir zaten.
 tek yapmamız gereken tarayımızın url sine localhost yazıp girmek.  </br><img src="wamp3.png" class="img-responsive" ></br>
 Bu şekilde girince projelerimiz orda gözükecektir. 
 Web sunucu kurulumu bu şekildeydi. Bu adımları yapmak yeterlidir. </br> </p>
<ul>
<li style="margin-left:-30px; color:#556B2F;">
<h3>Veritabanı Yazılımının Kurulumu </h3>
</li>
</ul>

<p> Projemizin veritabanı bağlantısını WampServer'ın içinde gelen PhpMyAdmin'i kullandık.
</br><img src="wlogo.png" class="img-responsive"  width="200" height="500"></br> 
PhpMyAdmin'e girmek için url yerine localhost/phpmyadmin yazılır. </br>
</br><img src="php.png" class="img-responsive"  width="400" height="600"></br> 
Burada kullanıcı adı = root parola kısmı ise boş kalıyor. Git dediğimizde veritabanımız açılıyor. Burada tablolarımızı oluşturuyoruz. 

</p>
</br>


<ul>
<li>
<h2 style="margin-left:-30px; color:#556B2F;">Veritabanının Kurulumu</h2>
<p>Zayıf Web Uygulamaları projesindeki veritabanı ile bağlantılı uygulamaları çalıştırmak için veritabanı kurulumu
yapılması gerekmektedir. Aşağıdaki linkten .sql dosyasını indiriniz. 
<pre><a href="veritabani.sql">sql dosyasını indirmek için tıklayınız.</a></pre>
Tarayıcınızın <strong>URL</strong> kısmına http://localhost/phpmyadmin/ adresini giriniz PhpMyAdmin sayfasında içe aktar
kısmından az önce indirmiş olduğunuz .sql dosyasını içeri aktarınız.<br />
<img src="sql.png" class="responsive" width="500" height="300"><br />
Bu şekilde uygulamanın veritabanı kurulumunu gerçekleştirmiş oldunuz.
Aşağıdaki butonu kullanrakta veritabanı kurulumunu gerçekleştirebilir veya çalışma esnasında kirlenmiş veritabanını
temizleyebilirsiniz.<br />
<a href="veritabani_kur.php"><button type="button">VERİTABANI KUR/TEMİZLE</button></a>
</p></li>
<li><h2 style="margin-left:-30px; color:#556B2F;">Uygulamanın Kurulumu</h2></li>
<strong>Windows için:</strong><br />
<li>Proje dosyasını bilgisayarınıza indiriniz.</li>
<li><strong>C:\wamp64\www</strong> dizinine indirmiş olduğunuz proje klasörünü kayıt ediniz.</li>
<li>Uygulamanın doğru çalışabilmesi için veritabanı kurulumu tamamlanmış olmalıdır.</li>
<li>Wampserverı aktif ettikten sonra tarayıcınızın  URL kısmına <strong>localhost/yazlab3/anasayfa.php</strong> yazıp ENTER bastığınızda 
localhostda uygulamanın kurulumu gerçekleşmiş olacaktır.</li>
</ul>

</div>

</div>	    
<div class="col-lg-1"></div>
	  
  </div>	 
     </div>
    </div>
</div>


</body>
</html>
