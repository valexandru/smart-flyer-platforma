<?php

/*
 * Following code will list all the products
 */

// array for JSON response
$response = array();


// include db connect class
require_once __DIR__ . '/db_connect.php';

// connecting to db
$db = new DB_CONNECT();
if (isset($_GET["id"])) {
	$id = $_GET['id'];

	// get all products from products table
	$result = mysql_query("SELECT * FROM produse WHERE pid = $id") or die(mysql_error());

// check for empty result
if (mysql_num_rows($result) > 0) {
    // looping through all results
    // products node
    $response["produse"] = array();
    
    while ($row = mysql_fetch_array($result)) {
        // temp user array
        $product = array();
        $product["id"] =  $row["pid"];
	$product["nume"] = $row["nume"];
        $product["pret"] = $row["pret"];
        $product["descriere"] = $row["descriere"];

        // push single product into final response array
        array_push($response["produse"], $product);
    }
    // success
    $response["success"] = 1;

    // echoing JSON response
    echo json_encode($response);
    }
} else {
    // no products found
    $response["success"] = 0;
    $response["message"] = "No products found";

    // echo no users JSON
    echo json_encode($response);
}
?>
