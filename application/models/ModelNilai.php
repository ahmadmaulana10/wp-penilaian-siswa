<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ModelNilai extends CI_Model
{

    public function getData()
    {
        $query = "SELECT * FROM `siswa` 
                    JOIN        `kelas_siswa` 
                    ON          `siswa`.`nisn` = `kelas_siswa`.`nisn`
                    JOIN        `kelas`
                    ON          `kelas_siswa`.`id_kelas` = `kelas`.`id_kelas`
                    ORDER BY    `kelas`.`nama_kelas` 
                    ASC";

        $query2 = "SELECT * FROM `siswa`
                    JOIN `nilai`
                    ON `siswa`.`nisn` = `nilai`.`nisn`
                    JOIN `detail_nilai`  
                    ON `nilai`.`id_nilai` = `detail_nilai`.`id_nilai`
                    ORDER BY `siswa`.`nisn`
                    ASC";

        return $this->db->query($query2);
    }
}
