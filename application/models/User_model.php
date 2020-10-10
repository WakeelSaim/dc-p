<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_model {

    public function email_exist($mail) {

        $this->db->where('email', $mail);
        $result = $this->db->get('users');
        if ($result->num_rows() < 1) {
            return true;
        } else {
            return false;
        }
    }

    public function insert_user() {

        $secret_code = md5($this->input->post('email'));
        $password = md5($this->input->post('password'));
        $email = trim($this->input->post('email'));
        $data = array(
            'first_name' => trim($this->input->post('firstname')),
            'last_name' => trim($this->input->post('lastname')),
            'email' => $email,
            'password' => $password,
            'email_verification_code' => $secret_code,
            'verified' => "0",
            'created_date' => date('Y-m-d H:i:s', time()),
            'modified_date' => date('Y-m-d H:i:s', time()),
            'delete_flag' => "0"
        );
        //print_r($data);exit;
        $this->db->insert('users', $data);
        $last_id = $this->db->insert_id();
        $data1 = array(
            'user_id' => $last_id,
            'gender' => $this->input->post('gender'),
            'join_as' => $this->input->post('typejoin')
        );
        $this->db->insert('user_bio_data', $data1);
        $d["code"] = $secret_code;
        if ($this->db->insert_id() != NULL) {
            $d["res"] = "true";
        } else {
            $d["res"] = "false";
        }
        return $d;
    }

    public function sendVerificatinEmail($email, $verificationText) {

        $this->load->library('email');
        $this->email->set_newline("\r\n");
        $this->email->from('wakeeeeel@gmail.com', "Admin Team");
        $this->email->to($email);
        $this->email->subject("Email Verification");
        $this->email->message("Dear User,\nPlease click on below URL or paste into your browser to verify your Email Address\n\n " . base_url() . "verify/" . $verificationText . "\n" . "\n\nThanks\nAdmin Team");
        if ($this->email->send()) {
            $r = TRUE;
        } else {
            $r = FALSE;
        }
        return $r;
    }

    public function verifyEmailAddress($verificationcode) {
        $select = "select verified from users where email_verification_code = '" . $verificationcode . "'";
        $res = $this->db->query($select);
        //echo "<pre>"; print_r($res->result()); echo "</pre>"; exit;
        foreach ($res->result() as $row) {
            $verify = $row->verified;
        }
        if ($verify == 0) {
            $date['date'] = "'" . date('Y-m-d H:i:s', time()) . "'";
            $sql = "update users set verified='1', modified_date =" . $date['date'] . " WHERE email_verification_code=?";
            $this->db->query($sql, array($verificationcode));
            return $this->db->affected_rows();
        } else {
            return 0;
        }
    }

    public function login() {
        $email = trim($this->input->post('email'));
        $pw = md5($this->input->post('password'));
        $res = $this->db->query("select u.id,u.first_name,u.verified ,u.last_name,b.gender,b.country,b.image_path from users AS u INNER JOIN user_bio_data AS b ON u.id = b.user_id WHERE u.email ='" . $email . "' and  password = '" . $pw . "' ");
        //echo "<pre>"; print_r($res->row()); echo"</pre>"; exit;
        return $res->row();
    }

    public function country() {
        $res = $this->db->query("select * from country");
        return $res->result();
    }

    public function data($id) {
        $email = $this->input->post('email');
        $pw = md5($this->input->post('password'));
        $res = $this->db->query("select u.id,u.first_name,u.last_name,b.gender,b.country from users AS u INNER JOIN user_bio_data AS b ON u.id = b.user_id WHERE u.email ='" . $email . "' and  password = '" . $pw . "'");
        return $res->result();
    }

    public function edit($id) {
        $res = $this->db->query("select u.first_name,u.last_name,b.gender,b.country,b.country_code,b.image_path,b.join_as,b.address,b.about,b.dob,b.contact_no from users AS u INNER JOIN user_bio_data AS b ON u.id = b.user_id WHERE u.id ='" . $id . "'");
        return $res->result();
    }

    public function edited($path) {
        $id = $this->session->userId;
        $this->db->query("update users SET first_name = '" . trim($this->input->post('firstname')) . "' , last_name = '" . trim($this->input->post('lastname')) . "' ,modified_date = '" . date('Y-m-d H:i:s', time()) . "'  WHERE id = " . $id);
        if ($path != '0') {
            $q = "update user_bio_data SET gender ='" . $this->input->post('gender') . "' , country ='" . $this->input->post('country') . "' , country_code ='" . $this->input->post('country_code') . "' , contact_no ='" . trim($this->input->post('contact_no')) . "' , join_as ='" . $this->input->post('typejoin') . "' , dob ='" . $this->input->post('dob') . "' , address ='" . trim($this->input->post('address')) . "' , about ='" . trim($this->input->post('about')) . "' , image_path ='" . $path . "'  where user_id = " . $id;
        } else {
            $q = "update user_bio_data SET gender ='" . $this->input->post('gender') . "' , country ='" . $this->input->post('country') . "' , country_code ='" . $this->input->post('country_code') . "' , contact_no ='" . trim($this->input->post('contact_no')) . "' , join_as ='" . $this->input->post('typejoin') . "' , dob ='" . $this->input->post('dob') . "' , address ='" . trim($this->input->post('address')) . "' , about ='" . trim($this->input->post('about')) . "'  where user_id = " . $id;
        }

        $res = $this->db->query($q);
        return $this->db->affected_rows();
    }

    public function insert_experince($data) {
        $id = $this->session->userId;
        $data1 = array(
            'user_id' => $id,
            'job_title' => trim($this->input->post('locations')),
            'year_from' => trim($this->input->post('gender')),
            'year_to' => trim($this->input->post('typejoin')),
            'location' => $this->input->post('gender'),
            'status' => $this->input->post('y')
        );

        $this->db->insert('experience', $data1);
    }

    public function insert_education($data) {
        $id = $this->session->userId;
        $data1 = array(
            'user_id' => $id,
            'degree_name' => trim($this->input->post('locations')),
            'institute_name' => trim($this->input->post('gender')),
            'year_from' => trim($this->input->post('typejoin')),
            'year_to' => trim($this->input->post('gender')),
            'status' => $this->input->post('y')
        );
        $this->db->insert('education', $data1);
    }

    public function insert_specialization($data) {
        $id = $this->session->userId;
        $data1 = array(
            'user_id' => $id,
            's_title' => trim($this->input->post('locations')),
            'status' => $this->input->post('y')
        );
        $this->db->insert('specialization', $data1);
    }

    public function insert_award($data) {
        $id = $this->session->userId;
        $data1 = array(
            'user_id' => $id,
            'award_title' => trim($this->input->post('locations')),
            'award_by' => trim($this->input->post('gender')),
            'year' => trim($this->input->post('typejoin')),
            'status' => $this->input->post('status')
        );
        $this->db->insert('award', $data1);
    }
    
    public function experience($id){
        $q = "select exp_id, job_title, exp_year_from, exp_year_to, location from experience where user_id = ".$id." and status = 'y'";
        $res = $this->db->query($q);
        return $res->result();
    }
    
    public function education($id){
        $q = "select edu_id, degree_name,institute_name ,edu_year_from, edu_year_to from education where user_id = ".$id." and status = 'y'";
        $res = $this->db->query($q);
        return $res->result();
    }
    
    public function specialization($id){
        $q = "select sp_id, s_title from specialization where user_id =".$id." and status = 'y'";
        $res = $this->db->query($q);
        return $res->result();
    }
    
    public function awards($id){
        $q = "select awrd_id, award_title, award_by, year from awards where user_id =".$id." and status = 'y'";
        $res = $this->db->query($q);
        return $res->result();
    }
    public function timescheduling($id){
        $q = "select t_id, clinic_name, address,time_from,time_to,days,fees from time_schedule where user_id =".$id." and status = 'y'";
        $res = $this->db->query($q);
        return $res->result();
    }
    
    public function bio_data($id) {
        $res = $this->db->query("select u.first_name,u.last_name,b.gender,b.country,b.country_code,b.image_path,b.join_as,b.address,b.about,b.dob,b.contact_no from users AS u INNER JOIN user_bio_data AS b ON u.id = b.user_id WHERE u.id ='" . $id . "'");
        return $res->row();
    }
    public function delete($data){
        $res = $this->db->query($data);
        return $this->db->affected_rows();
        
    }
    public function record($q) {
        $res = $this->db->query($q);
        $r["record"] = $res->row();
        $r["row"] = $res->num_rows();
        return $r;
    }
    public function insert($q){
        $res = $this->db->query($q);
        return $this->db->affected_rows();
    }
    public function updated($data){
        $res = $this->db->query($data);
        return $this->db->affected_rows();
        
    }
    
    public function search_record($d){
        $res = $this->db->query($d);
        return $res;
    }
    
    public function exe_query(){
        
        $q = "select exp_id, job_title, location, exp_year_from, exp_year_to from experience where status = 'y' and user_id = ".$this->session->userId;
        $r = $this->db->query($q);
        if($r->num_rows > 0){
            return $r->result();
        }else{
            return $r;
        }
    }
    
    

}
