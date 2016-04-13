<?php 

$servername = "localhost";
$username = "root";
$password = "afifzafri";
$dbname = "data";


if( $_POST['option'] == "add" )
{
	$n = $_POST['name'];
	$a = $_POST['age'];

	try
	{
		$conn = new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$stmt = $conn->prepare("INSERT INTO JSDATA (NAME,AGE) VALUES(?,?) ");
		$stmt->execute(array($n,$a));
		
		echo "Success add data!";
		
	}
	catch(PDOException $e)
	{
		echo "Connection Error : " . $e->getMessage();
	}

	$conn = null;
}

if( $_POST['option'] == "search" )
{
	$n = $_POST['name'];
	
	try
	{
		$conn = new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$stmt = $conn->prepare("SELECT * FROM JSDATA WHERE NAME LIKE ? ");
		$stmt->execute(array("%{$n}%"));
		
		echo "
		
		<table>
		<tr>
		<th>ID</th>
		<th>NAME</th>
		<th>AGE</th>
		</tr>
		
		
		";
		while($result = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			$id = $result['ID'];
			$name = $result['NAME'];
			$age = $result['AGE'];
			
			echo "
			<tr>
			<td>$id</td>
			<td>$name</td>
			<td>$age</td>
			</tr>
			";
		}
		
	}
	catch(PDOException $e)
	{
		echo "Connection Error : " . $e->getMessage();
	}

	$conn = null;
}

?>