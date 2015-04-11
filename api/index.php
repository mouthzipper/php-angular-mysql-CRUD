<?php

require 'Slim/Slim.php';

$app = new Slim();
$app->get('/products', 'getProducts');// get all the products
$app->post('/add_product', 'addProduct'); // add product
$app->delete('/products/:id', 'deleteProduct' );// dekete specifi product

$app->run();

function getProducts() {
	$sql = "select * FROM products ORDER BY product_id";
	try {
		$db = getConnection();
		$stmt = $db->query($sql);  
		$products = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db = null;
		echo json_encode($products);
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}

function addProduct() {
	$request = Slim::getInstance()->request();
	$product = json_decode($request->getBody());
	$sql = "INSERT INTO products (product_name, product_description, product_price, product_stock) VALUES (:product_name, :product_description, :product_price, :product_stock)";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);  
		$stmt->bindParam("product_name", $product->name);
		$stmt->bindParam("product_description", $product->description);
		$stmt->bindParam("product_price", $product->price);
		$stmt->bindParam("product_stock", $product->stock);
		$stmt->execute();
		$status->id = $db->lastInsertId();
		$db = null;
		echo json_encode($status);
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}

function deleteProduct($id) {
	$sql = "DELETE FROM products WHERE product_id=".$id;
	try {
		$db = getConnection();
		$stmt = $db->query($sql);  
		$productstmt->fetchAll(PDO::FETCH_OBJ);
		$db = null;
		echo json_encode($products);
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}

function getConnection() {
	$dbhost="localhost";
	$dbuser="angular";
	$dbpass="angular";
	$dbname="angular-crud";
	$dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);	
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	return $dbh;
}

?>