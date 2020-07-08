<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{ 

if(isset($_POST['add']))
{
$bookname=$_POST['bookname'];
$category=$_POST['category'];
$author=$_POST['author'];
$b_id=$_POST['b_id'];
$edition=$_POST['edition'];
$publisher=$_POST['publisher'];
$conn=new mysqli('localhost','root','','library');
$sql="Insert into tblbooks(BookName,C_id,Au_id,B_id,Edition,Publisher) VALUES ('$bookname',$category,$author,'$b_id','$edition','$publisher')";
$query=mysqli_query($conn,$sql);
if($query)
{
$_SESSION['msg']="Book added successfully.";
header('location:manage-books.php');
}
else 
{
$_SESSION['error']="Error in adding book.";
header('location:manage-books.php');
}

}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Sapthagiri College of Engg. CSE Library | Add Book</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />

    <link href="image/favicon.ico" rel="icon" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

</head>
<body>
      <!------MENU SECTION START-->
<?php include('includes/header.php');?>
<!-- MENU SECTION END-->
    <div class="content-wrapper">
         <div class="container">
        <div class="row pad-botm">
            <div class="col-md-12">
                <h4 class="header-line">Add Book</h4>
                
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
    <div class="form-group">
        <?php
         $bookid = "CS";
         $sql = "SELECT MAX(B_id) as id FROM tblbooks;";
         $query = $dbh->prepare($sql);
         $query->execute();
         $result = $query->fetchAll(PDO::FETCH_OBJ);
         if($query->rowCount()>0){
            foreach ($result as $r) {
                $bookid = intval(substr($r->id, 2));
                $bookid++;
                $bookid = "CS".$bookid;
            }
         }
        ?>
<label>Book ID<span style="color:red;">*</span></label>
<input class="form-control" type="text" name="b_id" autocomplete="off"  value ="<?php echo htmlentities($bookid); ?>" required />
</div>
<div class="form-group">
<label>Book Name<span style="color:red;">*</span></label>
<input class="form-control" type="text" name="bookname" autocomplete="off"  required />
</div>

<div class="form-group">
<label> Category<span style="color:red;">*</span></label>
<select class="form-control" name="category" required="required">
<option value=""> Select Category</option>
<?php
$sql = "SELECT * from  tblcategory";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>  
<option value="<?php echo htmlentities($result->C_id);?>"><?php echo htmlentities($result->CategoryName);?></option>
 <?php }} ?> 
</select>
</div>


<div class="form-group">
<label> Author<span style="color:red;">*</span></label>
<select class="form-control" name="author" required="required">
<option value=""> Select Author</option>
<?php 

$sql = "SELECT * from  tblauthors ";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>  
<option value="<?php echo htmlentities($result->Au_id);?>"><?php echo htmlentities($result->AuthorName);?></option>
 <?php }} ?> 
</select>
</div>

 <div class="form-group">
 <label>Year/Edition</label>
 <input class="form-control" type="text" name="edition" />
 </div>
 <div class="form-group">
 <label>Publisher</label>
 <input class="form-control" type="text" name="publisher" />
 </div>
<button type="submit" name="add" class="btn btn-info">Add </button>

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
