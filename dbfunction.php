<?php
//require_once('define.php');
function dbconnection()
{
	$con = mysql_connect(DB_HOST, DB_USER, DB_PASS) or die("Couldn't make connection.");
	$db = mysql_select_db(DB_NAME, $con) or die("Couldn't select database");
	return $con;
}
function getAll($con,$table)
{
	$sql = "SELECT * FROM {$table}";
	$result = mysqli_query($con,$sql);
	$return['result'] = array();
	if(mysqli_num_rows($result) > 0)
	{
		while ($row = mysqli_fetch_assoc($result))
		{
			$return['result'][] = $row;
		}
	}
	return $return['result'];
}
function getWhere($data = array(),$string = NULL)
{
	$fields = array_keys($data);
	$values = array_values($data);
	$count = count($fields);
	$item = "";
	for($i = 0; $i < $count; $i++)
	{
		if($count > 1 && $count - 1 != $i)
		{
			if(is_string($values[$i]))
			{
				$item .=  $fields[$i] . " = " . "'{$values[$i]}' AND ";
			}
			else
			{
				$item .=  $fields[$i] . " = " . "'{$values[$i]}' AND ";
			}
		}
		else
		{
			if(is_string($values[$i]))
			{
				$item .=  $fields[$i] . " = " . "'{$values[$i]}'";
			}
			else
			{
				$item .=  $fields[$i] . " = " . "'{$values[$i]}'";
			}
		}
		if(!is_null($string))
		{
			$item .= $string;
		}
	}
	return $item;
}
//----
function  selectWhere($con,$table,$data = array(),$string = NULL)
{
	$fields = array_keys($data);
	$values = array_values($data);
	$count = count($fields);
	$item = "";
	for($i = 0; $i < $count; $i++)
	{
		if($count > 1 && $count - 1 != $i)
		{
			if(is_string($values[$i]))
			{
				$item .=  $fields[$i] . " = " . "'{$values[$i]}' AND ";
			}
			else
			{
				$item .=  $fields[$i] . " = " . "'{$values[$i]}' AND ";
			}
		}
		else
		{
			if(is_string($values[$i]))
			{
				$item .=  $fields[$i] . " = " . "'{$values[$i]}'";
			}
			else
			{
				$item .=  $fields[$i] . " = " . "'{$values[$i]}'";
			}
		}
		if(!is_null($string))
		{
			$item .= $string;
		}
	}
	$sql = "SELECT * FROM {$table} WHERE {$item}"; 
	//echo $sql;
	if (!mysqli_query($con,$sql)) {
						echo $sql;		
								die('SELECT 5 INTO orders -Error: ' . mysqli_error($con));
								}
	$result = mysqli_query($con,$sql);
	$return['result'] = array();
	if(mysqli_num_rows($result) > 0)
	{
		while ($row = mysqli_fetch_assoc($result))
		{
			$return['result'][] = $row;
		}
	}
	return $return['result'];
}
function deleteAll($con,$table)
{
	$sql = "TRUNCATE {$table}";
	$result = mysqli_query($con,$sql);
	$callback = mysqli_affected_rows();
	return $callback;
}
//----
function deleteWhere($con,$table,$where)
{
	$sql = "DELETE FROM {$table} WHERE {$where}";
	$result = mysqli_query($con,$sql);
	$callback = mysqli_affected_rows();
	return $callback;
}
function insert($con,$table,$data = array(),$GetLastInsertID=true,$printQuery=false)
{
	$fields = implode(", ", array_keys($data));
	$values = "'".implode("','", array_values($data))."'";
	$sql = "INSERT INTO `{$table}` ({$fields}) VALUES ({$values}) ";
	if($printQuery)
	{
		echo $sql;
		//exit;
	}
	$result = mysqli_query($con,$sql);
	$insertId = mysqli_insert_id($con);
	if($GetLastInsertID)
	{
		return $insertId;
	}
	else
	{
		return $result;
	}
}
//----
function update($con,$table,$data,$where)
{
	foreach ($data as $x => $y)
	{
		$values[] = "{$x} = '{$y}'";
	}
	$final = implode(", ", $values);
	$sql = " UPDATE `{$table}` SET {$final} WHERE {$where} ";
	$result = mysqli_query($con,$sql);
	return $result;
}

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}