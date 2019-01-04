<?php


namespace forumphoto\addressbook\controller;

use Symfony\Component\DependencyInjection\ContainerInterface;

/**
* Admin controller
*/
class admin_controller {
	/** @var \phpbb\cache\driver\driver_interface */
	protected $cache;

	/** @var \phpbb\controller\helper */
	protected $helper;

	/** @var \phpbb\language\language */
	protected $lang;

	/** @var \phpbb\log\log */
	protected $log;

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \phpbb\request\request */
	protected $request;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	/** @var ContainerInterface */
	protected $container;

	/** @var \phpbb\event\dispatcher_interface */
	protected $dispatcher;

	/** @var string phpBB root path */
	protected $root_path;

	/** @var string phpEx */
	protected $php_ext;

	/** @var string Custom form action */
	protected $u_action;
	
	protected $dbprefix;

	/**
	* Constructor
	*
	* @param \phpbb\cache\driver\driver_interface $cache            Cache driver interface
	* @param \phpbb\controller\helper             $helper           Controller helper object
	* @param \phpbb\language\language             $lang             Language object
	* @param \phpbb\log\log                       $log              The phpBB log system
	* @param \phpbb\pages\operators\page          $page_operator    Pages operator object
	* @param \phpbb\request\request               $request          Request object
	* @param \phpbb\template\template             $template         Template object
	* @param \phpbb\user                          $user             User object
	* @param ContainerInterface                   $phpbb_container  Service container interface
	* @param \phpbb\event\dispatcher_interface    $phpbb_dispatcher Event dispatcher
	* @param string                               $root_path        phpBB root path
	* @param string                               $php_ext          phpEx
	* @access public
	*/
	public function __construct(\phpbb\cache\driver\driver_interface $cache, \phpbb\controller\helper $helper, \phpbb\language\language $lang, \phpbb\log\log $log, \phpbb\db\driver\driver_interface $db, \phpbb\request\request $request, \phpbb\template\template $template, \phpbb\user $user, ContainerInterface $phpbb_container, \phpbb\event\dispatcher_interface $phpbb_dispatcher, $root_path, $php_ext, $dbprefix)
	{
		$this->cache = $cache;
		$this->helper = $helper;
		$this->lang = $lang;
		$this->log = $log;
		$this->db = $db;
		$this->request = $request;
		$this->template = $template;
		$this->user = $user;
		$this->container = $phpbb_container;
		$this->dispatcher = $phpbb_dispatcher;
		$this->root_path = $root_path;
		$this->php_ext = $php_ext;
		$this->dbprefix = $dbprefix;
	}
	
	public function display_addbk(){
		$data = "";
		$gsql = 'SELECT * FROM `'. $this->dbprefix .'addressbook` ;';
		$dbQuery = $this->db->sql_query($gsql);
		
		while ($addrs= $this->db->sql_fetchrow($dbQuery)){
			
			$this->template->assign_block_vars('addresss', array(
				'ADDRS_ID'			=> $addrs['addbk_id'],
				'ADDRS_USERID'		=> $addrs['addbk_userid'],
				'ADDRS_TYPE'		=> $addrs['addbk_type'],
				'ADDRS_LOCATION'	=> $addrs['addbk_location'],
				'ADDRS_NAME'		=> $addrs['addbk_name'],
				'ADDRS_ADDRESS'		=> $addrs['addbk_address'],
				'ADDRS_TEL'			=> $addrs['addbk_tel'],
				'ADDRS_CEL'			=> $addrs['addbk_cel'],
				'ADDRS_POSLONG'		=> $addrs['addbk_poslong'],
				'ADDRS_POSLAT'		=> $addrs['addbk_poslat'],
				'ADDRS_PRESENTATION'=> $addrs['addbk_presentation'],
				'ADDRS_WEBSITE'		=> $addrs['addbk_website'],
				'ADDRS_EMAIL'		=> $addrs['addbk_email'],
				'U_DELETE'			=> "{$this->u_action}&amp;action=delete&amp;addrs_id=" . $addrs['addbk_id'],
				'U_EDIT'			=> "{$this->u_action}&amp;action=edit&amp;addrs_id=" . $addrs['addbk_id'],
			));
		}
		
		$this->db->sql_freeresult($dbQuery);    
		$this->template->assign_vars(array(
			'U_ACTION'			=> $this->u_action,
			'U_ADD_PAGE'	=> "{$this->u_action}&amp;action=list",
		));
	}
	
