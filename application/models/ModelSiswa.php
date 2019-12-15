<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ModelSiswa extends CI_Model
{
    public function getSiswaById($nisn)
    {
        return $this->db->get_where('siswa', ['nisn' => $nisn])->row_array();
    }

    public function totalRows()
    {
        return $this->db->get('siswa')->num_rows();
    }

    public function getUsers($limit, $start)
    {
        return $this->db->get('siswa', $limit, $start)->result_array();
    }

    public function getUserWhere($where = null)
    {
        return $this->db->get_where('siswa', $where);
    }

    public function ubahSiswa()
    {
        $data = [
            'nama_siswa' => $this->input->post('nama_siswa', true),
            'tempat_lahir' => $this->input->post('tempat_lahir', true),
            'tgl_lahir' => $this->input->post('tgl_lahir', true),
            'agama' => $this->input->post('agama', true),
            'alamat' => $this->input->post('alamat', true),
            'kelas' => $this->input->post('kelas', true),
            'jk' => $this->input->post('jk', true),
        ];

        $this->db->where('nisn', $this->input->post('nisn'));
        $this->db->update('siswa', $data);
    }

    public function updateSiswa($data = 'siswa', $where = null)
    {
        $this->db->update('siswa', $data, $where);
    }

    public function simpanData($data = null)
    {
        $this->db->insert('siswa', $data);
    }

    public function hapusSiswa($nisn)
    {
        $this->db->where('nisn', $nisn);
        $this->db->delete('siswa');
    }
}
