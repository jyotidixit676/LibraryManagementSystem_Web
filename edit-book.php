<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{ 

if(isset($_POST['update']))
{
$bookname=$_POST['BookName'];
$category=$_POST['category'];
$author=$_POST['author'];
$isbn=$_POST['isbn'];

$bookid=intval($_GET['bookid']);
$sql="update tblbooks set BookName=:bookname,C_id=:category,Au_id=:author,B_id=:isbn where B_id=:bookid";
$query = $dbh->prepare($sql);
$query->bindParam(':bookname',$bookname,PDO::PARAM_STR);
$query->bindParam(':category',$category,PDO::PARAM_STR);
$query->bindParam(':author',$author,PDO::PARAM_STR);
$query->bindParam(':isbn',$isbn,PDO::PARAM_STR);
$query->bindParam(':bookid',$bookid,PDO::PARAM_STR);
$query->execute();
$_SESSION['msg']="Book information updated successfully.";
header('location:manage-books.php');


}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Sapthagiri College of Engg. CSE Library | Edit Book</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

</head>
<body>
      <!------MENU SECTION START-->
<?php include('includes/header.php');?>
<!-- MENU SECTION END-->
    <div class="content-wra
    <div class="content-wrapper">
         <div class="container">
        <div class="row pad-botm">
            <div class="col-md-12">
                <h4 class="header-line">Edit Book</h4>
                
                            </div>

</div>
<div class="row">
<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3"">
<div class="panel panel-info">
<div class="panel-heading">
Book Info
</div>
<div class="panel-body">
<form role="form" method="post">
<?php 
$bookid=$_GET['bookid'];
$sql = "SELECT tblbooks.BookName,tblcategory.CategoryName,tblcategory.C_id as cid,tblauthors.AuthorName,tblauthors.Au_id as Au_id,tblbooks.B_id as bookid, tblbooks.edition from  tblbooks join tblcategory on tblcategory.C_id=tblbooks.C_id join tblauthors on tblauthors.Au_id=tblbooks.Au_id where tblbooks.B_id=:bookid";
$query = $dbh -> prepare($sql);
$query->bindParam(':bookid',$bookid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>  
<div class="form-group">
<label>Book Id : &nbsp;<?php echo $result->bookid; ?></label>
</div>

<div class="form-group">
<label>Book Name</label>
<input class="form-control" type="text" name="bookname" value="<?php echo htmlentities($result->BookName);?>" />
</div>

<div class="form-group">
<label> Category</label>
<select class="form-control" name="category" >
<option value="<?php echo htmlentities($result->cid);?>"> <?php echo htmlentities($catname=$result->CategoryName);?></option>
<?php 
$sql1 = "SELECT * from  tblcategory";
$query1 = $dbh -> prepare($sql1);
$query1->execute();
$resultss=$query1->fetchAll(PDO::FETCH_OBJ);
if($query1->rowCount() > 0)
{
foreach($resultss as $row)
{           
if($catname==$row->CategoryName)
{
continue;
}
else
{
    ?>  
<option value="<?php echo htmlentities($row->C_id);?>"><?php echo htmlentities($row->CategoryName);?></option>
 <?php }}} ?> 
</select>
</div>


<div class="form-group">
<label> Author</label>
<select class="form-control" name="author">
<option value="<?php echo htmlentities($result->Au_id);?>"> <?php echo htmlentities($athrname=$result->AuthorName);?></option>
<?php 

$sql2 = "SELECT * from  tblauthors ";
$query2 = $dbh -> prepare($sql2);
$query2->execute();
$result2=$query2->fetchAll(PDO::FETCH_OBJ);
if($query2->rowCount() > 0)
{
foreach($result2 as $ret)
{           
if($athrname==$ret->AuthorName)
{
continue;
} else{

    ?>  
<option value="<?php echo htmlentities($ret->C_id);?>"><?php echo htmlentities($ret->AuthorName);?></option>
 <?php }}} ?> 
</select>
</div>

 <div class="form-group">
 <label>Year/Edition</label>
 <input class="form-control" type="text" name="price" value="<?php echo htmlentities($result->edition);?>" />
 </div>
 <?php }} ?>
<button type="submit" name="update" class="btn btn-info">Update </button>

                                    </form>
                            </div>
                        </div>
                            </div>

        </div>
   
    </div>
    </div>
     <!-- CONTENT-WRAPPER SECTION END-->
  <?php include('includes/footer.php');?>
      <!-- FOOTER SECTION END-->
    <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY  -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
      <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>
</body>
</html>
<?php } ?>
