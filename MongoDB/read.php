<?php
//phpinfo();
?>
<?php
include "dbconnection.php";
$collection = $db->tablo;
$mydata = $collection->find();

// $id = $_GET['id'];
// $objectId = new MongoDB\BSON\ObjectID($id);
// $item = $collection->findOne(['_id' => $objectId]);

// $orderLimitSkipSort = $collection->find(
//     [],
//     [
//         'limit' => 2,
//         'skip' => 3,
//         'sort' => ['_id' => -1]
//     ]
// ); // id ye gore tersten 3 tane atlatıp 2 yane yazdır
// foreach ($orderLimitSkipSort as $list) {
//     var_dump($list);
// }

// $showDocument = $collection->find(
//     ['status' => 1],
//     ['projection' => ['name' => 1, '_id' => 0]]
// );

// foreach ($showDocument as $list) {
//     var_dump($list);
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Read List</title>
</head>

<body>
    <center><br><br><br>
        <a href="create.php">New Add</a> <br><br>
        <table border="1">
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Age</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            <?php foreach ($mydata as $document) : ?>
                <tr>
                    <td><?php echo $document['_id'] ?></td>
                    <td><?php echo $document['name'] ?? '' ?></td>
                    <td><?php echo $document['age'] ?? '' ?></td>
                    <td><a href="update.php?id=<?php echo $document["_id"]; ?>">Edit</a></td>
                    <td><a href="delete.php?id=<?php echo $document["_id"]; ?>" onClick="return confirm('Are you want to delete')">Delete</a></td>
                </tr>
            <?php endforeach ?>
        </table>
    </center>
</body>

</html>