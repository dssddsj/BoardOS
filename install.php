<?PHP
include_once dirname(__FILE__) . '/core/config.php'; 
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
        "http://www.w3.org/TR/html4/loose.dtd">
 
<html>
 
<head>
    <meta http-equiv="Content-type" content="text/html;charset=UTF-8">
    <title>Site Maintenance</title>
    <style type="text/css">
      body { text-align: center; padding: 150px; direction:rtl; }
      h1 { font-size: 50px; }
      body { font: 20px Helvetica, sans-serif; color: #333; }
      #article { display: block; text-align: right; width: 650px; margin: 0 auto; }
      a { color: #dc8100; text-decoration: none; }
      a:hover { color: #333; text-decoration: none; }
    </style>
 
</head>
<body>
<div id="article">
    <h1>ברוכים הבאים לBoardOS</h1>
    <div>
<?PHP

if (isset($_GET['stage'])) {
	if ($_GET['stage'] == 2) {
		include_once dirname(__FILE__) . '/core/engine.php'; 
define('DOCROOT', dirname(__FILE__));
$engine = new engine;
$password = hash('sha256', 'admin');
$date = date("m.d.y H:i:s");

$count = $db -> Get("2","members", '', '', 'id');
$count = count($count);

$install = $db -> Get("2","members", '', '', 'id');
if ($install) {
	echo 'שלב זה כבר בוצע, אנא מחקו קובץ זה.';
}

else {

// New User - admin:admin
$columns = array('username','password','email','first_name','last_name', 'join_date', 'rank');
$values = array('admin', $password, 'admin@admin.com', 'Admin', 'Admin', $date, 5);
$db -> Add("members", $columns, $values);

// Sample Category
$columns = array('name','description');
$values = array('הקטגוריה הראשונה שלי', 'תיאור על הקטגוריה הראשונה שלי');
$db -> Add("categories", $columns, $values);

// Sample Forum
$columns = array('name','description', 'category', 'managers', 'icon', 'parent');
$values = array('הפורום הראשון שלי', 'זהו תיאור קצר אודות הפורום הראשון שלי', 1, '', 'flag', 0);
$db -> Add("forums", $columns, $values);

// Add Basic Ranks
$columns = array('name', 'color');
$values = array('משתמש רגיל', '#2c3e50');
$db -> Add("ranks", $columns, $values);

$columns = array('name', 'color');
$values = array('משתמש רגיל', '#2c3e50');
$db -> Add("ranks", $columns, $values);

$columns = array('name', 'color');
$values = array('מנהל פורום', 'orange');
$db -> Add("ranks", $columns, $values);

$columns = array('name', 'color');
$values = array('מנהל ראשי', '#39d9df');
$db -> Add("ranks", $columns, $values);

$columns = array('name', 'color');
$values = array('מנהל האתר', '#84c800');
$db -> Add("ranks", $columns, $values);

// Sample Thread


// Sample Post


echo 'ההתקנה הסתיימה בהצלחה. להלן פרטי ההתחברות הראשוניים שלך למערכת :<br /><br /><b>שם משתמש :</b> admin <br /> <b>סיסמה :</b> admin <br /><br /><h3>חשוב מאוד : אנא מחק קובץ זה (install.php) באופן מיידי.</h3><br /><a href="index.php">לחץ כאן על מנת לעבור למערכת הפורומים שלך.</a>';
session_destroy();
	}
}

}

else {

global $host, $user, $pass, $db_name;
$con=@mysqli_connect($host,$user,$pass,$db_name);
// Check connection
if (@mysqli_connect_errno())
  {
  //echo mysqli_connect_error();
  echo '<p>המערכת לא הצליחה להתחבר למסד שהוגדר בקובץ Config.php. אנא בדוק שנית את הגדרות הקובץ ונסה שנית.</p>';
  }


include_once dirname(__FILE__) . '/core/engine.php'; 
define('DOCROOT', dirname(__FILE__));
$engine = new engine;
$password = hash('sha256', 'admin');
$date = date("m.d.y H:i:s");

$count = $db -> Get("2","members", '', '', 'id');
$count = count($count);

$install = $db -> Get("2","members", '', '', 'id');
if ($install) {
	echo 'שלב זה כבר בוצע, אנא מחקו קובץ זה.';
}

else {
   
// Create database
$sql = "CREATE TABLE IF NOT EXISTS categories
(
id INT NOT NULL AUTO_INCREMENT, 
PRIMARY KEY(id),
name TEXT CHARACTER SET utf8,
description TEXT CHARACTER SET utf8
);";

$sql .= "CREATE TABLE IF NOT EXISTS forums
(
id INT NOT NULL AUTO_INCREMENT, 
PRIMARY KEY(id),
name TEXT CHARACTER SET utf8,
description TEXT CHARACTER SET utf8,
category INT,
managers INT,
icon TEXT CHARACTER SET utf8,
parent INT
);";

$sql .= "CREATE TABLE IF NOT EXISTS members
(
id INT NOT NULL AUTO_INCREMENT, 
PRIMARY KEY(id),
username TEXT CHARACTER SET utf8,
password TEXT CHARACTER SET utf8,
email TEXT CHARACTER SET utf8,
first_name TEXT CHARACTER SET utf8,
last_name TEXT CHARACTER SET utf8,
join_date TEXT CHARACTER SET utf8,
rank INT
);";

$sql .= "CREATE TABLE IF NOT EXISTS permissions
(
id INT NOT NULL AUTO_INCREMENT, 
PRIMARY KEY(id),
forum_id INT,
view INT,
post INT,
post_threads INT,
rank_id INT,
category_id INT
);";

$sql .= "CREATE TABLE IF NOT EXISTS posts
(
id INT NOT NULL AUTO_INCREMENT, 
PRIMARY KEY(id),
content TEXT CHARACTER SET utf8,
user INT,
thread INT,
publish_date TEXT,
edit_date TEXT
);";

$sql .= "CREATE TABLE IF NOT EXISTS ranks
(
id INT NOT NULL AUTO_INCREMENT, 
PRIMARY KEY(id),
name TEXT CHARACTER SET utf8,
color TEXT CHARACTER SET utf8
);";

$sql .= "CREATE TABLE IF NOT EXISTS threads
(
id INT NOT NULL AUTO_INCREMENT, 
PRIMARY KEY(id),
title TEXT CHARACTER SET utf8,
content TEXT CHARACTER SET utf8,
user INT,
forum INT,
publish_date TEXT CHARACTER SET utf8,
views INT,
locked INT,
pinned INT
)";
}

if (@mysqli_multi_query($con,$sql))
  {
  echo "מסד הנתונים הותקן בהצלחה ! <a href='?stage=2'>לחץ כאן על מנת לעבור לשלב הבא</a>";
  }
else
  {
  // DB
  }
}
?>
    </div>
    </div>
</body>
</html>
