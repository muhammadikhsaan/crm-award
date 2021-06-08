<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CSync extends CI_Controller {
    public function __construct(){
        parent::__construct();
    }

    public function index(){
        $data['errors'] = $this->session->flashdata('errors');
		$this->load->view('root', $data);
    }

    public function select(){
        $date = $this->input->get('date');

        if ($this->input->get('action') == 'get') {
            $this->import($date);
        } else {
            $this->update($date);
        }
    }

    private function import($param = null){
        if(empty($param)){
            $this->session->set_flashdata('errors', array('errors' => 'Tanggal Harus Diisikan'));
			redirect(base_url());
        }

        if($param >= date("Y-m-d")){
            $this->session->set_flashdata('errors', array('errors' => 'Hanya dapat mengambil data pada tanggal sebelum hari ini'));
			redirect(base_url());
        }

        $this->sync->insert_from_cbd($param, true);
    }

    private function update($param = null){
        if(empty($param)){
            $this->session->set_flashdata('errors', array('errors' => 'Tanggal Harus Diisikan'));
			redirect(base_url());
        }

        if($param >= date("Y-m-d")){
            $this->session->set_flashdata('errors', array('errors' => 'Hanya dapat mengambil data pada tanggal sebelum hari ini'));
			redirect(base_url());
        }

        $this->sync->insert_from_cbd($param, false);
    }
}