	public function new_addbk(){
		
		
		// Is the form submitted
		$submit = $this->request->is_set_post('submit');
		
		// If the form has been submitted, set all data and save it
		if ($submit){
			
			$sql_arr = array(
				'addbk_userid'    	=> intval($this->request->variable('addrs_USERID', '', true)),
				'addbk_type'    	=> intval($this->request->variable('addrs_TYPE', '', true)),
				'addbk_location'    => htmlspecialchars ($this->request->variable('addrs_LOCATION', '', true)),
				'addbk_name'    	=> htmlspecialchars ($this->request->variable('addrs_NAME', '', true)),
				'addbk_address'    	=> htmlspecialchars ($this->request->variable('addrs_ADDRESS', '', true)),
				'addbk_tel'    		=> htmlspecialchars ($this->request->variable('addrs_TEL', '', true)),
				'addbk_cel'    		=> htmlspecialchars ($this->request->variable('addrs_CEL', '', true)),
				'addbk_poslong'   	=> htmlspecialchars ($this->request->variable('addrs_POSLONG', '', true)),
				'addbk_poslat'   	=> htmlspecialchars ($this->request->variable('addrs_POSLAT', '', true)),
				'addbk_presentation'=> htmlspecialchars ($this->request->variable('addrs_PRESENTATION', '', true)),
				'addbk_website'    	=> htmlspecialchars ($this->request->variable('addrs_WEBSITE', '', true)),
				'addbk_email'    	=> htmlspecialchars ($this->request->variable('addrs_EMAIL', '', true)),
			);
			
			$sql = 'INSERT INTO `'.$this->dbprefix .'addressbook` ' . $this->db->sql_build_array('INSERT', $sql_arr);
			$this->db->sql_query($sql);
			
		}else{
			$this->template->assign_block_vars('addresss', array(
					'ADDRS_ID'			=> '',
					'ADDRS_USERID'		=> '',
					'ADDRS_TYPE'		=> '',
					'ADDRS_LOCATION'	=> '',
					'ADDRS_NAME'		=> '',
					'ADDRS_ADDRESS'		=> '',
					'ADDRS_TEL'			=> '',
					'ADDRS_CEL'			=> '',
					'ADDRS_POSLONG'		=> '',
					'ADDRS_POSLAT'		=> '',
					'ADDRS_PRESENTATION'=> '',
					'ADDRS_WEBSITE'		=> '',
					'ADDRS_EMAIL'		=> '',
				));
			$this->template->assign_vars(array(
				'S_NEW_PAGE'	=> true,
				'U_ACTION'		=> "{$this->u_action}&amp;action=new",
			));
		}
	}
	
