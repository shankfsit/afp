<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Offer_model extends CI_Model {

	public function insert_new_offer($data)
	{
		return $this->db->insert('offers', $data);
	}

	public function update_offer($data, $id)
	{
		$this->db->where('id', $id);
		return $this->db->insert('offers', $data);
	}

	public function get_all_offers()
	{
		return $this->db->get('offers');
	}

	public function get_offer_by_id($id)
	{
		$this->db->where('id',$id);
		return $this->db->get('offers');
	}

	public function delete_offer($id)
	{
		date_default_timezone_set("Asia/Calcutta");
		$data = array(
        'delete_status' => '1',
        'deleted_by' => '2',
        'deleted_at' => date('Y-m-d h:i:sa')
		);
		$this->db->where('id', $id);
		return $this->db->update('offers', $data);
	}
}
