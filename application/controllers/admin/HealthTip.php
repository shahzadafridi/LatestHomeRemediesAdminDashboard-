<?php defined('BASEPATH') OR exit('No direct script access allowed');

class HealthTip extends MY_Controller
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
        $data['session'] =  $this->session->userdata['admin'];
        $xcrud = xcrud_get_instance();
        $session = $this->session->userdata['admin'];
        if ($session->role != "admin") {
            $xcrud->unset_edit(true); // 'admin' row can be editable
            $xcrud->unset_remove(true);
        }
        $xcrud->table('health_tips');
        $xcrud->relation('category_id', 'sub_categories', 'id','name');
        $xcrud->label(array('category_id' => 'Category'));
        $xcrud->fields(array('slug'), true);
        $xcrud->columns(array("image","category_id","title","tag"));
        $xcrud->change_type('image', 'image', '', array('width' => 300, 'path' => '../../assets/uploads/health_tips'));
        $menu = $this->loadMenu("healthtip");
        $xcrud->column_class('image', 'zoom_img');
        $this->twig->display('admin/xcrud', compact('xcrud', 'data','menu'));

    }
}
