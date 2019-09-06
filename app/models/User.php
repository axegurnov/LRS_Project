<?php
namespace app\models;
use app\core\Model;
use mysqli;

class User extends Model
{
    public $table = 'users';

    public function auth(){
		$usernameclean = filter_var($_POST["login"], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);
		$password = $_POST["password"];

		//check if name exists
		$namecheckquery = "SELECT login, password FROM lrs.users WHERE login='" . $usernameclean . "'; ";

		$namecheck = $this->db->query($namecheckquery);

		if ($namecheck) {
			if (mysqli_num_rows($namecheck) != 1) {
				$_POST["errors"]["noname"] = "Either no user with name, or more than one";
			} else {
				//get login info from query
				$existinginfo = $namecheck->fetch_array(MYSQLI_ASSOC);
				$hash = $existinginfo["password"];

				if (!password_verify($password, $hash)) {
					$_POST["errors"]["nopass"] = "Incorrect password";
				} else {
					setcookie("user", "login_success", time() + 3600, "/");
				}
			}
		} else {
			$_POST["errors"]["nores"] = "Name check query failed";
		}
    }

    public function exit() {
    	setcookie("user", "login_success", time() - 3600, "/");
    }
}
?>
