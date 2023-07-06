<?php

namespace App\Controllers;

use App\Models\MapelModel;

class Mapel extends BaseController
{
    protected $mapel;
    public function __construct()
    {
        $this->mapel = new MapelModel();
    }

    public function index($id)
    {
        $data = array(
            'menu' => 'manajemen kbm',
            'submenu' => 'kurikulum',
            'judul' => "Data Mata Pelajaran",
            'kurikulum' => $id,
            'mapel' => $this->mapel->getData($id)
        );
        return view('admin/mapel_tampil', $data);
    }

    public function post()
    {
        if (empty($_POST['idmapel']) || $_POST['idmapel'] == '') {
            $post = array(
                'idkur' => $this->request->getVar('idkur'),
                'akmapel' => $this->request->getVar('akmapel'),
                'jenis' => $this->request->getVar('jmapel'),
                'nmmapel' => $this->request->getVar('nmmapel'),
                'urut' => $this->request->getVar('urmapel')
            );
            if ($this->mapel->insert($post, false)) {
                session()->setFlashdata('sukses', 'Data Mata Pelajaran Berhasil Disimpan!');
            } else {
                session()->setFlashdata('gagal', 'Data Mata Pelajaran Gagal Disimpan!');
            }
        } else {
            $id = $this->request->getVar('idmapel');
            $post = array(
                'idkur' => $this->request->getVar('idkur'),
                'akmapel' => $this->request->getVar('akmapel'),
                'jenis' => $this->request->getVar('jmapel'),
                'nmmapel' => $this->request->getVar('nmmapel'),
                'urut' => $this->request->getVar('urmapel')
            );
            if ($this->mapel->update($id, $post)) {
                session()->setFlashdata('info', 'Data Mata Pelajaran Berhasil Diupdate!');
            } else {
                session()->setFlashdata('gagal', 'Data Mata Pelajaran Gagal Diupdate!');
            }
        }
        return redirect()->to(base_url('mapel/' . $this->request->getVar('idkur')));
    }

    public function edit()
    {
        $id = $this->request->getVar('id');
        echo json_encode($this->mapel->getDataById($id));
    }
}
