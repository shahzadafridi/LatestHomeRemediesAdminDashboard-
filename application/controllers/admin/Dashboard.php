<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!authCheck("admin")) {
            redirect("admin/login");
        }
        $this->load->model('DashboardModel');
    }
    
    public function index()
    {
        $menu = $this->loadMenu("dashboard");
        $data['numberofusers'] = $this->DashboardModel->numberofusers();
        $data['numberofcategories'] = $this->DashboardModel->numberofcategories();
        $data['numberofsubcategories'] = $this->DashboardModel->numberofsubcategories();
        $data['numberofremedies'] = $this->DashboardModel->numberofremedies();
        $data['numberofblogs'] = $this->DashboardModel->numberofblogs();
        $data['numberofrtips'] = $this->DashboardModel->numberofrtips();
        $data['numberofVideos'] = $this->DashboardModel->numberofVideos();
        $data['session'] =  $this->session->userdata['admin'];
        $xcrud = xcrud_get_instance();
        $session = $this->session->userdata['admin'];
        if ($session->role != "admin") {
            $xcrud->unset_edit(true); // 'admin' row can be editable
            $xcrud->unset_remove(true);
        }
        $xcrud->table('remedies');
        $xcrud->relation('category_id', 'sub_categories', 'id','name');
        $xcrud->label(array('category_id' => 'Category'));
        $xcrud->fields(array('created_at','slug'), true);
        $xcrud->columns(array('image','category_id','title','tag'));
        $xcrud->before_insert ('insert_before');
        $xcrud->before_update ('insert_before');
        $xcrud->change_type('image', 'image', '', array('width' => 300, 'path' => '../../assets/uploads/Remedies/thumbnail'));
        $this->twig->display('admin/dashboard', compact('menu','data','xcrud'));
    }

    public function settings()
    {
        $this->load->library('upload');
        $this->load->Model('SettingModel', 'SM');
        $this->load->helper(array('form', 'url'));
        $post = $this->input->post();
        $image_path = FCPATH."/assets/uploads/settings";
        $data["result"] = $this->SM->get_settings();
        if (!empty($post)) {
            $config['upload_path'] = $image_path ;
            $config['allowed_types'] = 'png|jpg|gif';
            $config['max_size'] = 2048;
            $config['encrypt_name'] = TRUE;
            $this->upload->initialize($config);
            if (!empty($_FILES["favicon"]["name"])) {
                if (!empty($_FILES['favicon']['name'])) {
                    if (!$this->upload->do_upload('favicon')) {
                        $data['errors'] = $this->upload->display_errors();
                        $error = true;
                    } else {
                        $favicon = $this->upload->data("file_name");
                        if(file_exists($image_path.$data["result"]["favicon"] ))
                        {
                            unlink($image_path.$data["result"]["favicon"] );

                        }
                        $post["favicon"] = $favicon;

                    }
                }
            }

            if (!empty($_FILES['logo']['name'])) {
                if (!$this->upload->do_upload('logo')) {
                    $errors = $this->upload->display_errors();
                    $data['errors'] = $errors;
                    $error = true;
                } else {
                    $logo = $this->upload->data("file_name");
                    if(file_exists($image_path.$data["result"]["logo"]))
                    {
                        unlink($image_path.$data["result"]["logo"]);
                    }
                    $post["logo"] = $logo;
                }
            }
            if (empty($error)) {
                $this->SM->update_settings($post);
                $data["success"] = "Update Successfully";
                $data["result"] = $this->SM->get_settings();
            }
            $menu = $this->loadMenu("General Settings");
            $this->twig->display('admin/settings', compact('menu', 'data'));

        } else {
            $menu = $this->loadMenu("General Settings");
            $data['session'] =  $this->session->userdata['admin'];
            $this->twig->display('admin/settings', compact('menu','data'));
        }
    }

    public function contact_us()
    {
        $data['session'] =  $this->session->userdata['admin'];
        $xcrud = xcrud_get_instance();
        $xcrud->table('contact_us');
        $this->twig->display('admin/xcrud', compact('xcrud','data'));
    }

   public function deleteorder(){
       $this->load->model('OrderModel');
       $order_id = $this->input->post('primery_keys');
       $this->OrderModel->orderdel($order_id);
   }

}
