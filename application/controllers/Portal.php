<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Portal extends CI_Controller {

    public function __construct() {
        parent::__construct();
        date_default_timezone_set("Asia/Karachi");
        $public = array(
            'portal/index',
            'portal/signin',
            'portal/forgot_password',
            'portal/forgot_password_send',
            'portal/reset_password',
            'portal/reset_password_save',
        );
        $private = array(
            'portal/dashboard',
            'portal/logout',
            'portal/account',
            'portal/account_save',
        );
        $this->load->model('portal_model');
        $current_url = $this->router->fetch_class() . '/' . $this->router->fetch_method();
        if ($this->session->userdata('user_logged_in')) {
            $user_access = $this->portal_model->get_current_user_roles_permissions();
            if ((in_array($current_url, $public))) {
                redirect('dashboard');
            } else if (in_array($current_url, $private)) {
                
            } else if ((!in_array($this->router->fetch_method(), array_column($user_access, 'user_permission_route')))) {
                redirect();
            }
        } elseif (!$this->session->userdata('user_logged_in') && !in_array($current_url, $public)) {
            redirect();
        }
    }

    public function index() {
        $data["page_title"] = "Dating Admin";
        $data['main_view'] = "portal/login_view";
        $this->load->view('portal/login', $data);
    }

    public function signin() {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if (!$this->form_validation->run()) {
            $data["page_title"] = "Dating";
            $this->load->view('portal', $data);
        } else {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $this->load->model('portal_model');
            if ($user = $this->portal_model->login_user($email, $password)) {
                $userdata = array(
                    'user_id' => $user->id,
                    'name' => $user->first_name . ' ' . $user->last_name,
                    'user_profile_image' => $user->profile_image,
                    'user_role_id' => $user->user_role_id,
                    'user_role_name' => $this->portal_model->get_user_role_name_by_id($user->user_role_id),
                    'user_logged_in' => true
                );
                $this->session->set_userdata($userdata);
                redirect('dashboard');
            } else {
                $this->session->set_flashdata('no_user_access', 'Invalid Email / Password.');
                redirect();
            }
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect();
    }

    public function forgot_password() {
        $data["page_title"] = "UTraders";
        $data['main_view'] = "portal/forgot_password_view";
        $this->load->view('portal/forgot_password_view', $data);
    }

    public function forgot_password_send() {
        $email = $this->input->post('email');
        $this->load->model('portal_model');
        if ($secret = $this->portal_model->user_forgot_password($email)) {
            $htmlContent = '<h1>UTraders Reset Password Request</h1>';
            $htmlContent .= '<p>Click on the link below to reset your password.</p>';
            $htmlContent .= '<p><a href="' . base_url('user') . '/reset-password/' . $secret . '">Reset Password</a></p>';

            $this->email->to($this->input->post('email'));
            $this->email->from(EMAIL_FROM_SMTP, 'UTraders');
            $this->email->subject('UTraders Reset Password Request');
            $this->email->message($htmlContent);
            $this->email->send();
            $this->session->set_flashdata('signup_success', 'Reset password link has been sent. Check your inbox.');
            redirect('forgot-password');
        } else {
            $this->session->set_flashdata('no_user_access', 'Invalid Email! Please try again.');
            redirect('forgot-password');
        }
    }

    public function reset_password($code) {
        $data['is_code_valid'] = $this->portal_model->user_check_secret_code($code);
        $data['secret_code'] = $code;
        $data["page_title"] = "SGIC - Admin Portal";
        $data['main_view'] = "portal/reset_password_view";
        $this->load->view('portal/reset_password_view', $data);
    }

    public function reset_password_save() {
        $code = $this->input->post('secret_code');
        $data['is_code_valid'] = $this->portal_model->user_check_secret_code($code);
        $data['secret_code'] = $code;
        if (!$data['is_code_valid']) {
            redirect('reset-password/' . $code);
        }
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
        $this->form_validation->set_rules('cpassword', 'Confirm Password', 'matches[password]');
        if (!$this->form_validation->run()) {
            $data['secret_code'] = $code;
            $data["page_title"] = "SGIC - Employee Portal";
            $data['main_view'] = "portal/reset_password_view";
            $this->load->view('portal/reset_password_view', $data);
        } else {
            if ($this->portal_model->user_reset_password($code)) {
                $this->session->set_flashdata('signup_success', 'Password changed successfully!');
                redirect();
            } else {
                $this->session->set_flashdata('no_user_access', 'Something went wrong! Please try again.');
                redirect('reset-password/' . $code);
            }
        }
    }

    public function account() {
        $data['page_title'] = "Account Settings";
        $data['main_view'] = "portal/account";
        $data['account'] = $this->db->where('id', $this->session->userdata('user_id'))->get('admin')->row();
        $this->load->view('portal/layout', $data);
    }

    public function account_save() {
        $data['page_title'] = "Account Settings";
        $data['main_view'] = "portal/account";
        $is_password = FALSE;
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
        $this->form_validation->set_rules('last_name', 'Surname', 'trim|required');
        if ($this->input->post('new_password')) {
            $this->form_validation->set_rules('current_password', 'Current Password', 'trim|required|callback_current_password_check');
            $this->form_validation->set_rules('new_password', 'New Password', 'trim|required');
            $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|matches[new_password]');
            $is_password = TRUE;
        }
        if (!$this->form_validation->run()) {
            $data['account'] = $this->db->where('id', $this->session->userdata('user_id'))->get('admin')->row();
            $this->load->view('portal/layout', $data);
        } else {
            if ($this->portal_model->user_account_update($is_password)) {
                $this->session->set_flashdata('success_message', 'Account updated successfully!');
                redirect('account');
            } else {
                $data['account'] = $this->db->where('id', $this->session->userdata('user_id'))->get('admin')->row();
                $this->session->set_flashdata('errorr_message', 'Something went wrong. Please try again!');
                $this->load->view('portal/layout', $data);
            }
        }
    }

    public function current_password_check($current_password) {
        if (!$this->portal_model->match_current_password($current_password)) {
            $this->form_validation->set_message('current_password_check', 'Current password doesn\'t not match');
            return FALSE;
        }
        return TRUE;
    }

    public function dashboard() {
        $data['page_title'] = "Dashboard";
        $data['main_view'] = "portal/dashboard";
//        $data['total_countries'] = $this->db->count_all_results('countries');
//        $data['total_states'] = $this->db->count_all_results('states');
//        $data['total_cities'] = $this->db->count_all_results('cities');
        $this->load->view('portal/layout', $data);
    }

    public function error404() {
        $this->load->view('404');
    }

    public function all_user_permissions() {
        $data['page_title'] = "User Permissions";
        $data['user_permissions'] = $this->portal_model->get_all_user_permissions();
        $data['main_view'] = "portal/user_permissions";
        $this->load->view('portal/layout', $data);
    }

    public function add_user_permission_save() {
        $this->form_validation->set_rules('user_permission_name', 'User Permission Name', 'trim|required');
        $this->form_validation->set_rules('user_permission_route', 'Route', 'trim|required');
        $this->form_validation->set_rules('user_permission_url', 'URL', 'trim|required');
        $this->form_validation->set_rules('user_permission_type', 'Type', 'trim|required');
        if (!$this->form_validation->run()) {
            $this->session->set_flashdata('errorr_message', 'Something went wrong. Please try again!');
            redirect('user-permissions');
        } else {
            if ($this->portal_model->add_user_permission_save()) {
                $this->session->set_flashdata('success_message', 'User Permission added successfully.');
                redirect('user-permissions');
            } else {
                $this->session->set_flashdata('errorr_message', 'Something went wrong. Please try again!');
                redirect('user-permissions');
            }
        }
    }

    public function edit_user_permission_save() {
        $this->form_validation->set_rules('user_permission_name', 'User Permission Name', 'trim|required');
        $this->form_validation->set_rules('user_permission_route', 'Route', 'trim|required');
        $this->form_validation->set_rules('user_permission_url', 'URL', 'trim|required');
        $this->form_validation->set_rules('user_permission_type', 'Type', 'trim|required');
        if (!$this->form_validation->run()) {
            $this->session->set_flashdata('errorr_message', 'Something went wrong. Please try again!');
            redirect('user-permissions');
        } else {
            if ($this->portal_model->edit_user_permission_save()) {
                $this->session->set_flashdata('success_message', 'User Permission updated successfully.');
                redirect('user-permissions');
            } else {
                $this->session->set_flashdata('errorr_message', 'Something went wrong. Please try again!');
                redirect('user-permissions');
            }
        }
    }

    public function delete_user_permission() {
        $this->db->where('user_permission_id', $this->input->post('user_permission_id'))->delete('user_permissions');
    }

    public function all_user_roles() {
        $data['page_title'] = "User Roles";
        $data['user_roles'] = $this->portal_model->get_all_user_roles();
        $data['main_view'] = "portal/user_roles";
        $this->load->view('portal/layout', $data);
    }

    public function add_user_role_save() {
        $this->form_validation->set_rules('user_role_name', 'User Role Name', 'trim|required');
        if (!$this->form_validation->run()) {
            $this->session->set_flashdata('errorr_message', 'Something went wrong. Please try again!');
            redirect('user-roles');
        } else {
            if ($this->portal_model->add_user_role_save()) {
                $this->session->set_flashdata('success_message', 'User Role added successfully.');
                redirect('user-roles');
            } else {
                $this->session->set_flashdata('errorr_message', 'Something went wrong. Please try again!');
                redirect('user-roles');
            }
        }
    }

    public function edit_user_role_save() {
        $this->form_validation->set_rules('user_role_name', 'User Role Name', 'trim|required');
        if (!$this->form_validation->run()) {
            $this->session->set_flashdata('errorr_message', 'Something went wrong. Please try again!');
            redirect('user-roles');
        } else {
            if ($this->portal_model->edit_user_role_save()) {
                $this->session->set_flashdata('success_message', 'User Role updated successfully.');
                redirect('user-roles');
            } else {
                $this->session->set_flashdata('errorr_message', 'Something went wrong. Please try again!');
                redirect('user-roles');
            }
        }
    }

    public function delete_user_role() {
        $this->db->where('user_role_id', $this->input->post('user_role_id'))->delete('user_roles');
    }

    public function all_user_roles_permissions($user_role_id) {
        if ($role_name = $this->portal_model->get_user_role_name_by_id($user_role_id)) {
            $data['user_role_name'] = $role_name;
        } else {
            redirect('user-roles');
        }
        $data['page_title'] = "Assign User Role's Permissions";
        $data['user_permissions'] = $this->portal_model->get_all_user_permissions();
        $data['user_role_id'] = $user_role_id;
        $data['main_view'] = "portal/user_roles_permissions";
        $this->load->view('portal/layout', $data);
    }

    public function add_user_roles_permissions_save() {
        if ($this->portal_model->add_user_roles_permissions_save()) {
            $this->session->set_flashdata('success_message', 'User Role\'s Permissions assigned successfully.');
            redirect('user-roles');
        } else {
            $this->session->set_flashdata('errorr_message', 'Something went wrong. Please try again!');
            redirect('user-roles');
        }
    }

    public function users_list() {
        $data['page_title'] = "Admin Users List";
        $result = $this->portal_model->get_all_users();
        $data['users'] = $this->paginator->paginate($result, ['base_url' => 'portal/users']);
        $data['user_roles'] = $this->db->order_by('created_at', 'ASC')->get('user_roles')->result();
        $data['search'] = $this->input->get('name');
        $data['main_view'] = "portal/users";
        $this->load->view('portal/layout', $data);
    }

    public function add_user_save() {
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Email', 'trim|required|min_length[8]');
        $this->form_validation->set_rules('user_role_id', 'User Role', 'trim|required');
        if (!$this->form_validation->run()) {
            $this->session->set_flashdata('errorr_message', 'Something went wrong. Please try again!');
            $this->session->set_flashdata('add_user_error', 'Something went wrong. Please try again!');
//            redirect('users');
            $this->users_list();
        } else {
            if ($this->portal_model->add_user_save()) {
                $this->session->set_flashdata('success_message', 'User added successfully.');
                redirect('users');
            } else {
                $this->session->set_flashdata('errorr_message', 'Something went wrong. Please try again!');
                redirect('users');
            }
        }
    }
     public function edit_user_save() {
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|min_length[8]');
        $this->form_validation->set_rules('user_role_id', 'User Role', 'trim|required');
        if (!$this->form_validation->run()) {
            $this->session->set_flashdata('error_message', 'Something went wrong. Please try again!');
            $this->session->set_flashdata('add_user_error', 'Something went wrong. Please try again!');
            redirect('users');
//            $this->users_list();
        } else {
            if ($this->portal_model->edit_user_save()) {
                $this->session->set_flashdata('success_message', 'User Updated successfully.');
                redirect('users');
            } else {
                $this->session->set_flashdata('error_message', 'Something went wrong. Please try again!');
                redirect('users');
            }
        }
    }
    public function branches_list() {
        $data['page_title'] = "Branches";
        $result = $this->portal_model->get_all_branches();
        $data['branches'] = $this->paginator->paginate($result, ['base_url' => 'portal/branches']);
        $data['search'] = $this->input->get('name');
        $data['main_view'] = "portal/branches";
        $this->load->view('portal/layout', $data);
    }

    public function add_branch_save() {
        $this->form_validation->set_rules('branch_name', 'Branch Name', 'trim|required');
        $this->form_validation->set_rules('branch_address', 'Branch Address', 'trim|required');
        $this->form_validation->set_rules('branch_contact', 'Branch Contact', 'trim|required');
        if (!$this->form_validation->run()) {
            $this->session->set_flashdata('errorr_message', 'Something went wrong. Please try again!');
            redirect('branches');
        } else {
            if ($this->portal_model->add_branch_save()) {
                $this->session->set_flashdata('success_message', 'Branch added successfully.');
                redirect('branches');
            } else {
                $this->session->set_flashdata('errorr_message', 'Something went wrong. Please try again!');
                redirect('branches');
            }
        }
    }

    public function edit_branch_save() {
        $this->form_validation->set_rules('branch_name', 'Branch Name', 'trim|required');
        $this->form_validation->set_rules('branch_address', 'Branch Address', 'trim|required');
        $this->form_validation->set_rules('branch_contact', 'Branch Contact', 'trim|required');
        if (!$this->form_validation->run()) {
            $this->session->set_flashdata('errorr_message', 'Something went wrong. Please try again!');
            redirect('branches');
        } else {
            if ($this->portal_model->edit_branch_save()) {
                $this->session->set_flashdata('success_message', 'Branch updated successfully.');
                redirect('branches');
            } else {
                $this->session->set_flashdata('errorr_message', 'Something went wrong. Please try again!');
                redirect('branches');
            }
        }
    }

    public function delete_branch() {
        $this->db->where('branch_id', $this->input->post('branch_id'))->delete('branches');
    }

    public function products_list() {
        $data['page_title'] = "Products List";
        $result = $this->portal_model->get_all_products();
        $data['products'] = $this->paginator->paginate($result, ['base_url' => 'portal/products']);
        $data['search'] = $this->input->get('name');
        $data['main_view'] = "portal/products";
        $this->load->view('portal/layout', $data);
    }

    public function add_product_save() {
        $this->form_validation->set_rules('name', 'Country Name', 'trim|required');
        $this->form_validation->set_rules('phonecode', 'Phone Code', 'trim|required');
        if (!$this->form_validation->run()) {
            $this->session->set_flashdata('errorr_message', 'Something went wrong. Please try again!');
            redirect('products');
        } else {
            if ($this->portal_model->add_product_save()) {
                $this->session->set_flashdata('success_message', 'Country added successfully.');
                redirect('products');
            } else {
                $this->session->set_flashdata('errorr_message', 'Something went wrong. Please try again!');
                redirect('products');
            }
        }
    }

    public function edit_product_save() {
        $this->form_validation->set_rules('name', 'Country Name', 'trim|required');
        $this->form_validation->set_rules('phonecode', 'Phone Code', 'trim|required');
        if (!$this->form_validation->run()) {
            $this->session->set_flashdata('errorr_message', 'Something went wrong. Please try again!');
            redirect('products');
        } else {
            if ($this->portal_model->edit_product_save()) {
                $this->session->set_flashdata('success_message', 'Country updated successfully.');
                redirect('products');
            } else {
                $this->session->set_flashdata('errorr_message', 'Something went wrong. Please try again!');
                redirect('products');
            }
        }
    }

    public function delete_product() {
        $this->db->where('product_id', $this->input->post('product_id'))->delete('products');
    }

}
