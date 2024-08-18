<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProyekController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('RestClient');
        $this->load->helper('url');
    }

    // Read all projects
    public function index() {
        $response = $this->restclient->get('/proyek');
        if ($response['status'] == 200) {
            $data['projects'] = $response['response'];
            $this->load->view('proyek/index', $data);
        } else {
            show_error('Unable to fetch projects');

        }
    }

    // Create a new project
    public function create() {
		if ($this->input->post()) {
			$data = $this->input->post();
			// You may need to validate and process the lokasiIds field here
			$response = $this->restclient->post('/proyek', $data);
			if ($response['status'] == 201) {
				redirect('proyek');
			} else {
				show_error('Unable to create project');
			}
		} else {
			$this->load->view('proyek/create');
		}
	}
	

    // Update a project
    public function edit($id) {
        if ($this->input->post()) {
            $data = $this->input->post();
            $response = $this->restclient->put("/proyek/$id", $data);
            if ($response['status'] == 204) {
                redirect('proyek');
            } else {
                show_error('Unable to update project');
            }
        } else {
            $response = $this->restclient->get("/proyek/$id");
            if ($response['status'] == 200) {
                $data['project'] = $response['response'];
                $this->load->view('proyek/edit', $data);
            } else {
                show_error('Unable to fetch project');
            }
        }
    }

    // Delete a project
    public function delete($id) {
        $response = $this->restclient->delete("/proyek/$id");
        if ($response['status'] == 204) {
            redirect('proyek');
        } else {
            show_error('Unable to delete project');
        }
    }
}
