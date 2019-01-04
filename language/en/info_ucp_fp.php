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
	'UCP_FP_ADDBK'				=> 'Settings',
	'UCP_FP_ADDBK_TITLE'		=> 'Address Book',
	'UCP_FP_ADDBK_SUBTITLE'		=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
	'UCP_FP_ADDBK_NOTINGROUP'	=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
	
	
	
	'UCP_FP_ADDBK_SAVED'		=> 'Settings have been saved successfully!',

	'UCP_ADDBK_NEW_ADDRS'	=> 'New Address',
	'UCP_ADDRS_FORM_USERID'	=> 'User id',
	'UCP_ADDRS_FORM_TYPE'	=> 'Type',
	'UCP_ADDRS_FORM_LOCATION'	=> 'Location',
	'UCP_ADDRS_FORM_NAME'	=> 'Name',
	'UCP_ADDRS_FORM_ADDRESS'	=> 'Address',
	'UCP_ADDRS_FORM_TEL'	=> 'Tel',
	'UCP_ADDRS_FORM_CEL'	=> 'Cel',
	'UCP_ADDRS_FORM_POSLONG'	=> 'Longitude',
	'UCP_ADDRS_FORM_POSLAT'	=> 'Latitude',
	'UCP_ADDRS_FORM_PRESENTATION'	=> 'Description',
	'UCP_ADDRS_FORM_WEBSITE'	=> 'Website',
	'UCP_ADDRS_FORM_EMAIL'	=> 'E-mail',
	
	'UCP_ADDRS_TYPE_ASSO' 		=> 'Association',
	'UCP_ADDRS_TYPE_PRO' 		=> 'Professional photographer',
	'UCP_ADDRS_TYPE_STORE' 		=> 'Photo store',
	'UCP_ADDRS_TYPE_PRINT' 		=> 'Photo print service',


	'NOTIFICATION_TYPE_FP'	=> 'Use Acme demo notifications',
));
