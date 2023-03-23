<li>
    <?php
    $yorumsor = $db->prepare("SELECT yorumlar.*,kullanici.* 
                            FROM yorumlar 
                            INNER JOIN kullanici ON yorumlar.kullanici_id=kullanici.kullanici_id 
                            WHERE urun_id=:id ORDER BY yorum_zaman DESC");
    $yorumsor->execute(array(
        'id' => $uruncek['urun_id']
    ));
    $yorumcek = $yorumsor->fetch(PDO::FETCH_ASSOC);
    ?>
    <ul class="profile-rating">
        <?php
        for ($i = 1; $i <= $yorumcek['yorum_puan']; $i++) { ?>
            <li><i class='fa fa-star' aria-hidden='true'></i></li>
        <?php }
        for ($j = 1; $j <= 5 - ($yorumcek['yorum_puan']); $j++) { ?>
            <li><i class="fa fa-star-o" aria-hidden="true"></i></li>
        <?php } ?>
        <li>(<span> <?= $yorumcek['yorum_puan'] ?></span> )</li>
    </ul>
</li>