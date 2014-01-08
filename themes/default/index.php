<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../assets/ico/favicon.png">

    <title>Boardial - מערכת פורומים חינמית -> עמוד הבית</title>

    <!-- Bootstrap core CSS -->
    <link href="themes/default/css/bootstrap.css" rel="stylesheet">
	<link rel="stylesheet" href="fonts/font-awesome/css/font-awesome.min.css">

    <!-- Custom styles for this template -->
	<link rel="stylesheet" href="js/plugins/morris/morris.css">
	<link rel="stylesheet" href="js/plugins/fullcalendar/fullcalendar/fullcalendar.css">
	<link href="themes/default/css/style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="../../assets/js/html5shiv.js"></script>
      <script src="../../assets/js/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"><img src="themes/default/img/logo.png"></a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="index.php">פורום</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
    
    
    
   
    <div class="container"> 
    <?PHP content(); ?>  
    </div><!-- /.container -->
    
    </div></div>
 <!--<div id="footer" class="footer">
      <div class="container">
     </span></p>
      </div>
    </div>-->
    
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
    <script src="js/bootstrap.min.js"></script>
   <script src="js/twitter-bootstrap-hover-dropdown.js"></script>
   <script src="js/plugins/ckeditor/ckeditor.js"></script>
   <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-44987275-1', 'vauls.com');
  ga('send', 'pageview');

</script>

   <script>$(function () { $("[data-toggle='tooltip']").tooltip(); });</script>
    
  </body>
</html>
