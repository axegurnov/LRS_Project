<?php
namespace app\controllers;

use app\core\Controller;

class UserController extends Controller {

    protected $nameModel = 'users';
  //  protected $table = 'users';

    public function indexAction($params)
    {
        $limit = 3;
        if (empty($params['page'])) {
            $params['page'] = 1;
        };
        $offset = ($params['page'] - 1) * $limit;
        $users = $this->model->pagination($offset, $limit, $this->nameModel);
        $count_id = $this->model->countId();
        $ttl = $count_id[0];
        $pages = ceil($ttl / $limit);
        $vars = [
            'title' => 'User',
            'users' => $users,
            'pages' => $pages
        ];
        $this->view->generate('user/index.tlp', $vars);
    }
	
	//форма авторизации и попытка залогиниться
	public function authAction() 
	{
        if (!empty($_SESSION["auth"])) {
            return $this->redirect("/lrs/list");
        }
		if (isset($_POST["loginButton"])) {
			$login = $this->filterVar($_POST['login']);
    		$password = $_POST["password"];
			$this->model->validAuth($login, $password);
			if (!isset($_SESSION["errors"])) {
				return $this->redirect("/lrs/list");
			}
		}
		$this->view->generate('user/auth.tlp');
	}

	public function userViewUpdateAction()
    {
        $userInfo = '';
        if (isset($_POST['id'])) {
            $str = "id=".$_POST['id'];
            $userInfo = $this->model->select($str);
        }
        $vars = [
            'title' => 'User form',
            'data_field' => $userInfo
        ];
        $this->view->generate('user/update.tlp',$vars);
    }

	public function userUpdateAction()
	{
        $id = $_POST['id'];
        $login = $this->filterVar($_POST['login']);
        $data_field = $_POST;

        if (!empty($_POST['id'])) {
           $valid = $this->model->setValues($data_field);
           if($valid){
            $password = $this->hashPassword($_POST['password']);
            $this->model->setValue('password',$password);
            $this->model->updateRecord($id);

            $this->redirect('../users');
           }
           else {
               $userInfo = $data_field;
               $vars = [
                   'title' => 'User form',
                   'data_field' => $userInfo
               ];
               $this->view->generate('user/update.tlp',$vars);
           }
            unset ($_SESSION['errors']);
        }
        elseif (empty($_POST['id'])) {
            array_pop($data_field);
            $valid = $this->model->setValues($data_field);

            if($valid) {
                $password = $this->hashPassword($_POST['password']);
                $this->model->setValue('password',$password);
                $this->model->addRecord();
                $this->redirect('../users');
            }
            else{
                $userInfo = $data_field;
                $vars = [
                    'title' => 'User form',
                    'data_field' => $userInfo
                ];
                $this->view->generate('user/update.tlp',$vars);
            }
            unset ($_SESSION['errors']);
        }
        elseif (empty($_POST['id'])) {
            $this->model->setValues($data_field);
            $this->model->addRecord();
            $this->redirect('/users');
        }
	}

    public function userDelAction()
    {
        $id = $_POST['id'];
        $this->model->dropRecord($id);
        $this->redirect('/users');
    }

	//разлогирование и выход на экран авторизации
	public function exitAction() 
	{
		$this->model->exit();
		$this->redirect("/login");
	}
}
?>