<?php
namespace app\models;
use app\core\Model;
use mysqli;

class User extends Model
{
    public $table = 'users';

    public function auth(){
    	$login = $_POST["login"];
    	$password = $_POST["password"];
    	if (($login == "") || ($password == "")) {
    		$_POST["errors"]["nodata"] = "Please, fill in the fields";
    	} else{
			$usernameclean = filter_var($login, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);

			//check if name exists
			//$namecheckquery = "SELECT login, password, status FROM lrs.users WHERE login='" . $usernameclean . "'; ";
			//$namecheck = $this->db->query($namecheckquery);

			$value1 = "login, password, status";
			$value2 = "login='" . $usernameclean . "'";
			$namecheck = $this->select($value1, $value2);

			if (!$namecheck) {
				$_POST["errors"]["nores"] = "Name check query failed";
			} else {
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
						/*
						$_SESSION["auth"] = true;
						$_SESSION["login"] = $existinginfo["login"];
						$_SESSION["status"] = $existinginfo["status"];
						*/
					}
				}
			}
		}
    }

    public function exit() 
    {
    	setcookie("user", "login_success", time() - 3600, "/");
    }
}
?>
