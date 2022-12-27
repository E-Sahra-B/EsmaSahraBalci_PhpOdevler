<?php
error_reporting(0);
include("../ayar.php");
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Sayfası</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body class="">
    <div id="wrapper">
        <?php
        include_once("headerMenu.php");
        ?>
        <div id="page-wrapper" class="gray-bg">
            <?php
            include_once("header.php");
            ?>
            <br>
            <form action="" method="get">
                <input type="text" name="isim" id="">
                <input type="submit" class="btn btn-sm btn-primary" value="Hesapla">
                <br>
                <small style="color: red;">Lütfen Türkçe karakterler kullanmayınız!</small>
            </form>
            <?php
            $ad = $_GET["isim"];
            function kucult($metin)
            {
                $bul = ['Ğ', 'Ü', 'Ş', 'İ', 'Ö', 'Ç', 'ğ', 'ü', 'ş', 'i', 'ı', 'ö', 'ç', ' '];
                $degistir = ['g', 'u', 's', 'i', 'o', 'c', 'g', 'u', 's', 'i', 'i', 'o', 'c', ''];
                $metin = str_replace($bul, $degistir, $metin);
                $metin = mb_strtolower($metin, 'utf-8');
                return $metin;
            }
            $isim = kucult($ad);
            $dizi = array('a' => 1, 'j' => 1, 's' => 1, 'ş' => 1, 'b' => 2, 'k' => 2, 't' => 2, 'c' => 3, 'ç' => 3, 'l' => 3, 'u' => 3, 'ü' => 3, 'd' => 4, 'm' => 4, 'v' => 4, 'e' => 5, 'n' => 5, 'w' => 5, 'f' => 6, 'o' => 6, 'ö' => 6, 'x' => 6, 'g' => 7, 'ğ' => 7, 'p' => 7, 'y' => 7, 'h' => 8, 'q' => 8, 'z' => 8, 'ı' => 9, 'i' => 9, 'r' => 9);
            echo "<br><b>" . $ad . "</b><br>";
            $uzunluk = strlen($isim);
            $sayi = 0;
            $toplam = $sayi;
            while ($sayi < $uzunluk) {
                $af = $dizi[$isim[$sayi]];
                $sayi++;
                $toplam += $af;
            }
            echo "<br>";
            $son = substr($toplam, -1, 1);
            $ilk = substr($toplam, 0, 1);
            $toplamUzunluk = strlen($toplam);
            if ($toplam != 11 && $toplam != 22 && $toplam != 22 && $toplamUzunluk > 1) {
                $sonuc = $ilk + $son;
                if ($sonuc != 11 && $sonuc != 22 && $sonuc != 22 && strlen($sonuc) > 1) {
                    $son = substr($sonuc, -1, 1);
                    $ilk = substr($sonuc, 0, 1);
                    $cikti = $ilk + $son;
                }
            }
            $aciklama = array(
                1 => "Öncü, lider, yaratıcı – egoist",
                2 => "Sevgi dolu, şefkatli, merhametli – fazla fedakar, sevgi arsızı",
                3 => "Enerjik, çalışkan, disiplinli – aşırı detaycı",
                4 => "Değişimi ve dünya düzenini temsil eder – istikrarsız, düzen kurmakta zorlanan",
                5 => "Zeki, entelektüel, komik – stresli, endişeli",
                6 => "Romantik, dengeli – ilişkilerde istikrarsız olabilir veya fazla bağlandığından dolayı çok acı çekebilir.",
                7 => "Gizemli, ruhsal yönü kuvvetli – soğuk, mesafeli, sevdikleri için fazla fedakar",
                8 => "Sonsuzluğun sembolü, bereketli, güçlü, başarılı – fazla sorumluluk alma isteği, başkalarının işine karışma isteği",
                9 => "Bazen çok bilge bazen çok çocuk – fazla inatçı – değişmez doğrulara sahip ",
                11 => "Dünya lideri olma isteği – çocukluk döneminde anlaşılmadıklarından dolayı içe dönüktürler ve zorluklar yaşayabilirler. ",
                22 => "Sevgi ile dünyayı değiştirme isteği, özverili, ilham verici "
            );
            if ($sonuc != 11 && $sonuc != 22 && $sonuc != 22 && strlen($sonuc) > 1) {
                echo "<b>Sayınız</b> => $cikti <br> <b>Açıklama</b> => " . $aciklama[$cikti] . "<br>";
            } else {
                echo "<b>Sayınız</b> => $sonuc <br> <b>Açıklama</b> => " . $aciklama[$sonuc] . "<br>";
            }
            $harfler = array(
                "a" => "Liderlik özelliği baskındır. Algılama ve mantık yürütme konularında etkin bir kişilik ortaya koyar. Enerjik bir kişiliği temsil eder.  ",
                "b" => "Duygusallığı ve ön sezileri yüksektir. İsminde B harfi bulunan kişilerin hayata karşı umutları yüksektir. ",
                "c" => "İsminde C harfi olan kişiler, sanatçı ruhu baskın, konuşma ve yazma konusunda yetenekli, duygusallığı yüksek kişilerdir. Genellikle rahatlarına düşkün bir karakterleri vardır. ",
                "ç" => "İsminde C harfi olan kişiler, sanatçı ruhu baskın, konuşma ve yazma konusunda yetenekli, duygusallığı yüksek kişilerdir. Genellikle rahatlarına düşkün bir karakterleri vardır. ",
                "d" => "Hırslı, güçlü ve girişimcilerdir. ",
                "e" => "Adında e harfi bulunan kişiler, farklı duyguları aynı anda yaşayabilen, çelişkili duygusallıklara müsait bir karaktere sahip olurlar. Çekimser ve içe dönük olabilirler. Bunun yanında sıkıntılarla baş etmek konusunda mücadelecilerdir. ",
                "f" => "Güvenilirlikleri ön planda olan, düzenli, sakin ve uysal karakterlerdir. ",
                "g" => "İnatçı olmaları en karakteristik özelliklerindendir. Diğer kişilerden üstün olmak istemelerinden de anlaşılacağı üzere gergin bir karakterleri vardır.",
                "ğ" => "İnatçı olmaları en karakteristik özelliklerindendir. Diğer kişilerden üstün olmak istemelerinden de anlaşılacağı üzere gergin bir karakterleri vardır. ",
                "h" => "İsminde H harfi olan kişilerin, sakin bir yapıları vardır. Ancak bunun yanında lider olma istekleri de çok kuvvetlidir. ",
                "ı" => "Hassas, duygusal ve kırılgandırlar. Bunun yanında detaycılık özellikleri de vardır. ",
                "i" => "Hassas, duygusal ve kırılgandırlar. Bunun yanında detaycılık özellikleri de vardır. ",
                "j" => "Farklı olmayı seven, kaprisli ve kıskanç bir karakteri temsil eder.",
                "k" => "Başarılı ve hırslılardır. ",
                "l" => "İsminde L harfi olan kişiler; sanatsal perspektifleri kuvvetli, sakin bir karaktere sahiptirler. Aynı zamanda özgüvenleri yüksektir. ",
                "m" => "Yüksek zeka ve ticarete yatkın bir kişilikleri vardır. Enerjileri çok yüksel ve eğlenceli ve karaktere sahiptirler.",
                "n" => "Sağduyulu olmaları en belirgin özelliklerindendir. Hayatlarında değişiklik yapmayı sevmezler.",
                "o" => "Gizemli, utangaç ve duygularını belli etmeyi sevmeyen bir kişiliği temsil eder. ",
                "ö" => "Gizemli, utangaç ve duygularını belli etmeyi sevmeyen bir kişiliği temsil eder. ",
                "p" => "özgüvenli, kendinden emin ve sakin bir karakterleri vardır. ",
                "r" => "Kararsız, kibirli ve alaycı bir kişiliğin habercisidir. Sert bir karakterleri vardır. ",
                "s" => "İsminde S veya Ş harfi olan kişiler; hayalperest, üretken ve güçlü bir karaktere sahiptirler.",
                "ş" => "İsminde S veya Ş harfi olan kişiler; hayalperest, üretken ve güçlü bir karaktere sahiptirler.",
                "t" => "Güvenilir ve duygularını belli etmekten kaçınan bir kişiliği temsil eder. İsminde T harfi olan kişiler, iş hayatında başarılı olurlar. ",
                "u" => "Durgun bir karakterleri vardır. Hümanisttirler. Kıskanılmaya müsait ve başarıları engellenmeye çalışılan kişilerdir.",
                "ü" => "Durgun bir karakterleri vardır. Hümanisttirler. Kıskanılmaya müsait ve başarıları engellenmeye çalışılan kişilerdir. ",
                "v" => "Karakterlerinin en belirgin özelliği içe dönük ve umursamaz olmalarıdır. Hayatlarında değişikliklere yer verirler ancak seçicidirler. ",
                "y" => "İsminde Y harfi olan kişiler; geçmişlerinin etkisi altında kalmaya müsait, zor unutan, aşka önem veren ve sezgisellikleri kuvvetli kişilik ortaya koyarlar.",
                "z" => "Prensipleri olan, akademik olarak başarılı, akıllı ve maddiyata önem veren bir karakteri temsil eder."
            );
            echo "<br>";
            for ($i = 0; $i < $uzunluk; $i++) {
                echo "<b>" . strtoupper($isim[$i]) . "</b> => " . $harfler[$isim[$i]] . "<br><br>";
            }



            include_once("footer.php");
            ?>
        </div>
    </div>
    <?php
    include_once("script.php");
    ?>
</body>

</html>