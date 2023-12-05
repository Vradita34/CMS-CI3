<?php
defined('BASEPATH') or exit('No direct Script access allowed :D');

class KomentarModel extends CI_Model
{


    public function add_comment($data)
    {
        $this->db->insert('comments', $data);
        return $this->db->insert_id();
    }

    public function get_comments($id_konten)
    {
        $this->db->select('comments.*, user.nama, user.username, user.foto_profil');
        $this->db->from('comments');
        $this->db->join('user', 'comments.id_user = user.id_user', 'left');
        $this->db->where('comments.id_konten', $id_konten);
        $this->db->order_by('comments.tanggal_komentar', 'ASC');
        return $this->db->get()->result_array();
    }
    public function get_latest_comments_with_content($limit = 5)
    {
        $this->db->select('comments.*, user.nama, user.username, user.foto_profil, konten.judul as konten_judul, konten.slug as konten_slug');
        $this->db->from('comments');
        $this->db->join('user', 'comments.id_user = user.id_user', 'left');
        $this->db->join('konten', 'comments.id_konten = konten.id_konten', 'left');
        $this->db->order_by('comments.tanggal_komentar', 'ASC');
        // Limit the number of results
        $this->db->limit($limit);
        // Execute the query and return the result array
        return $this->db->get()->result_array();
    }


    public function getSlugByIdKonten($id_konten)
    {
        // Assuming you have a table named 'konten' with a column 'slug'
        $this->db->select('slug');
        $this->db->from('konten');
        $this->db->where('id_konten', $id_konten);


        $query = $this->db->get();

        // Check if there is a result
        if ($query->num_rows() > 0) {
            $result = $query->row();
            return $result->slug;
        }

        // Return null if no result
        return null;
    }

    // public function editComment($commentId, $newComment)
    //     {
    //
    //         $this->db->where('id_comment', $commentId);
    //         $this->db->update('comments', ['isi_komentar' => $newComment]);
    //
    //         return $this->db->affected_rows() > 0;
    //     }
        public function editComment($commentId, $newComment)
        {
            $data = array(
                'isi_komentar' => $newComment,
                'status' => 'diedit',
            );
            $this->db->where('id_comment', $commentId);
            return $this->db->update('comments', $data);
        }

        public function deleteComment($commentId)
        {
            // Assume you have a table named 'comments' with a column 'id_comment'
            $this->db->where('id_comment', $commentId);
            $this->db->delete('comments');

            return $this->db->affected_rows() > 0;
        }

        public function getCommentById($commentId)
        {
            // Assume you have a table named 'comments' with columns 'id_comment', 'id_konten', etc.
            return $this->db->get_where('comments', ['id_comment' => $commentId])->row_array();
        }

        public function getCommentsByKontenId($id_konten)
        {
            return $this->db->get_where('comments', array('id_konten' => $id_konten))->result_array();
        }
        public function get_comments_all()
        {
            $this->db->select('comments.*, user.nama, user.username, user.foto_profil, konten.judul');
            $this->db->from('comments');
            $this->db->join('user', 'comments.id_user = user.id_user', 'left');
            $this->db->join('konten', 'comments.id_konten = konten.id_konten', 'left');
            $this->db->order_by('comments.tanggal_komentar', 'ASC');
            return $this->db->get()->result_array();
        }
}
