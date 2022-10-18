<?php
// Data file path
include "_constants.php";
include "_functions.php";

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
    <div id="forms">
        <form method="POST">
            <div id="data_input">
                <div id="location_div">
                    <div id="location_label_div">
                        <label for="location">Name of location: </label>
                    </div>
                    <div>
                        <input required type="text" name="location">
                    </div>
                </div>
                <div id="address_div">
                    <div id="address_label_div">
                        <label for="address">Address: </label>
                    </div>
                    <div>
                        <input required type="text" name="address" placeholder="Street, City, Postal Code">
                    </div>
                </div>
                <div id="comments_div">
                    <div id="comments_label_div">
                        <label for="comments">Comments: </label>
                    </div>
                    <div>
                        <input type="text" name="comments" placeholder="Comments" maxlength="50">
                    </div>
                </div>
            </div>
            <div id="buttons">
                <button id="save" type="submit" name="save">Save</button>
            </div>
        </form>
        <div id="numberOfLocations">Number of locations saved : <?= $counts ?></div>
    </div>
    <div>
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
                    <button id="edit" type="button" name="edit">Edit</button>
                    <button id="delete" type="button" name="delete">Delete</button>
                </td>
                </tr>
            <?php } ?>
        </table>
    </div>
    <!-- <script type="text/javascript" src="./app.js"></script> -->
</body>
</html>