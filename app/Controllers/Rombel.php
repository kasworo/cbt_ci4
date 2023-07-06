<?php

namespace App\Controllers;

use App\Models\SekolahModel;
use App\Models\GtkModel;
use App\Models\RombelModel;
use App\Models\KurikulumModel;

class Rombel extends BaseController
{
    protected $sekolah;
    protected $rombel;
    protected $guru;
    protected $kurikulum;

    public function __construct()
    {
        $this->sekolah = new SekolahModel();
        $this->guru = new GtkModel();
        $this->rombel = new RombelModel();
        $this->kurikulum = new KurikulumModel();
    }

    public function index()
    {
        $data = [
            'menu' => 'manajemen kbm',
            'submenu' => 'rombel',
            'judul' => 'Data Rombongan Belajar',
            'skul' => $this->sekolah->getSkul(session('user')),
            'kelas' => $this->rombel->getKelas(session('user')),
            'rombel' => $this->rombel->getData(session('user')),
            'gtk' => $this->guru->getData(session('user')),
            'kurikulum' => $this->kurikulum->getData(session('user')),
        ];

        if (session('level') == '1') {
            $data['skul'] = $this->sekolah->getSkul();
            $data['kelas'] = $this->rombel->getKelas();
            $data['rombel'] = $this->rombel->getData();
            $data['gtk'] = $this->guru->getData();
            $data['kurikulum'] = $this->kurikulum->getData();
        }

        return view('admin/rombel_tampil', $data);
    }
}
