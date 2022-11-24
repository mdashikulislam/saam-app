<?php
class Incident_model extends CI_Model{
	private $table = 'ci_incidents';
	public function add($data){
		$this->db->insert($this->table, $data);
		return true;
	}
	public function get_all(){
		$this->db->select('ci_incidents.*,ci_venues.name as venue_name,ci_users.username');
		$this->db->join('ci_users','ci_users.user_id = ci_incidents.added_by','LEFT');
		$this->db->join('ci_venues','ci_venues.id = ci_incidents.venue','LEFT');
		if($this->session->userdata('is_supper')){
			return $this->db->get($this->table)->result_array();
		}
		else{
			$this->db->where('ci_incidents.added_by',($this->session->userdata('user_id')));
			return $this->db->get($this->table)->result_array();
		}
	}
	// Get user detial by ID
	public function get_by_id($id){
		$query = $this->db->get_where($this->table, array('id' => $id));
		return $result = $query->row_array();
	}
	public function edit($data, $id){
		$this->db->where('id', $id);
		$this->db->update($this->table, $data);
		return true;
	}
}
