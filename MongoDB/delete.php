<?php
include_once "dbconnection.php";
$collection = $db->tablo;

if (isset($_GET['id'])) {
    $eventid = $_GET['id'];
    $deleteResult = $collection->deleteOne(['_id' => new MongoDB\BSON\ObjectID($eventid)]);

    if ($deleteResult->getDeletedCount() > 0) {
        echo '<script>alert("Event deleted successfully!");</script>';
    } else {
        echo '<script>alert("Event not found.");</script>';
    }
} else {
    echo '<script>alert("Event ID not provided.");</script>';
}

// $deleteResult = $collection->deleteMany(
//     ['name' => 'changeName']
// );
// printf("Deleted %d documents \n",  $updateResult->getDeletedCount());

// header("Location: read.php"); // Redirect back to the view page after deletion
// exit();
//$id = $_GET['id'];
// $objectId = new MongoDB\BSON\ObjectID($id);
// $data = ['_id' => $objectId];

// $collection->deleteOne($data);
// header("Location: read.php");
// //$collection->deleteOne(["id"=>$id]);
