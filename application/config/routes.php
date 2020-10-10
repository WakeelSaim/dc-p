<?php

defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'home';
$route['404_override'] = 'portal/error404';
$route['translate_uri_dashes'] = FALSE;



/////////////////////////   Admin Panel  ////////////////////////////
/////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////


$route['portal'] = "portal";
$route['signin']['POST'] = "portal/signin";
$route['logout']['GET'] = "portal/logout";
$route['account']['GET'] = "portal/account";
$route['account']['POST'] = "portal/account_save";
$route['dashboard'] = "portal/dashboard";
$route['users'] = "portal/users_list";
$route['forgot-password']['GET'] = "portal/forgot_password";
$route['forgot-password']['POST'] = "portal/forgot_password_send";
$route['reset-password/(:any)']['GET'] = "portal/reset_password/$1";
$route['reset-password']['POST'] = "portal/reset_password_save";
$route['edit-user']['POST'] = "portal/edit_user_save";
$route['branches']['GET'] = "portal/branches_list";
$route['add-branch']['POST'] = "portal/add_branch_save";
$route['edit-branch']['POST'] = "portal/edit_branch_save";

$route['products']['GET'] = "portal/products_list";

$route['countries']['GET'] = "portal/countries_list";
$route['add-country']['POST'] = "portal/add_country_save";
$route['edit-country']['POST'] = "portal/edit_country_save";
$route['delete-country']['POST'] = "portal/delete_country";


/////////////////////////   User Roles & Permissions  ////////////////////////////
/////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////


$route['user-permissions']['GET'] = "portal/all_user_permissions";
$route['add-user-permission']['POST'] = "portal/add_user_permission_save";
$route['edit-user-permission']['POST'] = "portal/edit_user_permission_save";
$route['delete-user-permission']['POST'] = "portal/delete_user_permission";
$route['user-roles']['GET'] = "portal/all_user_roles";
$route['add-user-role']['POST'] = "portal/add_user_role_save";
$route['edit-user-role']['POST'] = "portal/edit_user_role_save";
$route['delete-user-role']['POST'] = "portal/delete_user_role";
$route['user-roles-permissions/(:any)']['GET'] = "portal/all_user_roles_permissions/$1";
$route['add-user-roles-permissions']['POST'] = "portal/add_user_roles_permissions_save";


//////////////////////// Client Side ////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////


$route['user_registration'] = "Home/user_registration";
$route['user_registration1']['POST'] = "Home/registration1";
$route['user_registration2']['POST'] = "Home/registration2";
$route['verify/(:any)'] = "Home/verify/$1";
$route['login'] = "Home/login";
$route['dashboard'] = "Home/user_login"; 
$route['home'] = "Home/dashboard"; 
$route['edit_profile'] = "Home/edit_profile";
$route['index'] = "Home/index";
$route['logout'] = "Home/logout";
$route['edited'] = "Home/edited";
$route['edit_bio'] = "Home/bio_edit_data";
$route['delExp/(:any)'] = "Home/del_exp/$1";
$route['delEdu/(:any)'] = "Home/del_edu/$1";
$route['delAwrd/(:any)'] = "Home/del_awrd/$1";
$route['delSp/(:any)'] = "Home/del_sp/$1";
$route['delTime/(:any)'] = "Home/del_time/$1";
$route['editExp/(:any)'] = "Home/edit_exp/$1";
$route['editEdu/(:any)'] = "Home/edit_edu/$1";
$route['editAwrd/(:any)'] = "Home/edit_awrd/$1";
$route['editSp/(:any)'] = "Home/edit_sp/$1";
$route['editTime/(:any)'] = "Home/edit_time/$1";
$route['addTime'] = "Home/insert_time";
$route['addExp'] = "Home/insert_exp";
$route['addEdu'] = "Home/insert_edu";
$route['addSp'] = "Home/insert_sp";
$route['addAwrd'] = "Home/insert_awrd";
$route['updAwrd'] = "Home/upd_awrd";
$route['updExp'] = "Home/upd_exp";
$route['updEdu'] = "Home/upd_edu";
$route['updSp'] = "Home/upd_sp";
$route['updTime'] = "Home/upd_time";
$route['search'] = "Home/searchbar";
$route['add-editExp'] = "Home/move_exp";
$route['add-editEdu'] = "Home/move_edu";
$route['add-editAward'] = "Home/move_award";
$route['add-editSp'] = "Home/move_sp";
$route['add-editTime'] = "Home/move_time";
$route['profile/(:any)'] = "Home/single_profile/$1";