<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tools extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
	
	}
	
	// 過濾舊資料 |+| 符號
	public function filter_char()
	{
		$this->load->database();
		
		$query = $this->db->query('SELECT * FROM news_release');
		
		foreach ($query->result_array() as $row)
		{			
			if (strpos($row['content'],'|+|')!== false)
			{
				$data['content'] = str_replace ('|+|','',$row['content']);			
				$this->db->where('no', $row['no']);
				$this->db->update('news_release', $data);				
			}
			
		}		
	}
	
}