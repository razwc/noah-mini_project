<?php
include "_constants.php";

function createFile() {
    global $DATA_FILE_PATH;

    $data_file = fopen($DATA_FILE_PATH, "a+");
    fclose($data_file);
};

function createDataArray() {
    global $DATA_FILE_PATH;

    // Make all data array w/ json_decode
    $read_data_file = fopen($DATA_FILE_PATH, "r");
    $data_file_size = filesize($DATA_FILE_PATH);
    $data_str = '[]';
    
    if ($data_file_size > 0 ) {
        $data_str = fread($read_data_file, $data_file_size); // fread() returns a string
    }
    fclose($read_data_file);
    
    $data_arr = json_decode($data_str, true);
    
    return $data_arr;
};

function retrieveExistingDataString() {
    $all_data = createDataArray();
    
    return json_encode($all_data);
};

function retrieveDataString() {
    $all_data = createDataArray();
    $new_data = ["location" => $_POST["location"], "address" => $_POST["address"]];
    
    array_push($all_data, $new_data);
    
    return json_encode($all_data, JSON_PRETTY_PRINT);
};

function saveDataToFile() {
    global $DATA_FILE_PATH;

    $all_data_str = retrieveDataString();

    $data_file = fopen($DATA_FILE_PATH, "w");
    fwrite($data_file, $all_data_str);
    fclose($data_file);
};

function delete_place($place_name){
    global $DATA_FILE_PATH;

    $places = json_decode(retrieveExistingDataString(), true);

    // Change 1
    $places = array_filter($places, function($place) use($place_name){
        return $place["location"] != $place_name;
    });
    $places = array_values($places);

    // Change 2
    // $new_places = [];
    // foreach($places as $place){
    //     if($place["name"] != $place_name){
    //         array_push($new_places, $place);
    //     }
    // };

    //write
    $places = json_encode($places, JSON_PRETTY_PRINT);
    // saveDataToFile($DATA_FILE_PATH, $places);
    $data_file = fopen($DATA_FILE_PATH, "w");
    fwrite($data_file, $places);
    fclose($data_file);
};

// function edit_place($place_name, $new_place){
//     global $DATA_FILE_PATH;

//     $places = retrieveExistingDataString();


// }

?>