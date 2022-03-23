<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends Admin_controller
{
	private $_rules = array(
		array('field' => 'category_id', 'label' => 'Danh mục', 'rules' => 'trim'),
		array('field' => 'title', 'label' => 'Tiêu đề', 'rules' => 'trim|required|min_length[3]|max_length[255]'),
		array('field' => 'description', 'label' => 'Mô tả', 'rules' => 'trim'),
		array('field' => 'content', 'label' => 'Nội dung', 'rules' => 'trim|required'),
		array('field' => 'image', 'label' => 'Hình ảnh', 'rules' => 'trim'),
	);

	public function __construct()
	{
		parent::__construct();

		$this->load->model('covid/official_m');
		$this->load->model('covid/staff_m');

		$this->load->library('keywords/keywords');

		$this->data['categories'] = $this->article_category_m->nested();
		$this->data['scripts'][] = $this->data['module_path'] . 'js/admin.js';

		$this->template->set_breadcrumb('Thông tin Covid', 'admin/covid');
		$this->template->title('Admin', 'Thông tin Covid');

		$this->auth->check_uri_permissions();
	}

	public function index()
	{
		$params = array(
			'module' => '',
			'module_id' => '',
		);

		$sort_field = $this->input->post('field') ? $this->input->post('field') : 'articles.id';
		$sort_dir = $this->input->post('dir') ? $this->input->post('dir') : 'desc';

		if ($title = $this->input->post('title')) {
			$params['title'] = trim($title);
		}

		if ($category = $this->input->post('category')) {
			$params['category'] = intval($category);
		}

		if ($source = $this->input->post('source')) {
			$params['source'] = intval($source);
		}

		$this->data['total_items'] = $this->article_m->count_by($params);
		$this->data['pagination'] = create_pagination('admin/articles/index', $this->data['total_items'], Settings::get('records_per_page'), 4);
		$this->data['items'] = $this->article_m
			->with('creater')
			->with('updater')
			->with('category')
			->limit($this->data['pagination']['limit'])
			->order_by($sort_field, $sort_dir)
			->get_many_by($params);

		if ($this->input->is_ajax_request()) {
			$data['items'] = $this->template->load_view('articles/admin/rows', $this->data, TRUE);
			$data['pagination'] = $this->data['pagination'];
			$data['total_items'] = $this->data['total_items'];

			die(json_encode($data));
		}

		$this->template->build('articles/admin/index', $this->data);
	}

	public function create()
	{
		$message = array();
		$this->data['item'] = new stdClass();

		$this->form_validation->set_rules($this->_rules);
		if ($this->form_validation->run($this)) {
			$tags = set_value('tags');
			$tags_hash = Keywords::process($tags);

			$data = array(
				'category_id' 		=> intval(set_value('category_id')),
				'title' 			=> set_value('title'),
				'description' 		=> set_value('description'),
				'content' 			=> set_value('content'),
				'image' 		=> html_entity_decode(set_value('image')),

				'author' 			=> set_value('author'),
				'source' 			=> set_value('source'),
				'file' 				=> set_value('file'),
				'published_at'		=> set_value('published_at') ? set_value('published_at') : date('d/m/Y'),
				'keywords' 			=> $tags_hash,
				'layout' 			=> set_value('layout'),
				'template' 			=> set_value('template'),
				'status' 			=> set_value('status'),
				'is_featured'		=> set_value('is_featured'),
				'is_privated'		=> set_value('is_privated'),
				'meta_keywords' 	=> set_value('meta_keywords'),
				'meta_description' 	=> set_value('meta_description'),
			);

			if ($id = $this->article_m->insert($data)) {
				Modules::load('settings/utilities')->routes();
				Modules::load('settings/utilities')->sitemap();

				$this->session->set_flashdata('message', ['success' => 'Thành công']);
				redirect('admin/articles');
			} else {
				$this->data['message'] = ['error' => 'Xảy ra lỗi'];
			}
		} else {
			if (validation_errors()) {
				$this->data['message'] = ['error' => validation_errors()];
			}
		}

		foreach ($this->_rules as $key => $field) {
			$this->data['item']->{$field['field']} = set_value($field['field']);
		}
		$this->data['item']->image = 'images/no_image.jpg';

		$this->template->set_breadcrumb('Thêm mới', 'admin/articles/create');
		$this->template->title('Admin', 'Danh sách bài viết', 'Thêm mới');
		$this->template->build('articles/admin/form', $this->data);
	}

	public function update($id = NULL)
	{
		$id or redirect('admin/articles');

		$this->data['item'] = $this->article_m
			->with('category')
			->get($id);

		foreach ($this->_rules as $key => $field) {
			$this->data['item']->{$field['field']} = isset($this->data['item']->{$field['field']}) ? $this->data['item']->{$field['field']} : "";
		}

		$this->form_validation->set_rules($this->_rules);
		if ($this->form_validation->run($this)) {
			$tags = set_value('tags');
			$tags_hash = Keywords::process($tags, $this->data['item']->keywords);

			$data = array(
				'category_id' 		=> set_value('category_id'),
				'title' 			=> set_value('title'),
				'description' 		=> set_value('description'),
				'content' 			=> set_value('content'),
				'image' 		=> html_entity_decode(set_value('image')),

				'author' 			=> set_value('author'),
				'source' 			=> set_value('source'),
				'file' 				=> set_value('file'),
				'published_at'		=> set_value('published_at') ? set_value('published_at') : date('d/m/Y'),
				'keywords' 			=> $tags_hash,
				'layout' 			=> set_value('layout'),
				'template' 			=> set_value('template'),
				'status' 			=> set_value('status'),
				'is_featured'		=> set_value('is_featured'),
				'is_privated'		=> set_value('is_privated'),
				'meta_keywords' 	=> set_value('meta_keywords'),
				'meta_description' 	=> set_value('meta_description'),
			);

			if ($result = $this->article_m->update($id, $data)) {
				Modules::load('settings/utilities')->routes();
				Modules::load('settings/utilities')->sitemap();

				$this->session->set_flashdata('message', ['success' => 'Thành công']);
				redirect('admin/articles');
			} else {
				$this->data['message'] = ['error' => 'Xảy ra lỗi'];
			}
		} else {
			if (validation_errors()) {
				$this->data['message'] = ['error' => validation_errors()];
			}
		}

		foreach ($this->_rules as $key => $field) {
			if (isset($_POST[$field['field']])) {
				$this->data['item']->{$field['field']} = set_value($field['field']);
			}
		}
		$this->data['item']->tags = set_value('tags', Keywords::get_string($this->data['item']->keywords));

		$this->template->set_breadcrumb('Cập nhật', 'articles/update/' . $id);
		$this->template->title('Admin', 'Danh sách bài viết', 'Cập nhật');
		$this->template->build('articles/admin/form', $this->data);
	}

	public function delete($id = NULL)
	{
		$id_array = (!empty($id)) ? array($id) : $this->input->post('action_to');

		if (!empty($id_array)) {
			foreach ($id_array as $id) {
				$this->article_m->delete($id);
			}
		}

		Modules::load('settings/utilities')->routes();
		Modules::load('settings/utilities')->sitemap();
		echo "OK";
	}

	public function active($id = NULL)
	{
		$id_array = (!empty($id)) ? array($id) : $this->input->post('action_to');

		if (!empty($id_array)) {
			foreach ($id_array as $id) {
				$item = $this->article_m->get($id);
				$data['status'] = $item->status ? 0 : 1;
				$this->article_m->update($id, $data);
			}
		}

		Modules::load('settings/utilities')->routes();
		Modules::load('settings/utilities')->sitemap();

		echo "OK";
	}

	public function featured($id = NULL)
	{
		$id_array = (!empty($id)) ? array($id) : $this->input->post('action_to');

		if (!empty($id_array)) {
			foreach ($id_array as $id) {
				$item = $this->article_m->get($id);
				$this->article_m->update($id, ['is_featured' => $item->is_featured ? 0 : 1]);
			}
		}

		echo "OK";
	}

	public function privated($id = NULL)
	{
		$id_array = (!empty($id)) ? array($id) : $this->input->post('action_to');

		if (!empty($id_array)) {
			foreach ($id_array as $id) {
				$item = $this->article_m->get($id);
				$this->article_m->update($id, ['is_privated' => $item->is_privated ? 0 : 1]);
			}
		}

		echo "OK";
	}
}
