<?php
if(!isset($_SESSION))
{
 session_start();
}
 error_reporting(0);
 $oid=$_SESSION["o"];
 $conn=pg_connect("host=localhost dbname=cargo user=postgres password=123456")or die("Error");
 $res=pg_fetch_assoc(pg_query($conn,"select * from order1 where order_no=$oid"));
 $ress=pg_fetch_assoc(pg_query($conn,"select * from payment where orno=$oid")); 
 
 $cno=$res['cid'];
 $r=pg_fetch_assoc(pg_query($conn,"select * from customers where cust_id=$cno"));
 ?><center><body style="background-color:pink;">
 <h1>YOUR ORDER</h1>
<p><b>Name:</b>&nbsp &nbsp;<?php echo $r['full_name']; ?> </p>
<p><b>Product Type:</b>&nbsp &nbsp;<?php echo $res['product_type']; ?> </p>
<p><b>Product Quantity:</b>&nbsp &nbsp;<?php echo $res['product_quantity']; ?> </p>
<p><b>Product Package:</b>&nbsp &nbsp;<?php echo $res['product_package']; ?> </p>
<p><b>Delivery Mode:</b>&nbsp &nbsp;<?php echo $res['delivery_mode']; ?> </p>
<p><b>Delivery Type:</b>&nbsp &nbsp;<?php echo $res['delivery_type']; ?> </p>
<p><b>Source:</b>&nbsp &nbsp;<?php echo $res['source']; ?> </p>
<p><b>Destination:</b>&nbsp &nbsp;<?php echo $res['destination']; ?> </p>
<p><b>Destination Address:</b>&nbsp &nbsp;<?php echo $res['destination_address']; ?> </p>
<p><b>Total:</b>&nbsp &nbsp;<?php echo $ress['total']; ?> </p>
<p><b>Payment Status:</b>&nbsp &nbsp;<?php 
if($ress['type']=="COD")
{
echo "Cash On Delivery";
}
else
{
	echo "Paid Online";
}
?></p><marquee><b>PLEASE USE CONTACT US FOR ORDER CANCELLATION.<br> YOU WILL RECEIVE A MESSAGE PRIOR 10 DAYS OF YOUR DELIVERY DATE.</marquee><br>
<?php
if($ress['type']=="COD")
{
	?>
<button class="block" onclick="window.location.href='Thanks page.html';">CONFIRM</button>
<?php
}  
else
{
	?>
	<button  class="block" onclick="window.location.href='payment.php';">CONFIRM</button> <?php
} ?>

</center>
</div>	

<style>
.block {
  display: block;
  width: 50%;
  border: none;
  background-color:yellow;
  padding: 14px 28px;
  font-size: 16px;
  cursor: pointer;
  text-align: center;
}

</style>




 
