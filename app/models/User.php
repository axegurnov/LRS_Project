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
    		$_SESSION["errors"]["nodata"] = "Please, fill in the fields";
    	} 
    	else {
    		$this->oneUserCheck();
		}
    }

    //проверка существования пользователя
    public function oneUserCheck() 
    {
		$namecheckquery = "SELECT login, password FROM lrs.users WHERE login='" . $this->login . "'; ";
		$this->namecheck = $this->db->query($namecheckquery);

		if (!$this->namecheck) {
			$_SESSION["errors"]["nores"] = "Name check query failed";
		} 
		else {
            if (mysqli_num_rows($this->namecheck) != 1) {
                    $_SESSION["errors"]["noname"] = "Either no user with name, or more than one";
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
			$_SESSION["errors"]["nopass"] = "Incorrect password";
		} 
		else {
		    unset($_SESSION["errors"]);
			$_SESSION["auth"] =  $existinginfo["login"];
		}
	}

    public function exit()
    {
    	unset($_SESSION["auth"]);
    }
}
?>