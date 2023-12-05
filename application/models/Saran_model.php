<?php
defined('BASEPATH') or exit('No direct script access allowed :D');

class Saran_model extends CI_Model
{
  public function tambahSaran($data)
	{
		$data['tanggal'] = date('Y-m-d H:i:s');
		return $this->db->insert('saran', $data);
	}

  public function getSaran() {
    $this->db->select('saran.*, balasan.balasan, balasan.created_at as balasan_created_at, balasan.username as balasan_username, user_pengirim.foto_profil as foto_pengirim, user_balasan.foto_profil as foto_balasan');
    $this->db->from('saran');
    $this->db->join('balasan', 'saran.id_saran = balasan.id_saran', 'left');
    $this->db->join('user as user_pengirim', 'saran.username = user_pengirim.username', 'left');
    $this->db->join('user as user_balasan', 'balasan.username = user_balasan.username', 'left');
    $this->db->order_by('saran.tanggal', 'DESC');
    return $this->db->get()->result_array();
  }


    public function getSaranByUser(){
      $username = $this->session->userdata('username');

       $this->db->select('saran.*, balasan.balasan, balasan.created_at as balasan_created_at, balasan.username as balasan_username, user_pengirim.foto_profil as foto_pengirim, user_balasan.foto_profil as foto_balasan');
       $this->db->from('saran');
       $this->db->join('balasan', 'saran.id_saran = balasan.id_saran', 'left');
       $this->db->join('user as user_pengirim', 'saran.username = user_pengirim.username', 'left');
       $this->db->join('user as user_balasan', 'balasan.username = user_balasan.username', 'left');
       $this->db->where('saran.username', $username); 
       $this->db->order_by('saran.tanggal', 'DESC');
        return $this->db->get()->result_array();
    }


    public function deleteAllSaran()
    {
        $this->db->empty_table('saran');
    }

    public function deleteSaran($id_saran)
    {
        $this->db->where('id_saran', $id_saran);
        $result = $this->db->delete('saran');

        return $result;
    }

    public function tambahBalasanSaran($saran_id, $balasan)
    {
      $data = array(
  			'id_saran' => $saran_id,
        'id_user' => $this->session->userdata('id_user'),
  			'balasan' => $balasan,
  			'created_at' => date('Y-m-d H:i:s'),
  			'username' => $this->session->userdata('username'),
  		);

        return $this->db->insert('balasan', $data);
    }

    public function getBalasanSaran($id_saran)
    {
        $this->db->from('balasan');
        $this->db->where('id_saran', $id_saran);
        return $this->db->get()->result_array();
    }

    public function update_balasan($id_saran, $balasan)
    {
        $data = array(
            'balasan' => $balasan,
            'created_at' => date('Y-m-d H:i:s'),
        );

        $this->db->where('id_saran', $id_saran);
        $this->db->update('balasan', $data);

        return $this->db->affected_rows();
    }
}
