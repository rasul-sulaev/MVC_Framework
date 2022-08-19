<?php

namespace application\controllers;
use application\core\Controller;

class AccountController extends Controller {
    public function loginAction() {
        if (!empty($_POST)) {
            $this->view->message('success', 'текст сообщения');
        }
        $this->view->render('Вход');
    }
    public function registerAction() {
        if (!empty($_POST)) {
            $this->view->message('success', 'текст сообщения');
        }

        $this->view->layout = 'custom';
        $this->view->render('Регистрация');
    }
}