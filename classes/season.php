<?php 
class season
{
	function __construct(){

	}
	public function StartSession()
	{
		session_start();
	}
	public function send($value)
	{
		$_SESSION['user']=$value;
	}
	public function getSs()
	{
		if (isset($_SESSION['user'])) {
			$user = $_SESSION['user'];
			return $user;
		}else{
			$user ='';
			return $user;
		}
	}
	public function EndSession()
	{
		session_destroy();
	}
}
 ?>