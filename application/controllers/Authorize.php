<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authorize extends Degeo_Controller {

	public function index(){
		$this->login();
	} // function
	
	public function login(){
		if( $this->Account_Security->is_authorized() )
			redirect( site_url('dashboard'), 'location', 301 );
		
		$form_rules = array(
			array(
				'field' => 'account_username',
				'label' => 'Username',
				'rules' => 'required'
				),
			array(
				'field' => 'account_password',
				'label' => 'Password',
				'rules' => 'required|sha1'
				)
			);

		$this->form_validation->set_rules( $form_rules );

		if( $this->form_validation->run() === TRUE ):
			if( $userdata = $this->Account->read( array( 'account_username' => set_value( 'account_username' ), 'account_password' => set_value( 'account_password' ) ) ) ):
				# switch success message to flashdata
				# $this->Messages->add( 'success', "Welcome back, You've sucessfully logged in as {$userdata[0]['account_username']}!" );
				$this->Account_Security->authorize_user( $userdata[0] );
			else:
				$this->Messages->add( 'warning', 'Your login attempt failed. Please check your email and password and try again.' );
			endif;
		endif;
		
		$validation_errors = rtrim( validation_errors( '', ',' ), ',');
		$validation_errors = explode( ',', $validation_errors );
		if( !empty( $validation_errors ) ):
			foreach( $validation_errors as $error ):
				$this->Messages->add( 'warning', $error );
			endforeach;
		endif;
		
		$this->Layout->add_content( 'account-login-form', 'Accounts/login-form', 50 );
		$this->Layout->view( $this->Application->get_data() );
	} // function
	
	public function logout(){
		$this->Account_Security->destroy_session();
		
		redirect( site_url(), 'location', 301 );
	} // function
	
} // class
