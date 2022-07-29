<?php
   $o=3;
   $o=$_POST['REMOVE'];
$conn=pg_connect("host=localhost dbname=cargo user=postgres password=123456")or die("Error");
if($o!=3)
{
 $d=pg_query($conn,"delete from payment where orno=$o");
if(!$d)
 {
     echo "Error";
 }
 $res=pg_query($conn,"delete from order1 where order_no=$o");

 if(!$res)
 {
     echo "Error";
 }
$o=3;
}
include "admin.php";
echo "<h1><i><b><u>Data Successfully Deleted</u></b></i></h1>";
?>
 