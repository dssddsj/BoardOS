<?PHP
include_once dirname(__FILE__) . '/core/engine.php'; 
define('DOCROOT', dirname(__FILE__));
$engine = new engine;
$install = $db -> Get("2","members", '', '', 'id');
if (!$install) {
	echo '<script>window.location.replace("install.php");</script>';
}
?>

<?php
$time = microtime();
$time = explode(' ', $time);
$time = $time[1] + $time[0];
$start = $time;
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="themes/default/favicon.png">

    <title>BLAH - כותרת שונה לאתר שונה</title>
    

    <!-- Bootstrap core CSS -->
    <link href="themes/default/css/bootstrap.css" rel="stylesheet">
	<link rel="stylesheet" href="themes/default/fonts/font-awesome/css/font-awesome.min.css">

    <!-- Custom styles for this template -->
	<link rel="stylesheet" href="themes/default/js/plugins/morris/morris.css">
	<link rel="stylesheet" href="themes/default/js/plugins/fullcalendar/fullcalendar/fullcalendar.css">
	<link href="themes/default/css/style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="../../assets/js/html5shiv.js"></script>
      <script src="../../assets/js/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div class="collapse navbar-collapse">
         <a class="logo" href="index.php"><img src="themes/default/img/logo.png"></a>
          <ul class="nav navbar-nav">
            <li class="active"><a href="index.php">פורום</a></li>
            <li><a href="index.php">משתמשים</a></li>
              <?PHP 
	
	
	if (isset($_SESSION['username'])) { $user_name = $db ->Get(1,"members", 'id', $_SESSION['username'], 'username');echo '<li class="dropdown login"><a class="dropdown-toggle" data-toggle="dropdown" href="#">'.$user_name[0].'</a>
        <ul class="dropdown-menu">
          <li><a href="?showProfile='.$_SESSION['username'].'">הפרופיל שלי</a></li>
          <li><a href="#">עריכת משתמש</a></li>
          <li class="divider"></li>
          <li><a href="?act=logout">התנתק</a></li>
        </ul></li>
';}
	else {echo '<li><a data-toggle="modal" href="#signup">הרשמה</a></li><li class="login"><a data-toggle="modal" href="#login">התחבר</a></li>
';}
	
	
	?>
          
          </ul>
        </div><!--/.nav-collapse -->
       
      </div>
    </div>
    

   
    <div class="container"> 
    <?PHP $engine->start(); ?>  
    </div><!-- /.container -->
    
    </div></div>
    <div class="container"> 
<div class="row">
        <div class="col-lg-12">
         <div class="footer">
         מופעל ע"י <span class="logo-icon">BoardOS</span> גרסה 1.0 Alpha
         <ul>
         <li><a href="#">עלינו</a></li>
         <li><a href="#">בלוג</a></li>
         <li><a href="#">עזרה</a></li>
         <li class="highlight"><a href="#">@twitter</a></li>
         <li class="highlight"><a href="#">@facebook</a></li>
         </ul>
         </div>
         
        </div>
        </div>
       
       
      </div>
    
     <!-- Modal -->
  <div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">התחברות למערכת</h4>
        </div>
        <div class="modal-body">
        <form class="form-signin" action="?act=login" method="POST">
        <input type="text" class="form-control" name="username" placeholder="אימייל או שם משתמש" required>
        <br />
        <input type="password" class="form-control" name="password" placeholder="סיסמה" required>

 
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">סגור</button>
          <input type="submit" class="btn btn-primary" value="התחבר">
          </form>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  
  
   <!-- Modal -->
  <div class="modal fade" id="edit-post" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">עריכה</h4>
        </div>
        <div class="modal-body">
        <form class="form-signin" action="?act=login" method="POST">
     

 
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">סגור</button>
          <input type="submit" class="btn btn-primary" value="עריכה">
          </form>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  
      <!-- Modal -->
  <div class="modal fade" id="signup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">הרשמה לפורום</h4>
        </div>
        <div class="modal-body">
        <form class="form-signin" action="?act=signup" method="POST">
        <input type="text" class="form-control" name="username" placeholder="שם משתמש" required>
        <br />
        <input type="password" class="form-control" name="password" placeholder="סיסמה" required>
        <br />
        <input type="text" class="form-control" name="first_name" placeholder="שם פרטי" required>
        <br />
        <input type="text" class="form-control" name="last_name" placeholder="שם משפחה" required>
        <br />
        <input type="email" class="form-control" name="email" placeholder="אימייל" required>
        <br />

 
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">סגור</button>
          <input type="submit" class="btn btn-primary" value="הרשם למערכת">
          </form>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script src="themes/default/js/bootstrap.min.js"></script>
   <script src="themes/default/js/twitter-bootstrap-hover-dropdown.js"></script>
    <script src="core/libraries/editors/ckeditor/ckeditor.js"></script>



  
   <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-44987275-1', 'vauls.com');
  ga('send', 'pageview');

</script>

   <script>$(function () { $("[data-toggle='tooltip']").tooltip(); });</script>
   
   <?php
$time = microtime();
$time = explode(' ', $time);
$time = $time[1] + $time[0];
$finish = $time;
$total_time = round(($finish - $start), 4);
echo '<p style="text-align:center;">הדף נטען ב'.$total_time.' שניות</p>';
?>
    
  </body>
</html>

