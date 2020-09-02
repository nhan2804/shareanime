<?php 
class database
	{
		public $con;
		private $localhost="localhost";
		private $pass="";
		private $user="root";
		private $data="shareanime";
		private $result=null;
		function __construct()
		{
			$this->con= new mysqli($this->localhost,$this->user,$this->pass,$this->data) or die("connect failed"); 

			$this->con->query("SET NAMES UTF8");
		}
		public function numrow($sql)
		{
			$query = mysqli_query($this->con, $sql);
			if ($query) {
				$row = mysqli_num_rows($query);
				return $row;
			}
		}
		public function getData($sql)
		{
			$arr  = array();
			$this->result = mysqli_query($this->con,$sql);
			while ($row = mysqli_fetch_assoc($this->result)) {
				$arr[]=$row;
			}
			return $arr;
		}
		public function getRow($sql)
		{
			$result = mysqli_query($this->con,$sql);
			$row = mysqli_fetch_assoc($result);
			return $row;

		}
		public function statement($sql)
		{
			$this->con->query($sql);
		}
	}
 ?>