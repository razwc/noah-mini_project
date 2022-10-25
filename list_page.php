<?php
// Data file path
include "_constants.php";
include "_functions.php";

if(isset($_POST['submit'])){
    if($_POST['submit'] == 'delete'){
        delete_place($_POST['id']);
    }
};

if(!(isset($_POST["location"]) && isset($_POST["address"]))) {
    // Create data file
    createFile();

    // Show exsiting list
    $all_data_str = retrieveExistingDataString();
    $all_data_arr = json_decode($all_data_str, true);

    $counts = count($all_data_arr);

} else {
    // Prepare data string and data arr (json_encode & json_decode)

    $all_data_str = retrieveDataString();
    $all_data_arr = json_decode($all_data_str, true);

    // Save data in json file
    saveDataToFile();

    // Update counts
    $counts = count($all_data_arr);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css"/>
    <title>Let's visit again!</title>
</head>
<body>
    <div id="title">
        <h1>SAVE LOCATIONS TO VISIT</h1>
    </div>
    <div id="table_div">
        <table>
            <tr>
                <th id="number">#</th>
                <th id="name">Name</th>
                <th id="address">Address</th>
            </tr>
            <?php for($i = 0; $i < count($all_data_arr); $i++){ ?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <td><?= $all_data_arr[$i]["location"] ?></td>
                    <td><?= $all_data_arr[$i]["address"] ?></td>
                    <td>
                        <form method="POST">
                            <input type="hidden" name="id" value=<?= $all_data_arr[$i]['id']?>>
                            <button id="edit" type="button" name="submit" value="edit">Edit</button>
                            <button id="delete" type="submit" name="submit" value="delete">Delete</button>
                        </form>
                    </td>
                </tr>
                <?php } ?>
            </table>
    </div>
    <div id="menu">
        <ul>
            <li><a href="./index.php">< Go back</a></li>
        </ul>
    </div>
    <!-- <script type="text/javascript" src="./app.js"></script> -->
</body>
</html>