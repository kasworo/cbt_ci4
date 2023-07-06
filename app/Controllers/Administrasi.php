<?php

namespace App\Controllers;

use App\Models\AdministrasiModel;
use Mpdf\Mpdf;

class Administrasi extends BaseController
{
    protected $administrasi;
    private $pdf;

    public function __construct()
    {
        $mpdfConfig = [
            'format' => 'A4',
            'orientation' => 'P',
            'margin_left' => 10,
            'margin_right' => 10,
            'margin_header' => 5,
            'margin_top' => 10,
            'margin_bottom' => 10,
            'margin_footer' => 5,
            'default_font' => 'helvetica',
            'protection' => [
                'password' => '10500708Ok!?',
                'permissions' => [
                    'print'
                ]
            ]
        ];
        $this->pdf = new Mpdf($mpdfConfig);
        $this->administrasi = new AdministrasiModel();
    }

    public function kartu()
    {
        $data = [
            'menu' => 'administrasi ujian',
            'submenu' => 'kartu ujian',
            'judul' => 'Cetak Kartu Login'
        ];
        return view('admin/kartu_tampil.php', $data);
    }

    public function kartucetak()
    {
        $datarombel =
            session('level') == '1' ? $this->administrasi->getRombel() : $this->administrasi->getRombel(session('user'));
        $kelas = count($datarombel);
        foreach ($datarombel as $id => $rb) {
            $data = [
                'uji' => $this->administrasi->getUjiAktif(),
                'peserta' => $this->administrasi->getPesertaRombel($rb['idrombel'])
            ];
            $html = view('admin/kartu_cetak', $data);
            $this->pdf->SetColumns(2, 'J', 7.75);
            $this->pdf->WriteHTML($html);
            $this->pdf->AddColumn();
            if ($id > 1 and $id < ($kelas - 1)) {
                $this->pdf->AddPage();
            }
        }
        $this->pdf->Output();
        exit;
    }

    public function nomeja()
    {
        $data = [
            'menu' => 'administrasi ujian',
            'submenu' => 'nomor meja',
            'judul' => 'Cetak Nomor Meja'
        ];
        return view('admin/nomeja_tampil.php', $data);
    }

    public function nomejacetak()
    {

        $data = [
            'uji' => $this->administrasi->getUjiAktif(),
            'peserta' => session('level') == '1' ? $this->administrasi->getPesertaRuang() : $this->administrasi->getPesertaRuang(session('user'))
        ];
        try {
            ob_start();
            echo view('admin/kartu_cetak', $data);
            $html = ob_get_clean();
            ob_flush();
            $this->pdf->WriteHTML($html);
            $this->response->setHeader('Content-Type', 'application/pdf');
            $this->pdf->Output();
            exit;
        } catch (\Mpdf\MpdfException $e) {
            echo $e->getMessage();
        }
    }

    public function absen()
    {
        $data = [
            'menu' => 'administrasi ujian',
            'submenu' => 'daftar hadir',
            'judul' => 'Cetak Daftar Hadir'
        ];
        return view('admin/absen_tampil.php', $data);
    }

    public function absencetak()
    {
        $data = [
            'ruanguji' => session('level') == '1' ? $this->administrasi->getRuang() : $this->administrasi->getRuang(session('user')),
            'peserta' => $this->administrasi->getPesertaRuang()
        ];
        try {
            ob_start();
            echo view('admin/absen_cetak', $data);
            $html = ob_get_clean();
            ob_flush();

            $this->pdf->WriteHTML($html);
            $this->response->setHeader('Content-Type', 'application/pdf');
            $this->pdf->Output();
            exit;
        } catch (\Mpdf\MpdfException $e) {
            echo $e->getMessage();
        }
    }
}
