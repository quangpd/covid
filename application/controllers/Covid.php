<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 */

class Covid extends MY_controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('staff_m');
		$this->load->model('official_m');
	}

	public function index()
	{
		$this->data['officials'] = $this->official_m
			->order_by('position asc')
			->get_many_by(['covid_officials.parent_id' => 0]);

		$this->data['site_title'] = 'Tổ công tác hỗ trợ, điều trị COVID-19 tại cộng đồng';
		$this->load->view('index', $this->data);
	}

	public function detail($official_id = null)
	{
		$this->data['official'] = $this->official_m->get($official_id);
		$this->data['official']->children = $this->official_m->order_by('position asc')->get_many_by(['parent_id' => $official_id]);
		$this->data['official']->staffs = $this->staff_m->order_by('position asc')->get_many_by(['official_id' => $official_id]);

		$this->data['site_title'] = $this->data['official']->name . ' - Tổ công tác hỗ trợ, điều trị COVID-19 tại cộng đồng';
		$this->load->view('detail', $this->data);
	}

	public function pdfviewer()
	{
		$this->data['pdf_file'] = $this->input->get('file');
		$this->data['site_title'] = $this->input->get('file');
		$this->load->view('pdfviewer', $this->data);
	}

	public function import()
	{
		$file = './assets/yt.csv';
		$row = 1;
		if (($handle = fopen($file, "r")) !== FALSE) {
			while (($row = fgetcsv($handle, 1000, ",")) !== FALSE) {
				foreach ($row as &$val) {
					$val = trim($val);
				}

				$ttyt = $row[0];
				$tyt = $row[1];
				$tyt_hotline = $row[2];
				$staff_name = $row[3];
				$staff_title = $row[4];
				$staff_position = $row[5];
				$staff_mobile = $row[6];

				if ($staff_mobile[0] != "0") {
					$staff_mobile = '0' . $staff_mobile;
				}

				$data['ttyt'] = ['name' => $ttyt];
				$this->official_m->insert_ignore($data['ttyt'], $data['ttyt'], 0);
				$ttyt_id = $this->official_m->get_by($data['ttyt'])->id;

				if ($tyt) {
					$data['tyt'] = [
						'name' => $tyt,
						'parent_id' => $ttyt_id,
						'hotline' => $tyt_hotline,
					];
					$this->official_m->insert_ignore($data['tyt'], $data['tyt'], 0);
					echo $this->db->last_query() . "\n";
					$tyt_id = $this->official_m->get_by($data['tyt'])->id;
				}

				$data['staff'] = [
					'name' => $staff_name,
					'title' => $staff_title,
					'position_string' => $staff_position,
					'mobile' => $staff_mobile,
					'official_id' => $tyt ? $tyt_id : $ttyt_id,
				];
				$this->staff_m->insert_ignore($data['staff'], $data['staff'], 0);
				// print_r($data);
			}
			fclose($handle);
		}
	}
}
