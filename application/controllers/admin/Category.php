<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends MY_Controller
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
        $xcrud->table('categories');
        $xcrud->fields(array("created_at","slug"), true);
        $xcrud->columns(array('image','name'));
        $xcrud->column_class('image', 'zoom_img');
        $xcrud->change_type('image', 'image', '', array('width' => 300, 'path' => '../../assets/uploads/categories'));
        $xcrud->order_by('id','desc');
        $menu = $this->loadMenu("category");
        $this->twig->display('admin/xcrud', compact('xcrud', 'data','menu'));
	}
    public function sub()
    {
        $data['session'] =  $this->session->userdata['admin'];
        $xcrud = xcrud_get_instance();
        $session = $this->session->userdata['admin'];
        if ($session->role != "admin") {
            $xcrud->unset_edit(true); // 'admin' row can be editable
            $xcrud->unset_remove(true);
        }
        $xcrud->table('sub_categories');
        $xcrud->fields(array("created_at","slug"), true);
        $xcrud->relation('category_id', 'categories', 'id','name');
        $xcrud->label(array("category_id"=>"Category"));
        $xcrud->columns(array('image','category_id','name'));
        $xcrud->column_class('image', 'zoom_img');
        $xcrud->change_type('image', 'image', '', array('width' => 300, 'path' => '../../assets/uploads/categories/sub_categories'));
        $xcrud->order_by('id','desc');
        $menu = $this->loadMenu("category/sub");
        $this->twig->display('admin/xcrud', compact('xcrud', 'data','menu'));
    }
}
