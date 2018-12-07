<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Degeo_Restricted_Controller {

	public function __construct() {
		parent::__construct();

		$this->Application->set_page_title( 'Dashboard' );
		$this->Breadcrumbs->add_breadcrumb( 'dashboard', 'Dashboard', 10 );
	} // function

	public function index(){
		$this->Layout->view( $this->Application->get_data() );
	} // function

} // class
