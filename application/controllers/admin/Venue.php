<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Venue extends MY_Controller{
	public function __construct()
	{
		parent::__construct();
		auth_check();
		$this->rbac->check_module_access();
		$this->load->model('admin/admin_model', 'admin');
		$this->load->model('admin/Venue_model');
	}

	public function index()
	{
		$this->load->view('admin/includes/_header');
		$this->load->view('admin/venue/list');
		$this->load->view('admin/includes/_footer');
	}

	public function datatable_json()
	{
		$records['data'] = $this->Venue_model->get_all_venues();
		$data = array();
		$i=0;
		foreach ($records['data']   as $row)
		{
			$data[]= array(
				++$i,
				'<img style="max-width:80px" src="'.(@$row['logo'] ? base_url($row['logo']) : 'https://via.placeholder.com/80?text=Blank').'">',
				$row['name'],
				$row['address'],
				$row['contact'],
				$row['number'],
				$row['qr_stuff'],
				$row['qr_customer'],
				'<a title="View" class="view btn btn-xs btn-info" href="'.base_url('admin/venue/view/'.$row['id']).'"> <i class="fa fa-eye"></i></a>
				<a title="Edit" class="update btn btn-xs btn-warning" href="'.base_url('admin/venue/edit/'.$row['id']).'"> <i class="fa fa-pencil-square-o"></i></a>
				<a title="Delete" class="delete btn btn-xs btn-danger" href='.base_url("admin/venue/delete/".$row['id']).' title="Delete" onclick="return confirm(\'Do you want to delete ?\')"> <i class="fa fa-trash-o"></i></a>'
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
			$this->form_validation->set_rules('name', 'Name', 'trim|required');
			$this->form_validation->set_rules('address', 'Address', 'trim|required');
			$this->form_validation->set_rules('contact', 'Contact', 'trim|required');
			$this->form_validation->set_rules('number', 'Number', 'trim|required');
			$this->form_validation->set_rules('qr_stuff', 'QR Stuff', 'trim|required');
			$this->form_validation->set_rules('qr_customer', 'QR Customer', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('errors', $data['errors']);
				redirect(base_url('admin/venue/add'),'refresh');
			}else{
				$data = array(
					'added_by' => $this->session->userdata('user_id'),
					'name' => $this->input->post('name'),
					'address' => $this->input->post('address'),
					'contact' => $this->input->post('contact'),
					'number' => $this->input->post('number'),
					'qr_stuff' => $this->input->post('qr_stuff'),
					'qr_customer' => $this->input->post('qr_customer'),
					'created_at' => date('Y-m-d : h:m:s'),
					'updated_at' => date('Y-m-d : h:m:s'),
				);
				$path="assets/img/";
				if(!empty($_FILES['logo']['name'])){
					$result = $this->functions->file_insert($path, 'logo', 'image', '9097152');
					if($result['status'] == 1){
						$data['logo'] = $path.$result['msg'];
					}
				}
				$data = $this->security->xss_clean($data);
				$result = $this->Venue_model->add_venue($data);
				if($result){
					$this->session->set_flashdata('success', 'Venue added Successfully!');
					redirect(base_url('admin/venue'), 'refresh');
				}
			}
		}else{
			$this->load->view('admin/includes/_header');
			$this->load->view('admin/venue/add', $data);
			$this->load->view('admin/includes/_footer');
		}
	}

	public function view($id = 0)
	{
		$data['admin_roles'] = $this->admin->get_admin_roles();
		$this->rbac->check_operation_access();
		$data['venue'] = $this->Venue_model->get_venue_by_id($id);
		$this->load->view('admin/includes/_header');
		$this->load->view('admin/venue/edit', $data);
		$this->load->view('admin/includes/_footer');
	}
	public function edit($id = 0){
		$data['admin_roles'] = $this->admin->get_admin_roles();

		$this->rbac->check_operation_access();

		if($this->input->post('submit')){
			$this->form_validation->set_rules('name', 'Name', 'trim|required');
			$this->form_validation->set_rules('address', 'Address', 'trim|required');
			$this->form_validation->set_rules('contact', 'Contact', 'trim|required');
			$this->form_validation->set_rules('number', 'Number', 'trim|required');
			$this->form_validation->set_rules('qr_stuff', 'QR Stuff', 'trim|required');
			$this->form_validation->set_rules('qr_customer', 'QR Customer', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('errors', $data['errors']);
				redirect(base_url('admin/venue/edit/'.$id),'refresh');
			}
			else{
				$data = array(
					'added_by' => $this->session->userdata('user_id'),
					'name' => $this->input->post('name'),
					'address' => $this->input->post('address'),
					'contact' => $this->input->post('contact'),
					'number' => $this->input->post('number'),
					'qr_stuff' => $this->input->post('qr_stuff'),
					'qr_customer' => $this->input->post('qr_customer'),
					'updated_at' => date('Y-m-d : h:m:s'),
				);
				$path="assets/img/";
				if(!empty($_FILES['logo']['name'])){
					$result = $this->functions->file_insert($path, 'logo', 'image', '9097152');
					if($result['status'] == 1){
						$data['logo'] = $path.$result['msg'];
					}
				}
				$data = $this->security->xss_clean($data);
				$result = $this->Venue_model->edit_venue($data, $id);
				if($result){
					$this->session->set_flashdata('success', 'Venue has been updated successfully!');
					redirect(base_url('admin/venue'));
				}
			}
		}
		else{
			$data['venue'] = $this->Venue_model->get_venue_by_id($id);
			$this->load->view('admin/includes/_header');
			$this->load->view('admin/venue/edit', $data);
			$this->load->view('admin/includes/_footer');
		}
	}
	public function delete($id = 0)
	{
		$this->rbac->check_operation_access(); // check opration permission

		$this->db->delete('ci_venues', array('id' => $id));

		$this->session->set_flashdata('success', 'Venue has been deleted successfully!');
		redirect(base_url('admin/venue'));
	}
}
