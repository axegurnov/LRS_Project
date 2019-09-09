<?php
namespace app\models;
use app\core\Model;
use mysqli;

class User extends Model
{
    public $table = 'users';
    private $namecheck = "";
    private $login = "";
    private $password = "";

	//проверка введённых значений
    public function validAuth($login, $password)
    {
    	$this->login = $login;
    	$this->password = $password;
    	if (($this->login == "") || ($this->password == "")) {
    		$_POST["errors"]["nodata"] = "Please, fill in the fields";
    	} 
    	else {
    		$this->oneUserCheck();
		}
    }

    //проверка существования пользователя
    public function oneUserCheck() 
    {
		$usernameclean = filter_var($this->login, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);

		$namecheckquery = "SELECT login, password, status FROM lrs.users WHERE login='" . $usernameclean . "'; ";
		$this->namecheck = $this->db->query($namecheckquery);

		if (!$this->namecheck) {
			$_POST["errors"]["nores"] = "Name check query failed";
		} 
		else {
			if (mysqli_num_rows($this->namecheck) != 1) {
					$_POST["errors"]["noname"] = "Either no user with name, or more than one";
				} 
				else {
					$this->passwordCheck();
				}
		}
	}

	//хеширование паролей и их сверка
	public function passwordCheck() 
	{
		//get login info from query
		$existinginfo = $this->namecheck->fetch_array(MYSQLI_ASSOC);
		$hash = $existinginfo["password"];
		if (!password_verify($this->password, $hash)) {
			$_POST["errors"]["nopass"] = "Incorrect password";
		} 
		else {
			setcookie("user", "login_success", time() + 3600, "/");
			/*
			$_SESSION["auth"] = true;
			$_SESSION["login"] = $existinginfo["login"];
			$_SESSION["status"] = $existinginfo["status"];
			*/
		}
	}

    public function exit() 
    {
    	setcookie("user", "login_success", time() - 3600, "/");
    }
}
?>