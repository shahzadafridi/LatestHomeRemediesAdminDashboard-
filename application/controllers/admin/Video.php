<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Video extends MY_Controller
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
        $xcrud->table('videos');
        $session = $this->session->userdata['admin'];
        if ($session->role != "admin") {
            $xcrud->unset_edit(true); // 'admin' row can be editable
            $xcrud->unset_remove(true);
        }
        $xcrud->relation('category_id', 'categories', 'id','name');
        $xcrud->label(array('category_id' => 'Category'));
        $xcrud->columns(array("image","category_id","title","video","views","likes","dislikes","c_name"));
        $xcrud->change_type('image', 'image', '', array('width' => 300, 'path' => '../../assets/uploads/videos'));
        $menu = $this->loadMenu("video");
        $xcrud->column_class('image', 'zoom_img');
        $this->twig->display('admin/xcrud', compact('xcrud', 'data','menu'));

    }
}
