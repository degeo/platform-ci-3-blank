<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Degeo_Restricted_Controller extends Degeo_Controller {

	public function __construct() {
		parent::__construct();
		
		$this->Account->auth_required();
	} // function
	
} // class
