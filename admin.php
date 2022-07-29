<?php
error_reporting(0);
  $admin= $_POST['id'];
	  $adminpass= $_POST['psw'];
	  $conn=pg_connect("host=localhost dbname=cargo user=postgres password=123456")or die("Error");
	 if(!$conn)
	 {
		 echo "Not Connected to database<br>";
		 exit;
	 }
	$entry=pg_query($conn,"select password from admin where adminid='$admin'");
      $res=pg_fetch_assoc($entry);
	  if($res['password']==$adminpass)
	  {
        ?> <body style='background-color:pink'>
		<center><input type="button" class="block" onclick="window.location.href='admin.html';" style="float:center;" value="LOGOUT"><br><br>

		<?php		
		$tsql=pg_query($conn,"select * from order1");
		?>
		<form action="ad.php" method="POST">
		<table cellpadding= 10px border= 2px >
					<tr>
					<th align="center" >Name</th>
					<th align="center" >Mobile Number</th>
					<th align="center" >Order Id</th>
					<th align="center" >Product Name</th>
					<th align="center" >Product Quantity</th>
					<th align="center" >Product Package</th>
					<th align="center" >Source</th>
					<th align="center" >Destination Address</th>
					<th align="center" >Delivery Mode</th>
                    <th align="center" >Delivery Type</th>
					<th align="center" >Total</th>
					<th align="center" >Payment Status</th>
					<th align="center" >Date</th>
					<th align="center" >Remove</th>
					
					<?php
				while($table=pg_fetch_assoc($tsql))
				{
					$c = $table['cid'];
					$o=$table['order_no'];
					$result = pg_fetch_assoc(pg_query($conn,"select * from customers where cust_id= $c"));
					$allresult = pg_fetch_assoc(pg_query($conn,"select * from payment where orno=$o"));
					?>
					<tr>
					<td align="center"><?php echo $result['full_name'];?></td>
					<td align="center"><?php echo $result['phone'];?></td>
					<td align="center"><?php echo $table['order_no'];?></td>
					<td align="center"><?php echo $table['product_type'];?></td>
					<td align="center"><?php echo $table['product_quantity'];?></td>
					<td align="center"><?php echo $table['product_package'];?></td>
					<td align="center"><?php echo $table['source'];?></td>
					<td align="center"><?php echo $table['destination_address'];?></td>
					<td align="center"><?php echo $table['delivery_mode'];?></td>
					<td align="center"><?php echo $table['delivery_type'];?></td>
					<td align="center"><?php echo $allresult['total'];?></td>
					<td align="center"><?php echo $allresult['type'];?></td>
					<td align="center"><?php echo $table['date'];?></td>
					<td align="center"><button name="REMOVE" value="<?php echo $o;?>">Remove</button></td>
					
					</tr>
					<?php
     }
	 ?></table></form><?php
	  }
	  
	  else 
	  {
		  include "admin.html";
		  echo "<h1><i><b><u>you are not an admin</u></b></i></h1>";
	  }

 
?><html>
<style>

.block {
  display: block;
  width: 10%;
  border: none;
  background-color: yellow;
  padding: 10px 20px;
  font-size: 16px;
  cursor: pointer;
  text-align: center;
}
</style>
</html>