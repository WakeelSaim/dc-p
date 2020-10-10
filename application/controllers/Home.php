<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function index() {
        if (isset($this->session->userId)) {
            redirect('home');
        } else {
            $data["page_title"] = "Fly Pav";
            $this->load->view('front/home/layout', $data);
        }
    }

    public function user_registration() {
        $data["page_title"] = "Registration";
        $this->load->model('User_model');
        $data["gender"] = "male";
        $data["firstname"] = "";
        $data["lastname"] = "";
        $data["email"] = "";
        $data["typejoin"] = "hospital";
        $data["dropdown"] = $this->User_model->country();
        $this->load->view('front/home/register', $data);
    }

    public function registration1() {
        if (isset($this->session->userId)) {
            redirect('home');
        } else {
            $data["gender"] = $this->input->post('gender');
            $data["firstname"] = $this->input->post('firstname');
            $data["lastname"] = $this->input->post('lastname');
            $data["email"] = $this->input->post('email');
            $data["page_title"] = "Registration";
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');
            $this->form_validation->set_rules('password1', 'Password Confirmation', 'required|min_length[5]');
            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('registration_failed', 'Password must be minimum length 5.');
                $this->load->view('front/home/register', $data);
            } else {
                $email = $this->input->post('email');
                $this->load->model('User_model');
                if ($this->User_model->email_exist($email) == TRUE) {
                    if ($this->input->post('password') == $this->input->post('password1')) {
                        $this->load->model('User_model');
                        $result = $this->User_model->insert_user();
                        $result["email"] = $this->input->post('email');
                        $res = $this->sendVerificationEmail($result);
                        if ($res == TRUE) {
                            $this->session->set_flashdata('success', 'Please log in to your email account and find the email we have just sent you. It may be in your Spam/Bulk/Junk folder. To complete the process of verification of email, just click the link in that email.');
                        } else {
                            $this->session->set_flashdata('email_error', 'Sorry Unable to Send Email on Your Email!');
                        }
                        redirect('login');
                    } else {
                        $this->session->set_flashdata('pw_not_matched', 'Password does not match.');
                        $this->load->view('front/home/register', $data);
                    }
                } else {
                    $this->session->set_flashdata('email_exist', 'This email already exist.');
                    redirect('user_registration');
                }
            }
        }
    }

    public function login() {
        if (isset($this->session->userId)) {
            redirect('home');
        } else {
            $d["page_title"] = "Login";
            $this->load->view('front/home/login', $d);
        }
    }

    public function verify($verificationText = NULL) {
        $this->load->model('User_model');
        $noRecords = $this->User_model->verifyEmailAddress($verificationText);
        if ($noRecords == 1) {
            $this->session->set_flashdata('registration_success', 'Email Verified Successfully. Please login now.');
        } else {
            $this->session->set_flashdata('registration_error', 'Sorry Unable to Verify Your Email!');
        }
        redirect('login');
    }

    public function sendVerificationEmail($dat) {
        $this->load->model('User_model');
        return $this->User_model->sendVerificatinEmail($dat['email'], $dat['code']);
    }

    public function user_login() {
        if (isset($this->session->userId)) {
            redirect('home');
        } else {
            $this->load->model('User_model');
            $res = $this->User_model->login();
            if (isset($res->id)) {
                if ($res->verified != 0) {
                    $data = array(
                        'userId' => $res->id,
                        'name' => $res->first_name . " " . $res->last_name,
                        'image' => $res->image_path
                    );
                    
                    $this->session->set_userdata($data);
                    redirect('home');
                } else {
                    $this->session->set_flashdata('not_verified', 'You did not verify your Email yet. Please check your inbox to verify Email');
                    redirect('login');
                }
            } else {
                $this->session->set_flashdata('wrong_login', 'Email or Password are Invalid. Please try again!');
                redirect('login');
            }
        }
    }

    public function dashboard() {
        if (!(isset($this->session->userId))) {
            redirect('index');
        } else {
            $this->load->model('User_model');
            $data['dropdown'] = $this->User_model->country();
            $data['page_title'] = "Dashboard";
            $data['experience'] = $this->User_model->experience($this->session->userId);
            $data['education'] = $this->User_model->education($this->session->userId);
            $data['awards'] = $this->User_model->awards($this->session->userId);
            $data['specialization'] = $this->User_model->specialization($this->session->userId);
            $data['timescheduling'] = $this->User_model->timescheduling($this->session->userId);
            $data['bio_data'] = $this->User_model->bio_data($this->session->userId);
            $data["main_page"] = "front/home/main_profile";
           //echo "<pre>"; print_r($data); echo "</pre>"; exit;
            $this->load->view('front/home/dashboard', $data);
        }
    }

    public function edit_profile() {
        if (isset($this->session->userId)) {
            $id = $this->session->userId;
            $data['page_title'] = "Edit Profile";
            $this->load->model('User_model');
            $data['dropdown'] = $this->User_model->country();
            $data['record'] = $this->User_model->edit($id);
            $data['main_page'] = 'front/home/new_edit_file';
            $this->load->view('front/home/profile', $data);
        } else {
            redirect('index');
        }
    }

    public function logout() {
        $this->session->unset_userdata(array('userId', 'name'));
        redirect('index');
    }

    public function edited() {
        if (isset($this->session->userId)) {
            $image_path = '0';
            $config['upload_path'] = './uploads/images';
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            if (isset($_FILES['img']) && $_FILES['img']['name'] != '') {
                $this->upload->initialize($config);
                if ($this->upload->do_upload('img')) {
                    $data = $this->upload->data();
                    $image_path = 'uploads/images/' . $data['raw_name'] . $data['file_ext'];
                } else {
                    $this->session->set_flashdata('image_error', $this->upload->display_errors());
                    redirect('edit_profile');
                }
            }
            $this->load->model('User_model');
            $res = $this->User_model->edited($image_path);
            if($res == 1){
                $this->session->set_flashdata('record_updated','Profile has been updated.');
                redirect('home');
            }else{
                $this->session->set_flashdata('n_record_updated','Something went wrong. Please try again later.');
                redirect('home');
            }
        }else{
            redirect('index');
        }
    }
    
    public function bio_edit_data(){
        if (isset($this->session->userId)) {
            $this->load->model('User_model');
            $data["page_title"] = "Edit Bio Data";
            $data["main_page"] = "front/home/edit_bio_data";
            $data['page_title'] = "Dashboard";
            $data['experience'] = $this->User_model->experience($this->session->userId);
            $data['education'] = $this->User_model->education($this->session->userId);
            $data['awards'] = $this->User_model->awards($this->session->userId);
            $data['specialization'] = $this->User_model->specialization($this->session->userId);
            $data['timescheduling'] = $this->User_model->timescheduling($this->session->userId);
            $this->load->view('front/home/profile',$data);
            
        }else{
            redirect('index');
        }
        
    }
    
    
    public function del_exp($id){
        $this->load->model('User_model');
        $data = "update experience SET status = 'n' where exp_id =".$id;  
        $res = $this->User_model->delete($data);
        if($res == 1){
            $this->session->set_flashdata('deleted', 'Experience has been deleted.');
            redirect('add-editExp');
        }else{
            $this->session->set_flashdata('n_deleted', 'Experience has not been deleted.');
            redirect('add-editExp');
        }
    }
    
    public function del_edu($id){
        $this->load->model('User_model');
        $data = "update education SET status = 'n' where edu_id =".$id;  
        $res = $this->User_model->delete($data);
        if($res == 1){
            $this->session->set_flashdata('deleted', 'Education has been deleted.');
            redirect('add-editEdu');
        }else{
            $this->session->set_flashdata('n_deleted', 'Education has not been deleted.');
            redirect('add-editEdu');
        }
    }
    
    public function del_awrd($id){
        $this->load->model('User_model');
        $data = "update awards SET status = 'n' where awrd_id =".$id;  
        $res = $this->User_model->delete($data);
        if($res == 1){
            $this->session->set_flashdata('deleted', 'Award has been deleted.');
            redirect('add-editAward');
        }else{
            $this->session->set_flashdata('n_deleted', 'Award has not been deleted.');
            redirect('add-editAward');
        }
    }
    
    public function del_sp($id){
        $this->load->model('User_model');
        $data = "update specialization SET status = 'n' where sp_id =".$id;  
        $res = $this->User_model->delete($data);
        if($res == 1){
            $this->session->set_flashdata('deleted', 'Specialization has been deleted.');
            redirect('add-editSp');
        }else{
            $this->session->set_flashdata('n_deleted', 'Specialization has not been deleted.');
            redirect('add-editSp');
        }
    }
    
    public function del_time($id){
        $this->load->model('User_model');
        $data = "update time_schedule SET status = 'n' where t_id =".$id;  
        $res = $this->User_model->delete($data);
        if($res == 1){
            $this->session->set_flashdata('deleted', 'Time Schedule has been deleted.');
            redirect('add-editTime');
        }else{
            $this->session->set_flashdata('n_deleted', 'Time Schedule has not been deleted.');
            redirect('add-editTime');
        }
    }
    
    public function edit_exp($id){
        $this->load->model('User_model');
        $data["page_title"] = "Edit Bio Data";
        $data["main_page"] = "front/home/experience";
        $data['page_title'] = "Dashboard";
        $data['experience'] = $this->User_model->experience($this->session->userId);
        $data['education'] = $this->User_model->education($this->session->userId);
        $data['awards'] = $this->User_model->awards($this->session->userId);
        $data['specialization'] = $this->User_model->specialization($this->session->userId);
        $data['timescheduling'] = $this->User_model->timescheduling($this->session->userId);
        
        
        $q = "select exp_id,job_title,location,exp_year_from, exp_year_to from experience where exp_id = ".$id;
         
        $res = $this->User_model->record($q);
        if($res["row"] == 1){
            $data["ex"] = $res["record"];
            $this->load->view('front/home/profile',$data);
            
        }else{
            $this->session->set_flashdata('data_error', 'Something going wrong!');
            redirect('add-editExp');
        }
    }
    public function edit_edu($id){
        $this->load->model('User_model');
        
        $data["page_title"] = "Edit Bio Data";
        $data["main_page"] = "front/home/education";
        $data['page_title'] = "Dashboard";
        $data['experience'] = $this->User_model->experience($this->session->userId);
        $data['education'] = $this->User_model->education($this->session->userId);
        $data['awards'] = $this->User_model->awards($this->session->userId);
        $data['specialization'] = $this->User_model->specialization($this->session->userId);
        $data['timescheduling'] = $this->User_model->timescheduling($this->session->userId);
        
        
        $q = "select edu_id,degree_name,institute_name,edu_year_from, edu_year_to from education where edu_id = ".$id;
         
        $res = $this->User_model->record($q);
        
        if($res["row"] == 1){
            $data["edx"] = $res["record"];
            $this->load->view('front/home/profile',$data);
            
        }else{
            $this->session->set_flashdata('data_error', 'Something going wrong!');
            redirect('add-editEdu');
        }
    }
    
    public function edit_awrd($id){
        $this->load->model('User_model');
        $data["page_title"] = "Edit Bio Data";
        $data["main_page"] = "front/home/award";
        $data['page_title'] = "Dashboard";
        $data['experience'] = $this->User_model->experience($this->session->userId);
        $data['education'] = $this->User_model->education($this->session->userId);
        $data['awards'] = $this->User_model->awards($this->session->userId);
        $data['specialization'] = $this->User_model->specialization($this->session->userId);
        $data['timescheduling'] = $this->User_model->timescheduling($this->session->userId);
        
        
        $q = "select awrd_id,award_title,award_by,year from awards where awrd_id = ".$id;
         
        $res = $this->User_model->record($q);
        if($res["row"] == 1){
            $data["awx"] = $res["record"];
            $this->load->view('front/home/profile',$data);
            
        }else{
            $this->session->set_flashdata('data_error', 'Something going wrong!');
            redirect('add-editAward');
        }
    }
    public function edit_sp($id){
        $this->load->model('User_model');
        $data["page_title"] = "Edit Bio Data";
        $data["main_page"] = "front/home/specialization";
        $data['page_title'] = "Dashboard";
        $data['experience'] = $this->User_model->experience($this->session->userId);
        $data['education'] = $this->User_model->education($this->session->userId);
        $data['awards'] = $this->User_model->awards($this->session->userId);
        $data['specialization'] = $this->User_model->specialization($this->session->userId);
        $data['timescheduling'] = $this->User_model->timescheduling($this->session->userId);
        
        
        $q = "select sp_id, s_title from specialization where sp_id = ".$id;
         
        $res = $this->User_model->record($q);
        if($res["row"] == 1){
            $data["spx"] = $res["record"];
            $this->load->view('front/home/profile',$data);
            
        }else{
            $this->session->set_flashdata('data_error', 'Something going wrong!');
            redirect('add-editSp');
        }
    }
    public function edit_time($id){
        $this->load->model('User_model');
        $data["page_title"] = "Edit Bio Data";
        $data["main_page"] = "front/home/time_schedule";
        $data['page_title'] = "Dashboard";
        $data['experience'] = $this->User_model->experience($this->session->userId);
        $data['education'] = $this->User_model->education($this->session->userId);
        $data['awards'] = $this->User_model->awards($this->session->userId);
        $data['specialization'] = $this->User_model->specialization($this->session->userId);
        $data['timescheduling'] = $this->User_model->timescheduling($this->session->userId);

        
        
        $q = "select t_id,clinic_name,address,time_from,time_to,days,fees from time_schedule where t_id = ".$id;
         
        $res = $this->User_model->record($q);
        if($res["row"] == 1){
            $data["tx"] = $res["record"];
            $this->load->view('front/home/profile',$data);
            
        }else{
            $this->session->set_flashdata('data_error', 'Something going wrong!');
            redirect('add-editTime');
        }
    }
    
    
    public function insert_exp(){
        $this->load->model('User_model');
        $q = "INSERT INTO experience (job_title,exp_year_from,exp_year_to,location,user_id,status) VALUES ('".$this->input->post('job_title')."' , '".$this->input->post('exp_year_from')."' , '".$this->input->post('exp_year_to')."' , '".$this->input->post('location')."',".$this->session->userId.",'y')";
        $res = $this->User_model->insert($q);
        if($res == 1){
            $this->session->set_flashdata('insert_success', 'Experience has been added.');
            redirect('add-editEdu');
        }else{
            $this->session->set_flashdata('data_error', 'Experience has not been added!');
            redirect('add-editExp');
        }
    }
    public function insert_edu(){
        $this->load->model('User_model');
        $q = "INSERT INTO education (degree_name,edu_year_from,edu_year_to,institute_name,user_id,status) VALUES ('".$this->input->post('degree_name')."' , '".$this->input->post('edu_year_from')."' , '".$this->input->post('edu_year_to')."' , '".$this->input->post('institute_name')."',".$this->session->userId.",'y')";
        $res = $this->User_model->insert($q);
        if($res == 1){
            $this->session->set_flashdata('insert_success', 'Education has been added.');
            redirect('add-editEdu');
        }else{
            $this->session->set_flashdata('data_error', 'Education has not been added!');
            redirect('add-editEdu');
        }
    }
    public function insert_awrd(){
        $this->load->model('User_model');
        $q = "INSERT INTO awards (award_title,award_by,year,user_id,status) VALUES ('".$this->input->post('award_title')."' , '".$this->input->post('award_by')."' , '".$this->input->post('year')."',".$this->session->userId.",'y')";
        $res = $this->User_model->insert($q);
        if($res == 1){
            $this->session->set_flashdata('insert_success', 'Award has been added.');
            redirect('add-editAward');
        }else{
            $this->session->set_flashdata('data_error', 'Award has not been added!');
            redirect('add-editAward');
        }
    }
    public function insert_sp(){
        $this->load->model('User_model');
        $q = "INSERT INTO specialization (s_title,user_id,status) VALUES ('".$this->input->post('s_title')."',".$this->session->userId.",'y')";
        $res = $this->User_model->insert($q);
        if($res == 1){
            $this->session->set_flashdata('insert_success', 'Specialization has been added.');
            redirect('add-editSp');
        }else{
            $this->session->set_flashdata('data_error', 'Specialization has not been added!');
            redirect('add-editSp');
        }
    }
    public function insert_time(){
        $this->load->model('User_model');
        $q = "INSERT INTO time_schedule (clinic_name,address,time_from,time_to,days,fees,user_id,status) VALUES ('".$this->input->post('clinic_name')."' , '".$this->input->post('address')."' , '".$this->input->post('time_from')."' , '".$this->input->post('time_to')."','".$this->input->post('days')."',".$this->input->post('fees').",".$this->session->userId.",'y')";
        $res = $this->User_model->insert($q);
        if($res == 1){
            $this->session->set_flashdata('insert_success', 'Time Schedule has been added.');
            redirect('add-editTime');
        }else{
            $this->session->set_flashdata('data_error', 'Time Schedule has not been added!');
            redirect('add-editTime');
        }
    }
    
    public function upd_exp(){
        $this->load->model('User_model');
        $data = "update experience SET job_title = '".$this->input->post('job_title')."' ,location = '".$this->input->post('location')."', exp_year_from = '".$this->input->post('exp_year_from')."', exp_year_to = '".$this->input->post('exp_year_to')."' where exp_id =".$this->input->post('exp_id'); 
        $res = $this->User_model->updated($data);
        if($res == 1){
            $this->session->set_flashdata('updated_success', 'Experience has been updated.');
            redirect('add-editExp');
        }else{
            $this->session->set_flashdata('n_updated_success', 'Experience has not been updated.');
            redirect('add-editExp');
        }
    }
    public function upd_edu(){
        $this->load->model('User_model');
        $data = "update education SET degree_name = '".$this->input->post('degree_name')."' ,institute_name = '".$this->input->post('institute_name')."', edu_year_from = '".$this->input->post('edu_year_from')."', edu_year_to = '".$this->input->post('edu_year_to')."' where edu_id =".$this->input->post('edu_id'); 
        $res = $this->User_model->updated($data);
        if($res == 1){
            $this->session->set_flashdata('updated_success', 'Education has been updated.');
            redirect('add-editEdu');
        }else{
            $this->session->set_flashdata('n_updated_success', 'Education has not been updated.');
            redirect('add-editEdu');
        }
    }
    public function upd_awrd(){
        $this->load->model('User_model');
        $data = "update awards SET award_title = '".$this->input->post('award_title')."' ,award_by = '".$this->input->post('award_by')."', year = '".$this->input->post('year')."' where awrd_id = ".$this->input->post('awrd_id'); 
        $res = $this->User_model->updated($data);
        if($res == 1){
            $this->session->set_flashdata('updated_success', 'Award has been updated.');
            redirect('add-editAward');
        }else{
            $this->session->set_flashdata('n_updated_success', 'Award has not been updated.');
            redirect('add-editAward');
        }
    }
    
    public function upd_sp(){
        $this->load->model('User_model');
        $data = "update specialization SET s_title = '".$this->input->post('s_title')."' where sp_id = ".$this->input->post('sp_id'); 
        $res = $this->User_model->updated($data);
        if($res == 1){
            $this->session->set_flashdata('updated_success', 'Specialization has been updated.');
            redirect('add-editSp');
        }else{
            $this->session->set_flashdata('n_updated_success', 'Specialization has not been updated.');
            redirect('add-editSp');
        }
    }
    public function upd_time(){
        $this->load->model('User_model');
        $data = "update time_schedule SET clinic_name = '".$this->input->post('clinic_name')."' ,address = '".$this->input->post('address')."', time_from = '".$this->input->post('time_from')."', time_to = '".$this->input->post('time_to')."' days = '".$this->input->post('days')."' fees = ".$this->input->post('fees')." where t_id =".$$this->input->post('t_id'); 
        $res = $this->User_model->updated($data);
        if($res == 1){
            $this->session->set_flashdata('updated_success', 'Time Schedule has been updated.');
            redirect('add-editTime');
        }else{
            $this->session->set_flashdata('n_updated_success', 'Time Schedule has not been updated.');
            redirect('add-editTime');
        }
    }
    
    public function searchbar(){
        $data["main_page"] = "front/home/result_search";
        $data['page_title'] = "Search";
        $data['query'] = '';
        $this->load->model('User_model');
        $c = $this->input->post('search');
        $l = $this->input->post('locations');
        if($l == 'Location'){
            $location = " ";
        }else{
            $location = " AND b.country LIKE '%".$l."%'  ";
            $data['query'] = " In ".$l;
        }
        if($c!=" "){
            $clinic = " AND u.first_name LIKE '%".$c."%' OR u.last_name LIKE '%".$c."%'  AND b.join_as = 'doctor' OR b.join_as = 'hospital'";
            $data['query'] = $c.$data['query'];
            
        }else{
            $clinic = " ";
        }
        $q = "select u.id,u.first_name,u.last_name,b.country,b.image_path from users AS u INNER JOIN user_bio_data AS b ON u.id = b.user_id WHERE u.delete_flag = '0' ".$location.$clinic;
        $res = $this->User_model->search_record($q);
        if($res->num_rows()>0){
            
            $data['result'] = $res->result();
            $data['no_result'] = $res->num_rows();
        }else{
            $data['no_result'] = 0;
        }
        $this->load->view('front/home/main_page',$data);
        
        
    }
        
    public function fetch_exp(){
        $this->load->model('User_model');
        $q = "select exp_id, job_title, location, exp_year_from, exp_year_to from experience where status = 'y' and user_id = ".$this->session->userId;
        $res = $this->User_model->exe_query();
        
        echo json_encode($res);
        
    }
    
    public function move_exp(){
        $this->load->model('User_model');
        $data["page_title"] = "Edit Bio Data";
        $data["main_page"] = "front/home/experience";
        $data['page_title'] = "Edit Profile";
        $data['experience'] = $this->User_model->experience($this->session->userId);
        //$data['education'] = $this->User_model->education($this->session->userId);
        //$data['awards'] = $this->User_model->awards($this->session->userId);
        //$data['specialization'] = $this->User_model->specialization($this->session->userId);
        //$data['timescheduling'] = $this->User_model->timescheduling($this->session->userId);
        $this->load->view('front/home/profile',$data);
    }
    
    public function move_edu(){
        $this->load->model('User_model');
        $data["page_title"] = "Edit Bio Data";
        $data["main_page"] = "front/home/education";
        $data['page_title'] = "Edit Profile";
        //$data['experience'] = $this->User_model->experience($this->session->userId);
        $data['education'] = $this->User_model->education($this->session->userId);
        //$data['awards'] = $this->User_model->awards($this->session->userId);
        //$data['specialization'] = $this->User_model->specialization($this->session->userId);
        //$data['timescheduling'] = $this->User_model->timescheduling($this->session->userId);
        $this->load->view('front/home/profile',$data);
    }
    
    public function move_award(){
        $this->load->model('User_model');
        $data["page_title"] = "Edit Bio Data";
        $data["main_page"] = "front/home/award";
        $data['page_title'] = "Edit Profile";
        //$data['experience'] = $this->User_model->experience($this->session->userId);
        //$data['education'] = $this->User_model->education($this->session->userId);
        $data['awards'] = $this->User_model->awards($this->session->userId);
        //$data['specialization'] = $this->User_model->specialization($this->session->userId);
        //$data['timescheduling'] = $this->User_model->timescheduling($this->session->userId);
        $this->load->view('front/home/profile',$data);
    }
    public function move_sp(){
        $this->load->model('User_model');
        $data["page_title"] = "Edit Bio Data";
        $data["main_page"] = "front/home/specialization";
        $data['page_title'] = "Edit Profile";
        //$data['experience'] = $this->User_model->experience($this->session->userId);
        //$data['education'] = $this->User_model->education($this->session->userId);
        //$data['awards'] = $this->User_model->awards($this->session->userId);
        $data['specialization'] = $this->User_model->specialization($this->session->userId);
        //$data['timescheduling'] = $this->User_model->timescheduling($this->session->userId);
        $this->load->view('front/home/profile',$data);
    }
    public function move_time(){
        $this->load->model('User_model');
        $data["page_title"] = "Edit Bio Data";
        $data["main_page"] = "front/home/time_schedule";
        $data['page_title'] = "Edit Profile";
        //$data['experience'] = $this->User_model->experience($this->session->userId);
        //$data['education'] = $this->User_model->education($this->session->userId);
        //$data['awards'] = $this->User_model->awards($this->session->userId);
        //$data['specialization'] = $this->User_model->specialization($this->session->userId);
        $data['timescheduling'] = $this->User_model->timescheduling($this->session->userId);
        $this->load->view('front/home/profile',$data);
    }
    public function single_profile($id){
        if (isset($this->session->userId)) {
            
            //echo $id; exit;
            $this->load->model('User_model');
            $data["page_title"] = "Profile";
            $data["main_page"] = "front/home/single_profile";
            $data['experience'] = $this->User_model->experience($id);
            $data['education'] = $this->User_model->education($id);
            $data['awards'] = $this->User_model->awards($id);
            $data['specialization'] = $this->User_model->specialization($id);
            $data['timescheduling'] = $this->User_model->timescheduling($id);
            $data['bio_data'] = $this->User_model->bio_data($id);
            $this->load->view('front/home/main_page',$data);
            
        }else{
            redirect('index');
        }
    }
}
