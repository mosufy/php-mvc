<?php

class Account_Dashboard extends Account_Base
{
	private $_pathFile = 'account/';
	private $_page = 'dashboard';
	
	function __construct()
	{
		parent::__construct();
	}
    
    public function index()
    {		
		$this->render($this->_pathFile . $this->_page, array(
			'metaTitle' => 'Welcome to the Dashboard',
			'std' => $this->setCommonVars(),
			'page' => 'account',
			'subPage' => 'dashboard',
			'breadcrumb' => array('My Account'=>'account','Dashboard'=>'')
		));
    }
}
