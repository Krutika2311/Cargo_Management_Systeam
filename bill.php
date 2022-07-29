<?php
session_start();
$distance=$_POST['one'];
$weight=$_POST['two'];
$conn=pg_connect("host=localhost dbname=cargo user=postgres password=123456")or die("Error");

if(isset($_POST['pay']))
{
	$type=$_POST['pay'];
	$total=$distance*$weight;
	$ono=$_SESSION["o"];

 $pentry=pg_query($conn,"Insert into payment values(nextval('pay'),'$type',$total,$ono)");
include "finall bill.php";
}
  else
{
	include "bill.html";
echo 'payment type not selected';
}
?>
