<?php
include "dbconnection.php";
$collection = $db->tablo;
$eventid = isset($_GET['id']) ? $_GET['id'] : null;

$objectId = new MongoDB\BSON\ObjectID($eventid);
$item = $collection->findOne(['_id' => $objectId]);

if ($eventid === null) {
    echo '<script>alert("Event ID not provided.");</script>';
} else {
    // $event = $collection->findOne(['_id' => new MongoDB\BSON\ObjectID($eventid)]);
    $event = $collection->findOne(['_id' => $objectId]);

    if ($event === null) {
        echo '<script>alert("Event not found.");</script>';
    }
}

if (isset($_POST['editSubmit'])) {
    try {
        $updateResult = $collection->updateOne(
            //['_id' => new MongoDB\BSON\ObjectID($eventid)],
            ['_id' => $objectId],
            ['$set' => [
                'name' => $_POST['name'],
                'age' => $_POST['age']
            ]]
        );

        if ($updateResult->getModifiedCount() > 0) {
            echo '<script>alert("Event details updated successfully!");</script>';
            // printf("Matched %d documents \n",  $updateResult->getMatchedCount());
            // printf("Modified %d documents \n",  $updateResult->getModifiedCount());
        } else {
            echo '<script>alert("No changes made.");</script>';
        }
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}

// if (isset($_POST['editSubmit'])) {
//     $updateResult = $collection->updateMany(
//         ['age' => 18],
//         ['$set' => [
//             'name' => "changeName"
//         ]]
//     );
//     printf("Matched %d documents \n",  $updateResult->getMatchedCount());
//     printf("Modified %d documents \n",  $updateResult->getModifiedCount());
// }

// if (isset($_POST['editSubmit'])) {
//     $updateResult = $collection->replaceOne(
//         ['name' => 'Cassady Flowers'],
//         [
//             'name' => 'replaceName'
//         ]
//     );
//     printf("Matched %d documents \n",  $updateResult->getMatchedCount());
//     printf("Modified %d documents \n",  $updateResult->getModifiedCount());
// }

// $id = $_GET['id'];
// $objectId = new MongoDB\BSON\ObjectID($id);
// $item = $collection->findOne(['_id' => $objectId]);

// if (isset($_POST['editSubmit'])) {
//     $name = $_POST['name'];
//     $age = $_POST['age'];
//     $updateData = ['$set' => ['name' => $name, 'age' => $age]];
//     $myid = ['_id' => $objectId];
//     $result = $collection->updateOne($myid, $updateData);
//     header("Location: read.php");

//     // $post_data = array();
//     // $post_data['id'] = $_POST['txtId'];
//     // $post_data['name'] = $_POST['txtName'];
//     // $result = $students->updateOne(['id'=>$post_data['id']],['$set'=>$post_data],['upsert' => true]);
//     // $post_data = array();
//     // $_POST = array();
//     // header("Refresh:0");
// }


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
</head>

<body>
    <center>
        <h1>Registration Form</h1>
        <form method="POST" action="#">
            <label for="name">Full Name:</label>
            <input type="text" value="<?php echo $item["name"] ?? ''; ?>" name="name" id="name" required><br><br>
            <label for="age">Age:</label>
            <input type="text" value="<?php echo $item["age"] ?? ''; ?>" name="age" id="age" required><br><br>
            <input type="submit" name="editSubmit" value="Submit">
        </form>
        <a href="read.php">Go Back</a>
    </center>
</body>

</html>