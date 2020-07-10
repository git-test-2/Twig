<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User;

Class FrontController extends BaseController
{
    public function index()
    {
        $this->render('front/index',['array'=>123]);
    }

    private function validationRegisterForm(array $post)
    {
        $result = [];
        if (empty($post['name'])) {
            $result[] = 'name is empty';
        }
        if (empty($post['email'])) {
            $result[] = 'email is empty';
        }
        if (empty($post['password'])) {
            $result[] = 'password is empty';
        }
        if (mb_strlen($post['password']) < 4) {
            $result[] = 'password must be more than 4 characters';
        }
        if ($post['password'] !== $post['password-repeat']) {
            $result[] = 'passwords don\'t match';
        }
        return $result;
    }

    public function register()
    {
        $userModel = new User();
        $isValid = $this->validationRegisterForm($_POST);
        if($_POST) {
            if(empty($isValid)) {
                echo 'hi';
                $userModel->add($_POST);
            }
        }

        return $this->render('front/register',['errors'=>$isValid]);

        //$this->redirect('/main');
    }

    public function login()
    {
        $userModel = new User();

        $user = $userModel->get($_POST['email']);

        if (password_verify($_POST['password'], $user['password']) && $user) {

            $this->auth->login($user);
         if($this->auth->admin()){
             return $this->redirect('adminBlog');
         }

         return $this->redirect('blog');
        }
        return $this->render('front/login');
    }


}

