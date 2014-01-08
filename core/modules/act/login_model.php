<?PHP

class model extends act {	
	
	public function __construct() {
		// Get engine construct vars
		parent::__construct();
		
		global $msg, $db;
		
		if (isset($_SESSION['username'])) { 
		$msg = "Already logged in";
		}
		
		else {
		
		if (isset($_POST['username'])) {
			
$username = $_POST['username'];
$pass = $_POST['password'];
$pass = hash('sha256',$pass);

        $type = "username";
			
	if(filter_var($_POST['username'], FILTER_VALIDATE_EMAIL)) {
        $type = "email";
    }
	
			
$check_user = $db ->Get(1,"members", $type, $username, 'id');
$check_user = count($check_user);

$check_pass = $db ->Get(1,"members", 'password', $pass, 'id');
$check_pass = count($check_pass);

$user_id = $db ->Get(1,"members", $type, $username, 'id');

if ($check_user > 0 && $check_pass > 0 ) { 
// Login worked
echo $user_id[0];
$_SESSION['username'] = $user_id[0]; 
$msg = "Login worked.";
}

else {
	$msg = "Login didn't work";
}


			}
		}
	}
}

?>



