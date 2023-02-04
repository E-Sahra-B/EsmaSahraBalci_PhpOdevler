<?php
require_once 'header.php';
require_once 'sidebar.php';
error_reporting(0);
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <form action="" method="post">
                            <div class="alert alert-info" role="alert">
                                Listelemek istediğiniz zaman aralığını aşağıdan seçin ve filtrele butonuna basın.
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <label id="yazi1" for="example-date-input" class="col-form-label">Başlangıç tarihi seçin </label>
                                            </div>
                                            <div class="col-md-7">
                                                <input name="bastarih" class="form-control" type="date">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <label id="yazi2" for="example-date-input" class="col-form-label">Bitiş tarihi seçin</label>
                                            </div>
                                            <div class="col-md-7">
                                                <input name="bittarih" class="form-control" type="date">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <button name="satisfiltrele" type="submit" class="btn btn-outline-info btn-md"> Filtrele </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <br>

                        <?php
                        $bastarih = $_POST['bastarih'];
                        $bittarih = $_POST['bittarih'];
                        ?>
                    </div>
                    <?php if ($_GET['rapor'] == "nakit") { ?>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>Numara</th>
                                        <th>Başlık</th>
                                        <th>Açıklama</th>
                                        <th>Gelen</th>
                                        <th>Giden</th>
                                        <th>Zaman</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (empty($bastarih) & empty($bittarih)) {
                                        $nakit = $baglan->prepare("SELECT * from nakit");
                                        $nakit->execute(array());
                                    } else {
                                        $nakit = $baglan->prepare("SELECT * from nakit  where para_zaman between ? and ?");
                                        $nakit->execute(array($bastarih, $bittarih));
                                    }
                                    while ($nakitcek = $nakit->fetch(PDO::FETCH_ASSOC)) {
                                        $toplamgirdi += $nakitcek['para_gelen'];
                                        $toplamcikti += $nakitcek['para_giden'];
                                        $sonuc = $toplamgirdi - $toplamcikti;
                                        $toplamsayi = $nakit->rowCount();
                                    ?>
                                        <tr>
                                        <tr>
                                            <td><?php echo $nakitcek['nakit_id'] ?></td>
                                            <td><?php echo $nakitcek['para_baslik'] ?></td>
                                            <td><?php echo $nakitcek['para_aciklama'] ?></td>
                                            <td><?php echo number_format($nakitcek['para_gelen'], "2", ",", ".") ?></td>
                                            <td><?php echo number_format($nakitcek['para_giden'], "2", ",", ".") ?></td>
                                            <td><?php echo date("d-m-Y", strtotime($nakitcek['para_zaman'])) ?></td>
                                            </form>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <hr><br>
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-9">
                                        <label>Toplam <?php echo $toplamsayi ?> kayıt bulundu</label>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="text-right">
                                            <label>Toplam gelen : <?php echo number_format($toplamgirdi, "2", ",", ".") ?> ₺</label><br>
                                            <label>Toplam giden : <?php echo number_format($toplamcikti, "2", ",", ".") ?> ₺</label>
                                            <hr>
                                            <label>
                                                <?php
                                                if ($sonuc < 0) {
                                                    $sonuc *= -1;
                                                    echo "Borç : " . number_format($sonuc, "2", ",", ".") . " ₺";
                                                } else {
                                                    echo "Alacak : " . number_format($sonuc, "2", ",", ".") . " ₺";
                                                }
                                                ?>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } elseif ($_GET['rapor'] == "satis") { ?>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>Satış başlık</th>
                                        <th>Satış açıklama</th>
                                        <th>Satış zaman</th>
                                        <th>Satış tutar</th>
                                        <th>Satış ödeme yöntemi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (empty($bastarih) & empty($bittarih)) {
                                        $satis = $baglan->prepare("SELECT * from satislar");
                                        $satis->execute(array());
                                    } else {
                                        $satis = $baglan->prepare("SELECT * from satislar where satis_zaman between ? and ? order by satis_id DESC");
                                        $satis->execute(array($bastarih, $bittarih));
                                    }
                                    while ($satiscek = $satis->fetch(PDO::FETCH_ASSOC)) {
                                        $toplamsatis += $satiscek['satis_tutar'];
                                        $toplamsayi = $satis->rowCount();
                                    ?>
                                        <tr>
                                            <td><?php echo $satiscek['satis_baslik'] ?></td>
                                            <td><?php echo $satiscek['satis_aciklama'] ?></td>
                                            <td><span class="tag tag-success"><?php echo date("d-m-Y", strtotime($satiscek['satis_zaman'])) ?></span></td>
                                            <td><?php echo number_format($satiscek['satis_tutar'], "2", ",", ".") ?> ₺</td>
                                            <td><?php echo $satiscek['satis_odeme'] ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <hr><br>
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-9">
                                        <label>Toplam <?php echo $toplamsayi ?> kayıt bulundu</label>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="text-right">
                                            <label><?php echo "Toplam Satış : " . number_format($toplamsatis, "2", ",", ".") . " ₺"; ?></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } elseif ($_GET['rapor'] == "odeme") { ?>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>Başlık</th>
                                        <th>Açıklama</th>
                                        <th>Tutar</th>
                                        <th>Kime ödenecek</th>
                                        <th>Para alınan zaman</th>
                                        <th>Para ödenecek zaman</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (empty($bastarih) & empty($bittarih)) {
                                        $odeme = $baglan->prepare("SELECT * from odemeler");
                                        $odeme->execute(array());
                                    } else {
                                        $odeme = $baglan->prepare("SELECT * from odemeler where odeme_zaman between ? and ?  order by odeme_id DESC");
                                        $odeme->execute(array($bastarih, $bittarih));
                                    }
                                    while ($odemecek = $odeme->fetch(PDO::FETCH_ASSOC)) {
                                        $toplamodeme += $odemecek['odeme_tutar'];
                                        $toplamsayi = $odeme->rowCount();
                                    ?>
                                        <tr>
                                            <td><?php echo $odemecek['odeme_baslik'] ?></td>
                                            <td><?php echo $odemecek['odeme_aciklama'] ?></td>
                                            <td><span class="tag tag-success"><?php echo number_format($odemecek['odeme_tutar'], "2", ",", ".") ?> ₺</span></td>
                                            <td><?php echo $odemecek['odeme_kime'] ?></td>
                                            <td><?php echo date("d-m-Y", strtotime($odemecek['para_alinan_zaman'])) ?></td>
                                            <td><?php echo date("d-m-Y", strtotime($odemecek['odeme_zaman'])) ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <hr><br>
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-9">
                                        <label>Toplam <?php echo $toplamsayi ?> kayıt bulundu</label>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="text-right">
                                            <label><?php echo "Toplam Ödeme : " . number_format($toplamodeme, "2", ",", ".") . " ₺"; ?></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } elseif ($_GET['rapor'] == "masraf") { ?>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>Numara</th>
                                        <th>Başlık</th>
                                        <th>Açıklama</th>
                                        <th class="text-right">Tutar</th>
                                        <th>Kategori</th>
                                        <th>Zaman</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (empty($bastarih) & empty($bittarih)) {
                                        $masraf = $baglan->prepare("SELECT * from masraflar");
                                        $masraf->execute(array());
                                    } else {
                                        $masraf = $baglan->prepare("SELECT * from masraflar where masraf_zaman between ? and ?  order by masraf_id DESC");
                                        $masraf->execute(array($bastarih, $bittarih));
                                    }
                                    while ($masrafcek = $masraf->fetch(PDO::FETCH_ASSOC)) {
                                        $toplammasraf += $masrafcek['masraf_tutar'];
                                        $toplamsayi = $masraf->rowCount();
                                    ?>
                                        <tr>
                                            <td><?php echo $masrafcek['masraf_id']; ?></td>
                                            <td><?php echo $masrafcek['masraf_baslik'] ?></td>
                                            <td><?php echo $masrafcek['masraf_aciklama'] ?></td>
                                            <td class="text-right"><span class="tag tag-success"><?php echo number_format($masrafcek['masraf_tutar'], "2", ",", ".") ?> ₺ </span></td>
                                            <td><?php echo $masrafcek['masraf_kategori'] ?></td>
                                            <td><?php echo date("d-m-Y", strtotime($masrafcek['masraf_zaman'])) ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <hr><br>
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-9">
                                        <label>Toplam <?php echo $toplamsayi ?> kayıt bulundu</label>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="text-right">
                                            <label><?php echo "Toplam Masraf : " . number_format($toplammasraf, "2", ",", ".") . " ₺"; ?></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<?php require_once 'footer.php'; ?>