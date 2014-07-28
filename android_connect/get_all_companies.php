<?php

/*
 * Following code will list all the companies in the 'Firme' table
 */

// array for JSON response
$response = array();


// include db connect class
require_once __DIR__ . '/db_connect.php';

// connecting to db
$db = new DB_CONNECT();

// get all companies from the companies table
$result = mysql_query("SELECT *FROM firme") or die(mysql_error());

// checking for empty result
if (mysql_num_rows($result) > 0) {
    // searching through all results
    $response["firme"] = array();
    
    while ($row = mysql_fetch_array($result)) {
        // temp user array
        $product = array();
        $product["id"] = $row["id"];
        $product["nume"] = $row["nume"];
        $product["latitudine"] = $row["latitudine"];
        $product["longitudine"] = $row["longitudine"];


        // adding single product into final response array
        array_push($response["firme"], $product);
    }
    // success
    $response["success"] = 1;

    // echoing JSON response
    echo json_encode($response);
} else {
    // no companies found
    $response["success"] = 0;
    $response["message"] = "No companies found";

    // echo no users JSON
    echo json_encode($response);
}
?>
