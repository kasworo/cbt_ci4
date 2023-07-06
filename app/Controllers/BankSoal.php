<?php

namespace App\Controllers;

use App\Models\BankSoalModel;
use App\Models\StimulusModel;
use App\Models\SoalModel;

class BankSoal extends BaseController
{
    protected $bank;
    protected $stimulus;
    protected $soal;
    public function __construct()
    {
        $this->bank = new BankSoalModel();
        $this->stimulus = new StimulusModel();
        $this->soal = new SoalModel();
    }

    public function index()
    {
        $data = array(
            'menu' => 'manajemen ujian',
            'submenu' => 'bank soal',
            'judul' => 'Daftar Bank Soal',
            'kelas' => session('level') == '1' ? $this->bank->getKls() : $this->bank->getKls(session('user')),
            'kurikulum' => session('level') == '1' ? $this->bank->getKur() : $this->bank->getKur(session('user')),
            'banksoal' => $this->bank->getData()
        );
        return view('admin/banksoal_tampil', $data);
    }

    public function getkur()
    {
        $dtkur = $this->bank->getKur($_POST['id']);
        echo "<option selected value=''>..Pilih..</option>";
        foreach ($dtkur as $ku) {
            echo "<option value='$ku[idkur]'>$ku[nmkur]</option>";
        }
    }

    public function getmapel()
    {
        $dtmap = $this->bank->getMapelByKur($_POST['id']);
        echo "<option selected value=''>..Pilih..</option>";
        foreach ($dtmap as $m) {
            echo "<option value='$m[idmapel]'>$m[nmmapel]</option>";
        }
    }

    public function getid()
    {
        $post = array(
            'idkelas' => $this->request->getVar('kls'),
            'idmapel' => $this->request->getVar('map'),
        );
        echo $this->bank->getKode($post);
    }

    public function postbank()
    {
        $uji = $this->bank->getUji();
        $post = array(
            'idujian' => $uji['idujian'],
            'idkelas' => $this->request->getVar('idkelas'),
            'idmapel' => $this->request->getVar('idmapel'),
            'nmbank' => $this->request->getVar('nmbank'),
            'deleted' => '0',
            'hal' => 0
        );
        if ($this->bank->insert($post, false)) {
            session()->setFlashdata('sukses', 'Data Bank Soal Berhasil Disimpan!');
        } else {
            session()->setFlashdata('gagal', 'Data Bank Soal Gagal Disimpan!');
        }
        return redirect()->to(base_url('banksoal'));
    }

    public function isi($id)
    {
        if ($this->bank->getBank($id) !== NULL) {
            $data = array(
                'menu' => 'manajemen ujian',
                'submenu' => 'bank soal',
                'judul' => 'Detail Bank Soal',
                'bank' => $this->bank->getBank($id)
            );
            return view('admin/banksoal_isi', $data);
        } else {
            $data = array(
                'menu' => 'manajemen ujian',
                'submenu' => 'bank soal',
                'judul' => 'Tambah Stimulus Soal',
                'stimulus' => array(
                    'tombol' => 'Simpan',
                    'idbank' => $id,
                    'idstimulus' => NULL,
                    'stimulus' => NULL,
                    'petunjuk' => NULL
                )
            );
            return view('admin/banksoal_stimulus', $data);
        }
    }

    public function navigasi()
    {
        $post = array(
            'idbank' => $this->request->getVar('idbank'),
            'hal' => $this->request->getVar('hal')
        );
        $data = array(
            'isisoal' => $this->bank->getSoal($post),
            'opsiview' => $this->bank->getOpsi($post)
        );
        return view('admin/banksoal_load', $data);
    }

    public function navlist()
    {
        $data = array(
            'soal' => $this->bank->getNavSoal($this->request->getVar('idbank'))
        );
        return view('admin/banksoal_navigasi', $data);
    }

    public function seturut()
    {
        $post = array(
            'idbank' => $this->request->getVar('idbank'),
            'hal' => $this->request->getVar('hal')
        );
        return $this->bank->updateUrut($post);
    }

    public function stimulus($id)
    {
        $data = array(
            'menu' => 'manajemen ujian',
            'submenu' => 'bank soal',
            'judul' => 'Tambah Stimulus Soal',
            'stimulus' => array(
                'tombol' => 'Simpan',
                'idbank' => $id,
                'idstimulus' => NULL,
                'stimulus' => NULL,
                'petunjuk' => NULL
            )
        );
        return view('admin/banksoal_stimulus', $data);
    }

