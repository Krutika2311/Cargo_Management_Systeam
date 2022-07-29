<?php
	$username=$_POST["username"];
	$password=$_POST["psw"];
	
	$conn=pg_connect("host=localhost dbname=cargo user=postgres password=123456")or die("Error");
	
	$res=pg_query($conn,"Select password from login where username='$username'");
	
	if(!$res)
	{
		echo "Error";
	}
	
	$row=pg_fetch_assoc($res);
	if($row['password']==$password)
	{
		echo Login successful;
	}
	else
	{
		echo "Invalid Password";
	}
?>