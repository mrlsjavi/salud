<?php

class Live extends Controller{

	function __construct(){
		parent::__construct(); //llamar el construct del padre que es controller(libs/controller)


		//Auth::handleLogin();

		
		//ya tenogo incluido el jquery y aqui mando a llamar su javascript independiente de cada vista 
		$this->view->js = array('live/js/default.js', 'live/js/circle-progress.js', 'live/js/gradient-progress-bar.js', 'live/js/Chart.js', 'live/js/tableExport.js', 'live/js/jquery.base64.js', 'live/js/sprintf.js', 'live/js/base64.js', 'live/js/html2canvas.js', 'live/js/jspdf.js');

		
	}

	function index(){
		$this->view->title = 'Live';
		$this->view->render('header');
		//echo Hash::create('md5', 'test', HASH_PASSWORD_KEY);
		//echo Hash::create('sha256', 'test', HASH_PASSWORD_KEY);
		//vista carpeta/archivo
		$this->view->render('live/index');
		$this->view->render('footer');
	}

	

	function guardar(){
		$this->model->guardar();
	}

	function vivo(){
		$this->model->vivo();
	}

	function select(){
		$this->model->select();
	}

	function historial(){
		$this->model->historial();
	}

	function llenar_tabla(){
		$this->model->llenar_tabla();
	}

    //http://js-tutorial.com/jquery-circle-progress-draw-animated-circular-progress-bars-1114


	
}