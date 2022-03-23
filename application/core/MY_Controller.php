<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
	/**
	 * [$module description]
	 * @var [type]
	 */
	public $module;

	/**
	 * [$controller description]
	 * @var [type]
	 */
	public $controller;

	/**
	 * [$method description]
	 * @var [type]
	 */
	public $method;

	/**
	 * [__construct description]
	 */
	public function __construct()
	{
		parent::__construct();

		$this->load->library('form_validation');

		$this->data = [];

		$this->data['base_url'] = base_url();
		$this->data['base_path'] = config_item('base_path');
		$this->data['module_path'] 	= config_item('base_path') . 'modules/' . $this->module . '/';

		$this->data['meta_description'] = '';
		$this->data['meta_keywords'] 	= '';
	}
}

/**
 * [ci description]
 * @return [type] [description]
 */
function ci()
{
	return get_instance();
}

// End MY_Controller