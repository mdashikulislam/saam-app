<?php
class Venue_model extends CI_Model{
	private $table = 'ci_venues';
	public function add_venue($data){
		$this->db->insert($this->table, $data);
		return true;
	}
	public function get_all_venues(){
		$this->db->select('*');
		if(!$this->session->userdata('is_supper')){
			$this->db->join('ci_users','ci_users.venue_id = ci_venues.id','INNER');
			$this->db->where('ci_users.user_id',($this->session->userdata('user_id')));
		}
		return $this->db->get($this->table)->result_array();
	}

	// Get user detial by ID
	public function get_venue_by_id($id){
		$query = $this->db->get_where($this->table, array('id' => $id));
		return $result = $query->row_array();
	}
	public function edit_venue($data, $id){
		$this->db->where('id', $id);
		$this->db->update($this->table, $data);
		return true;
	}
}
