<?php
require_once 'inc/config.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Enstitü İstanbul İsmek - Zemin İstanbul PHP Atölyesi">
        <meta name="author" content="Mehmet Selçuk Batal">
        <title>Hakkımızda - Eİİ Shop v1.0</title>
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet">
        <link href="css/styles.css" rel="stylesheet">
    </head>
    <body>
        <?php include_once 'tmp_ust.php'; ?>
        <section class="bg-dark py-1">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h3 class="fw-bolder">Hakkımızda</h3>
                </div>
            </div>
        </section>
        <div class="container content py-5">
            <div class="row">
                <div class="col-12">
                    <?php
                        $icerik = $baglan->select('hakkimizda')->run();
                        echo $icerik[0]["aciklama"];
                    ?>
                </div>
            </div>
        </div>
        <?php include_once 'tmp_alt.php'; ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>