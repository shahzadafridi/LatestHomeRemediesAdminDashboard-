<?php defined('BASEPATH') OR exit('No direct script access allowed');


class Slider extends MY_Controller
{
    public function index()
    {
        $data['session'] =  $this->session->userdata['admin'];
        $xcrud = xcrud_get_instance();
        $session = $this->session->userdata['admin'];
        if ($session->role != "admin") {
            $xcrud->unset_edit(true); // 'admin' row can be editable
            $xcrud->unset_remove(true);
        }
        $xcrud->table('sliders');
        $xcrud->relation('category_id', 'sub_categories', 'id','name');
        $xcrud->label(array("category_id"=>"Category"));
        $xcrud->change_type('image', 'image', '', array('width' => 300, 'path' => '../../assets/uploads/slider_images'));
        $xcrud->fields(array('created_at','slug'), true);
        $xcrud->columns(array('image','category_id','title','description'));
        $menu = $this->loadMenu("slider");
        $this->twig->display('admin/xcrud', compact('xcrud','data', 'menu'));
    }
}