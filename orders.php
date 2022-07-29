<?php
 session_start();
    
      if(isset($_COOKIE["a"]))
      {
     $c=$_COOKIE["a"];
	$src=$_POST["source"];
	$destination=$_POST["des"];
	$product_type=$_POST["pt"];
	$product_quantity=$_POST["pq"];
	$delivery_mode=$_POST["dm"];
	$delivery_type=$_POST["dt"];
	$destination_address=$_POST["add"];
	$product_package=$_POST["pp"];
	$date=date("d/m/Y");
	 $conn=pg_connect("host=localhost dbname=cargo user=postgres password=123456")or die("Error");
	
	$res=pg_query($conn,"insert into order1 values(nextval('orders'),'$src','$destination','$destination_address','$product_type','$product_quantity','$product_package','$delivery_type','$delivery_mode',$c,'$date')");
	if(!$res)
	{
		echo "Error";
	} 
	$orid=pg_fetch_assoc(pg_query($conn,"Select order_no from order1 where source='$src' and destination='$destination' and destination_address='$destination_address' and cid=$c"));
	$_SESSION["o"]=$orid["order_no"];
	include "bill.html";
	  }
	  else
	  {     ?>
  
        <h1 style="color:white;text-align:center;background-color:black">DETAILS<br></h1>
<div class="topnav">
  <a class="active" href="home page.html">Home</a>
  <a href="contact us.html">Contact</a>
  <a href="about us.html">About</a>
  <a href="banned product page.html">Banned Product</a>
</div>

<br><br><center>
  <p style="text-align:center;font-size:25px" ><b>LOGIN TO PLACE YOUR ORDER</b></p>
		<br><br><button class='block' style="font-color:white;text-align:center;background-color:yellow"><a href="login page.html"><b>LOGIN</b></a>
		</button>&nbsp;<button class='block' style="color:white;text-align:center;background-color:yellow"><a href="home page.html"><b>HOME</b></a></button>
<center></div>	 
	 <?php
	  }
	
?>	
<style>
.container {
  padding: 16px;
  background-color: pink;
.text-block{text-size:10;position:absolute;top:100px;right:80px;color:white;padding-left:20px;padding-right:20px;font-size:20px;}
}

.body {
  font-family: Arial, Helvetica, sans-serif;
  background-color: white;
}

.block {
  display: block;
  width: 30%;
  border: none;
  background-color: green;
  padding: 14px 28px;
  font-size: 20px;
  cursor: pointer;
  text-align: center;
}

.topnav {
  overflow: hidden;
  background-color: #333;
}
#right-bar{
float:right;
width:100px;
height:100%;
border-left:1px solid black;}
.topnav a {
  float: left;
  color: #f2f2f2;
  text-align: center;
  padding: 13px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:hover {
  background-color: #ddd;
  color: black;
}
.closebtn:hover {
  color: black;
}
</style>
<form action="bill.html"><br>
<center><h1>DETAILS SAVED SUCCESSFULLY</h1>
<input type="submit" class="block" value="NEXT">
</center>
</form>