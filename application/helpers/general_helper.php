<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

function dd($content = '') {
    echo '<pre>';
    print_r($content);
    die();
}

function UUID() {
    $data = random_bytes(16);
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80);
    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}

function admin_profile_image() {
    $CI = get_instance();
    $image_path = base_url('assets') . '/images/admin/' . str_replace(' ', '_', $CI->session->userdata('admin_profile_image'));
    if (getimagesize($image_path)) {
        return $image_path;
    } else {
        $image_path = base_url('assets') . '/images/admin/no-image.png';
        return $image_path;
    }
}

function get_admin_profile_image_by_id($user_id) {
    $CI = get_instance();
    $CI->load->model('portal_model');
    $image_path = base_url('assets') . '/images/admin/' . str_replace(' ', '_', $CI->portal_model->get_admin_profile_image_by_id($user_id));
    if (getimagesize($image_path)) {
        return $image_path;
    } else {
        $image_path = base_url('assets') . '/images/admin/no-image.png';
        return $image_path;
    }
}

function get_admin_name_by_id($user_id) {
    $CI = get_instance();
    $CI->load->model('portal_model');
    return $CI->portal_model->get_admin_name_by_id($user_id);
}

function check_user_role_permissions($user_permission_id, $user_role_id) {
    $CI = get_instance();
    $CI->load->model('portal_model');
    return $CI->portal_model->check_user_role_permissions($user_permission_id, $user_role_id);
}

function use_role_permission_checkbox($user_permission_id, $user_role_id) {
    if (check_user_role_permissions($user_permission_id, $user_role_id)) {
        return 'checked';
    }
}

function get_state_name_by_id($state_id) {
    $CI = get_instance();
    $CI->load->model('portal_model');
    return $CI->portal_model->get_state_name_by_id($state_id);
}

function get_city_name_by_id($city_id) {
    $CI = get_instance();
    $CI->load->model('portal_model');
    return $CI->portal_model->get_city_name_by_id($city_id);
}

function check_route($url, $type) {
    $CI = get_instance();
    $CI->load->model('portal_model');
    return $CI->portal_model->get_users_route_access($url, $type);
}

function get_user_role_name() {
    $CI = get_instance();
    $CI->load->model('portal_model');
    return $CI->portal_model->get_user_role_name();
}
