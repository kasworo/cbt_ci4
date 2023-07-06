<?php

namespace App\Controllers;

use App\Models\JadwalModel;

class Jadwal extends BaseController
{
    protected $jadwal;
    public function __construct()
    {
        $this->jadwal = new JadwalModel();
    }
    public function index()
    {
        $data = [
            'menu' => 'manajemen ujian',
            'submenu' => 'jadwal',
            'judul' => 'Daftar Jadwal',
            'jadwal' => $this->jadwal->getData()
        ];
        return view('admin/jadwal_tampil', $data);
    }
}
