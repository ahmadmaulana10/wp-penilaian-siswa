<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Nilai extends CI_Controller
{
    public function index()
    {
        $data = $this->ModelNilai->getData()->result_array();
        var_dump($data);
        // foreach ($data as $d => $value) {
        //     echo $d . " -> " . $value['nisn'] . "<br>";
        // }
    }
}
