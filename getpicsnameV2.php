<?php
	$from=$_GET['from'];
	$now=0;
	$arr=array();
	
	$dbc=mysqli_connect('localhost','root','root','appdb')
	or die("connect failed");
	$query="SELECT * FROM picsname";
	$result=mysqli_query($dbc,$query)
	or die("query failed");
	
	while($row=mysqli_fetch_array($result))
	{
		$now++;
		if($now<$from)
			continue;
		else if($now>=$from+8)
			break;
		else{
			$obj=new stdClass();
			$obj->name=$row['name'];
			array_push($arr,json_encode($obj));
		}
	}
	mysqli_close($dbc);
	echo "[";
	for($i=0;$i<count($arr);$i++)
	{
		echo $arr[$i];
		if($i<count($arr)-1)
			echo ",";
	}
	echo "]";
?>