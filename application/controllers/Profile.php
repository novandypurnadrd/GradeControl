<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends CI_Controller {

	public function Profile(){
		parent::__construct();
			$this->load->helper(array('url','form'));
			$this->load->model('User_model');
			$this->load->library('session');
			$this->load->library('upload');
	}

	public function Index(){
    if ($this->session->userdata('GradeControl')) {
      $this->User_model->GetUser($this->session->userdata('usernameGradeControl'), $this->session->userdata('passwordGradeControl'));
      $data['User'] = '';
      $data['main'] = "";
      $data['sub'] = "";
      $data['subsub'] = "";
			$this->load->view('Profile', $data);
		}
		else {
			redirect('GradeControl');
		}
	}

	public function UpdateProfile()
	{
		if ($this->session->userdata('GradeControl')) {
			if ($this->input->post('password') == '') {
				$data = array(
					'name' => $this->input->post('name'),
				);
				$this->User_model->updateProfile($data);

			}
			else {
				$data = array(
					'name' => $this->input->post('name'),
					'password' => md5($this->input->post('password')),
				);
				$this->User_model->updateProfile($data);
			}
			$data_session = array(
					'username'=> $this->session->userdata('usernameGradeControl'),
					'password'=> $this->session->userdata('passwordCSR'),
					'role'=> $this->session->userdata('GradeControl'),
					'name'=> $this->input->post('name'),
				);
			$this->session->set_userdata($data_session);


			$this->Index();

			   //pesan yang muncul jika berhasil diupload pada session flashdata
                $this->session->set_flashdata("message", "<div class=\"col-md-12\"><div class=\"alert alert-success\" id=\"alert\">Updated Password success !!</div></div>");
                redirect('Profile'); 
			// echo $this->input->post('name');
			// echo $this->input->post('new');
		}
		else {
			//pesan yang muncul jika terdapat error dimasukkan pada session flashdata
                $this->session->set_flashdata("message", "<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"alert\">
				Updated Password Failed !!</div></div>");
                redirect('Profile'); 
		}
	}

	public function insertImage(){
       
        $nmfile = "file_".time(); //nama file saya beri nama langsung dan diikuti fungsi time
        $config['upload_path'] = './assets/uploadImage/'; //path folder
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
        $config['max_size'] = '10000'; //maksimum besar file 10M
        //$config['max_width']  = '1288'; //lebar maksimum 1288 px
        //$config['max_height']  = '768'; //tinggi maksimu 768 px
        $config['file_name'] = $nmfile; //nama yang terupload nantinya
 
        $this->upload->initialize($config);
         
        if($_FILES['filefoto']['name'])
        {
            if ($this->upload->do_upload('filefoto'))
            {
                $gbr = $this->upload->data();
                $data = array(
                  'picture' =>$gbr['file_name']
                   
                );
 
                $this->User_model->insertImage($data); //akses model untuk menyimpan ke database
                //pesan yang muncul jika berhasil diupload pada session flashdata
                $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-success\" id=\"alert\">Upload image success !!</div></div>");
                redirect('Profile'); //jika berhasil maka akan ditampilkan view vupload
            }else{
                //pesan yang muncul jika terdapat error dimasukkan pada session flashdata
                $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"alert\">
				Upload image failed !!</div></div>");
                redirect('Profile'); //jika gagal maka akan ditampilkan form upload
            }
        }
    }

}
?>
