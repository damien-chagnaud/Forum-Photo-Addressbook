<?php

namespace forumphoto\addressbook\controller;

/**
* Interface for our admin controller
*
* This describes all of the methods we'll use for the admin front-end of this extension
*/
interface admin_interface
{
	/**
	* Display the pages
	*
	* @return void
	* @access public
	*/
	public function display_address();

	/**
	* Add a page
	*
	* @return void
	* @access public
	*/
	public function add_address();

	/**
	* Edit a page
	*
	* @param int $page_id The page identifier to edit
	* @return void
	* @access public
	*/
	public function edit_address($address_id);

	/**
	* Delete a page
	*
	* @param int $page_id The page identifier to delete
	* @return void
	* @access public
	*/
	public function delete_address($address_id);

}
