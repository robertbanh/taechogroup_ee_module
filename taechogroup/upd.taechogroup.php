<?php
// =======================
// Author: Robert Banh
// Taecho Group, LLC
// Date: 
//
// =======================
class Taechogroup_upd
{
	var $version = '1.0';

	function __construct()
	{
		$this->EE =& get_instance();
	}

	function install()
	{
		// install module
		$this->EE->db->insert('modules', array(
			'module_name' => 'Taechogroup',
			'module_version' => $this->version,
			'has_cp_backend' => 'y',
			'has_publish_fields' => 'n'
		));

		// create action
		/*$this->EE->db->insert('actions', array(
			'class' => 'Taechogroup',
			'method' => 'tg_submit',
		));*/

		/*$this->EE->db->query("CREATE TABLE IF NOT EXISTS 
			`".$this->EE->db->dbprefix('tg_entry_member')."` (
				`id` int(10) NOT NULL AUTO_INCREMENT,
				`entry_id` int(10) NOT NULL DEFAULT '0',
				`member_id` int(10) NOT NULL DEFAULT '0',
				`site_id` INT(6) NOT NULL DEFAULT '1',
			PRIMARY KEY (`id`),
			KEY `entry_id` (`entry_id`),
  			KEY `member_id` (`member_id`)
			);");*/
		

		return TRUE;
	}

	function update( $current = '' )
	{
		if ($current == '' OR $current == $this->version)
		{
			return FALSE;
		}

		$this->EE->load->dbforge();
	}

	function uninstall()
	{
		$this->EE->db->query("DELETE FROM exp_modules WHERE module_name = 'Taechogroup'");
		$this->EE->db->query("DELETE FROM exp_actions WHERE class = 'Taechogroup'");

		//$this->EE->db->query("DROP TABLE IF EXISTS ".$this->EE->db->dbprefix('tg_entry_member'));

		return TRUE;
	}
}

