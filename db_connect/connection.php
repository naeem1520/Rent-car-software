<?php
class database
{
	public $servername="localhost";
	public $username="root";
	public $pass="";
	public $dbname="rent_management";	

	public $link;
	public $error;
	public $warn;

	public function __construct()
	{
		$this->dbconnect();
	}

	/* Db conn */

	private function dbconnect(){

		$this->link = new mysqli($this->servername,$this->username,$this->pass,$this->dbname) or die("database failed".$this->link->error."(".$this->link->errno.")");
		if(!$this->link)
		{
			$this->error="database connection failed.";
		}

	}

	public function insert($insquery)
	{
		$insquery=$this->link->query($insquery);

		if($insquery)
		{
			return $insquery;
		}
		else
		{
			$this->warn="Sorry!Something went wrong.Try again.";
		}
	}

//check edit or replace  query 
	public function replace($a)
	{
		$edit=$this->link->query($a);

		if($edit)
		{
			return $edit;
		}
		else
		{
			$this->warn="Sorry!Something went wrong.Try again.";			}
		}

//check src query
		public function select($a)
		{
			$scr_querr=$this->link->query($a);
			if($scr_querr->num_rows>0)
			{
				return $scr_querr;
			}
		}

//check delete  query
		public function delete($a)
		{
			$delquery=$this->link->query($a);

			if($delquery)
			{
				return $delquery;
			}
			else
			{
				$this->warn="Sorry!Something went wrong.Try again.";			}
			}

			public function update($u)
			{
				$updatequery=$this->link->query($u);
				if($updatequery)
				{
					return $updatequery;
				}
				else
				{
					$this->warn="Sorry!Something went wrong.Try again.";			
				}
			}

				public function auto($table,$field,$prefix,$idlength)
				{
					$query="select max($field) FROM $table";
					$fetch_query=$this->select($query)->fetch_Array();
					$max_id=$fetch_query[0];
					$prefix_length=strlen($prefix);
					$only_id=substr($max_id,$prefix_length);
					$new_id=(int)($only_id);
					$new_id++;
					$number_of_zero=$idlength-$prefix_length-strlen($new_id);	
					$zero=str_repeat("0",$number_of_zero);
					$made_id=$prefix.$zero.$new_id;
					return($made_id);	
				}

				public function __destruct()
				{
					$this->link->close();
				}

			}
			?>