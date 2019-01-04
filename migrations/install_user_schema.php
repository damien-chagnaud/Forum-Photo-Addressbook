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

class install_user_schema extends \phpbb\db\migration\migration
{
	public function effectively_installed()
	{
		return $this->db_tools->sql_column_exists($this->table_prefix . 'users', 'fp_addbk_id');
	}

	static public function depends_on()
	{
		return array('\phpbb\db\migration\data\v31x\v314');
	}

	public function update_schema()
	{
		return array(
			/*addressbook table: */
			'add_tables'		=> array(
				$this->table_prefix . 'addressbook'	=> array(
					'COLUMNS'				=> array(
						'addbk_id'			=> array('UINT', null, 'auto_increment'),
						'addbk_userid'		=> array('UINT'),
						'addbk_type'		=> array('USINT'),
						'addbk_location'	=> array('VCHAR:100', ''),
						'addbk_name'		=> array('VCHAR:100', ''),
						'addbk_address'		=> array('VCHAR:255', ''),
						'addbk_tel'			=> array('VCHAR:50', ''),
						'addbk_cel'			=> array('VCHAR:50', ''),
						'addbk_poslong'		=> array('VCHAR:20', ''),
						'addbk_poslat'		=> array('VCHAR:20', ''),
						'addbk_presentation'=> array('VCHAR:255', ''),
						'addbk_website'		=> array('VCHAR:255', ''),
						'addbk_email'		=> array('VCHAR:100', ''),
					),
					'PRIMARY_KEY'	=> 'addbk_id',
				),
			),
			/*user table: */
			'add_columns'	=> array(
				$this->table_prefix . 'users'	=> array(
					'fp_addbk_id'	=> array('USINT', 0),
				),
			),
		);
	}

	public function revert_schema()
	{
		return array(
			/*addressbook table: */
			'drop_tables'		=> array(
				$this->table_prefix . 'addressbook',
			),
			/*user table: */
			'drop_columns'	=> array(
				$this->table_prefix . 'users'	=> array(
					'fp_addbk_id',
				),
			),
		);
	}
}
