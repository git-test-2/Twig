<?php
namespace App\Controllers;

use App\Database\MicroBlogUsers;
use App\Models\Message;
use App\Models\User;

class AdminBlogConroller extends BaseController
{
    public function index()
    {
        $massageModel = new Message();
        $imageModel = new \App\Models\Image();


        $allMessages = $massageModel->getAll();

        $userId = $this->auth->user()['id'];
        if($_GET){
            $massageModel->delete(key($_GET));

            echo key($_GET);
        }


        if($_POST){

            if (!empty($_FILES['userfile']['tmp_name'])) {
                $imageModel->add($_FILES['userfile']['tmp_name'],$massageModel->getLastInsertId());
            }

            $massageModel->add($userId,$_POST['text']);
            $this->redirect('blog');
        }
//        $users = MicroBlogUsers::all();
          return  $this->render('front/adminBlog',['messages'=>$allMessages]);

    }

    public function users()
    {
        $users = MicroBlogUsers::all();

        if (!in_array($this->auth->user()['id'], ADMIN_ID)) {
            return 0;
        }
        $userModel = new MicroBlogUsers();
//        $result = $userModel->newQuery()->select('*')->get();

        $result = MicroBlogUsers::all();
        $userM = new User();
        if ($_GET) {
            $userM->delete(key($_GET));
            return $this->redirect('adminUsers');
//           echo key($_GET);
        }
        if ($_POST['id_change']) {
            $userM->edit($_POST);
            return $this->redirect('adminUsers');
        }
        if($_POST){
            $userM->add($_POST);
            return $this->redirect('adminUsers');
        }

        //костыль
        $frontController = new FrontController();


        $isValid = $frontController->validationRegisterForm($_POST);
        $error = [];
        if ($isValid !== true) {
            $error = $isValid;
            foreach ($error as $key => $value) {
                $error[$key] = strip_tags($value);
            }
            $this->render('front/usersAdmin', ['list' => $result,'error' => $error, 'result' => 'Add failed']);
            return 0;
        }
        $user = $userModel->getByEmail($_POST['email']);
        if (!empty($user)) {
            $this->render('front/usersAdmin', ['list' => $result, 'error' => $error, 'result' => 'Add failed, user already exist']);
            return 0;
        }
        $userModel->add($_POST);
        $this->view->render('front/usersAdmin', ['list' => $result, 'error' => $error, 'result' => 'Add success']);

        return $this->render('front/usersAdmin',['users'=>$users]);
    }



}