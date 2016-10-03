<?php

class Usuario_Alerta extends Controller{

	function __construct(){
		parent::__construct(); //llamar el construct del padre que es controller(libs/controller)


		//Auth::handleLogin();

		
		//ya tenogo incluido el jquery y aqui mando a llamar su javascript independiente de cada vista 
		$this->view->js = array('usuario_alerta/js/default.js');

		
	}

	function index(){
		$this->view->title = 'Alertas';
		$this->view->render('header');
		//echo Hash::create('md5', 'test', HASH_PASSWORD_KEY);
		//echo Hash::create('sha256', 'test', HASH_PASSWORD_KEY);
		//vista carpeta/archivo
		$this->view->render('usuario_alerta/index');
		$this->view->render('footer');
	}

	

	function guardar(){
		$this->model->guardar();
	}

	function traer_sensor()
	{
		$this->model->traer_sensor();
	}

	function traer_paginas(){
		$this->model->traer_paginas();
	}

	function llenar_tabla(){
		$this->model->llenar_tabla();
	}

	function traer_alertas(){
		$this->model->traer_alertas();
	}

	function verificar_usuario(){
		$this->model->verificar_usuario();
	}

	function traer_dato(){
		$this->model->traer_dato();
	}

	function actualizar(){
		$this->model->actualizar();
	}

	function eliminar(){
		$this->model->eliminar();
	}

	
}