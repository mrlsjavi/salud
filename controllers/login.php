<?php

class Login extends Controller{

	function __construct(){
		parent::__construct(); //llamar el construct del padre que es controller(libs/controller)
		
		$this->view->js = array('login/js/default.js');
	}

	function index(){
		$this->view->title = 'Login';
		$this->view->render('header');
		//echo Hash::create('md5', 'test', HASH_PASSWORD_KEY);
		//echo Hash::create('sha256', 'test', HASH_PASSWORD_KEY);
		//vista carpeta/archivo
		$this->view->render('login/index');
		$this->view->render('footer');
	}


	function run(){
		$this->model->run();
	}

	function clave(){
		$this->model->clave();
	}

	function prueba(){
		$this->model->prueba();
	}

	function entrar(){
		$this->model->entrar();
	}
}