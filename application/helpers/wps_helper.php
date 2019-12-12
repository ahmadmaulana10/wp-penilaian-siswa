<?php
function is_login()
{
     $ci = get_instance();

     if (!$ci->session->userdata('email')) {
          redirect('auth');
     } else {
          $role_id = $ci->session->userdata('role_id');
          $menu = $ci->uri->segment(1);

          $queryMenu = $ci->db->get_where('user_menu', ['menu' => $menu])->row_array();
          $menu_id = $queryMenu['id'];

          $userAccess = $ci->db->get_where('user_aksesmenu', [
               'role_id' => $role_id,
               'menu_id' => $menu_id
          ]);

          // if ($userAccess->num_rows() < 1) {
          //      redirect('auth/blok');
          // }
     }
}

function cek_akses($role_id, $menu_id)
{
     $ci = get_instance();

     // Cara penulisan ke-1
     $result = $ci->db->get_where('user_aksesmenu', [
          'role_id' => $role_id,
          'menu_id' => $menu_id
     ]);

     if ($result->num_rows() > 0) {
          return "checked='checked'";
     }
}
