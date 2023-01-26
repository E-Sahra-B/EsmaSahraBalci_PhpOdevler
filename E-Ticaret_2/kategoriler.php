<?php
require_once 'header.php';
$sayfada = 6;
$sorgu = $db->prepare("select * from kategori");
$sorgu->execute();
$toplam_icerik = $sorgu->rowCount();
$toplam_sayfa = ceil($toplam_icerik / $sayfada);
$sayfa = isset($_GET['sayfa']) ? (int) $_GET['sayfa'] : 1;
if ($sayfa < 1) $sayfa = 1;
if ($sayfa > $toplam_sayfa) $sayfa = $toplam_sayfa;
$limit = ($sayfa - 1) * $sayfada;

if (isset($_GET['sef'])) {
       $kategorisor = $db->prepare("SELECT * FROM kategori where kategori_seourl=:seourl");
       $kategorisor->execute(array(
              'seourl' => $_GET['sef']
       ));
       $kategoricek = $kategorisor->fetch(PDO::FETCH_ASSOC);
       $kategori_id = $kategoricek['kategori_id'];
       //$urunsor = $db->prepare("SELECT * FROM urun where kategori_id=:kategori_id order by urun_id DESC");
       $urunsor = $db->prepare("SELECT * FROM urun where kategori_id=:kategori_id order by urun_id DESC limit $limit,$sayfada");
       $urunsor->execute(array(
              'kategori_id' => $kategori_id
       ));
       $say = $urunsor->rowCount();
} else {
       //$urunsor = $db->prepare("SELECT * FROM urun order by urun_id DESC");
       $urunsor = $db->prepare("SELECT * FROM urun order by urun_id DESC limit $limit,$sayfada");
       $urunsor->execute();
}
?>

<head>
       <title><?php echo $kategoricek['kategori_ad'] ?> - Esb-Ticaret</title>
</head>

<div class="container">
       <div class="clearfix"></div>
       <div class="lines"></div>
</div>
<div class="container">
       <div class="row">
              <div class="col-md-9"><!--Main content-->
                     <div class="title-bg">
                            <div class="title">Kategoriler</div>
                            <!-- <div class="title-nav">
                                   <a href="javascripti:void(0);"><i class="fa fa-th-large"></i>grid</a>
                                   <a href="javascripti:void(0);"><i class="fa fa-bars"></i>List</a>
                            </div> -->
                     </div>
                     <div class="row prdct"><!--Products-->
                            <?php
                            if ($toplam_icerik == 0) {
                                   echo "Bu kategoride ürün bulunamadı";
                            }
                            while ($uruncek = $urunsor->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                                   <div class="col-md-4">
                                          <div class="productwrap">
                                                 <div class="pr-img">
                                                        <div class="hot"></div>
                                                        <a href="urun-<?= seo($uruncek["urun_ad"]) . '-' . $uruncek["urun_id"] ?>">
                                                               <img src="
                                                               <?php
                                                               $urun_id = $uruncek['urun_id'];
                                                               $urunfotosor = $db->prepare("SELECT * FROM urunfoto where urun_id=:urun_id order by urunfoto_sira ASC limit 1 ");
                                                               $urunfotosor->execute(array(
                                                                      'urun_id' => $urun_id
                                                               ));
                                                               $urunfotocek = $urunfotosor->fetch(PDO::FETCH_ASSOC);
                                                               if (!empty($urunfotocek['urunfoto_resimyol'])) {
                                                                      echo $urunfotocek['urunfoto_resimyol'];
                                                               } else {
                                                                      echo "img\logo-yok.png";
                                                               }
                                                               ?>
                                                               " alt="" class="img-responsive"></a>
                                                        <div class="pricetag on-sale">
                                                               <div class="inner on-sale">
                                                                      <span class="onsale">
                                                                             <span class="oldprice">
                                                                                    <?php echo number_format(($uruncek['urun_fiyat'] * 1.50), 2, ',', '.');   ?>
                                                                             </span>
                                                                             <?php echo number_format($uruncek['urun_fiyat'], 2, ',', '.'); ?>
                                                                      </span>
                                                               </div>
                                                        </div>
                                                 </div>
                                                 <span class="smalltitle"><a href="#>"><?php echo substr($uruncek['urun_ad'], 0, 15) ?></a></span>
                                                 <span class="smalldesc">Ürün Kodu.: <?php echo $uruncek['urun_id'] ?></span>
                                          </div>
                                   </div>
                            <?php } ?>

                     </div><!--Products-->
                     <div class="text-right" class="col-md-12">
                            <ul class="pagination shop-pag">
                                   <!-- <li><a href="#"><i class="fa fa-caret-left"></i></a></li> -->
                                   <?php
                                   $s = 0;
                                   while ($s < $toplam_sayfa) {
                                          $s++;
                                          if ($s == $sayfa) { ?>
                                                 <li class="active">
                                                        <a href="kategoriler?sayfa=<?php echo $s; ?>"><?php echo $s; ?></a>
                                                 </li>
                                          <?php } else { ?>
                                                 <li>
                                                        <a href="kategoriler?sayfa=<?php echo $s; ?>"><?php echo $s; ?></a>
                                                 </li>
                                   <?php   }
                                   }
                                   ?>
                                   <!-- <li><a href="#"><i class="fa fa-caret-right"></i></a></li> -->
                            </ul>
                     </div>
              </div>
              <?php require_once 'sidebar.php' ?>
       </div>
       <div class="spacer"></div>
</div>
<?php require_once 'footer.php'; ?>