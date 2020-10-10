<?php

class Portal_model extends CI_model {

    public function add_log($type, $id, $token) {
        $this->logger
                ->user($this->session->userdata('user_id'))
                ->type($type)
                ->id($id)
                ->token($token)
                ->comment($this->session->userdata('name') . ' ' . $token . ' ' . $type)
                ->log();
    }

    public function login_user($email, $password) {
        $this->db->where('email', $email);
        $result = $this->db->get('admin');
        if ($result->num_rows()) {
            $db_password = $result->row(1)->password;

            if (password_verify($password, $db_password)) {
                return $result->row(1);
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function match_current_password($current_password) {
        $this->db->where('id', $this->session->userdata('user_id'));
        $result = $this->db->get('admin');
        if ($result->num_rows()) {
            $db_password = $result->row(1)->password;

            if (password_verify($current_password, $db_password)) {
                return True;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function user_forgot_password($email) {
        $this->db->where('email', $email);
        $result = $this->db->get('admin');
        if ($result->num_rows()) {
            $secret_code = random_string('sha1');
            $data = array(
                'secret_code' => $secret_code
            );
            $this->db->where('email', $email);
            $this->db->update('admin', $data);

            return $secret_code;
        } else {
            return FALSE;
        }
    }

    public function user_check_secret_code($secret) {
        $this->db->where('secret_code', $secret);
        $result = $this->db->get('admin');
        if ($result->num_rows()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function user_reset_password($secret) {
        $options = ['cost' => 10];
        $encrypted_pass = password_hash($this->input->post('password'), PASSWORD_BCRYPT, $options);
        $data = array(
            'password' => $encrypted_pass,
            'secret_code' => NULL
        );
        $this->db->where('secret_code', $secret);
        $this->db->update('admin', $data);
        return $this->db->affected_rows();
    }

    public function user_account_update($is_password = FALSE) {
        $data = array(
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
        );
        $this->session->set_userdata('name', $this->input->post('first_name') . ' ' . $this->input->post('last_name'));
        if ($is_password) {
            $options = ['cost' => 10];
            $encrypted_pass = password_hash($this->input->post('new_password'), PASSWORD_BCRYPT, $options);
            $data['password'] = $encrypted_pass;
        }
        if (isset($_FILES['profile_image']) && $_FILES['profile_image']['name'] != '') {
            $config['upload_path'] = './assets/images/admin/';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['file_name'] = time() . $_FILES['profile_image']['name'];
            $profile_image = $config['file_name'];
            $this->upload->initialize($config);
            if ($this->upload->do_upload('profile_image')) {
                $data['profile_image'] = $profile_image;
                $this->session->set_userdata('user_profile_image', $profile_image);
            }
        }
        $this->db->where('id', $this->session->userdata('user_id'));
        return $this->db->update('admin', $data);
    }

    public function get_admin_profile_image_by_id($user_id) {
        return $this->db->where('id', $user_id)->get('admin')->row()->profile_image;
    }

    public function get_admin_name_by_id($user_id) {
        $result = $this->db->where('id', $user_id)->get('admin')->row();
        if ($result)
            return $result->first_name . ' ' . $result->last_name;
        else
            return '-';
    }

    public function get_all_user_permissions() {
        $this->db->select('user_permissions.*, CONCAT(admin.`first_name`, " ", admin.`last_name`) as created_by_user');
        $this->db->from('user_permissions');
        $this->db->join('admin', 'user_permissions.created_by = admin.id', 'left');
        return $this->db->order_by('user_permissions.created_at', 'ASC')->get()->result();
    }

    public function add_user_permission_save() {
        $data = array(
            'user_permission_id' => UUID(),
            'user_permission_name' => $this->input->post('user_permission_name'),
            'user_permission_route' => $this->input->post('user_permission_route'),
            'user_permission_url' => $this->input->post('user_permission_url'),
            'user_permission_type' => $this->input->post('user_permission_type'),
            'created_at' => date('Y-m-d H:i:s', time()),
            'created_by' => $this->session->userdata('user_id')
        );
        return $this->db->insert('user_permissions', $data);
    }

    public function edit_user_permission_save() {
        $data = array(
            'user_permission_name' => $this->input->post('user_permission_name'),
            'user_permission_route' => $this->input->post('user_permission_route'),
            'user_permission_url' => $this->input->post('user_permission_url'),
            'user_permission_type' => $this->input->post('user_permission_type')
        );
        return $this->db->where('user_permission_id', $this->input->post('user_permission_id'))->update('user_permissions', $data);
    }

    public function get_user_role_name_by_id($user_role_id) {
        $result = $this->db->where('user_role_id', $user_role_id)->get('user_roles')->row();
        if ($result) {
            return $result->user_role_name;
        } else {
            return FALSE;
        }
    }

    public function check_user_role_permissions($user_permission_id, $user_role_id) {
        return $this->db->where('user_role_id', $user_role_id)->where('user_permission_id', $user_permission_id)->get('user_roles_permissions')->row();
    }

    public function add_user_roles_permissions_save() {
        $this->db->where('user_role_id', $this->input->post('user_role_id'))->delete('user_roles_permissions');
        $data = array();
        $user_permission_id = $this->input->post('user_role_permission');
        if ($user_permission_id != NULL && $user_permission_id != '' && !empty($user_permission_id)) {
            foreach ($user_permission_id as $key => $value) {
                if ($value != "" && $value != NULL) {
                    $new = array(
                        'user_roles_permissions_id' => UUID(),
                        'user_role_id' => $this->input->post('user_role_id'),
                        'user_permission_id' => $value
                    );
                    array_push($data, $new);
                }
            }
            return $this->db->insert_batch('user_roles_permissions', $data);
        }
    }

    public function get_all_user_roles() {
        $this->db->select('user_roles.*, CONCAT(admin.`first_name`, " ", admin.`last_name`) as created_by_user');
        $this->db->from('user_roles');
        $this->db->join('admin', 'user_roles.created_by = admin.id', 'left');
        return $this->db->order_by('user_roles.created_at', 'ASC')->get()->result();
    }

    public function add_user_role_save() {
        $data = array(
            'user_role_id' => UUID(),
            'user_role_name' => $this->input->post('user_role_name'),
            'created_at' => date('Y-m-d H:i:s', time()),
            'created_by' => $this->session->userdata('user_id')
        );
        return $this->db->insert('user_roles', $data);
    }

    public function edit_user_role_save() {
        $data = array(
            'user_role_name' => $this->input->post('user_role_name')
        );
        return $this->db->where('user_role_id', $this->input->post('user_role_id'))->update('user_roles', $data);
    }

    public function get_current_user_roles_permissions() {
        $user_role_id = $this->db->where('id', $this->session->userdata('user_id'))->get('admin')->row()->user_role_id;
        $this->db->select('user_permissions.*');
        $this->db->from('user_permissions');
        $this->db->join('user_roles_permissions', 'user_permissions.user_permission_id = user_roles_permissions.user_permission_id', 'left');
        $this->db->where('user_roles_permissions.user_role_id', $user_role_id);
        return $this->db->get()->result();
    }

    public function get_all_users() {
        if ($this->input->get('name')) {
            $this->db->like('admin.name', $this->input->get('name'));
        }
        $this->db->select('admin.*, user_roles.user_role_name');
        $this->db->from('admin');
        $this->db->join('user_roles', 'admin.user_role_id = user_roles.user_role_id', 'left');
        return $this->db->order_by('admin.id', 'ASC');
    }

    public function add_user_save() {
        $options = ['cost' => 10];
        $encrypted_pass = password_hash($this->input->post('password'), PASSWORD_BCRYPT, $options);
        $data = array(
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'email' => $this->input->post('email'),
            'password' => $encrypted_pass,
            'active' => $this->input->post('active'),
            'user_role_id' => $this->input->post('user_role_id'),
            'created_at' => date('Y-m-d H:i:s', time()),
            'created_by' => $this->session->userdata('user_id')
        );
        $uuid = UUID();
        $this->db->set('id', "$uuid", TRUE);
        $result = $this->db->insert('admin', $data);
        $this->add_log('user', $uuid, 'added');
        return $result;
    }

     public function edit_user_save() {
        $options = ['cost' => 10];
        $data = array(
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'email' => $this->input->post('email'),
            'active' => $this->input->post('active'),
            'user_role_id' => $this->input->post('user_role_id'),
            'updated_at' => date('Y-m-d H:i:s', time()),
            'updated_by' => $this->session->userdata('user_id')
        );
        // if password is updats
//        if($this->input->post('password') && $this->input->post('password')!=''){
//        $encrypted_pass = password_hash($this->input->post('password'), PASSWORD_BCRYPT, $options);
//        $data+= array("password"=>$encrypted_pass);
//       }
        $result = $this->db->where('id', $this->input->post('id'))->update('admin', $data);
        return $result;
    }

    public function get_all_branches() {
        if ($this->input->get('name')) {
            $this->db->like('branches.branch_name', $this->input->get('name'));
        }
        $this->db->select('branches.*, CONCAT(admin.`first_name`, " ", admin.`last_name`) as created_by_user');
        $this->db->from('branches');
        $this->db->join('admin', 'branches.created_by = admin.id', 'left');
        return $this->db->order_by('branches.branch_name', 'ASC');
    }

    public function add_branch_save() {
        $data = array(
            'branch_name' => $this->input->post('branch_name'),
            'branch_address' => $this->input->post('branch_address'),
            'branch_contact' => $this->input->post('branch_contact'),
            'created_at' => date('Y-m-d H:i:s', time()),
            'created_by' => $this->session->userdata('user_id')
        );
        $result = $this->db->insert('branches', $data);
        return $result;
    }

    public function edit_branch_save() {
        $data = array(
            'branch_name' => $this->input->post('branch_name'),
            'branch_address' => $this->input->post('branch_address'),
            'branch_contact' => $this->input->post('branch_contact'),
            'updated_at' => date('Y-m-d H:i:s', time()),
            'updated_by' => $this->session->userdata('user_id')
        );
        $result = $this->db->where('branch_id', $this->input->post('branch_id'))->update('branches', $data);
        return $result;
    }

    public function get_all_products() {
        if ($this->input->get('name')) {
            $this->db->like('products.product_name', $this->input->get('name'));
        }
        $this->db->select('products.*, CONCAT(admin.`first_name`, " ", admin.`last_name`) as created_by_user');
        $this->db->from('products');
        $this->db->join('admin', 'products.created_by = admin.id', 'left');
        return $this->db->order_by('products.product_name', 'ASC');
    }

    public function add_product_save() {
        $data = array(
            'name' => $this->input->post('name'),
            'phonecode' => $this->input->post('phonecode'),
            'active' => $this->input->post('active'),
            'created_at' => date('Y-m-d H:i:s', time()),
            'created_by' => $this->session->userdata('user_id')
        );
        $result = $this->db->insert('products', $data);
        $this->add_log('product', $this->db->insert_id(), 'added');
        return $result;
    }

    public function edit_product_save() {
        $data = array(
            'name' => $this->input->post('name'),
            'phonecode' => $this->input->post('phonecode'),
            'active' => $this->input->post('active')
        );
        $result = $this->db->where('product_id', $this->input->post('product_id'))->update('products', $data);
        $this->add_log('product', $this->input->post('product_id'), 'updated');
        return $result;
    }

    public function get_users_route_access($url, $type) {
        $this->db->select('*')->from('admin');
        $this->db->join('user_roles_permissions', 'admin.user_role_id = user_roles_permissions.user_role_id', 'left');
        $this->db->join('user_permissions', 'user_permissions.user_permission_id = user_roles_permissions.user_permission_id', 'left');
        $this->db->where('admin.id', $this->session->userdata('user_id'));
        $this->db->where('user_permissions.user_permission_url', $url);
        return $this->db->where('user_permissions.user_permission_type', $type)->get()->row();
    }

}

?>