<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LokasiController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('RestClient');
        $this->load->helper('url');
    }

    // Read all locations
    public function index() {
        $response = $this->restclient->get('/lokasi');
        if ($response['status'] == 200) {
            $data['locations'] = $response['response'];
            $this->load->view('lokasi/index', $data);
        } else {
            show_error('Unable to fetch locations');
        }
    }

    // Create a new location
    public function create() {
        if ($this->input->post()) {
            $data = $this->input->post();
            $response = $this->restclient->post('/lokasi', $data);
            if ($response['status'] == 201) {
                redirect('lokasi');
            } else {
                show_error('Unable to create location');
            }
        } else {
            $this->load->view('lokasi/create');
        }
    }

    // Update a location
    public function edit($id) {
        if ($this->input->post()) {
            $data = $this->input->post();
            $response = $this->restclient->put("/lokasi/$id", $data);
            if ($response['status'] == 204) {
                redirect('lokasi');
            } else {
                show_error('Unable to update location');
            }
        } else {
            $response = $this->restclient->get("/lokasi/$id");
            if ($response['status'] == 200) {
                $data['location'] = $response['response'];
                $this->load->view('lokasi/edit', $data);
            } else {
                show_error('Unable to fetch location');
            }
        }
    }

    // Delete a location
    public function delete($id) {
        $response = $this->restclient->delete("/lokasi/$id");
        if ($response['status'] == 204) {
            redirect('lokasi');
        } else {
            show_error('Unable to delete location');
        }
    }
}
