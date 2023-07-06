<?php

namespace App\Controllers;

use App\Models\KurikulumModel;

class Kurikulum extends BaseController
{
    protected $kurikulum;

    public function __construct()
    {
        $this->kurikulum = new KurikulumModel();
    }

    public function index()
    {
        $data = [
            'menu' => 'manajemen kbm',
            'submenu' => 'kurikulum',
            'judul' => 'Data Kurikulum',
            'jenjang' => $this->kurikulum->getJenjang(),
            'kurikulum' => session('level') == '1' ? $this->kurikulum->getData() : $this->kurikulum->getData(session('user')),
        ];

        return view('admin/kurikulum_tampil', $data);
    }

    public function edit()
    {
        $id = $this->request->getVar('id');
        echo json_encode($this->kurikulum->find($id));
    }
}
