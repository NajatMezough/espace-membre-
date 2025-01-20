<?php
session_start();
$connexion= new PDO('mysql:host=localhost;dbname=users_base1','root','');


if (isset($_POST['valider'])) {
    // Create a new message array with the input data
    $new_message = array(
        "nom" => htmlspecialchars($_POST['nom']),
        "prenom" => htmlspecialchars($_POST['prenom']), 
        "telephome" => htmlspecialchars($_POST['telephone']),
        "pack" => htmlspecialchars($_POST['pack']), 
        "email" => htmlspecialchars($_POST['email']),
        "password" => htmlspecialchars($_POST['password']), 
        "img" => htmlspecialchars($_POST['img']['name']), 


       
    );

    $file_path = "data.json"; // Define the file path

    // Check if the file exists and is readable
    if (!file_exists($file_path) || filesize($file_path) == 0) {
        // If the file doesn't exist or is empty, create the first record
        $data_to_save = array($new_message);
    } else {
        // If the file exists and is not empty, read and decode the old records
        $file_contents = file_get_contents($file_path);

        if ($file_contents === false) {
            die("Error: Unable to read the file.");
        }

        $old_records = json_decode($file_contents, true);

        // If decoding fails, initialize as an empty array
        if (!is_array($old_records)) {
            $old_records = [];
        }

        // Add the new message to the existing records
        $old_records[] = $new_message; // Use shorthand for array_push
        $data_to_save = $old_records;
    }

    // Save the updated data back to the file
    if (file_put_contents($file_path, json_encode($data_to_save, JSON_PRETTY_PRINT | LOCK_EX))) {
        $success = "Data saved successfully!";
    } else {
        $error = "Error: Unable to save the data.";
    }
}
?>