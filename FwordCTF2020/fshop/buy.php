<?php
session_start();
include_once("db.php");
include("order.php");
$product_id=$_GET['id'];
$quantity=$_GET['quantity'];
$size=$_GET['size'];
$user_id=$_SESSION['id'];

$stmt=$conn->prepare("SELECT * FROM products where id=?");
$stmt->bind_param("s",$id);
$id=$product_id;
$stmt->execute();
if ($stmt->get_result()->num_rows==0){
	die("Product does not exist");
}
$productOBJ=new Order($product_id,$quantity,$size);

$serialized_product=serialize($productOBJ);

$filtered_serialized_product=str_replace(chr(0).'*'.chr(0), '\0\0\0', $serialized_product);

$sql="INSERT INTO user_items (user_id,product_object) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("is",$id, $object);
$id=(int)$user_id;
$object=$filtered_serialized_product;
$stmt->execute();
header("Location: items.php");
?>
