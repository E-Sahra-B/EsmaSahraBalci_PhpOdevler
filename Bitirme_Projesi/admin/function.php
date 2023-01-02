<?php
function kucult($metin)
{
    $bul = ['Ğ', 'Ü', 'Ş', 'İ', 'Ö', 'Ç', 'I'];
    $degistir = ['ğ', 'ü', 'ş', 'i', 'ö', 'ç', 'ı'];
    $metin = str_replace($bul, $degistir, $metin);
    $metin = mb_strtolower($metin, 'utf-8');
    return $metin;
}
function buyut($metin)
{
    $degistir = ['ğ', 'ü', 'ş', 'i', 'ö', 'ç', 'ı'];
    $bul = ['Ğ', 'Ü', 'Ş', 'İ', 'Ö', 'Ç', 'I'];;
    $metin = str_replace($degistir, $bul, $metin);
    $metin = mb_strtoupper($metin, 'utf-8');
    return $metin;
}

function sefurl($metin)
{
    $random = rand(1111, 9999);
    $metin = mb_strtolower($metin);
    $bul = ['İ', 'ı', 'ğ', 'ü', 'ş', 'ö', 'ç', ' ', '.'];
    $degistir = ['i', 'i', 'g', 'u', 's', 'o', 'c', '_', ''];
    $metin = str_replace($bul, $degistir, $metin);
    $metin .= $random . '.html';
    return $metin;
}

function kelimesay($metin)
{
    $kelimesay = str_word_count($metin);
    return $kelimesay;
}
function dakikahesapla($metin)
{
    $kelimesay = str_word_count($metin);
    $kacdakika = ceil($kelimesay / 190);
    return $kacdakika;
}
