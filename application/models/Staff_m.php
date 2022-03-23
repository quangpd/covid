<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Staff_m extends MY_Model
{
	public $_table = 'covid_staffs';

	public $before_create = array('created_at', 'updated_at', 'created_by', 'updated_by');

	public $before_update = array('updated_at', 'updated_by', 'dmy2date');


	public $belongs_to = array(
		'creater' 	=> array('model' => 'user_m', 'primary_key' => 'created_by'),
		'updater' 	=> array('model' => 'user_m', 'primary_key' => 'updated_by'),
		'official' 	=> array('model' => 'official_m', 'primary_key' => 'official_id'),
	);

	public function __construct()
	{
		parent::__construct();

		$this->load->helper('date');
	}
}
