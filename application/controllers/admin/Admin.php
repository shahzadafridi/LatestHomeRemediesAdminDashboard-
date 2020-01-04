<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

    }

    //Test commit for cpanel git version.ss
    //Test Commit by shahzad afirid.
    //Final test commit by shahzad afridi..
    // Last Final Test Commit...
    // Please Final last commit..

    public function index()
	{
        $this->twig->display('admin/login');
	}


}
