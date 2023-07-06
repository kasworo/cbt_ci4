<?php

namespace App\Controllers;

use App\Models\SiswaModel;
use App\Models\SekolahModel;

class Siswa extends BaseController
{
    protected $siswa;
    protected $sekolah;

    public function __construct()
    {
        $this->siswa = new SiswaModel();
        $this->sekolah = new SekolahModel();
    }

    public function index()
    {
        $data = [
            'menu' => 'data master',
            'submenu' => 'peserta didik',
            'judul' => 'Data Peserta Didik',
            'siswa' => $this->siswa->getData(session('level') == '1' ? '' : session('user'))
        ];

        return view('admin/siswa_tampil', $data);
    }

    public function baru()
    {
        $data = [
            'menu' => 'data master',
            'submenu' => 'data siswa',
            'judul' => 'Tambah Data Peserta Didik',
            'skul' => $this->sekolah->getSkul(session('level') == '1' ? '' : session('user')),
            'siswa' => [
                'idsiswa' => NULL,
                'idskul' => session('level') == '1' ? NULL : session('user'),
                'nmsiswa' => NULL,
                'nis' => NULL,
                'nisn' => NULL,
                'tmplahir' => NULL,
                'tgllahir' => NULL,
                'gender' => NULL,
                'agama' => NULL,
                'alamat' => NULL
            ],
            'tombol' => 'Simpan'
        ];
        return view('admin/siswa_form', $data);
    }

    public function edit($id)
    {
        $data = [
            'menu' => 'data master',
            'submenu' => 'data siswa',
            'judul' => 'Update Data Peserta Didik',
            'skul' => $this->sekolah->getSkul(session('level') == '1' ? '' : session('user')),
            'siswa' => $this->siswa->getDataByID($id),
            'tombol' => 'Update'
        ];
        return view('admin/siswa_form', $data);
    }

    public function post()
    {
        if (empty($this->request->getVar('idsiswa'))) {
            $post = [
                'idskul' => $this->request->getVar('aslskul'),
                'nmsiswa' => $this->request->getVar('nmsiswa'),
                'nis' => $this->request->getVar('nis'),
                'nisn' => $this->request->getVar('nisn'),
                'tmplahir' => $this->request->getVar('tmplahir'),
                'tgllahir' => $this->request->getVar('tgllahir'),
                'gender' => $this->request->getVar('gender'),
                'agama' => $this->request->getVar('agama'),
                'alamat' => $this->request->getVar('almt'),
            ];
            if ($this->siswa->insert($post, false)) {
                session()->setFlashdata('sukses', 'Data Peserta Didik Berhasil Disimpan!');
            } else {
                session()->setFlashdata('gagal', 'Data Peserta Didik Gagal Disimpan!');
            }
        } else {
            $id = $this->request->getVar('idsiswa');
            $post = array(
                'idskul' => $this->request->getVar('aslskul'),
                'nmsiswa' => $this->request->getVar('nmsiswa'),
                'nis' => $this->request->getVar('nis'),
                'nisn' => $this->request->getVar('nisn'),
                'tmplahir' => $this->request->getVar('tmplahir'),
                'tgllahir' => $this->request->getVar('tgllahir'),
                'gender' => $this->request->getVar('gender'),
                'agama' => $this->request->getVar('agama'),
                'alamat' => $this->request->getVar('almt'),
            );
            if ($this->siswa->update($id, $post)) {
                session()->setFlashdata('info', 'Data Peserta Didik Berhasil Diupdate!');
            } else {
                session()->setFlashdata('sukses', 'Data Peserta Didik Gagal Diupdate!');
            }
        }
        return redirect()->to(base_url('siswa'));
    }
}
