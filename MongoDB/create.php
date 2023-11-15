<?php
include "dbconnection.php";
$collection = $db->tablo;
if (isset($_POST['addSubmit'])) {
    try {
        $insertOneResult = $collection->insertOne([
            'name' => $_POST['name'],
            'age' => $_POST['age']
        ]);

        if ($insertOneResult->getInsertedCount() > 0) {
            echo '<script>alert("Inserted' . $insertOneResult->getInsertedId() . 'Successfully!");</script>';
        } else {
            echo '<script>alert("Error. No Inserted.");</script>';
        }
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}

// if (isset($_POST['addSubmit'])) {
//     $name = $_POST['name'];
//     $age = $_POST['age'];
//     $data = array('name' => $name, 'age' => $age);
//     if ($data) {
//         $collection->insertOne($data);
//         echo "<script type='text/javascript'>alert('Inserted Successfully');</script>";

//         header("Location: read.php");
//         //exit();	   
//     }
// }

// $postData = [];
// $postData['name'] = $_POST['name'];
// $postData['age'] = $_POST['age'];
// $collection->insertOne($postData);

// $insertManyResult = $collection->insertMany([
//     ['_id' => 1, 'name' => "name1", 'age' => 18],
//     ['_id' => 2, 'name' => "name2", 'age' => 19]
// ]);
// printf("Inserted %d documents", $insertManyResult->getInsertedCount());
// var_dump($insertManyResult->getInsertedIds());
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create</title>
</head>

<body>
    <form method="post" action="#">
        <table>
            <tr>
                <td>Name :</td>
                <td><input type="text" placeholder="Name" name="name" required /></td>
            </tr>
            <tr>
                <td>Age :</td>
                <td><input type="text" placeholder="Age" name="age" required /></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="Submit" name="addSubmit" /></td>
            </tr>
        </table>
        <a href="read.php">Go Back</a>
    </form>
</body>

</html>