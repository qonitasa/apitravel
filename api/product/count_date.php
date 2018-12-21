<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/core.php';
include_once '../config/database.php';
include_once '../objects/product.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$product = new Product($db);
 
// get keywords
$keywords=isset($_GET["date"]) ? $_GET["date"] : "";
 
// query products
$stmt = $product -> count_per_day($keywords);
$num = $stmt -> rowCount();

	// check if more than 0 record found
	if($num>0){
		http_response_code(200);
	 
		// show products data
		echo json_encode($num);
	}
	 
	else{
		// set response code - 404 Not found
		http_response_code(404);
	 
		// tell the user no products found
		echo json_encode(
			array("message" => "No products found.")
		);
	}
?>