    public function poststimulus()
    {
        $fileupl = $this->request->getFile('filestim');
        if ($fileupl->isValid()) {
            $rules = 'mime_in[file,image/jpg,image/gif,image/png,video/mp4,video/mpeg,audio/mpeg,audio/wav,audio/mp3]';

            if ($this->request->getVar('idstimulus') == NULL || $this->request->getVar('idstimulus') == '') {
                if ($this->validate(['file' => $rules])) {
                    if ($fileupl->guessExtension() == 'jpg' || $fileupl->guessExtension() == 'gif' || $fileupl->guessExtension() == 'png') {
                        $newName = $fileupl->getRandomName();
                        $fileupl->move(ROOTPATH . 'public/pictures', $newName);
                        $post = array(
                            'idbank' => $this->request->getVar('idbank'),
                            'petunjuk' => $this->request->getVar('petunjuk'),
                            'stimulus' => $this->request->getVar('stimulus'),
                            'gambar' => $newName
                        );
                    }
                    if ($fileupl->guessExtension() == 'mp4' || $fileupl->guessExtension() == 'mpeg') {
                        $newName = $fileupl->getRandomName();
                        $fileupl->move(ROOTPATH . 'public/videos', $newName);
                        $post = array(
                            'idbank' => $this->request->getVar('idbank'),
                            'petunjuk' => $this->request->getVar('petunjuk'),
                            'stimulus' => $this->request->getVar('stimulus'),
                            'video' => $newName
                        );
                    }
                    if ($fileupl->guessExtension() == 'mp3' || $fileupl->guessExtension() == 'wav') {
                        $newName = $fileupl->getRandomName();
                        $fileupl->move(ROOTPATH . 'public/audios', $newName);
                        $post = array(
                            'idbank' => $this->request->getVar('idbank'),
                            'petunjuk' => $this->request->getVar('petunjuk'),
                            'stimulus' => $this->request->getVar('stimulus'),
                            'audio' => $newName
                        );
                    }
                    if ($this->stimulus->insert($post, false)) {
                        session()->setFlashdata('sukses', 'Stimulus Berhasil Disimpan!');
                    } else {
                        session()->setFlashdata('gagal', 'Stimulus Gagal Disimpan!');
                    }
                } else {
                    session()->setFlashdata('gagal', 'File Tidak Diizinkan Untuk Diupload!');
                }
            } else {
                $key = array(
                    'idstimulus' => $this->request->getVar('idstimulus')
                );
                if ($this->validate(['file' => $rules])) {
                    if ($fileupl->guessExtension() == 'jpg' || $fileupl->guessExtension() == 'gif' || $fileupl->guessExtension() == 'png') {
                        $newName = $fileupl->getRandomName();
                        $fileupl->move(ROOTPATH . 'public/pictures', $newName);
                        $post = array(
                            'petunjuk' => $this->request->getVar('petunjuk'),
                            'stimulus' => $this->request->getVar('stimulus'),
                            'gambar' => $newName
                        );
                    }
                    if ($fileupl->guessExtension() == 'mp4' || $fileupl->guessExtension() == 'mpeg') {
                        $newName = $fileupl->getRandomName();
                        $fileupl->move(ROOTPATH . 'public/videos', $newName);
                        $post = array(
                            'petunjuk' => $this->request->getVar('petunjuk'),
                            'stimulus' => $this->request->getVar('stimulus'),
                            'video' => $newName
                        );
                    }
                    if ($fileupl->guessExtension() == 'mp3' || $fileupl->guessExtension() == 'wav') {
                        $newName = $fileupl->getRandomName();
                        $fileupl->move(ROOTPATH . 'public/audios', $newName);
                        $post = array(
                            'petunjuk' => $this->request->getVar('petunjuk'),
                            'stimulus' => $this->request->getVar('stimulus'),
                            'audio' => $newName
                        );
                    }
                    if ($this->stimulus->update($key, $post)) {
                        session()->setFlashdata('info', 'Stimulus Berhasil Diupdate!');
                    } else {
                        session()->setFlashdata('gagal', 'Stimulus Gagal Diupdate!');
                    }
                } else {
                    session()->setFlashdata('gagal', 'File Tidak Diizinkan Untuk Diupload!');
                }
            }
            return redirect()->to(base_url('banksoal/stimulus/' . $this->request->getVar('idbank')));
        } else {
            if ($this->request->getVar('idstimulus') == NULL || $this->request->getVar('idstimulus') == '') {
                $post = array(
                    'idbank' => $this->request->getVar('idbank'),
                    'petunjuk' => $this->request->getVar('petunjuk'),
                    'stimulus' => $this->request->getVar('stimulus')
                );
                if ($this->stimulus->insert($post, false)) {
                    session()->setFlashdata('sukses', 'Stimulus Berhasil Disimpan!');
                } else {
                    session()->setFlashdata('gagal', 'Stimulus Gagal Disimpan!');
                }
            } else {
                $key = array(
                    'idstimulus' => $this->request->getVar('idstimulus')
                );
                $post = array(
                    'petunjuk' => $this->request->getVar('petunjuk'),
                    'stimulus' => $this->request->getVar('stimulus')
                );
                if ($this->stimulus->update($key, $post)) {
                    session()->setFlashdata('info', 'Stimulus Berhasil Diupdate!');
                } else {
                    session()->setFlashdata('gagal', 'Stimulus Gagal Diupdate!');
                }
            }
            return redirect()->to(base_url('banksoal/editstimulus/' . $this->request->getVar('idstimulus')));
        }
    }

    public function editstimulus($id)
    {
        $stim = $this->stimulus->where(array('idstimulus' => $id))->first();
        $data = array(
            'menu' => 'manajemen ujian',
            'submenu' => 'bank soal',
            'judul' => 'Update Stimulus Soal',
            'stimulus' => array(
                'tombol' => 'Update',
                'idbank' => $stim['idbank'],
                'idstimulus' => $stim['idstimulus'],
                'stimulus' => $stim['stimulus'],
                'petunjuk' => $stim['petunjuk'],
                'gambar' => $stim['gambar'],
                'audio' => $stim['audio'],
                'video' => $stim['video']
            )
        );
        return view('admin/banksoal_stimulus', $data);
    }

    public function addsoal($id)
    {
        $stim = $this->stimulus->where('idstimulus', $id)->first();
        $idbank = $stim['idbank'];
        $data = array(
            'menu' => 'manajemen ujian',
            'submenu' => 'bank soal',
            'judul' => 'Tambah Butir Soal',
            'soal' => array(
                'tombol' => 'Simpan',
                'idbank' => $idbank,
                'idstimulus' => $id,
                'idbutir' => NULL,
                'jnssoal' => NULL,
                'skormaks' => NULL,
                'butirsoal' => NULL,
                'opsi' => []
            )
        );
        return view('admin/banksoal_butir', $data);
    }

    public function postbutir()
    {
        dd($_FILES);
    }
}
