<?php 
require_once("includes/config.php");
if(!empty($_POST["studentid"])) {
  $studentid= strtoupper($_POST["studentid"]);
 
    $sql ="SELECT * FROM tblstudents WHERE S_id=:studentid";
$query= $dbh -> prepare($sql);
$query-> bindParam(':studentid', $studentid, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query -> rowCount() > 0)
{
foreach ($results as $result) {
if($result->Status==0)
{
echo "<span style='color:red'> Student ID Blocked </span>"."<br />";
echo "<b>Student Name-</b>" .$result->FullName;
 echo "<script>$('#submit').prop('disabled',true);</script>";
} else {
	if($_POST['call']=='issue'){
	$sql = 'SELECT COUNT(*) FROM tblissuedbookdetails WHERE S_id=:studentid AND ReturnDate="0000-00-00 00:00:00"';
	$query = $dbh->prepare($sql);
	$query-> bindParam(':studentid', $studentid, PDO::PARAM_STR);
	$query-> execute();	
	$numberOfBooks = $query->fetchColumn();
	echo nl2br(htmlentities("Name : ".$result->FullName."\nSem : ".$result->Sem."\nSec : ".$result->Section."\n"));

	if ($numberOfBooks >=3) {
	echo '<span style="color:red;">';
	echo htmlentities("Books not yet returned : ".$numberOfBooks);
	echo '</span>';
		echo "<script>$('#submit').prop('disabled',true);</script>";
	}
	else{
	echo htmlentities("Books not yet returned : ".$numberOfBooks);
 }
	}
	else{
	echo htmlentities($result->FullName);
	echo "<script>$('#submit').prop('disabled',false);</script>";
	}
}
}
}
 else{
  
  echo "<span style='color:red'> Invaid Student Id. Please Enter Valid Student id .</span>";
 echo "<script>$('#submit').prop('disabled',true);</script>";
}
}



?>
