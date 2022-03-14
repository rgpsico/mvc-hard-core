<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\LoginForm;
use app\models\User;

class AuthController extends Controller
{

    public function login(Request $request, Response $response)
    {
        $loginForm = new LoginForm();

        if ($request->isPost()) {
            $loginForm->loadData($request->getBody());
            if ($loginForm->validate() && $loginForm->login()) {
                $response->redirect('/');
                //Application::$app->login();
                return;
            }
        }

        $this->setLayout('auth');
        return $this->render('login', [
            'model' => $loginForm
        ]);
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

    public function logout(Request $request, Response $response)
    {
        Application::$app->logout();
        $response->redirect('/');
    }
}
