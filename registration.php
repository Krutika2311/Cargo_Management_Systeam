<?php
    $uid=0;
    error_reporting(E_ERROR | E_WARNING | E_PARSE);
	$name=$_POST["name"];
	$username=$_POST["username"];
	$phone=$_POST["phone"];
	$email=$_POST["email"];
	$password=$_POST["psw"];
	$cpassword=$_POST["psw-repeat"];
	function test_input($em)
	{
	if(!preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-])*(\.[a-z]{2,3})$^",$em))
		{
			return false;
		}
		else
			return true;
	}
	
	$con=pg_connect("host=localhost dbname=cargo user=postgres password=123456") or die("Unable to connect");
	if((test_input($email)==false)&&($email!=""))
	{
		include "registration.html";
		?>
		<label style="color:yellow">INVALID EMAIL FORMAT</label>
		</body>
		</html>
		<?php
	}
	else if($password==$cpassword)
	{
		$uname=pg_query($con,"select * from login where username='$username'");
		$cun=pg_num_rows($uname);
		if($cun==1)
		{
			include "registration.html";
			?>
			<label style="color:yellow">Username already taken<br>Try Another</label>
			</body>
			</html>
			<?php
		}
		else
		{
			$res=pg_query($con,"Insert into customers values(nextval('customer'),'$email','$phone','$name')");
		    $result=pg_fetch_assoc(pg_query($con,"select cust_id from customers where email='$email' and phone='$phone'"));
		    $cid=$result['cust_id']; 
		    $ress=pg_query($con,"insert into login values('$username','$password',$cid)");
		    setcookie("a",$cid);
		}
	}
	else
	{
		echo "home page.html";
		?>
		<label style ="color:yellow">Confirm Password Does Not Match</label>
		</body>
		</html>
	<?php
	}
	
?>
<html>
<head>
<style>
.container{position:relative;}
.text-block{text-size:10;position:absolute;top:100px;right:80px;color:white;padding-left:20px;padding-right:20px;font-size:20px;}
.block {
  display: block;
  width: 50%;
  border: none;
  background-color: yellow;
  padding: 14px 28px;
  font-size: 16px;
  cursor: pointer;
  text-align: center;
}

body {
  margin: 0;
   
  font-family: Arial, Helvetica, sans-serif;
}
</style></head>
<form action="order.html">
<div class="container"><img src="img6.jpg" alt="image" width="1490" height="900">
<div class="text-block">
<center><h1>REGISTRATION SUCCESSFULLY DONE</h1>
<input type="submit" class="block" value="NEXT">
</center>
</div>
</div>
</form>
</html>