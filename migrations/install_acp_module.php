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

class install_acp_module extends \phpbb\db\migration\migration
{
	public function effectively_installed()
	{
		return isset($this->config['fp_acp_config']);
	}

	static public function depends_on()
	{
		return array('\phpbb\db\migration\data\v31x\v314');
	}

	public function update_data()
	{
		return array(
			array('config.add', array('fp_acp_config', '')),

			array('module.add', array(
				'acp',
				'ACP_CAT_DOT_MODS',
				'ACP_FP_ADDBK_TITLE'
			)),
			array('module.add', array(
				'acp',
				'ACP_FP_ADDBK_TITLE',
				array(
					'module_basename'	=> '\forumphoto\addressbook\acp\main_module',
					'modes'				=> array('manage', 'settings'),
				),
			)),
		);
	}
}
