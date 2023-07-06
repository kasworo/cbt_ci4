<?php

namespace App\Controllers;

use App\Models\GtkModel;
use App\Models\SekolahModel;

class Gtk extends BaseController
{
    protected $gtk;
    protected $skul;

    public function __construct()
    {
        $this->gtk = new GtkModel();
        $this->skul = new SekolahModel();
    }

    public function index()
    {
        $data = [
            'menu' => 'data master',
            'submenu' => 'guru dan staff',
            'judul' => 'Data Guru dan Tenaga Kependidikan',
            'gtk' => session('level') == 1 ? $this->gtk->getData() : $this->gtk->getData(session('user'))
        ];

        return view('admin/gtk_tampil', $data);
    }

    public function baru()
    {
        $data = [
            'menu' => 'data master',
            'submenu' => 'guru dan staff',
            'judul' => 'Tambah Data Guru dan Tenaga Kependidikan',
            'skul' => session('level') == 1 ? $this->skul->getSkul() : $this->skul->getSkul(session('user')),
            'gtk' => [
                'idskul' => null,
                'idgtk' => null,
                'nama' => null,
                'nik' => null,
                'nip' => null,
                'tmplahir' => null,
                'tgllahir' => null,
                'gender' => null,
                'agama' => null,
                'kepeg' => null,
                'jbtdinas' => null,
                'alamat' => null,
                'kdpos' => null,
                'nohp' => null,
                'email' => null,
                'foto' => null,
                'ttd' => null
            ],
            'tombol' => 'Simpan'
        ];

        return view('admin/gtk_form', $data);
    }

    public function edit($id)
    {
        $data = [
            'menu' => 'data master',
            'submenu' => 'guru dan staff',
            'judul' => 'Update Data Guru dan Tenaga Kependidikan',
            'skul' => session('level') == 1 ? $this->skul->getSkul() : $this->skul->getSkul(session('user')),
            'gtk' => $this->gtk->getDataById($id),
            'tombol' => 'Update'
        ];
        return view('admin/gtk_form', $data);
    }

    public function post()
    {
        $post = [
            'idskul' => $this->request->getVar('idskul'),
            'nama' => $this->request->getVar('nmgtk'),
            'nik' => $this->request->getVar('nik'),
            'nip' => $this->request->getVar('nip'),
            'tmplahir' => $this->request->getVar('tmplahir'),
            'tgllahir' => $this->request->getVar('tgllahir'),
            'gender' => $this->request->getVar('gender'),
            'agama' => $this->request->getVar('agama'),
            'kepeg' => $this->request->getVar('stsp'),
            'jbtdinas' => $this->request->getVar('jbtd'),
            'alamat' => $this->request->getVar('almt'),
            'kdpos' => $this->request->getVar('kdpos'),
            'nohp' => $this->request->getVar('nohp'),
            'email' => $this->request->getVar('imel')
        ];

        if (empty($this->request->getVar('idgtk'))) {
            $this->gtk->insert($post, false);
        } else {
            $id = $this->request->getVar('idgtk');
            $this->gtk->update($id, $post);
        }

        return redirect()->to('/gtk');
    }
}
