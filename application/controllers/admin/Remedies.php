<?php defined('BASEPATH') OR exit('No direct script access allowed');

use Ramsey\Uuid\Uuid;

class Remedies extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->library('doctrine');
        $this->em = $this->doctrine->em;

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
        $xcrud->table('remedies');
        $xcrud->relation('category_id', 'sub_categories', 'id','name');
        $xcrud->label(array('category_id' => 'Category'));
        $xcrud->fields(array('created_at','slug'), true);
        $xcrud->columns(array('image','category_id','title','tag','id'));
        $xcrud->before_insert ('insert_before');
        $xcrud->before_update ('insert_before');
        $xcrud->column_callback('id', 'photoGallery');
        $xcrud->change_type('image', 'image', '', array('width' => 300, 'path' => '../../assets/uploads/Remedies/thumbnail'));
        $xcrud->column_class('image', 'zoom_img');
        $xcrud->label(array('id' => 'Gallery'));
        $menu = $this->loadMenu("remedies");
        $del_url = base_url("admin/remedie/alldelete");
        $this->twig->display('admin/xcrud', compact('xcrud', 'data','menu','del_url'));

       
    }
    
    public function alldelete(){
        $this->load->model('ProductModel');
        $something = $this->input->post('primery_keys');
        $this->ProductModel->deleterecord($something);
    }

	public function gallery($remedies_id)
    {
        $gallery = $this->doctrine->em->getRepository("Entity\Gallery")->findBy(array('module_id' => $remedies_id));

        $menu = $this->loadMenu("gallery");
        $this->twig->display('admin/gallery', compact('gallery', 'menu', 'remedies_id'));
    }

    public function gallery_upload($remedies_id)
    {
        $this->load->helper('gallery');
        $response = getImageBinary("file");
        if ($response["status"] == "fail")
        {
            $result = array(
                "status" => "fail",
                "errors" => $response["errors"]
            );
        }
        else
        {
            $binaryImage = $response["data"];
            $decodedImage = base64_decode($binaryImage);
            $image_data = getimagesizefromstring($decodedImage);
            // Generate a version 4 (random) UUID object
            $name = (Uuid::uuid4()->toString()).image_type_to_extension($image_data[2]);

            // Save image.
            try {
                $gallery = new Entity\Gallery();
                $gallery->setImage($name);
                $gallery->setModuleId($remedies_id);

                $this->em->persist($gallery);
                $this->em->flush();

                // Save image into directory
                file_put_contents("./assets/uploads/Remedies/gallery/{$name}", base64_decode($binaryImage));

                $status = "success";
                $message = "successfully uploaded";
            } catch (Exception $e) {
                $status = "success";
                $message = $e->getMessage();
            }

            $result = array(
                "status" => $status,
                "message" => $message
            );
        }
        $this->output->set_content_type("application/json");
        $this->output->set_output(json_encode($result));
    }

    public function gallery_delete()
    {
        $image_ids = $this->input->post('image_ids');
        foreach ($image_ids as $id) {
            $gallery = $this->em->getRepository("Entity\Gallery")->find($id);
            $this->em->remove($gallery);
            $this->em->flush();
        }

        $this->output->set_output(json_encode(array(
            "status" => "success",
            "message" => "records successfully deleted"
        )));
    }

    public function gallery_flag_thumbnail()
    {
        $new_thumbnail = $this->input->post('image_id');
        $current_thumbnail = $this->db->query("SELECT id FROM galleries WHERE flag_thumbnail = 1")->row();

        if (! empty($current_thumbnail)) {
            $gallery = $this->em->getRepository("Entity\Gallery")->find($current_thumbnail->id);
            $gallery->setFlagThumbnail(0);
            $this->em->persist($gallery);
            $this->em->flush();
        }

        $gallery = $this->em->getRepository("Entity\Gallery")->find($new_thumbnail);
        $gallery->setFlagThumbnail(1);
        $this->em->persist($gallery);
        $this->em->flush();

        $this->output->set_output(json_encode(array(
            "status" => "success",
            "message" => "records successfully updated"
        )));
    }

    public function gallery_flag_active()
    {
        $image_id = $this->input->post('image_id');
        $flag_status = $this->input->post('flag_status');

        $gallery = $this->em->getRepository("Entity\Gallery")->find($image_id);
        $gallery->setFlagActive($flag_status);
        $this->em->persist($gallery);
        $this->em->flush();

        $this->output->set_output(json_encode(array(
            "status" => "success",
            "message" => "records successfully updated"
        )));
    }

    public function gallery_sort_order()
    {
        $image_id = $this->input->post('image_id');
        $sort_order = $this->input->post('sort_order');

        $gallery = $this->em->getRepository("Entity\Gallery")->find($image_id);
        $gallery->setSortOrder($sort_order);
        $this->em->persist($gallery);
        $this->em->flush();

        $this->output->set_output(json_encode(array(
            "status" => "success",
            "message" => "records successfully updated"
        )));
    }
}
