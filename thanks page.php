<?php
if(isset($_POST["logout"]))
{
	setcookie("a","",3600);
	include "home page.html";
}
?>