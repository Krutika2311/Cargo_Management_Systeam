<?php
    $r=2;
	$username=$_POST["username"];
	$password=$_POST["psw"];
	class login{
		private $username,$password;
		function login($a,$b)
		{
			$this->username=$a;
			$this->password=$b;
		}
		public function ChkLogin()
		{
			$un=$this->username;
			$pa=$this->password;
	        $conn=pg_connect("host=localhost dbname=cargo user=postgres password=123456")or die("Error");
	        $res=pg_query($conn,"Select password from login where username='$un'");
			$row=pg_fetch_assoc($res);
			$cr=pg_num_rows($res);
			if($cr==0)
            {
                return -1;
            }
            else
            {
                if(!$row)
                {
                    echo "Error";
                }
                else if($pa==$row['password'])
                {
                    return 0;
                }
                else
                {
                    return 1;
                }
            }
		}
	}
	if(isset($_COOKIE["a"]))
	{
		include "login page.html";
		?>
		<label style="color:yellow;font-size:25px;"><center><b>Already Logged In.<br>No Need to login</b></center></label>
		</div>
		<h3 style="color:black;">Follow Us:<img src="followus.jpg" alt="Follow Us" width="200" height="50"></h3>
		</body>
		</html>
		<?php
	}
	else{
		$l=new login($username,$password);
		$r=$l->ChkLogin();
		if($r==-1)
		{
			include "login page.html";
			?>
			<label style="color:black;font-size:25px;"><center><b>Account Not Found<br>Create account to login</b></center></label>
			</div>
			<h3 style="color:black;">Follow Us:<img src="followus.jpg" alt="Follow Us" width="200" height="50"></h3>
			</body>
			</html>
		<?php
		}
        else if($r==0)
        {
            $con=pg_connect("host=localhost dbname=cargo user=postgres password=123456") or die("Unable to connect");
            $getcid=pg_fetch_assoc(pg_query($con,"Select cid from login where username='$username'"));
			$cid=$getcid['cid'];
            setcookie("a","$cid");
            include "l.html";
        }
        else if($r==1)
        {
            include "login page.html";
        ?>
        <label style="color:black;;font-size:25px;"><center><b>Incorrect Password!!!<br>Try Again</b></center></label>
        </div>
		<h3 style="color:black;">Follow Us:<img src="followus.jpg" alt="Follow Us" width="200" height="50"></h3>
        </body>
        </html>
        <?php
        }
		
	}
	?>

