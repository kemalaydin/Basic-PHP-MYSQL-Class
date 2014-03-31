Basit Temel PHP MySQL Sınıfı Kullanımı
=====================

Kullanacağınız sayfaya öncelikle dosyayı dahil ediniz ;

"<?php require_once('db.class.php'); ?>"

Database sınıfını kullanabilmeniz için öncelikle dosyanızda sınıfı çağırın ;

"<?php $SqlClass = new dbClass(); ?>"

İşlem yapabilmek için öncelikel Database ile iletişim kurun ; 

"$SqlClass->dbConnect("Sunucu Adresi ( Genellikle Localhost ) "," Database Kullanıcı Adı "," Database Şifresi "," Seçilecek Database "," Hata Mesajı ");"

Yukarıda belirtilen alanlardan Sunucu Adresi , Database Kullanıcı Adı , Database Şifresi ( Şifreniz yok ise "" şeklinde boş bırakmanız yeterli olacaktır ) doldurulması zorunlu alanlar olup Seçilecek Database bölümünü boş bırakmanız durumunda alt sorgular işe yaramayacaktır. Bundan dolayı boş bırakılmaması tavsiye edilmektedir. Hata Mesajı ise seçiminize bağlı olmakla beraber boş bırakıldığı taktirde class tarafından atanmış hata mesajı verilecektir.

Mysql_query fonksiyonunu Çağırma ;

"<?php 
  
  $idA = 4;
  
  $dizi = array(
    	"table" => "games",
    	"columns" => "id",
    	"where" => "Adi = 'Kemal' && Soyadi = 'Aydin' || id = $idA",
      "OrderBy"=> "id",
      "OrderByP" = "+"
	);
	echo $SqlClass->query($dizi," İstenilen Sütun ");
	?> "
	
	Yukarıda bulunan alanlardan dizi değişkeni içerisinde bulunan table tablo adını belirtir ve zorunludur, columns seçilecek sütun adını belirtir zorunludur ( Bütün sutunları çekmek için * işareti koymanız gerekmektedir ), where alanı ise koyacağınız şartları belirtir zorunlu değildir - string veriler için tek tırnak kullanmanız gerekmektedir - , orderBy alanı zorunlu olmamakla beraber hangi sütuna göre sıralanacağını belirtir, ortderByP ise + veya - değer almaktadır. + değer çoğalana - değer azalana anlamına gelmektedir.
	
	Mysql_num_rows fonksiyonu çağırma ;
	"<?php 
  	$dizi = array(
      	"table" => "games",
      	"columns" => "id"
  	);
  	echo $SqlClass->rows($dizi);
  	?>"
