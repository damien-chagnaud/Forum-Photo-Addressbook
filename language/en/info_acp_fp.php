<?php
/**
 *
 * Forum Photo. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2018, CHAGNAUD DAMIEN
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

$lang = array_merge($lang, array(
	
	'ACP_FP_ADDBK_MANAGE'	=> 'Manage',
	'ACP_FP_ADDBK_MANAGE_TITLE' => 'Adress Book Manager',
	'ACP_FP_ADDBK_TITLE'	=> 'Address Book',
	'ACP_FP_ADDBK_TITLE_NEW'	=> 'Address Book: NEW',
	'ACP_FP_ADDBK_TITLE_EDIT'	=> 'Address Book: EDIT',

	'ACP_ADDBK_NEW_ADDRS'	=> 'New Address',
	'ACP_ADDRS_FORM_USERID'	=> 'User id',
	'ACP_ADDRS_FORM_TYPE'	=> 'Type',
	'ACP_ADDRS_FORM_LOCATION'	=> 'Location',
	'ACP_ADDRS_FORM_NAME'	=> 'Name',
	'ACP_ADDRS_FORM_ADDRESS'	=> 'Address',
	'ACP_ADDRS_FORM_TEL'	=> 'Tel',
	'ACP_ADDRS_FORM_CEL'	=> 'Cel',
	'ACP_ADDRS_FORM_POSLONG'	=> 'Longitude',
	'ACP_ADDRS_FORM_POSLAT'	=> 'Latitude',
	'ACP_ADDRS_FORM_PRESENTATION'	=> 'Description',
	'ACP_ADDRS_FORM_WEBSITE'	=> 'Website',
	'ACP_ADDRS_FORM_EMAIL'	=> 'E-mail',
	
	'ADDRS_TYPE_ASSO' 		=> 'Association',
	'ADDRS_TYPE_PRO' 		=> 'Professional photographer',
	'ADDRS_TYPE_STORE' 		=> 'Photo store',
	'ADDRS_TYPE_PRINT' 		=> 'Photo print service',

	
	'ACP_ADDRS_DELETE_SUCCESS' => 'Address was deletted',

	'ACP_FP_ADDBK_SETTINGS'			=> 'Settings',
	'ACP_FP_ADDBK_SETTINGS_TITLE'		=> 'Settings',
	'ACP_ADDRS_STGS_FORM_GROUP'		=> 'Select group to include in address book',
));
