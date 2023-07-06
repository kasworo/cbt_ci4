<?php

namespace App\Controllers;

use App\Models\PengampuModel;

class Pengampu extends BaseController
{
    protected $pengampu;
    public function __construct()
    {
        $this->pengampu = new PengampuModel();
    }

    public function index($id)
    {
        if (session('level') == '1') {
            $data = array(
                'judul' => 'Data Pengampu',
                'pengampu' => $this->pengampu->getData($id),
                'guru' => $this->pengampu->getGuru(),
                'rombel' => $id
            );
        } else {
            $data = array(
                'judul' => 'Data Pengampu',
                'pengampu' => $this->pengampu->getDataBySkul(session('user')),
                'guru' => $this->pengampu->getGuruBySkul(session('user')),
                'rombel' => $id
            );
        }
        return view('admin/pengampu_tampil', $data);
    }

    public function post()
    {
        $key = array(
            'idmapel' => $this->request->getVar('idmapel'),
            'idrombel' => $this->request->getVar('idrombel')
        );
        if ($this->pengampu->cekData($key) > 0) {
            $post = array(
                'idgtk' => $this->request->getVar('idgtk')
            );
            if ($this->pengampu->update($key, $post)) {
                $ok = 2;
            } else {
                $ok = 0;
            }
        } else {
            $post = array(
                'idmapel' => $this->request->getVar('idmapel'),
                'idrombel' => $this->request->getVar('idrombel'),
                'idgtk' => $this->request->getVar('idgtk')
            );
            if ($this->pengampu->insert($post, false)) {
                $ok = 1;
            } else {
                $ok = 0;
            }
        }
        echo $ok;
    }
}
