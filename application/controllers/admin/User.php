<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!authCheck("admin")) {
            redirect("admin/login");
        }
    }

    public function index()
    {
        $data['session'] = $this->session->userdata['admin'];
        $xcrud = xcrud_get_instance();
        $xcrud->table('users');
        $session = $this->session->userdata['admin'];
        if ($session->role != "admin") {
            $xcrud->unset_edit(true); // 'admin' row can be editable
            $xcrud->unset_remove(true);
        }
        $xcrud->columns(array("username", "email", "password", "country", "role"));
        $xcrud->fields(array("password", 'created_at'), true);
        $menu = $this->loadMenu("user");
        $this->twig->display('admin/xcrud', compact('xcrud', 'data','menu'));
    }
}
