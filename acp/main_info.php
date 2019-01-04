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
 * Forum Photo ACP module info.
 */
class main_info
{
	public function module()
	{
		return array(
			'filename'	=> '\forumphoto\addressbook\acp\main_module',
			'title'		=> 'ACP_FP_ADDBK_TITLE',
			'version'    => '1.0.0',
			'modes'		=> array(
				'settings'	=> array('title'	=> 'ACP_FP_ADDBK_SETTINGS', 'auth'	=> 'ext_forumphoto/addressbook && acl_a_board', 'cat'	=> array('ACP_FP_ADDBK_SETTINGS_TITLE')),
				'manage'	=> array('title'	=> 'ACP_FP_ADDBK_MANAGE', 'auth'	=> 'ext_forumphoto/addressbook && acl_a_board', 'cat'	=> array('ACP_FP_ADDBK_MANAGE_TITLE')),
			),
		);
	}
}
