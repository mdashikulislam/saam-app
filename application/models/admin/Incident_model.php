<?php
class Incident_model extends CI_Model{
	private $table = 'ci_incidents';
	public function add($data){
		$this->db->insert($this->table, $data);
		return true;
	}
	public function get_all(){
		$this->db->select('*');
		return $this->db->get($this->table)->result_array();
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
