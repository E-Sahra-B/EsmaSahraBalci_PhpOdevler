<?php
    class Sepet {

        public function __construct() {
            session_start();
        }

        public function ekle($urun, $adet) {
            if (isset($_SESSION['sepet'][$urun])) {
                unset($_SESSION['sepet'][$urun]);
            }
            $_SESSION['sepet'][$urun] = $adet;
        }

        public function sil($urun) {
            if (isset($_SESSION['sepet'][$urun])) {
                unset($_SESSION['sepet'][$urun]);
            }
        }

        public function temizle() {
            if (isset($_SESSION['sepet'])) {
                unset($_SESSION['sepet']);
            }
        }

        public function urunsay() {
            if (isset($_SESSION['sepet'])) {
                return count($_SESSION['sepet']);
            } else {
                return 0;
            }
        }

    }
?>