	public function edit_addbk($addrs_id){
		
		// Is the form submitted
		$submit = $this->request->is_set_post('submit');
		
		
		// If the form has been submitted, set all data and save it
		if ($submit){
			// Test if the form is valid
			// Use -1 to allow unlimited time to submit form
			/*if (!check_form_key('add_edit_page', -1))
			{
				$errors[] = $this->lang->lang('FORM_INVALID');
			}*/
			
			$sql_arr = array(
				'addbk_id'    		=> intval($addrs_id),
				'addbk_userid'    	=> intval($this->request->variable('addrs_USERID', '', true)),
				'addbk_type'    	=> intval($this->request->variable('addrs_TYPE', '', true)),
				'addbk_location'    => htmlspecialchars ($this->request->variable('addrs_LOCATION', '', true)),
				'addbk_name'    	=> htmlspecialchars ($this->request->variable('addrs_NAME', '', true)),
				'addbk_address'    	=> htmlspecialchars ($this->request->variable('addrs_ADDRESS', '', true)),
				'addbk_tel'    		=> htmlspecialchars ($this->request->variable('addrs_TEL', '', true)),
				'addbk_cel'    		=> htmlspecialchars ($this->request->variable('addrs_CEL', '', true)),
				'addbk_poslong'   	=> htmlspecialchars ($this->request->variable('addrs_POSLONG', '', true)),
				'addbk_poslat'   	=> htmlspecialchars ($this->request->variable('addrs_POSLAT', '', true)),
				'addbk_presentation'=> htmlspecialchars ($this->request->variable('addrs_PRESENTATION', '', true)),
				'addbk_website'    	=> htmlspecialchars ($this->request->variable('addrs_WEBSITE', '', true)),
				'addbk_email'    	=> htmlspecialchars ($this->request->variable('addrs_EMAIL', '', true)),
			);

			$sql = 'UPDATE `'.$this->dbprefix .'addressbook` SET ' . $this->db->sql_build_array('UPDATE', $sql_arr);
			$this->db->sql_query($sql);
			
			
			// Log the action
			$this->log->add('admin', $sql_arr['addbk_id'], $this->user->ip, 'ACP_FORUMPHOTO_EDITED_LOG', time(), array($sql_arr['addbk_id']));

			// Purge the cache to refresh route collections
			$this->cache->purge();
	
		}else{
			//Create edit form with data
			$data = "";
			$gsql = 'SELECT * FROM `'. $this->dbprefix .'addressbook` WHERE `addbk_id` = '.$addrs_id.';';
			$dbQuery = $this->db->sql_query($gsql);
			$addrs = $this->db->sql_fetchrow($dbQuery);
			
			if(count($addrs)>0){
				$this->template->assign_vars(array(
					'ADDRS_ID'			=> $addrs['addbk_id'],
					'ADDRS_USERID'		=> $addrs['addbk_userid'],
					'ADDRS_TYPE'		=> $addrs['addbk_type'],
					'ADDRS_LOCATION'	=> $addrs['addbk_location'],
					'ADDRS_NAME'		=> $addrs['addbk_name'],
					'ADDRS_ADDRESS'		=> $addrs['addbk_address'],
					'ADDRS_TEL'			=> $addrs['addbk_tel'],
					'ADDRS_CEL'			=> $addrs['addbk_cel'],
					'ADDRS_POSLONG'		=> $addrs['addbk_poslong'],
					'ADDRS_POSLAT'		=> $addrs['addbk_poslat'],
					'ADDRS_PRESENTATION'=> $addrs['addbk_presentation'],
					'ADDRS_WEBSITE'		=> $addrs['addbk_website'],
					'ADDRS_EMAIL'		=> $addrs['addbk_email'],
				));
				
				// Set output vars for display in the template
				$this->template->assign_vars(array(
					'S_EDIT_PAGE'	=> true,
					'U_ACTION'		=> "{$this->u_action}&amp;addrs_id={$addrs_id}&amp;action=edit",
					'ADDRS_FOUND'	=> true,
				));
			}else{
				// Set output vars for display in the template
				$this->template->assign_vars(array(
					'S_EDIT_PAGE'	=> true,
					'U_ACTION'		=> "{$this->u_action}&amp;addrs_id={$addrs_id}&amp;action=edit",
					'ADDRS_FOUND'	=> false,
				));
			}
			
			$this->db->sql_freeresult($dbQuery);
		}

	}
	

	public function delete_addbk($addrs_id){
		$data = "";
		$gsql = 'SELECT * FROM `'. $this->dbprefix .'addressbook` WHERE `addbk_id` = '.$addrs_id.';';
		$dbQuery = $this->db->sql_query($gsql);
		$addrs = $this->db->sql_fetchrow($dbQuery);
		$this->db->sql_freeresult($dbQuery);
		try{
			
			if(count($addrs)>0){
				$gsql = 'DELETE FROM `'. $this->dbprefix .'addressbook` WHERE `addbk_id` = '.$addrs_id.';';
				$dbQuery = $this->db->sql_query($gsql);
				$this->db->sql_freeresult($dbQuery);
			}
			
		}catch (\forumphoto\addressbook\exception\base $e){
			// Display an error message if delete failed
			trigger_error($this->lang->lang('ACP_PAGES_DELETE_ERRORED') . adm_back_link($this->u_action), E_USER_WARNING);
		}

		// Log the action
		$this->log->add('admin', $this->user->data['user_id'], $this->user->ip, 'ACP_ADDRS_DELETED_LOG', time(), array($addrs['addbk_name']));

		// If AJAX was used, show user a result message
		if ($this->request->is_ajax())
		{
			$json_response = new \phpbb\json_response;
			$json_response->send(array(
				'MESSAGE_TITLE'	=> $this->lang->lang('INFORMATION'),
				'MESSAGE_TEXT'	=> $this->lang->lang('ACP_ADDRS_DELETE_SUCCESS'),
				'REFRESH_DATA'	=> array(
					'time'	=> 3
				)
			));
		}
	}
	
	public function settings(){
		$gsql = 'SELECT * FROM `'. $this->dbprefix .'groups` ;';
		$dbQuery = $this->db->sql_query($gsql);
		
		while ($groups= $this->db->sql_fetchrow($dbQuery)){
			$this->template->assign_block_vars('groups', array(
				'ID'		=> $groups['group_id'],
				'NAME'		=> $groups['group_name'],
			));
		}
		$this->db->sql_freeresult($dbQuery); 
	}
	
	/**
	* Set page url
	*
	* @param string $u_action Custom form action
	* @return void
	* @access public
	*/
	public function set_addbk_url($u_action)
	{
		$this->u_action = $u_action;
	}
}
	