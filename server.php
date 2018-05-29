<?php

	session_start();

	//create key for CSRF token
	if(empty($_SESSION['key']))
	{
    		$_SESSION['key']=bin2hex(random_bytes(32));
    
	}

	//generate CSRF token
	$token = hash_hmac('sha256',"This is token:index.php",$_SESSION['key']);

	$_SESSION['CSRF'] = $token; //store CSRF token in session variable

	ob_start(); // start of outer buffer function

	echo $token;


	if(isset($_POST['submit']))
	{	
    		ob_end_clean(); //clean previous displayed echoed  --End of Outer Buffer--
    
    		//validate the logins
    		loginvalidate($_POST['CSR'],$_COOKIE['session_id'],$_POST['username'],$_POST['pass']);

	}	


	//function to validate Login
	function loginvalidate($user_CSRF,$user_sessionID, $username, $password)
	{
    		if($username=="abc" && $password=="123" && $user_CSRF==$_SESSION['CSRF'] && $user_sessionID==session_id())
    		{
        		echo "<script> alert('Sucessfully loggod in!!') </script>";
        		echo "Welcome user "."<br/>"; 
        		echo "For more info visit: ".'<a href="https://fzrsec.blogspot.com/2018/05/cross-site-request-forgery-protection.html", target="_blank" >'. "https://www.fzrsec.blogspot.com"."</a>";
        		apc_delete('CSRF_token');
    		}
    		else
    		{
        		echo "<script> alert('Error: failed to Login') </script>";
        		echo "<script type=\"text/javascript\"> window.location.href = 'index.php'; </script>";
        
    		}
	}


?>
