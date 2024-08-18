<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RestClient {

    private $ci;
    private $base_url;

    public function __construct() {
        $this->ci =& get_instance();
        $this->base_url = 'http://localhost:8080'; // Base URL of your API
    }

    private function _request($method, $endpoint, $data = array()) {
        $url = $this->base_url . $endpoint;
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);

        if (!empty($data)) {
            if ($method == 'POST' || $method == 'PUT') {
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json',
                    'Content-Length: ' . strlen(json_encode($data))
                ));
            }
        }

        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return array('status' => $http_code, 'response' => json_decode($response, true));
    }

    public function get($endpoint) {
        return $this->_request('GET', $endpoint);
    }

    public function post($endpoint, $data = array()) {
        return $this->_request('POST', $endpoint, $data);
    }

    public function put($endpoint, $data = array()) {
        return $this->_request('PUT', $endpoint, $data);
    }

    public function delete($endpoint) {
        return $this->_request('DELETE', $endpoint);
    }
}
