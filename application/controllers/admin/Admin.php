<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

    }

    //Last time checking Git version of cpanel.

    public function index()
	{
        $this->twig->display('admin/login');
	}


}
