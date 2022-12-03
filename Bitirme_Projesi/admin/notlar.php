<?php
error_reporting(0);
include("../ayar.php");
$sorgu = $baglan->query("select * from todo order by tarih desc", PDO::FETCH_ASSOC);
?>
<div class="row">
    <div class="col-lg-12">
        <div class="wrapper wrapper-content animated fadeInUp">
            <ul class="notes">
                <?php
                foreach ($sorgu as $satir) {
                    echo "
                    <li>
                        <div>
                            <input type='hidden' value='$satir[id]'>
                            <small>" . date('d-m-Y', strtotime($satir['tarih'])) . "</small>
                            <h4>$satir[baslik]</h4>
                            <p>$satir[aciklama]</p>
                            <a href='index.php?islem=sil&id=$satir[id]'><i class='fa fa-trash-o'></i></a>
                        </div>
                    </li>
                ";
                }
                ?>
            </ul>
        </div>
    </div>
</div>