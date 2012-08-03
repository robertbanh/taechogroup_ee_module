<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');

// =======================
// Author: Robert Banh
// Taecho Group, LLC
// Date: 
//
// =======================
class Taechogroup_model
{
	private $EE;

	public function __construct()
	{
		$this->EE =& get_instance();

		// custom settings
		$this->_blah_channel_id = 1;
	}

	// ==================
	// 
	// ==================
	public function get_all_events($x = 1)
	{
		$sql = $this->EE->db->query("
			SELECT 
				ct.*
			FROM ".$this->EE->db->dbprefix('channel_titles')." ct
			INNER JOIN ".$this->EE->db->dbprefix('channel_data')." cd on cd.entry_id = ct.entry_id
			WHERE 
				ct.channel_id = ".$this->EE->db->escape_str($x)."
			ORDER BY ct.entry_id asc
		");
		$re = $sql->result_array();
		return $re;
	}

	// ==================
    // 
    // ==================
    public function get_total_x($group_id = 2)
    {
        $sql = $this->EE->db->query("
            SELECT 
                count(*)
            FROM ".$this->EE->db->dbprefix('members')."
            WHERE 
                group_id = ".$group_id."
        ");
        $re = $sql->row_array();
        return current($re);
    }

    // ==================
    // 
    // ==================
    public function insert_x($data)
    {
        if (empty($data)) return;

        $col = array(
            'member_id' => $this->EE->session->userdata('member_id'),
            'serialized_data' => serialize($data)
            );

        $this->EE->db->insert('tg_table_blah', $col);

        return true;
    }

}

