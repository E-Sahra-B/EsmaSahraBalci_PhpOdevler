<?php
ob_start();
session_start();
require_once 'baglan.php';
include '../production/fonksiyon.php';


if (isset($_POST['genelayarkaydet'])) {
	$ayarkaydet = $db->prepare("UPDATE ayar SET
		ayar_title=:ayar_title,
		ayar_description=:ayar_description,
		ayar_keywords=:ayar_keywords,
		ayar_author=:ayar_author
		WHERE ayar_id=0");
	$update = $ayarkaydet->execute(array(
		'ayar_title' => $_POST['ayar_title'],
		'ayar_description' => $_POST['ayar_description'],
		'ayar_keywords' => $_POST['ayar_keywords'],
		'ayar_author' => $_POST['ayar_author']
	));
	if ($update) {
		header("Location:../production/genel-ayar.php?durum=ok");
	} else {
		header("Location:../production/genel-ayar.php?durum=no");
	}
}

if (isset($_POST['iletisimayarkaydet'])) {
	$ayarkaydet = $db->prepare("UPDATE ayar SET
		ayar_tel=:ayar_tel,
		ayar_gsm=:ayar_gsm,
		ayar_faks=:ayar_faks,
		ayar_mail=:ayar_mail,
		ayar_ilce=:ayar_ilce,
		ayar_il=:ayar_il,
		ayar_adres=:ayar_adres,
		ayar_mesai=:ayar_mesai
		WHERE ayar_id=0");
	$update = $ayarkaydet->execute(array(
		'ayar_tel' => $_POST['ayar_tel'],
		'ayar_gsm' => $_POST['ayar_gsm'],
		'ayar_faks' => $_POST['ayar_faks'],
		'ayar_mail' => $_POST['ayar_mail'],
		'ayar_ilce' => $_POST['ayar_ilce'],
		'ayar_il' => $_POST['ayar_il'],
		'ayar_adres' => $_POST['ayar_adres'],
		'ayar_mesai' => $_POST['ayar_mesai']
	));
	if ($update) {
		header("Location:../production/iletisim-ayarlar.php?durum=ok");
	} else {
		header("Location:../production/iletisim-ayarlar.php?durum=no");
	}
}

if (isset($_POST['apiayarkaydet'])) {
	$ayarkaydet = $db->prepare("UPDATE ayar SET
		ayar_analystic=:ayar_analystic,
		ayar_maps=:ayar_maps,
		ayar_zopim=:ayar_zopim
		WHERE ayar_id=0");
	$update = $ayarkaydet->execute(array(
		'ayar_analystic' => $_POST['ayar_analystic'],
		'ayar_maps' => $_POST['ayar_maps'],
		'ayar_zopim' => $_POST['ayar_zopim']
	));
	if ($update) {
		header("Location:../production/api-ayarlar.php?durum=ok");
	} else {
		header("Location:../production/api-ayarlar.php?durum=no");
	}
}

if (isset($_POST['sosyalayarkaydet'])) {
	$ayarkaydet = $db->prepare("UPDATE ayar SET
		ayar_facebook=:ayar_facebook,
		ayar_twitter=:ayar_twitter,
		ayar_youtube=:ayar_youtube,
		ayar_google=:ayar_google
		WHERE ayar_id=0");
	$update = $ayarkaydet->execute(array(
		'ayar_facebook' => $_POST['ayar_facebook'],
		'ayar_twitter' => $_POST['ayar_twitter'],
		'ayar_youtube' => $_POST['ayar_youtube'],
		'ayar_google' => $_POST['ayar_google']
	));
	if ($update) {
		header("Location:../production/sosyal-ayar.php?durum=ok");
	} else {
		header("Location:../production/sosyal-ayar.php?durum=no");
	}
}

if (isset($_POST['mailayarkaydet'])) {
	$ayarkaydet = $db->prepare("UPDATE ayar SET
		ayar_smtphost=:smtphost,
		ayar_smtpuser=:smtpuser,
		ayar_smtppassword=:smtppassword,
		ayar_smtpport=:smtpport
		WHERE ayar_id=0");
	$update = $ayarkaydet->execute(array(
		'smtphost' => $_POST['ayar_smtphost'],
		'smtpuser' => $_POST['ayar_smtpuser'],
		'smtppassword' => $_POST['ayar_smtppassword'],
		'smtpport' => $_POST['ayar_smtpport']
	));
	if ($update) {
		Header("Location:../production/mail-ayar.php?durum=ok");
	} else {
		Header("Location:../production/mail-ayar.php?durum=no");
	}
}

if (isset($_POST['hakkimizdakaydet'])) {
	$ayarkaydet = $db->prepare("UPDATE hakkimizda SET
		hakkimizda_baslik=:hakkimizda_baslik,
		hakkimizda_icerik=:hakkimizda_icerik,
		hakkimizda_video=:hakkimizda_video,
		hakkimizda_vizyon=:hakkimizda_vizyon,
		hakkimizda_misyon=:hakkimizda_misyon
		WHERE hakkimizda_id=0");
	$update = $ayarkaydet->execute(array(
		'hakkimizda_baslik' => $_POST['hakkimizda_baslik'],
		'hakkimizda_icerik' => $_POST['hakkimizda_icerik'],
		'hakkimizda_video' => $_POST['hakkimizda_video'],
		'hakkimizda_vizyon' => $_POST['hakkimizda_vizyon'],
		'hakkimizda_misyon' => $_POST['hakkimizda_misyon']
	));
	if ($update) {
		header("Location:../production/hakkimizda.php?durum=ok");
	} else {
		header("Location:../production/hakkimizda.php?durum=no");
	}
}

if (isset($_POST['admingiris'])) {
	$kullanici_mail = $_POST['kullanici_mail'];
	$kullanici_password = trim($_POST["kullanici_password"]);
	$kullanicisor = $db->prepare("SELECT * FROM kullanici 
	where kullanici_mail=:mail and kullanici_yetki=:yetki");
	$kullanicisor->execute(array(
		'mail' => $kullanici_mail,
		'yetki' => 5
	));
	$kayit = $kullanicisor->fetch(PDO::FETCH_ASSOC);
	if (password_verify($kullanici_password, $kayit["kullanici_password"])) {
		$_SESSION['kullanici_mail'] = $kullanici_mail;
		header("Location:../production/index.php");
		exit;
	} else {
		header("Location:../production/login.php?durum=no");
		exit;
	}
}

if (isset($_POST['kullaniciduzenle'])) {
	$kullanici_id = $_POST['kullanici_id'];
	$ayarkaydet = $db->prepare("UPDATE kullanici SET
		kullanici_gsm=:kullanici_gsm,
		kullanici_adsoyad=:kullanici_adsoyad,
		kullanici_durum=:kullanici_durum
		WHERE kullanici_id={$_POST['kullanici_id']}");
	$update = $ayarkaydet->execute(array(
		'kullanici_gsm' => $_POST['kullanici_gsm'],
		'kullanici_adsoyad' => $_POST['kullanici_adsoyad'],
		'kullanici_durum' => $_POST['kullanici_durum']
	));
	if ($update) {
		Header("Location:../production/kullanici-duzenle.php?kullanici_id=$kullanici_id&durum=ok");
	} else {
		Header("Location:../production/kullanici-duzenle.php?kullanici_id=$kullanici_id&durum=no");
	}
}

if (isset($_GET['kullanicisil'])) {
	$sil = $db->prepare("DELETE from kullanici where kullanici_id=:id");
	$kontrol = $sil->execute(array(
		'id' => $_GET['kullanici_id']
	));
	if ($kontrol) {
		header("location:../production/kullanici.php?sil=ok");
	} else {
		header("location:../production/kullanici.php?sil=no");
	}
}

if (isset($_POST['menuduzenle'])) {
	$menu_id = $_POST['menu_id'];
	$menu_seourl = seo($_POST['menu_ad']);
	$ayarkaydet = $db->prepare("UPDATE menu SET
		menu_ad=:menu_ad,
		menu_detay=:menu_detay,
		menu_url=:menu_url,
		menu_sira=:menu_sira,
		menu_seourl=:menu_seourl,
		menu_durum=:menu_durum
		WHERE menu_id={$_POST['menu_id']}");
	$update = $ayarkaydet->execute(array(
		'menu_ad' => $_POST['menu_ad'],
		'menu_detay' => $_POST['menu_detay'],
		'menu_url' => $_POST['menu_url'],
		'menu_sira' => $_POST['menu_sira'],
		'menu_seourl' => $menu_seourl,
		'menu_durum' => $_POST['menu_durum']
	));
	if ($update) {
		Header("Location:../production/menu-duzenle.php?menu_id=$menu_id&durum=ok");
	} else {
		Header("Location:../production/menu-duzenle.php?menu_id=$menu_id&durum=no");
	}
}

if (isset($_GET['menusil']) == "ok") {
	islemkontrol();
	$sil = $db->prepare("DELETE from menu where menu_id=:id");
	$kontrol = $sil->execute(array(
		'id' => $_GET['menu_id']
	));
	if ($kontrol) {
		header("location:../production/menu.php?sil=ok");
	} else {
		header("location:../production/menu.php?sil=no");
	}
}

if (isset($_POST['menukaydet'])) {
	$menu_seourl = seo($_POST['menu_ad']);
	$ayarekle = $db->prepare("INSERT INTO menu SET
		menu_ad=:menu_ad,
		menu_detay=:menu_detay,
		menu_url=:menu_url,
		menu_sira=:menu_sira,
		menu_seourl=:menu_seourl,
		menu_durum=:menu_durum
		");
	$insert = $ayarekle->execute(array(
		'menu_ad' => $_POST['menu_ad'],
		'menu_detay' => $_POST['menu_detay'],
		'menu_url' => $_POST['menu_url'],
		'menu_sira' => $_POST['menu_sira'],
		'menu_seourl' => $menu_seourl,
		'menu_durum' => $_POST['menu_durum']
	));
	if ($insert) {
		Header("Location:../production/menu-ekle.php?durum=ok");
	} else {
		Header("Location:../production/menu-ekle.php?durum=no");
	}
}

if (isset($_POST['logoduzenle'])) {
	if ($_FILES['ayar_logo']['size'] > 1048576) {
		echo "Bu dosya boyutu çok büyük";
		Header("Location:../production/genel-ayar.php?durum=dosyabuyuk");
	}
	$izinli_uzantilar = array('jpg', 'gif', 'png');
	$ext = strtolower(substr($_FILES['ayar_logo']["name"], strpos($_FILES['ayar_logo']["name"], '.') + 1));
	if (in_array($ext, $izinli_uzantilar) === false) {
		echo "Bu uzantı kabul edilmiyor";
		Header("Location:../production/genel-ayar.php?durum=formathata");
		exit;
	}
	$uploads_dir = '../../img';
	@$tmp_name = $_FILES['ayar_logo']["tmp_name"];
	@$name = $_FILES['ayar_logo']["name"];
	$benzersizsayi = rand(10000, 11000);
	$refimgyol = substr($uploads_dir, 6) . "/" . $benzersizsayi . $name;
	@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizsayi$name");
	$duzenle = $db->prepare("UPDATE ayar SET
		ayar_logo=:logo
		WHERE ayar_id=0");
	$update = $duzenle->execute(array(
		'logo' => $refimgyol
	));
	if ($update) {
		$resimsilunlink = $_POST['eski_yol'];
		unlink("../../$resimsilunlink");
		Header("Location:../production/genel-ayar.php?durum=ok");
	} else {
		Header("Location:../production/genel-ayar.php?durum=no");
	}
}

if (isset($_POST['sliderkaydet'])) {
	$uploads_dir = '../../img/slider';
	@$tmp_name = $_FILES['slider_resimyol']["tmp_name"];
	@$name = $_FILES['slider_resimyol']["name"];
	$benzersizsayi1 = rand(10000, 11000);
	$benzersizsayi2 = rand(10000, 11000);
	$benzersizsayi3 = rand(10000, 11000);
	$benzersizsayi4 = rand(10000, 11000);
	$benzersizad = $benzersizsayi1 . $benzersizsayi2 . $benzersizsayi3 . $benzersizsayi4;
	$refimgyol = substr($uploads_dir, 6) . "/" . $benzersizad . $name;
	@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");
	$kaydet = $db->prepare("INSERT INTO slider SET
		slider_ad=:slider_ad,
		slider_sira=:slider_sira,
		slider_link=:slider_link,
		slider_resimyol=:slider_resimyol
		");
	$insert = $kaydet->execute(array(
		'slider_ad' => $_POST['slider_ad'],
		'slider_sira' => $_POST['slider_sira'],
		'slider_link' => $_POST['slider_link'],
		'slider_resimyol' => $refimgyol
	));
	if ($insert) {
		Header("Location:../production/slider-ekle.php?durum=ok");
	} else {
		Header("Location:../production/slider-ekle.php?durum=no");
	}
}

if (isset($_POST['sliderduzenle'])) {
	if ($_FILES['slider_resimyol']["size"] > 0) {
		$uploads_dir = '../../img/slider';
		@$tmp_name = $_FILES['slider_resimyol']["tmp_name"];
		@$name = $_FILES['slider_resimyol']["name"];
		$benzersizsayi1 = rand(10000, 11000);
		$benzersizsayi2 = rand(10000, 11000);
		$benzersizsayi3 = rand(10000, 11000);
		$benzersizsayi4 = rand(10000, 11000);
		$benzersizad = $benzersizsayi1 . $benzersizsayi2 . $benzersizsayi3 . $benzersizsayi4;
		$refimgyol = substr($uploads_dir, 6) . "/" . $benzersizad . $name;
		@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");
		$duzenle = $db->prepare("UPDATE slider SET
			slider_ad=:ad,
			slider_link=:link,
			slider_sira=:sira,
			slider_durum=:durum,
			slider_resimyol=:resimyol	
			WHERE slider_id={$_POST['slider_id']}");
		$update = $duzenle->execute(array(
			'ad' => $_POST['slider_ad'],
			'link' => $_POST['slider_link'],
			'sira' => $_POST['slider_sira'],
			'durum' => $_POST['slider_durum'],
			'resimyol' => $refimgyol,
		));
		$slider_id = $_POST['slider_id'];
		if ($update) {
			$resimsilunlink = $_POST['slider_resimyol'];
			unlink("../../$resimsilunlink");
			Header("Location:../production/slider-duzenle.php?slider_id=$slider_id&durum=ok");
		} else {
			Header("Location:../production/slider-duzenle.php?durum=no");
		}
	} else {
		$duzenle = $db->prepare("UPDATE slider SET
			slider_ad=:ad,
			slider_link=:link,
			slider_sira=:sira,
			slider_durum=:durum		
			WHERE slider_id={$_POST['slider_id']}");
		$update = $duzenle->execute(array(
			'ad' => $_POST['slider_ad'],
			'link' => $_POST['slider_link'],
			'sira' => $_POST['slider_sira'],
			'durum' => $_POST['slider_durum']
		));
		$slider_id = $_POST['slider_id'];
		if ($update) {
			Header("Location:../production/slider-duzenle.php?slider_id=$slider_id&durum=ok");
		} else {
			Header("Location:../production/slider-duzenle.php?durum=no");
		}
	}
}

if (isset($_GET['slidersil']) == "ok") {
	islemkontrol();
	$sil = $db->prepare("DELETE from slider where slider_id=:slider_id");
	$kontrol = $sil->execute(array(
		'slider_id' => $_GET['slider_id']
	));
	if ($kontrol) {
		$resimsilunlink = $_GET['slider_resimyol'];
		unlink("../../$resimsilunlink");
		Header("Location:../production/slider.php?durum=ok");
	} else {
		Header("Location:../production/slider.php?durum=no");
	}
}

if (isset($_POST['kullanicikaydet'])) {
	$kullanici_adsoyad = htmlspecialchars($_POST['kullanici_adsoyad']);
	$kullanici_mail = htmlspecialchars($_POST['kullanici_mail']);
	$kullanici_passwordone = $_POST['kullanici_passwordone'];
	$kullanici_passwordtwo = $_POST['kullanici_passwordtwo'];
	if ($kullanici_passwordone == $kullanici_passwordtwo) {
		if (strlen($kullanici_passwordone) >= 6) {
			$kullanicisor = $db->prepare("select * from kullanici where kullanici_mail=:mail");
			$kullanicisor->execute(array(
				'mail' => $kullanici_mail
			));
			$say = $kullanicisor->rowCount();
			if ($say == 0) {
				$password = sha1(md5($kullanici_passwordone));
				$kullanici_yetki = 1;
				$kullanicikaydet = $db->prepare("INSERT INTO kullanici SET
					kullanici_adsoyad=:kullanici_adsoyad,
					kullanici_mail=:kullanici_mail,
					kullanici_password=:kullanici_password,
					kullanici_yetki=:kullanici_yetki
					");
				$insert = $kullanicikaydet->execute(array(
					'kullanici_adsoyad' => $kullanici_adsoyad,
					'kullanici_mail' => $kullanici_mail,
					'kullanici_password' => $password,
					'kullanici_yetki' => $kullanici_yetki
				));
				if ($insert) {
					header("Location:../../index.php?durum=loginbasarili");
				} else {
					header("Location:../../register.php?durum=basarisiz");
				}
			} else {
				header("Location:../../register.php?durum=mukerrerkayit");
			}
		} else {
			header("Location:../../register.php?durum=eksiksifre");
		}
	} else {
		header("Location:../../register.php?durum=farklisifre");
	}
}

if (isset($_POST['kullanicigiris'])) {
	echo $kullanici_mail = htmlspecialchars($_POST['kullanici_mail']);
	echo $kullanici_password = sha1(md5($_POST['kullanici_password']));
	$kullanicisor = $db->prepare("select * from kullanici where 
    kullanici_mail=:mail and 
    kullanici_yetki=:yetki and 
    kullanici_password=:password and 
    kullanici_durum=:durum");
	$kullanicisor->execute(array(
		'mail' => $kullanici_mail,
		'yetki' => 1,
		'password' => $kullanici_password,
		'durum' => 1
	));
	$say = $kullanicisor->rowCount();
	if ($say == 1) {
		echo $_SESSION['userkullanici_mail'] = $kullanici_mail;
		header("Location:../../");
		exit;
	} else {
		header("Location:../../?durum=basarisizgiris");
	}
}

if (isset($_POST['kategoriduzenle'])) {
	$kategori_id = $_POST['kategori_id'];
	$kategori_seourl = seo($_POST['kategori_ad']);
	$kaydet = $db->prepare("UPDATE kategori SET
		kategori_ad=:ad,
		kategori_durum=:kategori_durum,	
		kategori_seourl=:seourl,
		kategori_sira=:sira
		WHERE kategori_id={$_POST['kategori_id']}");
	$update = $kaydet->execute(array(
		'ad' => $_POST['kategori_ad'],
		'kategori_durum' => $_POST['kategori_durum'],
		'seourl' => $kategori_seourl,
		'sira' => $_POST['kategori_sira']
	));
	if ($update) {
		Header("Location:../production/kategori-duzenle.php?durum=ok&kategori_id=$kategori_id");
	} else {
		Header("Location:../production/kategori-duzenle.php?durum=no&kategori_id=$kategori_id");
	}
}

if (isset($_POST['kategoriekle'])) {
	$kategori_seourl = seo($_POST['kategori_ad']);
	$kaydet = $db->prepare("INSERT INTO kategori SET
		kategori_ad=:ad,
		kategori_durum=:kategori_durum,	
		kategori_seourl=:seourl,
		kategori_sira=:sira
		");
	$insert = $kaydet->execute(array(
		'ad' => $_POST['kategori_ad'],
		'kategori_durum' => $_POST['kategori_durum'],
		'seourl' => $kategori_seourl,
		'sira' => $_POST['kategori_sira']
	));
	if ($insert) {
		Header("Location:../production/kategori-ekle.php?durum=ok");
	} else {
		Header("Location:../production/kategori-ekle.php?durum=no");
	}
}

if (isset($_GET['kategorisil']) == "ok") {
	$sil = $db->prepare("DELETE from kategori where kategori_id=:kategori_id");
	$kontrol = $sil->execute(array(
		'kategori_id' => $_GET['kategori_id']
	));
	if ($kontrol) {
		Header("Location:../production/kategori.php?sil=ok");
	} else {
		Header("Location:../production/kategori.php?sil=no");
	}
}

if (isset($_GET['urunsil']) == "ok") {
	$sil = $db->prepare("DELETE from urun where urun_id=:urun_id");
	$kontrol = $sil->execute(array(
		'urun_id' => $_GET['urun_id']
	));
	if ($kontrol) {
		Header("Location:../production/urun.php?sil=ok");
	} else {
		Header("Location:../production/urun.php?sil=no");
	}
}

if (isset($_POST['urunekle'])) {
	$urun_seourl = seo($_POST['urun_ad']);
	$kaydet = $db->prepare("INSERT INTO urun SET
		kategori_id=:kategori_id,
		urun_ad=:urun_ad,
		urun_detay=:urun_detay,
		urun_fiyat=:urun_fiyat,
		urun_video=:urun_video,
		urun_keyword=:urun_keyword,
		urun_durum=:urun_durum,
		urun_onecikar=:urun_onecikar,
		urun_stok=:urun_stok,	
		urun_seourl=:seourl		
		");
	$insert = $kaydet->execute(array(
		'kategori_id' => $_POST['kategori_id'],
		'urun_ad' => $_POST['urun_ad'],
		'urun_detay' => $_POST['urun_detay'],
		'urun_fiyat' => $_POST['urun_fiyat'],
		'urun_video' => $_POST['urun_video'],
		'urun_keyword' => $_POST['urun_keyword'],
		'urun_durum' => $_POST['urun_durum'],
		'urun_onecikar' => $_POST['urun_onecikar'],
		'urun_stok' => $_POST['urun_stok'],
		'seourl' => $urun_seourl
	));
	if ($insert) {
		Header("Location:../production/urun-ekle.php?durum=ok");
	} else {
		Header("Location:../production/urun-ekle.php?durum=no");
	}
}

if (isset($_POST['urunduzenle'])) {
	$urun_id = $_POST['urun_id'];
	$urun_seourl = seo($_POST['urun_ad']);
	$kaydet = $db->prepare("UPDATE urun SET
		kategori_id=:kategori_id,
		urun_ad=:urun_ad,
		urun_detay=:urun_detay,
		urun_fiyat=:urun_fiyat,
		urun_video=:urun_video,
		urun_onecikar=:urun_onecikar,
		urun_keyword=:urun_keyword,
		urun_durum=:urun_durum,
		urun_stok=:urun_stok,	
		urun_seourl=:seourl		
		WHERE urun_id={$_POST['urun_id']}");
	$update = $kaydet->execute(array(
		'kategori_id' => $_POST['kategori_id'],
		'urun_ad' => $_POST['urun_ad'],
		'urun_detay' => $_POST['urun_detay'],
		'urun_fiyat' => $_POST['urun_fiyat'],
		'urun_video' => $_POST['urun_video'],
		'urun_onecikar' => $_POST['urun_onecikar'],
		'urun_keyword' => $_POST['urun_keyword'],
		'urun_durum' => $_POST['urun_durum'],
		'urun_stok' => $_POST['urun_stok'],
		'seourl' => $urun_seourl
	));
	if ($update) {
		Header("Location:../production/urun-duzenle.php?durum=ok&urun_id=$urun_id");
	} else {
		Header("Location:../production/urun-duzenle.php?durum=no&urun_id=$urun_id");
	}
}

if (isset($_POST['yorumkaydet'])) {
	$gelen_url = $_POST['gelen_url'];
	$ayarekle = $db->prepare("INSERT INTO yorumlar SET
		yorum_detay=:yorum_detay,
		kullanici_id=:kullanici_id,
		urun_id=:urun_id	
		");
	$insert = $ayarekle->execute(array(
		'yorum_detay' => $_POST['yorum_detay'],
		'kullanici_id' => $_POST['kullanici_id'],
		'urun_id' => $_POST['urun_id']
	));
	if ($insert) {
		Header("Location:$gelen_url?yorum=ok");
	} else {
		Header("Location:$gelen_url?yorum=no");
	}
}

if (isset($_GET['yorum_onay']) == "ok") {
	$duzenle = $db->prepare("UPDATE yorumlar SET
		yorum_onay=:yorum_onay
		WHERE yorum_id={$_GET['yorum_id']}");
	$update = $duzenle->execute(array(
		'yorum_onay' => $_GET['yorum_one']
	));
	if ($update) {
		Header("Location:../production/yorum.php?durum=ok");
	} else {
		Header("Location:../production/yorum.php?durum=no");
	}
}

if (isset($_GET['yorumsil']) == "ok") {
	$sil = $db->prepare("DELETE from yorumlar where yorum_id=:yorum_id");
	$kontrol = $sil->execute(array(
		'yorum_id' => $_GET['yorum_id']
	));
	if ($kontrol) {
		Header("Location:../production/yorum.php?durum=ok");
	} else {
		Header("Location:../production/yorum.php?durum=no");
	}
}
