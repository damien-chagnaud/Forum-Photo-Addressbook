<?php
/**
 *
 * Forum Photo. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2018, CHAGNAUD DAMIEN
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace forumphoto\addressbook\ucp;

/**
 * Forum Photo UCP module info.
 */
class main_info
{
	function module()
	{
		return array(
			'filename'	=> '\forumphoto\addressbook\ucp\main_module',
			'title'		=> 'UCP_FP_ADDBK_TITLE',
			'modes'		=> array(
				'settings'	=> array(
					'title'	=> 'UCP_FP_ADDBK',
					'auth'	=> 'ext_forumphoto/addressbook',
					'cat'	=> array('UCP_FP_ADDBK_TITLE')
				),
			),
		);
	}
}
