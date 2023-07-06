<?php

namespace App\Controllers;

use App\Models\UjianModel;

class Ujian extends BaseController
{
    protected $ujian;
    public function __construct()
    {
        $this->ujian = new UjianModel();
    }

    public function index()
    {
        if (session('level') == '1') {
            $data = array(
                'menu' => 'manajemen ujian',
                'submenu' => 'ujian',
                'judul' => 'Data Jenis Tes',
                'ujian' => $this->ujian->findAll()
            );
        } else {
            $data = array(
                'menu' => 'manajemen ujian',
                'submenu' => 'ujian',
                'judul' => 'Data Jenis Tes',
                'ujian' => $this->ujian->findAll()
            );
        }
        return view('admin/ujian_tampil', $data);
    }

    public function post()
    {
        if ($_POST['idtes'] == '') {
            $post = array(
                'idujian' => $this->request->getVar('idtes'),
                'akujian' => $this->request->getVar('aktes'),
                'nmujian' => $this->request->getVar('nmtes'),
                'status' => '0'
            );
            if ($this->ujian->insert($post, false)) {
                session()->setFlashdata('sukses', 'Data Ujian Berhasil Disimpan!');
            } else {
                session()->setFlashdata('gagal', 'Data Ujian Gagal Disimpan!');
            }
        } else {
            $id = $this->request->getVar('idtes');
            $post = array(
                'akujian' => $this->request->getVar('aktes'),
                'nmujian' => $this->request->getVar('nmtes'),
                'status' => '0'
            );
            if ($this->ujian->update($id, $post)) {
                session()->setFlashdata('info', 'Data Ujian Berhasil Diupdate!');
            } else {
                session()->setFlashdata('gagal', 'Data Ujian Gagal Diupdate!');
            }
        }
        return redirect()->to(base_url('ujian'));
    }

    public function aktif()
    {
        $thn = $this->ujian->getTahun();
        $id = $this->request->getVar('id');
        $post = array(
            'idthpel' => $thn['idthpel'],
            'aktif' => $this->request->getVar('isi') == '1' ? '0' : '1'
        );
        $this->ujian
            ->where('idujian <>', $id)
            ->where('aktif', '1')
            ->set('aktif', '0')->update();
        if ($this->ujian->update($id, $post)) {
            echo $post['aktif'];
        }
    }

    public function edit()
    {
        $id = $this->request->getVar('id');
        echo json_encode($this->ujian->find($id));
    }

    public function hapus()
    {
        $id = $this->request->getVar('id');
        if ($this->ujian->where('idujian', $id)->delete()) {
            echo 1;
        } else {
            echo 0;
        }
    }
}
