<?php

namespace App\Controllers;

use App\Models\SekolahModel;

class Sekolah extends BaseController
{
    protected $sekolah;

    public function __construct()
    {
        $this->sekolah = new SekolahModel();
    }

    public function index()
    {
        $data = [
            'menu' => 'data master',
            'submenu' => 'data sekolah',
            'judul' => 'Data Satuan Pendidikan',
            'sekolah' => session('level') == '1' ? $this->sekolah->getData() : $this->sekolah->getData(session('user')),
        ];

        if (session('level') != '1') {
            $data['tombol'] = 'Update';
        }

        if (session('level') == '1') {
            return view('admin/skul_tampil', $data);
        } else {
            return view('admin/skul_form', $data);
        }
    }

    public function baru()
    {
        $data = [
            'menu' => 'data master',
            'submenu' => 'data sekolah',
            'judul' => 'Tambah Satuan Pendidikan',
            'sekolah' => [
                'idskul' => NULL,
                'idjenjang' => NULL,
                'kdskul' => NULL,
                'nmskul' => NULL,
                'npsn' => NULL,
                'nss' => NULL,
                'nmskpd' => NULL,
                'alamat' => NULL,
                'kdpos' => NULL,
                'website' => NULL,
                'email' => NULL,
                'logoskul' => NULL,
                'logoskpd' => NULL
            ],
            'tombol' => 'Simpan'
        ];

        return view('admin/skul_form', $data);
    }

    public function edit($id)
    {
        $data = [
            'menu' => 'data master',
            'submenu' => 'data sekolah',
            'judul' => 'Update Satuan Pendidikan',
            'sekolah' => $this->sekolah->getDataById($id),
            'tombol' => 'Update'
        ];

        return view('admin/skul_form', $data);
    }

    public function post()
    {
        $id = $this->request->getVar('idskul');
        $post = [
            'idjenjang' => $this->request->getVar('idjjg'),
            'kdskul' => $this->request->getVar('kode'),
            'nmskul' => $this->request->getVar('nama'),
            'npsn' => $this->request->getVar('npsn'),
            'nss' => $this->request->getVar('nss'),
            'nmskpd' => $this->request->getVar('skpd'),
            'alamat' => $this->request->getVar('almt'),
            'email' => $this->request->getVar('imel')
        ];

        if (empty($id)) {
            if ($this->sekolah->insert($post, false)) {
                session()->setFlashdata('sukses', 'Data Satuan Pendidikan Berhasil Disimpan!');
            } else {
                session()->setFlashdata('gagal', 'Data Satuan Pendidikan Gagal Disimpan!');
            }
        } else {
            if ($this->sekolah->update($id, $post)) {
                session()->setFlashdata('info', 'Data Satuan Pendidikan Berhasil Diupdate!');
            } else {
                session()->setFlashdata('sukses', 'Data Satuan Pendidikan Gagal Diupdate!');
            }
        }

        return redirect()->to(base_url('sekolah'));
    }

    public function aktif()
    {
        $id = $this->request->getVar('id');
        $skul = $this->sekolah->getDataByID($id);
        $password = password_hash($skul['npsn'], PASSWORD_DEFAULT);
        $post = ['passwd' => $password];

        if ($this->sekolah->update($id, $post)) {
            session()->setFlashdata('sukses', 'Akun Sekolah Berhasil Diaktifkan!');
        } else {
            session()->setFlashdata('gagal', 'Akun Sekolah Gagal Diaktifkan!');
        }

        return redirect()->to(base_url('sekolah'));
    }
}
