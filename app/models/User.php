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
            $errors["empty"] = "Please, fill in the fields";
        } else {
            $errors = $this->oneUserCheck();
        }
        return $errors;
    }

    //проверка существования пользователя
    public function oneUserCheck()
    {
        $namecheckquery = "SELECT login, password FROM lrs.users WHERE login='" . $this->login . "'; ";
        $this->namecheck = $this->db->query($namecheckquery);
        if (!$this->namecheck) {
            $errors["name"] = "Name check query failed";
        } else {
            if (mysqli_num_rows($this->namecheck) != 1) {
                $errors["auth"] = "Either no user with name, or more than one";
            } else {
                $errors = $this->passwordCheck();
            }
        }
        return $errors;
    }

    //хеширование паролей и их сверка
    public function passwordCheck()
    {
        //get login info from query
        $existinginfo = $this->namecheck->fetch_array(MYSQLI_ASSOC);
        $hash = $existinginfo["password"];
        if (!password_verify($this->password, $hash)) {
            $errors["auth"] = "Incorrect password";
        } else {
            unset($errors);
            $_SESSION["auth"] = $existinginfo["login"];
        }
        return $errors;
    }

    public function exit()
    {
        unset($_SESSION["auth"]);
    }
}

?>
