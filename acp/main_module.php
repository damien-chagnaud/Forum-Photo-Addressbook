<?php
/**
 *
 * Forum Photo. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2018, CHAGNAUD DAMIEN
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace forumphoto\addressbook\acp;

/**
 * Address Book ACP module.
 */
class main_module
{
	public $page_title;
	public $tpl_name;
	public $u_action;

	public function main($id, $mode){
		global $config, $request, $template, $user, $db, $table_prefix, $phpbb_container;
		
		$user->add_lang_ext('forumphoto/addressbook', 'common');
		
		// Requests
		$action = $request->variable('action', '');
		
		// Get an instance of the admin controller
		$admin_controller = $phpbb_container->get('forumphoto.addressbook.admin.controller');
		
		// Requests
		$action = $request->variable('action', '');
		$addrs_id = $request->variable('addrs_id', 0);
		
		// Make the $u_action url available in the admin controller
		$admin_controller->set_addbk_url($this->u_action);

		

		// Perform any actions submitted by the user
		if($mode=='manage'){
			$this->tpl_name = 'acp_fp_addbk_body';
			switch ($action){
				case 'new':
					$this->page_title = $user->lang('ACP_FP_ADDBK_TITLE_NEW');
					$admin_controller->new_addbk();
				break;
				case 'edit':
					$this->page_title = $user->lang('ACP_FP_ADDBK_TITLE_EDIT');
					$admin_controller->edit_addbk($addrs_id);
				break;
				case 'delete':
					
				break;
				default:
					$this->page_title = $user->lang('ACP_FP_ADDBK_TITLE');
					$admin_controller->display_addbk();
				break;
			}
		}else{
			$this->tpl_name = 'acp_fp_settings_body';
			$this->page_title = $user->lang('ACP_FP_ADDBK_SETTINGS_TITLE');
			add_form_key('forumphoto/addressbook/settings');
			
			$admin_controller->settings();
			
			if ($request->is_set_post('submit') && check_form_key('forumphoto/addressbook/settings')){
				$config->set('fp_acp_config', $request->variable('addbk_settings_group', 0));

				//trigger_error($user->lang('ACP_DEMO_SETTING_SAVED') . adm_back_link($this->u_action));
			}

			$template->assign_vars(array(
				'U_ACTION'	=> $this->u_action,
				'CONFIG_GROUP'		=> $config['fp_acp_config'],
			));

			
	
		}
	}
}