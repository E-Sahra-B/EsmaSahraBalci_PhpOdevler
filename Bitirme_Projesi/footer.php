<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-6 footer-grid-agileits-w3ls text-left" data-aos="fade-down">
                <h3>Hakkımızda</h3>
                <p>Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. lacinia eget consectetur sed, convallis at tellus..</p>
                <div class="read">
                    <a href="sayfalar.php?oku=menu&id=<?php echo $satir['id']; ?>" class="btn btn-primary read-m">Devamını Oku</a>
                </div>
            </div>
            <div class="col-lg-6 footer-grid-agileits-w3ls text-left">

                <div class="tech-btm" data-aos="fade-down">
                    <h3>Son Bloglar</h3>
                    <?php
                    //session_start();
                    include("ayar.php");
                    $sorgu = $baglan->prepare("select * from bloglar where durum='0' order by id desc limit 3");
                    $sorgu->fetch(PDO::FETCH_ASSOC);
                    $sorgu->execute();
                    foreach ($sorgu as $satir) {
                    ?>
                        <div class="blog-grids row mb-3">
                            <div class="col-md-5 blog-grid-left">
                                <a href="sayfalar.php?oku=blog&id=<?php echo $satir['id']; ?>">
                                    <img src="<?php echo "admin/" . $satir['resim']; ?>" class="img-fluid" alt="">
                                </a>
                            </div>
                            <div class="col-md-7 blog-grid-right">

                                <h5>
                                    <a href="sayfalar.php?oku=blog&id=<?php echo $satir['id']; ?>"><?php echo mb_substr($satir["icerik"], 0, 100, "utf-8"); ?></a>
                                </h5>
                                <div class="sub-meta">
                                    <span>
                                        <i class="far fa-clock"></i><?php echo date('d-m-Y', strtotime($satir['tarih'])); ?></span>
                                </div>
                            </div>

                        </div>
                    <?php

                    } ?>
                </div>
            </div>

        </div>
    </div>
    <!-- footer -->
    <div class="footer-cpy text-center">
        <div class="footer-social">
            <div class="copyrighttop">
                <ul>
                    <li class="mx-3">
                        <a class="facebook" href="#">
                            <i class="fab fa-facebook-f"></i>
                            <span>Facebook</span>
                        </a>
                    </li>
                    <li>
                        <a class="facebook" href="#">
                            <i class="fab fa-twitter"></i>
                            <span>Twitter</span>
                        </a>
                    </li>
                    <li class="mx-3">
                        <a class="facebook" href="#">
                            <i class="fab fa-google-plus-g"></i>
                            <span>Google+</span>
                        </a>
                    </li>
                    <li>
                        <a class="facebook" href="#">
                            <i class="fab fa-linkedin"></i>
                            <span>Linkedin</span>
                        </a>
                    </li>
                </ul>

            </div>
        </div>
        <div class="w3layouts-agile-copyrightbottom">
            <p>2022 Esma Sahra BALCI tarafında
                &#128156; ile Php kodları yazılmıştır | Design by ©
                <a href="#">W3layouts</a>
            </p>

        </div>
    </div>

    <!-- //footer -->
    </div>
</footer>