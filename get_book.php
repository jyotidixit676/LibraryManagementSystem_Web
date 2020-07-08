<?php 
require_once("includes/config.php");
if(!empty($_POST["bookid"])) {
  $bookid=$_POST["bookid"];
    $sql ="SELECT * FROM tblbooks WHERE (B_id=:bookid)";
$query= $dbh -> prepare($sql);
$query-> bindParam(':bookid', $bookid, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query -> rowCount() > 0)
{
	foreach ($results as $result) {
	if($result->Status == 0){
echo nl2br(htmlentities($result->BookName."\n"));
echo '<span style="color:red;">'.htmlentities("Book is already issued.")."</span>";
 echo "<script>$('#submit').prop('disabled',true);</script>";
}
else{
echo htmlentities($result->BookName);
echo "<script>$('#submit').prop('disabled',false);</script>";
}
}
}
 else{
 echo htmlentities("Invalid book ID.");
 echo "<script>$('#submit').prop('disabled',true);</script>";
}
}



?>
