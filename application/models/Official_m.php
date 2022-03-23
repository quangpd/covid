<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Official_m extends MY_Model
{
	public $_table = 'covid_officials';

	public $before_create = array('created_at', 'updated_at', 'created_by', 'updated_by');

	public $before_update = array('updated_at', 'updated_by');

	public $after_get = array('count_children');

	public $belongs_to = array(
		'creater' => array('model' => 'user_m', 'primary_key' => 'created_by'),
		'updater' => array('model' => 'user_m', 'primary_key' => 'updated_by'),
	);

	public $has_many = array(
		'staffs' => array('model' => 'staff_m', 'primary_key' => 'official_id'),
		'children' => array('model' => 'official_m', 'primary_key' => 'parent_id')
	);

	public function __construct()
	{
		parent::__construct();
	}

	public function count_children($row)
	{
		$row->count_children = $this->count_by([
			'parent_id' => $row->id,
		]);

		return $row;
	}
}
