<?php

namespace App\Controllers;

use App\Models\PesertaModel;


class Peserta extends BaseController
{
    protected $peserta;
    public function __construct()
    {
        $this->peserta = new PesertaModel();
    }

    public function index()
    {
        if (session('level') == '1') {
            $data = array(
                'menu' => 'manajemen ujian',
                'submenu' => 'peserta',
                'judul' => 'Data Peserta',
                'ujian' => $this->peserta->getUjiAktif(),
                'sekolah' => $this->peserta->getSkul(),
                'kelas' => $this->peserta->getKelas(),
                'peserta' => $this->peserta->getData()
            );
        } else {
            $data = array(
                'menu' => 'manajemen ujian',
                'submenu' => 'peserta',
                'judul' => 'Data Peserta Ujian',
                'ujian' => $this->peserta->getUjiAktif(),
                'sekolah' => $this->peserta->getSkul(session('user')),
                'kelas' => $this->peserta->getKelas(session('user')),
                'peserta' => $this->peserta->getData(session('user'))
            );
        }
        return view('admin/peserta_tampil', $data);
    }

    public function generate()
    {
        $datapst = array(
            'idujian' => $this->request->getVar('idujian'),
            'idskul' => $this->request->getVar('idskul'),
            'idkelas' => $this->request->getVar('idkls'),
            'ruang' => $this->request->getVar('ruang')
        );
        $rows = $this->peserta->getNopes($datapst);
        if ($rows > 0) {
            session()->setFlashdata('sukses', 'Ada ' . $rows . ' Berhasil Diberikan Nomor Peserta');
        } else {
            session()->setFlashdata('gagal', 'Ada ' . $rows . ' Gagal Diberikan Nomor Peserta!');
        }
        return redirect()->to(base_url('peserta'));
    }
}
