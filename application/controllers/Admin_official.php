<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_staffs extends Admin_controller
{
    private $_rules = array(
        array('field' => 'title', 'label' => 'Tiêu đề', 'rules' => 'trim|required|min_length[3]|max_length[255]'),
        array('field' => 'meta_keywords', 'label' => 'Meta keywords', 'rules' => 'trim'),
        array('field' => 'meta_description', 'label' => 'Meta description', 'rules' => 'trim'),
        array('field' => 'status', 'label' => 'Trạng thái', 'rules' => 'trim'),
        array('field' => 'display', 'label' => 'Hiển thị', 'rules' => 'trim'),
        array('field' => 'template', 'label' => 'Template', 'rules' => 'trim'),
        array('field' => 'layout', 'label' => 'Layout', 'rules' => 'trim'),
    );

    public function __construct()
    {
        parent::__construct();

        $this->load->model('covid/official_m');
        $this->load->model('covid/staff_m');

        $this->data['categories'] = $this->article_category_m->nested();
        $this->data['scripts'][] = $this->data['module_path'] . 'js/admin_staffs.js';

        $this->auth->check_uri_permissions();
    }

    public function index()
    {

        $this->template->build('covid/admin_staffs/index', $this->data);
    }

    public function create($parent_id = 0)
    {
        if ($this->input->server('REQUEST_METHOD') == 'GET') {
            $this->data['item'] = new stdClass;
            foreach ($this->_rules as $key => $field) {
                $this->data['item']->{$field['field']} = "";
            }

            $response['html'] = $this->template->load_view('covid/admin_staffs/form', $this->data, TRUE);
            $response['parent_id'] = $parent_id;
            die(json_encode($response));
        } else {
            $this->form_validation->set_rules($this->_rules);
            if ($this->form_validation->run($this)) {
                $data = array(
                    'parent_id'         => set_value('parent_id', $parent_id),
                    'title'             => set_value('title'),
                );

                if ($id = $this->article_category_m->insert($data)) {
                    echo json_encode('OK');
                    Modules::load('settings/utilities')->routes();
                } else {
                    echo json_encode('ERROR');
                }
            } else if (validation_errors()) {
                echo json_encode(validation_errors());
            }
        }
    }

    public function update($id = NULL)
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
            exit;
        }

        if ($this->input->server('REQUEST_METHOD') == 'GET') {
            $response = array('html' => '');

            $this->data['item'] = $this->article_category_m->get($id);
            if ($this->data['item']) {
                $response['id'] = $this->data['item']->id;
                $response['html'] = $this->template->load_view('covid/admin_staffs/form', $this->data, TRUE);
                die(json_encode($response));
            }
        } else {
            $this->form_validation->set_rules($this->_rules);
            if ($this->form_validation->run($this)) {
                $data = array(
                    'title'             => set_value('title'),
                    'status'            => set_value('status'),
                );

                if ($this->article_category_m->update($id, $data)) {
                    echo json_encode('OK');
                } else {
                    echo json_encode('ERROR');
                }
            } else if (validation_errors()) {
                echo json_encode(validation_errors());
            }
        }

        Modules::load('settings/utilities')->routes();
        exit();
    }

    public function ajax_position()
    {
        if ($this->input->is_ajax_request()) {
            if ($list = $this->input->post('list')) {
                $this->article_category_m->update_nested($list);
            }
        }
    }

    public function delete($id = NULL)
    {
        if ($this->input->is_ajax_request()) {
            $id = $this->input->post('id') ? intval($this->input->post('id')) : $id;

            $this->article_category_m->update_by(array('parent_id' => $id), array('parent_id' => 0, 'position' => 0));
            $this->article_category_m->delete($id);
            $this->article_m->delete_by(array('category_id' => $id));

            Modules::load('settings/utilities')->routes();

            echo json_encode('OK');
        }
    }
}
