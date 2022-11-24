<?php
class Venue_model extends CI_Model{
	public function add_venue($data){
		$this->db->insert('ci_venues', $data);
		return true;
	}
}
