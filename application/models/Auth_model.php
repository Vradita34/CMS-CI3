<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Auth_model extends CI_Model
{
  public function simpan($username, $hashed_password, $email,  $foto_profil)
  {
      $data = array(
          'nama' => $this->input->post('nama'),
          'username' => $username,
          'email' => $email,
          'password' => $hashed_password, // Menggunakan kata sandi yang sudah di-hash
          'level' => $this->input->post('level'),
          'foto_profil' =>  $foto_profil
      );
      $this->db->insert('user', $data);
  }


  public function update_user($id, $nama, $hashed_password = null, $foto_profil = null)
     {
         $data = array(
             'nama' => $nama,
         );

         if ($hashed_password !== null) {
             $data['password'] = $hashed_password;
         }

         if ($foto_profil !== null) {
             $data['foto_profil'] = $foto_profil;
         }

         $this->db->where('id_user', $id);
         $this->db->update('user', $data);
     }


    public function changeUserPassword($id,$new_password){
      $this->db->set('password',$new_password)->where('id',$id)->update('user');

    }


}
