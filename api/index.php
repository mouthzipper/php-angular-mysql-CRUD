<?php

require 'Slim/Slim.php';
\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();
$app->post( '/do_login', 'doLogin'  ); //login
$app->get( '/is_login', 'isLogin' ); //check if login\
$app->get( '/logout', 'logout' ); // logout
$app->get( '/products', 'getProducts');// get all the products
$app->post( '/add_product', 'addProduct'); // add product
$app->put( '/delete_product/:id', 'deleteProduct' );// dekete specifi product
$app->get( '/get_product/:id', 'getProduct'); // get product by id
$app->put( '/edit_product/:id', 'updateProduct' );

$app->run();
function isLogin() {
	session_start();
	if( isset($_SESSION['username']) && !empty($_SESSION['username']))
		echo '{"isLogin": true}';
	else
		echo '{"isLogin": false}';
}
function logout() {
	session_start();
	session_destroy();
}
function doLogin() {
	
	$request = \Slim\Slim::getInstance()->request();
	$user = json_decode($request->getBody());

	$sql = "SELECT * FROM users WHERE username=:username AND password=:password";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);  
		$stmt->bindParam("username", $user->username);
		$stmt->bindParam("password", $user->password);
		$stmt->execute();
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$db = null;
		if( count($rows) ) {	
			session_start();
			$_SESSION['username'] =  $user->username;
			
			echo '{"status": "success"}';
		}
		else {
			echo '{"status": "failed"}';
		}  
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}

function getProducts() {
	$sql = "select * FROM products WHERE deleted=0 ORDER BY product_id";
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
function getProduct( $id ) {
	$sql = "select * FROM products WHERE product_id=".$id." ORDER BY product_id";
	try {
		$db = getConnection();
		$stmt = $db->query($sql);  
		$product = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db = null;
		echo json_encode($product);
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}

function addProduct() {
	$request = \Slim\Slim::getInstance()->request();
	$product = json_decode($request->getBody());
	$sql = "INSERT INTO products (product_name, product_description, product_price, product_stock) VALUES (:product_name, :product_description, :product_price, :product_stock)";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);  
		$stmt->bindParam("product_name", $product->name);
		$stmt->bindParam("product_description", $product->description);
		$stmt->bindParam("product_price", $product->price);
		$stmt->bindParam("product_stock", $product->stock);
		$status = $stmt->execute();	
		$db = null;
		echo '{"status":'.$status.'}';
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}

function deleteProduct($id) {
	$sql = "UPDATE products SET deleted=1 WHERE product_id=".$id;
	try {
		$db = getConnection();
		$stmt = $db->query($sql);  
		$db = null;
		getProducts();
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}

function updateProduct($id) {
	$request = \Slim\Slim::getInstance()->request();
	$product = json_decode($request->getBody());
	$sql = "UPDATE products SET product_name=:name, product_description=:description, product_price=:price, product_stock=:stock WHERE product_id=:id";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);  
		$stmt->bindParam("name", $product->product_name);
		$stmt->bindParam("description", $product->product_description);
		$stmt->bindParam("price", $product->product_price);
		$stmt->bindParam("stock", $product->product_stock);
		$stmt->bindParam("id", $id);
		$stmt->execute();
		$db = null;
		echo json_encode($product); 
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