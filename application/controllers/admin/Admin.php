<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

    }

    //Test commit for cpanel git version.ss

    public function index()
	{
        $this->twig->display('admin/login');
	}


}