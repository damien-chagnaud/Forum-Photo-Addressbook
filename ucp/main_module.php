<?php
/**
 *
 * Address Book. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2018, CHAGNAUD DAMIEN
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace forumphoto\addressbook\ucp;

/**
 * Address Book UCP module.
 */
class main_module
{
	var $u_action;

	function main($id, $mode)
	{
		global $config, $db, $request, $template, $user, $table_prefix;

		$this->tpl_name = 'ucp_fp_body';
		$this->page_title = $user->lang('UCP_FP_ADDBK_TITLE');
		add_form_key('forumphoto/addressbook');
		$groupPro = intval($config['fp_acp_config']);
		$userID = $user->data['user_id'];
		
		$sql = "SELECT * FROM `". $table_prefix ."user_group` WHERE `group_id` = '$groupPro' AND `user_id` = '$userID' ;";
		$dbQuery = $db->sql_query($sql);
		$userispro= $db->sql_fetchrow($dbQuery);
		$db->sql_freeresult($dbQuery);
		
		
		
		$USERINGROUP = false;
		$addrs = array();
		$userisinaddbk = false;
		if(is_array($userispro)){
			$USERINGROUP = true;
			$gsql = 'SELECT * FROM `'. $table_prefix .'addressbook` WHERE `addbk_userid` = '.$userID.';';
			$dbQuery = $db->sql_query($gsql);
			$addrs = $db->sql_fetchrow($dbQuery);
			if(is_array($addrs)){
				$userisinaddbk = true;
				$template->assign_vars(array(
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
			}
			$db->sql_freeresult($dbQuery);
		}
		


		if ($request->is_set_post('submit')){
			if (!check_form_key('forumphoto/addressbook')){
				trigger_error($user->lang('FORM_INVALID'));
			}

			$sql_arr = array(
				'addbk_userid'    	=> intval($userID),
				'addbk_type'    	=> intval($request->variable('addrs_TYPE', '', true)),
				'addbk_location'    => htmlspecialchars ($request->variable('addrs_LOCATION', '', true)),
				'addbk_name'    	=> htmlspecialchars ($request->variable('addrs_NAME', '', true)),
				'addbk_address'    	=> htmlspecialchars ($request->variable('addrs_ADDRESS', '', true)),
				'addbk_tel'    		=> htmlspecialchars ($request->variable('addrs_TEL', '', true)),
				'addbk_cel'    		=> htmlspecialchars ($request->variable('addrs_CEL', '', true)),
				'addbk_poslong'   	=> htmlspecialchars ($request->variable('addrs_POSLONG', '', true)),
				'addbk_poslat'   	=> htmlspecialchars ($request->variable('addrs_POSLAT', '', true)),
				'addbk_presentation'=> htmlspecialchars ($request->variable('addrs_PRESENTATION', '', true)),
				'addbk_website'    	=> htmlspecialchars ($request->variable('addrs_WEBSITE', '', true)),
				'addbk_email'    	=> htmlspecialchars ($request->variable('addrs_EMAIL', '', true)),
			);

			if($userisinaddbk){
				$sql_arr['addbk_id'] = intval($addrs['addbk_id']);
				try{
					$sql = 'UPDATE `'. $table_prefix .'addressbook` SET ' . $db->sql_build_array('UPDATE', $sql_arr);
					$db->sql_query($sql);
				}catch(Exception $e){
					
				}
			}else{
				try{
					$sql = 'INSERT INTO `'. $table_prefix .'addressbook` ' . $db->sql_build_array('INSERT', $sql_arr);
					$db->sql_query($sql);
				}catch(Exception $e){
					
				}
			
			}

			meta_refresh(3, $this->u_action);
			$message = $user->lang('UCP_DEMO_SAVED') . '<br /><br />' . $user->lang('RETURN_UCP', '<a href="' . $this->u_action . '">', '</a>');
			trigger_error($message);
		}

		$template->assign_vars(array(
			'S_UCP_ACTION'	=> $this->u_action,
			'USERINGROUP' => $USERINGROUP,
		));
	}
}
