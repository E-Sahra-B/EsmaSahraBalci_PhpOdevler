<?php
require 'vendor/autoload.php';
// $db = $client->selectDatabase("deneme");
// $cl = $db->selectCollection("tablo");

// $db = (new MongoDB\Client("mongodb://localhost:27017"))->deneme->tablo;
// $collection = $db->find();
// foreach ($collection as $key) {
//   //echo $value->name;
//   echo $key['name'] . "<br>";
// }

$connect = new MongoDB\Client("mongodb://localhost:27017");
$db = $connect->deneme;

//selectDatabase
// $db = $connect->deneme;
// $db = $client->selectDatabase("deneme");

//databaseList
// foreach ($connect->listDatabases() as $dbName) {
//     var_dump($dbName);
// }

//deleteDatabase
// $deleteDatabase = $connect->dropDatabase('yeni');

//createTable
// $createTable = $db->createCollection('newTable');

//selectTable
// $collection = $db->newTable;
// $collection = $db->selectCollection("newTable");

//tableList
// foreach ($db->listCollections() as $tblName) {
//     var_dump($tblName);
// }

//deleteTable
// $deleteTable = $db->dropCollection('newTable');