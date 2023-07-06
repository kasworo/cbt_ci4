<?php

namespace App\Controllers;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
// use App\Models\MapelModel;
// use App\Models\BankSoalModel;
use App\Models\ThpelModel;
use App\Models\SekolahModel;
use App\Models\RombelModel;
use App\Models\SiswaModel;
use App\Models\GtkModel;

class Home extends BaseController
{
    // protected $mapelModel;
    // protected $banksoalModel;
    protected $thpelModel;
    protected $sekolahModel;
    protected $rombelModel;
    protected $siswaModel;
    protected $gtkModel;

    public function __construct()
    {
        // $this->mapelModel = new MapelModel();
        // $this->banksoalModel = new BankSoalModel();
        $this->thpelModel = new ThpelModel();
        $this->sekolahModel = new SekolahModel();
        $this->rombelModel = new RombelModel();
        $this->siswaModel = new SiswaModel();
        $this->gtkModel = new GtkModel();
    }

    public function index()
    {
        $level = session('level');
        $userId = session('user');
        $skulCount = $level == '1' ? $this->sekolahModel->CountData() : $this->sekolahModel->CountData($userId);
        $guruCount = $level == '1' ? $this->gtkModel->CountData($userId) : $this->gtkModel->CountData($userId);
        $siswaCount = $level == '1' ? $this->siswaModel->CountData($userId) : $this->siswaModel->CountData($userId);
        $rombelCount = $level == '1' ? $this->rombelModel->CountData($userId) : $this->rombelModel->CountData($userId);
        // $mapelCount = $level == '1' ? $this->mapelModel->CountData($userId) : $this->mapelModel->jmlmapel($userId);
        // $banksoalCount = $level == '1' ? $this->banksoalModel->CountData() : $this->banksoalModel->jmlBank();

        $data = [
            'menu' => 'home',
            'submenu' => 'dashboard',
            'judul' => 'Dashboard',
            'isi' => [
                'skul' => $skulCount,
                'guru' => $guruCount,
                'siswa' => $siswaCount,
                'rombel' => $rombelCount
            ]
        ];

        $this->aktifthpel();
        return view('admin/dashboard_tampil', $data);
    }

    public function aktifthpel()
    {
        $tahun = date('Y');
        $bulan = date('m');
        $semester = ($bulan > 6) ? '1' : '2';
        $nmsemester = ($semester === '1') ? 'Ganjil' : 'Genap';
        $tgl = ($semester === '1') ? strtotime("07/01" . $tahun) : strtotime("01/01" . ($tahun - 1));
        $awal = date('Y-m-d', $tgl);

        $tahun1 = $tahun + 1;
        $ay = $tahun . $semester;
        $nama = $tahun . '/' . $tahun1 . '-' . $nmsemester;

        $existingThpel = $this->thpelModel->where('nmthpel', $ay)->countAllResults();

        if ($existingThpel === 0) {
            $post = [
                'nmthpel' => $ay,
                'desthpel' => $nama,
                'awal' => $awal,
                'aktif' => '1'
            ];

            $this->thpelModel->where('nmthpel !=', $ay)
                ->where('aktif', '1')
                ->set(['aktif' => '0'])
                ->update();

            $this->thpelModel->insert($post, false);
        }
    }
}
