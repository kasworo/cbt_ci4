<?php

namespace App\Controllers;

use App\Models\KkmModel;

class Kkm extends BaseController
{
    protected $kkm;
    public function __construct()
    {
        $this->kkm = new KkmModel();
    }
    public function index()
    {
        $data = array(
            'menu' => 'manajemen kbm',
            'submenu' => 'kkm',
            'judul' => 'Data Kriteria Ketuntasan Minimal',
            'kelas' => $this->kkm->getKelas('8'),
            'mapel' => $this->kkm->getMapel('8')
        );
        return view('admin/kkm_tampil', $data);
    }
}
