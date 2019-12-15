<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ModelGuru extends CI_Model
{
    public function getGuruById($nip)
    {
        return $this->db->get_where('guru', ['nip' => $nip])->row_array();
    }

    public function totalRows()
    {
        return $this->db->get('guru')->num_rows();
    }

    public function getUsers($limit, $start)
    {
        return $this->db->get('guru', $limit, $start)->result_array();
    }

    public function ubahGuru()
    {
        $data = [
            'nama_guru' => $this->input->post('nama_guru', true),
            'tempat_lahir' => $this->input->post('tempat_lahir', true),
            'tgl_lahir' => $this->input->post('tgl_lahir', true),
            'jk' => $this->input->post('jk', true),

        ];

        $this->db->where('nip', $this->input->post('nip'));
        $this->db->update('guru', $data);
    }

    public function updateGuru($data = 'guru', $where = null)
    {
        $this->db->update('guru', $data, $where);
    }

    public function simpanGuru($data = null)
    {
        $this->db->insert('guru', $data);
    }

    public function hapusGuru($nip)
    {
        $this->db->where('nip', $nip);
        $this->db->delete('guru');
    }
}
