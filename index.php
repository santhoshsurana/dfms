<?php session_start(); ?>
<!doctype html>
<html>
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width' />
    <title>DFMS</title>
    <link rel='stylesheet' type='text/css' href='css/bootstrap.css'>
    <link rel='stylesheet' type='text/css' href='css/bootstrap-responsive.min.css'>
    <link rel="stylesheet" type="text/css" href="css/datatables.css">
    <link rel="stylesheet" type="text/css" href="css/datepicker.css" />
    <link rel='stylesheet' type='text/css' href='css/style.css'>
        <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="img/144.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="img/114.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="img/72.png">
                    <link rel="apple-touch-icon-precomposed" href="img/57.png">
                                   <link rel="shortcut icon" href="img/29.png">
</head>
<body>
  <div class='alert_box span4' id="alert_box">        
    <div class='alert alert-error' style='display:none;' id='error'>
          <button type='button' class='close' data-dismiss='alert'>&times;</button>
          <h4>Failed!</h4>
        <p id='errorTxt' class="text-error"></p>
    </div>
    <div class='alert alert-success' style='display:none;' id='success'>
          <button type='button' class='close' data-dismiss='alert'>&times;</button>
          <h4>Success!</h4>
        <p id='successTxt' class="text-success"></p>
    </div>
    <div class='alert alert-warning' style='display:none;' id='warning'>
          <button type='button' class='close' data-dismiss='alert'>&times;</button>
          <h4>Warning!</h4>
        <p id='warningTxt' class="text-warning"></p>
    </div>
    <div class='alert alert-info' style='display:none;' id='info'>
          <button type='button' class='close' data-dismiss='alert'>&times;</button>
          <h4>Notification!</h4>
        <p id='infoTxt' class="text-info"></p>
    </div>
  </div>
<?php if(isset($_SESSION['employeename'])) {?>
    <header class="top-header">
        <div class='navbar navbar-inverse'>
            <div class='navbar-inner'>
                <a class='brand' href='index.php'>
                    <img src='img/29.png' alt='DFMS' />
                </a>
                   
                    <a class='btn btn-navbar' data-toggle='collapse' data-target='.navbar-responsive-collapse'>
                        <span class='icon-bar'></span>
                        <span class='icon-bar'></span>
                        <span class='icon-bar'></span>
                    </a>
                    <div class='nav-collapse collapse navbar-responsive-collapse'>
                        <ul class='nav'>
                            <li id='home'><a href='#'  onClick="display('home.php');">Home</a>
                            </li>
                            <li class='dropdown'>
                                <a href='#' class='dropdown-toggle' data-toggle='dropdown'>Customers<b class='caret'></b></a>
                                <ul class='dropdown-menu'>
                                    <li><a href='#' onClick="display('createcustomer.php');">Create customers</a>
                                    </li>
                                    <li class=''><a href='#' onClick="display('class/viewcustomers.class.php');">View customers</a>
                                    </li>
                                </ul>
                            </li>
                            <li class='dropdown'>
                                <a href='#' class='dropdown-toggle' data-toggle='dropdown'>Accounts<b class='caret'></b></a>
                                <ul class='dropdown-menu'>
                                    <li><a href='#' onClick="display('createaccount.php');">create Loan Account</a>
                                    </li>
                                    <li class=''><a href='#' onClick="display('class/viewaccounts.class.php');">view Loan account</a>
                                    </li>
                                </ul>
                            </li>
                            <li class='dropdown adminOnly'>
                                <a href='#' class='dropdown-toggle' data-toggle='dropdown'>Reports <b class='caret'></b></a>
                                <ul class='dropdown-menu'>
                                    <li id='reports'><a href='#'  onClick="display('reports.php');">Daily Collection Reports</a>
                                    </li>
                                    <li><a href='#' onClick="display('interest.php');">Monthly Interest Reports</a>
                                    </li>
                                </ul>
                            </li>
                            <li class='dropdown adminOnly'>
                                <a href='#' class='dropdown-toggle' data-toggle='dropdown'>Employee <b class='caret'></b></a>
                                <ul class='dropdown-menu'>
                                    <li><a href='#' onClick="display('createemployee.php');">Create employee</a>
                                    </li>
                                    <li><a href='#' onClick="display('class/viewemployees.class.php');">View employee</a>
                                    </li>
                                </ul>
                            </li>
                            <li id='backups'><a href='#'  onClick="display('class/backup.class.php');">Backup</a>
                            <li><a href='logout.php'>Logout</a></li>
                        </ul>
                        <form class='input-append navbar-search  pull-right'>
                            <input placeholder='Search' id='search' type='text'>
                            <button class='btn' type='button' onKeyPress="charChk(event,'alphanum');" onClick="searchEngine();"><i class='icon-search'></i>
                            </button>
                        </form>

                    </div>
                    <!-- /.nav-collapse -->
            </div>
        </div>
        <!-- /navbar-inner -->
    </header>

    <!-- this is where data will be rendered -->
    <div  class='container-fluid'>
      <div class="row-fluid">
      
         <div id='data'>

         </div>
      </div>
    </div>





    <?php }else{?>
              <div class='alert_box span4' id="alert_box">        
                  <div class='alert alert-error' style='display:none;' id='error'>
                        <button type='button' class='close' data-dismiss='alert'>&times;</button>
                        <h4>Failed!</h4>
                      <p id='errorTxt' class="text-error"></p>
                  </div>
                  <div class='alert alert-success' style='display:none;' id='success'>
                        <button type='button' class='close' data-dismiss='alert'>&times;</button>
                        <h4>Success!</h4>
                      <p id='successTxt' class="text-success"></p>
                  </div>
                  <div class='alert alert-warning' style='display:none;' id='warning'>
                        <button type='button' class='close' data-dismiss='alert'>&times;</button>
                        <h4>Warning!</h4>
                      <p id='warningTxt' class="text-warning"></p>
                  </div>
                  <div class='alert alert-info' style='display:none;' id='info'>
                        <button type='button' class='close' data-dismiss='alert'>&times;</button>
                        <h4>Notification!</h4>
                      <p id='infoTxt' class="text-info"></p>
                  </div>
                </div>

                <div class="container">

      <form class="form-signin">
        <h2 class="form-signin-heading"><img src='img/114.png' alt='login logo' class='logo' longdesc='img/114.png'></h2>
        <label class='control-label' for='employeename'>Username</label>
        <input type='text' id='employeename' required name='employeename' placeholder='enter employeename' class="input-xlarge" />
        <label class='control-label' for='password'>Password</label>
        <input type='password' id='password' required name='password' placeholder='********' class="input-xlarge" />
        <input type='button' name='login' value='login' class='btn btn-large btn-inverse' onClick="logIn();" />
      </form>

    </div> <!-- /container -->
    <?php } ?>
    <!-- footer -->
    <div class='footer'>&copy; <?php echo date( 'Y');?>  Reserved to <a href="#" onClick="display('credit.php');">AzulTech</a></div>
     <!-- Bootstrap core JavaScript-->
    <script src='js/jquery-2.0.3.js'></script>  
    <script src='js/bootstrap.min.js'></script>
    <script src='js/custom.js'></script>
    <script type="text/javascript" charset="utf8" src="js/datatables.js"></script>
   	<script type="text/javascript" src="js/bootstrap-datepicker.js"></script>   
</body>
</html>