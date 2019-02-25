<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Main_model extends CI_Model {
	
    function __construct()
    {
        // 呼叫模型(Model)的建構函數
        parent::__construct();
		$this->load->database();
		
    }
    
    function check_user($data)
    {		
		$query = $this->db->query("SELECT phpbb_users.user_id, phpbb_users.username, passport.username t_name, passport.level 
									FROM passport, phpbb_users
										WHERE passport.active = '1'
											AND phpbb_users.username ='" . $data['account'] . "'
											AND phpbb_users.user_password = '" . md5($data['passwd']) . "'
											AND passport.no = phpbb_users.user_id");
		
		$result = $query->row_array();
		$result['ip'] = $data['ip'];

		if(isset($result['user_id'])){
			$result['logid'] = $this->_insert_log($result);			
			$result['status'] = true;
			return $result;
		}else{
			$result['status'] = false;
			return $result;
		}
    }
	
	function get_user_login($person)
	{		
		$person_query ='';
		if($person !=='')
		{
			$person_query =" AND passport.no = '". $person ."'";
		}

		$query = $this->db->query("SELECT passport.username,loginlog.ip_addr,loginlog.datetime
									FROM passport,loginlog
										WHERE passport.no = loginlog.passport_no
										".$person_query."
									ORDER BY loginlog.datetime DESC
									LIMIT 0, 15"
								);
		
		$result = $query->result_array();
		return $result;
	}
	
	function get_users_list()
	{
		$query = $this->db->query("SELECT passport.no,
										  phpbb_users.username user_id,
										  passport.username,
										  passport.level,
										  passport.active
										FROM
										  phpbb_users,
										  passport
										WHERE
										  passport.no = phpbb_users.user_id
										ORDER BY
										  passport.no"
								 );

		$result = $query->result_array();
		return $result;
	}
	
	function get_reported($query_data)
	{		
		(trim($query_data['CompanySelect'])!== '') ? $company_query = " AND news_release.location = '" . $query_data['CompanySelect'] . "'" : $company_query = '';
		(trim($query_data['datepicker'])!== '') ? $date_query = " AND news_release.datetime like  '%" . $query_data['datepicker'] . "%'" : $date_query = '';
		
		$sql = "
			SELECT
				  news_release.no,
				  news_release.datetime,
				  SubCategory.name,
				  news_release.title,
				  passport.username,
				  news_release.sort
				FROM
				  news_release,
				  passport,
				  SubCategory
				WHERE
				  news_release.poster = passport.no 
					  AND news_release.category = SubCategory.no 
					  AND news_release.act = '" . $query_data['act'] . "' 
					  " . $company_query . " 
					  " . $date_query . " 
				ORDER BY
				  news_release.sort,
				  news_release.datetime DESC,
				  news_release.no
				LIMIT " . $query_data['record_begin'] . ", " . $query_data['show_num'] . "
		";
		
		$query = $this->db->query($sql);

		$result = $query->result_array();	
		return $result;
	}	
	
	function change_pwd($change_data)
	{	
		$data = array(
			'user_password' => md5($change_data['password'])
		);
		
		$this->db->where('user_id', $change_data['no']);
		$this->db->update('phpbb_users', $data);	
	}
	
	function modify_reported($modify_data)
	{	
	
		if ( !empty($modify_data['title1']) || !empty($modify_data['title2']) ){	
			$title = $modify_data['title1'] . '|+|' . $modify_data['title2'];
		}	
			
		if ( !empty($modify_data['interviewee1']) || !empty($modify_data['interviewee2']) ){
			$interviewee = $modify_data['interviewee1'] . '|+|' . $modify_data['interviewee2'];
		}
		if ( !empty($modify_data['content1']) || !empty($modify_data['content2']) ){
			$content = $modify_data['content1'] . '|+|' . $modify_data['content2'];
		}
	
		$data = array(
			'category' => $modify_data['category'],
			'title' => $title,
			'interviewee' => $interviewee,
			'content' => $content
		);
		
		$this->db->where('no', $modify_data['no']);
		$this->db->update('news_release', $data);	
	}
	
	function add_reported($add_data)
	{	
		$data = array(
			
			'datetime' => $add_data['now'],
			'category' => $add_data['category'],
			'title' => $add_data['title'],
			'interviewee' => $add_data['interviewee'],
			'content' => $add_data['content'],
			'poster' => $add_data['poster'],
			'location' => $add_data['location'],
			'act' => 1,
			'sort' => 0
		);
		
		$this->db->insert('news_release', $data);

		$query = $this->db->query("SELECT MAX(no) no FROM `news_release`");
				
		$log_result = $query->row_array();
		return $log_result['no'];		
	}	
	
	function add_vedio($add_data)
	{		
		
		$data = array(
			'date' => $add_data['date'],
			'paster' => $add_data['session']['ssnUserNo'],
			'record_no' => $add_data['r_no'],
			'title' => $add_data['title'],
			'content' => $add_data['content'],
			'time' => $add_data['r_time'],
			'loginlog' => $add_data['session']['ssnLoginID'],
			'act' => '1',
			'path' => $add_data['r_path']
		);	
		
		$this->db->insert('news_record', $data);
		
		return;
	}	
	
	function modify_vedio($modify_data)
	{	
	
		$data = array(
			'date' => $modify_data['date'],
			'record_no' => $modify_data['r_no'],
			'title' => $modify_data['title'],
			'content' => $modify_data['content'],
			'time' => $modify_data['time'],
			'path' => $modify_data['path']
		);
		
		$this->db->where('no', $modify_data['no']);
		$this->db->update('news_record', $data);	
	}	
	
	function get_reported_count ($query_data)
	{
		
		(trim($query_data['CompanySelect'])!== '') ? $company_query = " AND news_release.location = '" . $query_data['CompanySelect'] . "'" : $company_query = '';
		(trim($query_data['datepicker'])!== '') ? $date_query = " AND news_release.datetime like '%" . $query_data['datepicker'] . "%'" : $date_query = '';
				
		$query = $this->db->query("SELECT COUNT(*)	count								 
									FROM
									  news_release,
									  passport,
									  SubCategory
									WHERE
									  news_release.poster = passport.no 
										  AND news_release.category = SubCategory.no 
										  AND news_release.act = '" . $query_data['act'] . "'
											" . $company_query . " 
											" . $date_query . " 										  
									ORDER BY
									  news_release.sort,
									  news_release.datetime,
									  news_release.no
								 ");

		$result = $query->row_array();
		
		return $result['count'];
	}
	
	function get_show_reported ($no)
	{
		$query = $this->db->query("SELECT
									  news_release.datetime,
									  news_release.category,
									  news_release.title,
									  news_release.interviewee,
									  news_release.content,
									  passport.username,
									  news_release.location,
									   news_release.act
									FROM
									  news_release,
									  passport
									WHERE
									  news_release.poster = passport.no 
									  AND news_release.no = " . $no . "
								 ");

		$result = $query->row_array();
		
		return $result;
	}	
	
	function get_month_report ()
	{
		$month = date("Y-m", mktime(0,0,0, date("m")-1, date("d"), date("Y")));
		$query = $this->db->query("SELECT  SUM( 1 ) SUM,category, (select username from passport where no = poster) username
									FROM news_release
									WHERE act =9 AND DATETIME
										LIKE  '".$month."%'
									GROUP BY category, poster
								 ");

		$result = $query->result_array();
		
		return $result;
	}	
	
	function get_show_vedio ($no)
	{
		$query = $this->db->query("SELECT
									  news_record.date,
									  passport.username,
									  news_record.record_no,
									  news_record.title,
									  news_record.content,
									  news_record.time,
									  news_record.act,
									  news_record.path
								  FROM
									  news_record,
									  passport
								  WHERE
									  news_record.paster = passport.no AND news_record.no = '" . $no . "'		
		");

		$result = $query->row_array();

		return $result;
	}	
	
	function get_view_ae ()
	{
		
		
		$query = $this->db->query(" SELECT
									  news_release.title,
									  news_release.content,
									  SubCategory.name,
									  passport.username
									FROM
									  news_release,
									  SubCategory,
									  passport
									WHERE
									  act = '1' AND news_release.category = SubCategory.no AND news_release.poster = passport.no
									ORDER BY
									  news_release.sort,
									  news_release.datetime	
								 ");

		$result = $query->result_array();
		
		return $result;
	}		
	
	function get_week_ae ()
	{
		
		
		$query = $this->db->query(" SELECT
									  news_release.content
									FROM
									  news_release,
									  news_weekly
									WHERE
									  news_release.no = news_weekly.no
									ORDER BY
									  news_weekly.sort,
									  news_release.datetime DESC,
									  news_release.no		
								 ");

		$result = $query->result_array();
		
		return $result;
	}	
	
	function search_reported ($data)
	{	
		$act_sql ='';
		if($data['act']!=='all'){
			$act_sql = " AND news_release.act = '".$data['act']."' ";
		}
		$query = $this->db->query(" 
									SELECT
										news_release.no,
										news_release.datetime,
										SubCategory.name,
										news_release.title,
										passport.username
									FROM
										news_release,
										passport,
										SubCategory
										WHERE
											news_release.poster = passport.no 
												AND news_release.category = SubCategory.no
												".$act_sql."
												AND news_release.content LIKE '%". $data['find'] . "%'
									ORDER BY news_release.datetime DESC, news_release.no  
								 ");

		$result = $query->result_array();
		
		return $result;
	}	
	
	function search_vedio ($data)
	{	
		$query = $this->db->query(" 
									SELECT
									  news_record.no,
									  news_record.record_no,
									  passport.username,
									  news_record.title,
									  news_record.time
									FROM
									  news_record,
									  passport
									WHERE
									  news_record.paster = passport.no AND(
										news_record.title LIKE '%".$data['find']."%' 
										OR news_record.content LIKE '%".$data['find']."%'
									  )
									ORDER BY
									  news_record.paster DESC,
									  news_record.no									 
								 ");

		$result = $query->result_array();
		
		return $result;
	}	
	
	/**
	 * 刪除 or 還原 報導資料
	 *
	 * @author      Easonwei
	 * @link  
	 */		
	function delete_undo ($get_data)
	{			
		$data = array(
			'act' => $get_data['act']
		);
		
		$this->db->where('no', $get_data['no']);
		$this->db->update('news_release', $data);			
	}
	
	/**
	 * 刪除 影帶資料
	 *
	 * @author      Easonwei
	 * @link  
	 */		
	function delete_vedio ($get_data)
	{			

		$data = array(
			'act' => $get_data['act']
		);
		
		$this->db->where('no', $get_data['no']);
		$this->db->update('news_record', $data);
	}		
	
	/**
	 * 更新一週大事排序
	 *
	 * @author      Easonwei
	 * @link       
	 */		
	function update_week_sort ($get_data)
	{			
		$Num = $get_data['num'];
		
		for ( $i=0; $i<$Num; $i++ ) {
			$a= 'a'.$i;
			$s= 's'.$i;
			
			$data = array(
				'sort' => $get_data[$s]
			);
			
			$this->db->where('no', $get_data[$a]);
			$this->db->update('news_weekly', $data);		
		}		
	}
	
	/**
	 * 更新一週大事新增
	 *
	 * @author      Easonwei
	 * @link       
	 */		
	function update_week_add ($get_data)
	{			
		$Num = $get_data['num'];		

		for ( $i=0; $i<$Num; $i++ ) {
			$n= 'n'.$i;		

			if(!isset($get_data[$n])){continue;};
			
			$data = array(
			   'no' => $get_data[$n] ,
			   'sort' => ''
			);
			
			$this->db->insert('news_weekly', $data);
		}
		
		$this->db->where('no', '0');
		$this->db->delete('news_weekly');		
	}	
	/**
	 * 更新一週大事刪除
	 *
	 * @author      Easonwei
	 * @link       
	 */		
	function update_week_del ($get_data)
	{			
		$Num = $get_data['num'];
		
		for ( $i=0; $i<$Num; $i++ ) {
			$n= 'n'.$i;
			if(isset($get_data[$n])){
				$this->db->where('no', $get_data[$n]);
				$this->db->delete('news_weekly');							
			}			
		}	
	}
	
	/**
	 * 更新新聞稿排序
	 *
	 * @author      Easonwei
	 * @link       
	 */		
	function update_report_sort ($get_data)
	{			
		$Num = $get_data['rows_count'];
		
		for ( $i=0; $i<$Num; $i++ ) {
			$n= 'n'.$i;
			$s= 's'.$i;
			
			$data = array(
				'sort' => $get_data[$s]
			);
			
			$this->db->where('no', $get_data[$n]);
			$this->db->update('news_release', $data);			
		}		
	}		
	
	function get_view_week($view)
	{
		
	$view_sql ='AND news_weekly.no IS NULL';	
	if ( $view == "1" ) {
		$view_sql = "AND news_weekly.no IS NOT NULL ";
	}

	$Mon = date("Y-m-d", mktime(0, 0, 0, date("m") ,(date("d")-date("w")+1), date("Y")));
	$T1  = date("Y-m-d", mktime(0, 0, 0, date("m") ,(date("d")-date("w")+2), date("Y")));
	$Wed = date("Y-m-d", mktime(0, 0, 0, date("m") ,(date("d")-date("w")+3), date("Y")));
	$T2  = date("Y-m-d", mktime(0, 0, 0, date("m") ,(date("d")-date("w")+4), date("Y")));
	$Fri = date("Y-m-d", mktime(0, 0, 0, date("m") ,(date("d")-date("w")+5), date("Y")));
	$Sat = date("Y-m-d", mktime(0, 0, 0, date("m") ,(date("d")-date("w")+6), date("Y")));
	
	//$Mon = $T1 = $Wed = $T2 = $Fri = $Sat = '2009-04-27' ;
		
	$query = $this->db->query("SELECT
								  news_release.no,
								  news_release.datetime,
								  SubCategory.name,
								  news_release.title,
								  passport.username,
								  news_weekly.sort
								FROM
								  news_release
								INNER JOIN
								  passport ON news_release.poster = passport.no
								INNER JOIN
								  SubCategory ON news_release.category = SubCategory.no
								LEFT JOIN
								  news_weekly ON news_release.no = news_weekly.no
								WHERE
								  news_release.act != 0 AND(
															news_release.datetime LIKE '".$Mon."%' 
															OR news_release.datetime LIKE '".$T1."%' 
															OR news_release.datetime LIKE '".$Wed."%' 
															OR news_release.datetime LIKE '".$T2."%' 
															OR news_release.datetime LIKE '".$Fri."%' 
															OR news_release.datetime LIKE '".$Sat."%') 
														".$view_sql."
								ORDER BY
								  news_weekly.sort,
								  news_release.datetime DESC,
								  news_release.no
								LIMIT 0, 30	
							 ");

		$result = $query->result_array();	
		
		return $result;
	}		
	
	/**
	 * 取得影帶管理
	 *
	 * @author      Easonwei
	 * @link        
	 */		
	function get_veiw_vedio ($act)
	{
		
		
		$query = $this->db->query(" SELECT
									  news_record.no,
									  passport.username,
									  news_record.record_no,
									  news_record.title,
									  news_record.time
									FROM
									  news_record,
									  passport
									WHERE
									  news_record.paster = passport.no AND news_record.act = '". $act . "'
									ORDER BY
									  news_record.paster,
									  news_record.record_no,
									  news_record.no		
								 ");

		$result = $query->result_array();
		
		return $result;
	}	
	
	/**
	 * 登入紀錄
	 *
	 * @author      Easonwei
	 * @link        
	 */		
    function _insert_log($result)
    {		
		$data = array(
		   'passport_no' => $result['user_id'] ,
		   'ip_addr' => $result['ip'] ,
		   'datetime' => date("Y-m-d H:i:s")
		);
		
		$this->db->insert('loginlog', $data);
				
		$query = $this->db->query("SELECT MAX(no) no FROM `loginlog`");
		
		$log_result = $query->row_array();
		return $log_result['no'];
    }
}