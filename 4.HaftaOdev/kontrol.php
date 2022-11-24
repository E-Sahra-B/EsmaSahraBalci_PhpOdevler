<?php
class TcKontrol
{
    public function tcKontrol()
    {
        $tc = $_POST["tc"];
        $durum = $_POST["durum"];

        if (strlen($tc) == 11) {
            // $sonuc = filter_input(INPUT_POST, $tc, FILTER_SANITIZE_NUMBER_INT);
            // if ($sonuc == true) {
            if ($tc[0] != 0) {
                $tc10Rakam = ((($tc[0] + $tc[2] + $tc[4] + $tc[6] + $tc[8]) * 7) - ($tc[1] + $tc[3] + $tc[5] + $tc[7])) % 10;
                if ($tc10Rakam == $tc[9]) {
                    $tc11Rakam = ($tc[0] + $tc[1] + $tc[2] + $tc[3] + $tc[4] + $tc[5] + $tc[6] + $tc[7] + $tc[8] + $tc[9]) % 10;
                    if ($tc11Rakam == $tc[10]) {
                        $durum = "TC Kimlik Geçerli";
                        return $durum;
                    } else {
                        $durum = "TC Kimlik Geçersiz 11. rakam hatalı";
                        return $durum;
                    }
                } else {
                    $durum = "TC Kimlik Geçersiz 10. rakam hatalı";
                    return $durum;
                }
            } else {
                $durum = "TC kimlik Geçersiz 0 ile başlayamaz";
                return $durum;
            }
            // } else {
            //     $durum = "TC Kimlik Geçersiz TC Kimlik Numarası yalnızca rakamlardan oluşmaktadır.";
            //     return $durum;
            // }
        } else {
            $durum = "TC Kimlik Geçersiz 11 hane olmak zorundadır.";
            return $durum;
        }
    }
}
