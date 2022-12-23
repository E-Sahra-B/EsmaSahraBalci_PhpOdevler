<?php
@session_start();
@ob_start();
error_reporting(0);
include("../ayar.php");
$kAdi = $_SESSION['adSoyad'];
if (isset($_POST)) {
    $id = $_POST["id"];
    $sorgu = $baglan->query("select * from kullanici where id=$id");
    $satir = $sorgu->fetch(PDO::FETCH_ASSOC);
    $kullaniciAdi = $_POST["kullaniciAdi"];
    $sifre = $_POST["sifre"];
    $ySifre = $_POST["ySifre"];
    $ySifreTekrar = $_POST["ySifreTekrar"];
    // $resimName = date('d-m-Y') . '-' . $_FILES["resim"]["name"];
    $img_name = $_FILES['resim']['name'];
    $img_size = $_FILES['resim']['size'];
    $tmp_name = $_FILES['resim']['tmp_name'];
    $error = $_FILES['resim']['error'];
    if (!empty($tmp_name)) {
        if ($error === 0) {
            if ($img_size > 1000000) {
                echo '<div class="alert alert-danger">HATA: RESİM DOSYASI ÇOK BÜYÜK!</div>';
            } else {
                $uzanti = pathinfo($img_name, PATHINFO_EXTENSION);
                $uzantiKucuk = strtolower($uzanti);
                $izinliUzanti = array('jpg', 'jpeg', 'png', 'gif');
                if (in_array($uzantiKucuk, $izinliUzanti)) {
                    $new_img_name = $img_name;
                    $img_upload_path = "img/" . $new_img_name;
                    move_uploaded_file($tmp_name, $img_upload_path);
                    $sorgu = $baglan->prepare("update kullanici set resim=? where kullaniciAdi=?");
                    $guncelle = $sorgu->execute(array($img_upload_path, $kAdi));
                    if ($guncelle) {
                        echo '<div class="alert alert-success">RESİM GÜNCELLEME YAPILDI</div>';
                    } else {
                        echo '<div class="alert alert-danger">HATA: RESİM GÜNCELLEME YAPILAMADI !</div>';
                    }
                } else {
                    echo '<div class="alert alert-danger">HATA: RESİM JPG YAPILAMADI !</div>';
                }
            }
        } else {
            echo '<div class="alert alert-danger">HATA: RESİM GÜNCELLEME YAPILAMADI !</div>';
        }
    }
    if ($sifre != "" and $ySifre != "" and $ySifreTekrar != "") {
        if ($ySifre == $ySifreTekrar) {
            if ($satir["sifre"] == sha1(md5($sifre))) {
                $sorgu = $baglan->prepare("update kullanici set kullaniciAdi=?, sifre=? where id=?");
                $guncelle = $sorgu->execute(array($kullaniciAdi, sha1(md5($ySifre)), $id));
                if ($guncelle) {
                    echo '<div class="alert alert-success">ŞİFRE GÜNCELLEME YAPILDI</div>';
                } else {
                    echo '<div class="alert alert-danger">ŞİFRE GÜNCELLEME YAPALAMADI </div>';
                }
            } else {
                echo '<div class="alert alert-danger">Girmiş olduğunuz eski şifre hatalıdır.</div>';
            }
        } else {
            echo '<div class="alert alert-danger">Girmiş olduğunuz şifreler birbiri ile aynı değildir.</div>';
        }
    }
    if ($_POST["kullaniciAdi"] != $_SESSION['adSoyad']) {
        $sorgu = $baglan->prepare("update kullanici set kullaniciAdi=? where id=?");
        $guncelle = $sorgu->execute(array($kullaniciAdi, $id));
        if ($guncelle) {
            echo '<div class="alert alert-success">KULLANICI ADI GÜNCELLEME YAPILDI</div>';
        } else {
            echo '<div class="alert alert-danger">KULLANICI ADI GÜNCELLEME YAPILAMADI</div>';
        }
    }
}
