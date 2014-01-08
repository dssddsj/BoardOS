<?PHP

class model extends act {	
	
	public function __construct() {
		// Get engine construct vars
		parent::__construct();
		global $db, $date;
		
		$password = hash('sha256', $_POST['password']);
		$check_user = $db ->Get(1,"members", 'username', $_POST['username'], 'id');
$check_email = $db ->Get(1,"members", 'email', $_POST['email'], 'id');

if (strlen($_POST['username']) < 4) {
	$this->error_handler->show('שם המשתמש שלך חייב להכיל לפחות 4 תווים.', 'שם המשתמש שבחרתה אינו מכיל 4 תווים. עליך לבחור בשם משתמש שמכיל לפחות 4 תווים.');
	}

else if (count($check_user) > 0) {
	$this->error_handler->show('המשתמש שבחרתה כבר קיים במערכת.', 'המשתמש שבחרתה כבר קיים, לכן עליך לבחור שם משתמש שונה.');
	}
else if (count($check_email) > 0) {
	$this->error_handler->show('האימייל שבחרתה כבר קיים במערכת.', 'האימייל שבחרתה כבר קיים, לכן עליך לבחור אימייל שונה.');
	}


else {
$columns = array('username','password','email','first_name','last_name','join_date','rank');
$values = array($_POST['username'], $password, $_POST['email'], $_POST['first_name'], $_POST['last_name'], $date, 1);
$db -> Add("members", $columns, $values);
$last_id = $db->getID();
$_SESSION['username'] = $last_id; 

$this->forum_handler->redirect('index.php');

}
		
	}
}

?>



