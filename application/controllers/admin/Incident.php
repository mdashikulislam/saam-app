<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Incident extends MY_Controller{
	public function __construct()
	{
		parent::__construct();
		auth_check();
		$this->rbac->check_module_access();
		$this->load->model('admin/admin_model', 'admin');
		$this->load->model('admin/Incident_model');
	}

	public function index()
	{
		$this->load->view('admin/includes/_header');
		$this->load->view('admin/incident/list');
		$this->load->view('admin/includes/_footer');
	}

	public function datatable_json()
	{
		$records['data'] = $this->Incident_model->get_all();
		$data = array();
		$i=0;
		foreach ($records['data']   as $row)
		{
			$data[]= array(
				++$i,
				$row['venue_name'],
				getPerson($row['person']),
				getGender($row['gender']),
				$row['comments'],
				$row['username'],
				'<a title="View" class="view btn btn-xs btn-info" href="'.base_url('admin/incident/view/'.$row['id']).'"> <i class="fa fa-eye"></i></a>
				<a title="Edit" class="update btn btn-xs btn-warning" href="'.base_url('admin/incident/edit/'.$row['id']).'"> <i class="fa fa-pencil-square-o"></i></a>
				<a title="Delete" class="delete btn btn-xs btn-danger" href='.base_url("admin/incident/delete/".$row['id']).' title="Delete" onclick="return confirm(\'Do you want to delete ?\')"> <i class="fa fa-trash-o"></i></a>'
			);
		}
		$records['data']=$data;
		echo json_encode($records);
	}
	public function add()
	{
		$this->rbac->check_operation_access();
		$data['admin_roles'] = $this->admin->get_admin_roles();
		if($this->input->post('submit')){
			$this->form_validation->set_rules('venue', 'Venue', 'trim|required');
			$this->form_validation->set_rules('person', 'Person', 'trim|required');
			$this->form_validation->set_rules('gender', 'Gender', 'trim|required');
			$this->form_validation->set_rules('comments', 'Comments', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('errors', $data['errors']);
				redirect(base_url('admin/incident/add'),'refresh');
			}else{
				$data = array(
					'added_by' => $this->session->userdata('user_id'),
					'venue' => $this->input->post('venue'),
					'person' => $this->input->post('person'),
					'gender' => $this->input->post('gender'),
					'comments' => $this->input->post('comments'),
					'created_at' => date('Y-m-d : h:m:s'),
					'updated_at' => date('Y-m-d : h:m:s'),
				);

				$data = $this->security->xss_clean($data);
				$result = $this->Incident_model->add($data);
				if($result){
					$this->session->set_flashdata('success', 'Incident added Successfully!');
					redirect(base_url('admin/incident'), 'refresh');
				}
			}
		}else{
			$this->load->view('admin/includes/_header');
			$this->load->view('admin/incident/add', $data);
			$this->load->view('admin/includes/_footer');
		}
	}

	public function view($id = 0)
	{
		$data['admin_roles'] = $this->admin->get_admin_roles();
		$this->rbac->check_operation_access();
		$data['incident'] = $this->Incident_model->get_by_id($id);
		$this->load->view('admin/includes/_header');
		$this->load->view('admin/incident/edit', $data);
		$this->load->view('admin/includes/_footer');
	}
	public function edit($id = 0){

		$data['admin_roles'] = $this->admin->get_admin_roles();
		$this->rbac->check_operation_access();
		if($this->input->post('submit')){
			$this->form_validation->set_rules('venue', 'Venue', 'trim|required');
			$this->form_validation->set_rules('person', 'Person', 'trim|required');
			$this->form_validation->set_rules('gender', 'Gender', 'trim|required');
			$this->form_validation->set_rules('comments', 'Comments', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('errors', $data['errors']);
				redirect(base_url('admin/incident/edit/'.$id),'refresh');
			}
			else{
				$data = array(
					'venue' => $this->input->post('venue'),
					'person' => $this->input->post('person'),
					'gender' => $this->input->post('gender'),
					'comments' => $this->input->post('comments'),
					'updated_at' => date('Y-m-d : h:m:s'),
				);
				$data = $this->security->xss_clean($data);
				$result = $this->Incident_model->edit($data, $id);
				if($result){
					$this->session->set_flashdata('success', 'Incident has been updated successfully!');
					redirect(base_url('admin/incident'));
				}
			}
		}
		else{
			$data['incident'] = $this->Incident_model->get_by_id($id);
			$this->load->view('admin/includes/_header');
			$this->load->view('admin/incident/edit', $data);
			$this->load->view('admin/includes/_footer');
		}
	}
	public function delete($id = 0)
	{
		$this->rbac->check_operation_access(); // check opration permission

		$this->db->delete('ci_incidents', array('id' => $id));

		$this->session->set_flashdata('success', 'Incident has been deleted successfully!');
		redirect(base_url('admin/incident'));
	}

}
