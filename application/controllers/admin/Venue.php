<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Venue extends MY_Controller{
	public function __construct()
	{
		parent::__construct();
		auth_check();
		//$this->rbac->check_module_access();
		$this->load->model('admin/admin_model', 'admin');
		$this->load->model('admin/Venue_model');
	}

	public function index()
	{
		die('as');
	}

	public function add()
	{
		//$this->rbac->check_operation_access();
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
}
