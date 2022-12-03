<?php
class kontroller
{
    public function guvenlik($metin = '')
    {
        $metin = strip_tags($metin);
        $metin = htmlspecialchars($metin);
        return $metin;
    }
}
