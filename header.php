<div class="navbar navbar-inverse set-radius-zero" >
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" >
                    <img src="assets/img/sapthbig.bmp" />
                    <h4 style="float:right;font-size:20px;color:blue;font-family:Ariel"><b>  <br>SCE-CSE Library</b></h4>
                </a>

            </div>
            <div class="container">
            <div class="right-div">
                <img src="assets/img/navi.bmp" width="200px" height="25%" />
            </div>
            </div>
<?php if($_SESSION['login'])
{
?> 
            <div class="container-fluid">
                <div class="rigth-div">
                <a href="logout.php" class="btn btn-danger pull-right" style="margin-bottom: 1em;">LOG ME OUT</a>
            </div>
            </div>
            <?php }?>
        </div>
    </div>
    <!-- LOGO HEADER END-->
<?php if($_SESSION['login'])
{
?>    
<section class="menu-section">
        <div class="container">
            <div class="row ">
                <div class="col-md-12">
                    <div class="navbar-collapse collapse ">
                        <ul id="menu-top" class="nav navbar-nav navbar-right">
                            <li><a href="dashboard.php" class="menu-top-active">DASHBOARD</a></li>
                            <li><a href="available-books.php">Available Books</a></li>
                            <li><a href="issued-books.php">Issued Books</a></li>
                            <li><a href="history.php">History</a></li>
                            <li><a href="change-password.php">CHANGE PASSWORD</a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <?php } else { ?>
        <section class="menu-section">
        <div class="container">
            <div class="row ">
                <div class="col-md-12">
                    <div class="navbar-collapse collapse ">
                        <ul id="menu-top" class="nav navbar-nav navbar-right">                        
                          
  <li><a href="adminlogin.php">Admin Login</a></li>
                             <li><a href="index.php">User Login</a></li>
                          

                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <?php } ?>