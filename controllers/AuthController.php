<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\User;

class AuthController extends Controller
{

    public function login()
    {
        $this->setLayout('auth');
        return $this->render('login');
    }

    public function register(Request $request)
    {


        $User = new User();
        if ($request->isPost()) {


            $User->loadData($request->getBody());



            if ($User->validate() && $User->save()) {
                Application::$app->session->setFlash('success', 'thanks for register');
                Application::$app->response->redirect('/');
                exit;
            }


            return $this->render('register', [
                'model' => $User
            ]);
        }
        $this->setLayout('auth');
        return $this->render('register', [
            'model' => $User
        ]);
    }
}
