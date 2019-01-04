<?php
/**
 *
 * Forum Photo. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2018, CHAGNAUD DAMIEN
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace forumphoto\addressbook\migrations;

class install_ucp_module extends \phpbb\db\migration\migration
{
	public function effectively_installed()
	{
		$sql = 'SELECT module_id
			FROM ' . $this->table_prefix . "modules
			WHERE module_class = 'ucp'
				AND module_langname = 'UCP_FP_ADDBK_TITLE'";
		$result = $this->db->sql_query($sql);
		$module_id = $this->db->sql_fetchfield('module_id');
		$this->db->sql_freeresult($result);

		return $module_id !== false;
	}

	static public function depends_on()
	{
		return array('\forumphoto\addressbook\migrations\install_user_schema');
	}

	public function update_data()
	{
		return array(
			array('module.add', array(
				'ucp',
				0,
				'UCP_FP_ADDBK_TITLE'
			)),
			array('module.add', array(
				'ucp',
				'UCP_FP_ADDBK_TITLE',
				array(
					'module_basename'	=> '\forumphoto\addressbook\ucp\main_module',
					'modes'				=> array('settings'),
				),
			)),
		);
	}
}
