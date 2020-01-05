<?php defined('BASEPATH') OR exit('No direct script access allowed');


class ApiController extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('encryption');
    }

    public function index()
    {
    }

    //Select all records.

    function get_sliders()
    {
        $header = $this->input->request_headers();
        $api_token = base64_decode($header['api_token']);
        if ($api_token == "encryptsoul@homeremedies") {
            $this->db->select('*');
            $q = $this->db->get('sliders');
            $rows = $q->num_rows();
            if ($rows > 0) {
                $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(200) // Return status
                    ->set_output(json_encode(array(
                        'status' => '200',
                        'data' => $q->result())));
            } else {
                $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(200) // Return status
                    ->set_output(json_encode(array(
                        'status' => '404',
                        'data' => array())));
            }
        } else {
            $this->output
                ->set_content_type('application/json')
                ->set_status_header(200) // Return status
                ->set_output(json_encode(array(
                    'status' => '404',
                    'data' => array('message' => "unauthorized access."))));
        }

    }

    // getting categories using rest api and return response in JSON formate.

    function get_categories()
    {
        $header = $this->input->request_headers();
        $api_token = base64_decode($header['api_token']);
        if ($api_token == "encryptsoul@homeremedies") {
            $this->db->select('*');
            $q = $this->db->get('categories');
            $rows = $q->num_rows();
            if ($rows > 0) {
                $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(200) // Return status
                    ->set_output(json_encode(array(
                        'status' => '200',
                        'data' => $q->result())));
            } else {
                $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(200) // Return status
                    ->set_output(json_encode(array(
                        'status' => '404',
                        'data' => array())));
            }
        } else {
            $this->output
                ->set_content_type('application/json')
                ->set_status_header(200) // Return status
                ->set_output(json_encode(array(
                    'status' => '404',
                    'data' => array('message' => "unauthorized access."))));
        }
    }

    function get_sub_categories()
    {
        $header = $this->input->request_headers();
        $api_token = base64_decode($header['api_token']);
        if ($api_token == "encryptsoul@homeremedies") {
            $start = 0;
            $limit = 5;
            $this->db->select('*');
            $this->db->limit($limit, $start);
            $q = $this->db->get('sub_categories');
            $rows = $q->num_rows();
            if ($rows > 0) {
                $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(200) // Return status
                    ->set_output(json_encode(array(
                        'status' => '200',
                        'data' => $q->result())));
            } else {
                $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(200) // Return status
                    ->set_output(json_encode(array(
                        'status' => '404',
                        'data' => array())));
            }
        } else {
            $this->output
                ->set_content_type('application/json')
                ->set_status_header(200) // Return status
                ->set_output(json_encode(array(
                    'status' => '404',
                    'data' => array('message' => "unauthorized access."))));
        }
    }

    function get_remedies()
    {
        $header = $this->input->request_headers();
        $api_token = base64_decode($header['api_token']);
        if ($api_token == "encryptsoul@homeremedies") {
            $this->db->select('*');
            $q = $this->db->get('remedies');
            $rows = $q->num_rows();
            if ($rows > 0) {
                $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(200) // Return status
                    ->set_output(json_encode(array(
                        'status' => '200',
                        'data' => $q->result())));
            } else {
                $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(200) // Return status
                    ->set_output(json_encode(array(
                        'status' => '404',
                        'data' => array())));
            }
        } else {
            $this->output
                ->set_content_type('application/json')
                ->set_status_header(200) // Return status
                ->set_output(json_encode(array(
                    'status' => '404',
                    'data' => array('message' => "unauthorized access."))));
        }
    }

    function get_blogs()
    {
        $header = $this->input->request_headers();
        $api_token = base64_decode($header['api_token']);
        if ($api_token == "encryptsoul@homeremedies") {

            $this->db->select('*');
            $q = $this->db->get('blogs');
            $rows = $q->num_rows();
            if ($rows > 0) {
                $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(200) // Return status
                    ->set_output(json_encode(array(
                        'status' => '200',
                        'data' => $q->result())));
            } else {
                $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(200) // Return status
                    ->set_output(json_encode(array(
                        'status' => '404',
                        'data' => array())));
            }
        } else {
            $this->output
                ->set_content_type('application/json')
                ->set_status_header(200) // Return status
                ->set_output(json_encode(array(
                    'status' => '404',
                    'data' => array('message' => "unauthorized access."))));
        }
    }

    function get_health_tips()
    {
        $header = $this->input->request_headers();
        $api_token = base64_decode($header['api_token']);
        if ($api_token == "encryptsoul@homeremedies") {

            $this->db->select('*');
            $q = $this->db->get('health_tips');
            $rows = $q->num_rows();
            if ($rows > 0) {
                $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(200) // Return status
                    ->set_output(json_encode(array(
                        'status' => '200',
                        'data' => $q->result())));
            } else {
                $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(200) // Return status
                    ->set_output(json_encode(array(
                        'status' => '404',
                        'data' => array())));
            }
        } else {
            $this->output
                ->set_content_type('application/json')
                ->set_status_header(200) // Return status
                ->set_output(json_encode(array(
                    'status' => '404',
                    'data' => array('message' => "unauthorized access."))));
        }
    }

    function get_videos()
    {
        $header = $this->input->request_headers();
        $api_token = base64_decode($header['api_token']);
        if ($api_token == "encryptsoul@homeremedies") {

            $this->db->select('*');
            $q = $this->db->get('videos');
            $rows = $q->num_rows();
            if ($rows > 0) {
                $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(200) // Return status
                    ->set_output(json_encode(array(
                        'status' => '200',
                        'data' => $q->result())));
            } else {
                $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(200) // Return status
                    ->set_output(json_encode(array(
                        'status' => '404',
                        'data' => array())));
            }
        } else {
            $this->output
                ->set_content_type('application/json')
                ->set_status_header(200) // Return status
                ->set_output(json_encode(array(
                    'status' => '404',
                    'data' => array('message' => "unauthorized access."))));
        }
    }

    function get_pages()
    {
        $header = $this->input->request_headers();
        $api_token = base64_decode($header['api_token']);
        if ($api_token == "encryptsoul@homeremedies") {

            $this->db->select('*');
            $q = $this->db->get('pages');
            $rows = $q->num_rows();
            if ($rows > 0) {
                $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(200) // Return status
                    ->set_output(json_encode(array(
                        'status' => '200',
                        'data' => $q->result())));
            } else {
                $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(200) // Return status
                    ->set_output(json_encode(array(
                        'status' => '404',
                        'data' => array())));
            }
        } else {
            $this->output
                ->set_content_type('application/json')
                ->set_status_header(200) // Return status
                ->set_output(json_encode(array(
                    'status' => '404',
                    'data' => array('message' => "unauthorized access."))));
        }
    }

    function get_settings()
    {
        $header = $this->input->request_headers();
        $api_token = base64_decode($header['api_token']);
        if ($api_token == "encryptsoul@homeremedies") {

            $this->db->select('*');
            $q = $this->db->get('settings');
            $rows = $q->num_rows();
            if ($rows > 0) {
                $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(200) // Return status
                    ->set_output(json_encode(array(
                        'status' => '200',
                        'data' => $q->result())));
            } else {
                $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(200) // Return status
                    ->set_output(json_encode(array(
                        'status' => '404',
                        'data' => array())));
            }
        } else {
            $this->output
                ->set_content_type('application/json')
                ->set_status_header(200) // Return status
                ->set_output(json_encode(array(
                    'status' => '404',
                    'data' => array('message' => "unauthorized access."))));
        }
    }


    //search

    function search_instruction_by_category_id()
    {
        if ($this->input->post('id') != null) {
            $this->db->where('remedies.category_id', $this->input->post('id'));
            $q = $this->db->get('remedies');
            $rows = $q->num_rows();
            if ($rows > 0) {
                $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(200) // Return status
                    ->set_output(json_encode(array(
                        'status' => '200',
                        'data' => $q->result())));
            } else {
                $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(404) // Return status
                    ->set_output(json_encode(array(
                        'status' => '404',
                        'data' => array())));
            }
        } else {
            $this->output
                ->set_content_type('application/json')
                ->set_status_header(400) // Return status
                ->set_output(json_encode(array(
                    'status' => '400',
                    'message' => 'category_id required')));
        }
    }

    function search_instruction_by_id()
    {
        if ($this->input->post('id') != null) {
            $this->db->where('remedies.id', $this->input->post('id'));
            $q = $this->db->get('remedies');
            $rows = $q->num_rows();
            if ($rows > 0) {
                $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(200) // Return status
                    ->set_output(json_encode(array(
                        'status' => '200',
                        'data' => $q->result())));
            } else {
                $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(404) // Return status
                    ->set_output(json_encode(array(
                        'status' => '404',
                        'data' => array())));
            }
        } else {
            $this->output
                ->set_content_type('application/json')
                ->set_status_header(400) // Return status
                ->set_output(json_encode(array(
                    'status' => '400',
                    'message' => 'Remedies id required')));
        }
    }

    function search_instruction_by_text($search_text)
    {
        $this->db->table('remedies');
        $this->db->select('*');
        $this->db->like('remedies.name', $search_text, 'both');
        $this->db->order_by('remedies.id', 'desc');
        $q = $this->db->get('remedies');
        $this->output
            ->set_content_type('application/json')
            ->set_status_header(200) // Return status
            ->set_output(json_encode($q->result()));
    }

    function register_user()
    {
        $name = $this->input->post('name');
        $CompanyName = $this->input->post('company_name');
        $phone = $this->input->post('telephone');
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        if ($name != null && $CompanyName != null && $phone != null && $email != null && $password != null) {

            $this->db->where('users.email', $email);
            $user = $this->db->get('users');

            if ($user->num_rows() == 0) {

                $encrypted_password = $this->encryption->encrypt($password);

                $data = array(
                    'name' => $name,
                    'email' => $email,
                    'password' => $encrypted_password,
                    'telephone' => $phone,
                    'company_name' => $CompanyName
                );

                $result = $this->db->insert('users', $data);

                if ($result) {
                    $this->db->where('users.email', $email);
                    $query = $this->db->get('users');
                    $user = $query->row();

                    $this->output
                        ->set_content_type('application/json')
                        ->set_status_header(200) // Return status
                        ->set_output(json_encode(array(
                            'status' => '200',
                            'message' => 'Регистрация прошла успешно',
                            'data' => array(
                                'id' => $user->id,
                                'name' => $user->name,
                                'email' => $user->email,
                                'telephone' => $user->telephone,
                                'company_name' => $user->company_name,
                                'created_at' => $user->created_at,
                            ))));
                } else {
                    $this->output
                        ->set_content_type('application/json')
                        ->set_status_header(200) // Return status
                        ->set_output(json_encode(array(
                            'status' => '401',
                            'message' => 'Ошибка регистрации пользователя',
                            'data' => null)));
                }
            } else {
                $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(200) // Return status
                    ->set_output(json_encode(array(
                        'status' => '402',
                        'message' => 'Ошибка регистрации пользователя',
                        'data' => null)));
            }
        } else {
            $this->output
                ->set_content_type('application/json')
                ->set_status_header(200) // Return status
                ->set_output(json_encode(array(
                    'status' => '403',
                    'message' => 'Неполная информация.',
                    'data' => null)));
        }

    }

    function login_user()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        if ($email != null && $password != null) {

            $this->db->where('users.email', $email);
            $query = $this->db->get('users');
            if ($query->num_rows() > 0) {

                $user = $query->row();
                $user_password = $user->password;
                $decrypted_password = $this->encryption->decrypt($user_password);

                if ($password == $decrypted_password) {
                    $this->output
                        ->set_content_type('application/json')
                        ->set_status_header(200) // Return status
                        ->set_output(json_encode(array(
                            'status' => '200',
                            'message' => 'Неверный логин или пароль',
                            'data' => array(
                                'id' => $user->id,
                                'name' => $user->name,
                                'email' => $user->email,
                                'telephone' => $user->telephone,
                                'company_name' => $user->company_name,
                                'created_at' => $user->created_at,
                            ))));
                } else {
                    $this->output
                        ->set_content_type('application/json')
                        ->set_status_header(200) // Return status
                        ->set_output(json_encode(array(
                            'status' => '401',
                            'message' => 'Неверный логин или пароль',
                            'data' => null)));
                }

            } else {
                $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(200) // Return status
                    ->set_output(json_encode(array(
                        'status' => '402',
                        'message' => 'Ошибка входа',
                        'data' => null)));
            }
        } else {
            $this->output
                ->set_content_type('application/json')
                ->set_status_header(200) // Return status
                ->set_output(json_encode(array(
                    'status' => '403',
                    'message' => 'Неполная информация.',
                    'data' => null)));
        }
    }

}



