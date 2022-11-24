<?php
	class User_model extends CI_Model{

		public function add_user($data){
			$this->db->insert('ci_users', $data);
			return true;
		}

		//---------------------------------------------------
		// get all users for server-side datatable processing (ajax based)
		public function get_all_users(){

			$this->db->select('ci_users.*,ci_venues.name');
			$this->db->join('ci_venues','ci_venues.id = ci_users.venue_id','LEFT');
			if($this->session->userdata('is_supper')){
				$this->db->where('ci_users.is_user',1);
				return $this->db->get('ci_users')->result_array();
			}
			else{
				$this->db->where('ci_users.is_user', 1);
				$this->db->where('ci_users.added_by',($this->session->userdata('user_id')));
				return $this->db->get('ci_users')->result_array();
			}
		}


		//---------------------------------------------------
		// Get user detial by ID
		public function get_user_by_id($id){
			$query = $this->db->get_where('ci_users', array('user_id' => $id));
			return $result = $query->row_array();
		}

		//---------------------------------------------------
		// Edit user Record
		public function edit_user($data, $id){
			$this->db->where('user_id', $id);
			$this->db->update('ci_users', $data);
			return true;
		}

		//---------------------------------------------------
		// Change user status
		//-----------------------------------------------------
		function change_status()
		{		
			$this->db->set('is_active', $this->input->post('status'));
			$this->db->where('user_id', $this->input->post('id'));
			$this->db->update('ci_users');
		} 

	}

?>
