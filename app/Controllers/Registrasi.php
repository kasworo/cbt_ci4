<?php

namespace App\Controllers;

use App\Models\RegistrasiModel;
use App\Models\SiswaModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Registrasi extends BaseController
{
    protected $siswa;
    protected $regis;

    public function __construct()
    {
        $this->siswa = new SiswaModel();
        $this->regis = new RegistrasiModel();
    }

    public function index()
    {
        $registrasiData = $this->regis->getData();
        $siswaData = $this->siswa->getData();
        $data = [
            'menu' => 'manajemen kbm',
            'submenu' => 'registrasi',
            'judul' => 'Data Registrasi Peserta Didik',
            'registrasi' => count($registrasiData) == 0 ? $siswaData : $registrasiData,
        ];
        return view('admin/registrasi_tampil', $data);
    }

    public function ekspor()
    {
        $spreadsheet = new Spreadsheet();
        $data = $this->regis->getData();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue("A1", "Template Data Registrasi Peserta Didik");
        $sheet->setCellValue("A3", "No");
        $sheet->setCellValue("B3", "NIS");
        $sheet->setCellValue("C3", "NISN");
        $sheet->setCellValue("D3", "NamaLengkap");
        $sheet->setCellValue("E3", "NPSN");
        $sheet->setCellValue("F3", "Kelas");
        $sheet->setCellValue("G3", "Rombel");
        $sheet->setCellValue("H3", "Ket.");

        $headerStyle = [
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER
            ],
            'font' => ['bold' => true],
            'fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'EEEEEE']],
            'borders' => ['allBorders' => ['borderStyle' => 'thin', 'color' => ['rgb' => 'CCCCCC']]]
        ];
        $akhir = $sheet->getHighestColumn();
        $sheet->mergeCells('A1:' . $akhir . '1');
        $sheet->getStyle('A3:' . $akhir . '3')->applyFromArray($headerStyle);

        foreach ($data as $id => $dt) {
            $row = $id + 4;
            $sheet->setCellValueExplicit('A' . $row, $id + 1 . '.', \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            $sheet->setCellValueExplicit('B' . $row, $dt['nis'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            $sheet->setCellValueExplicit('C' . $row, $dt['nisn'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            $sheet->setCellValueExplicit('D' . $row, $dt['nmsiswa'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            $sheet->setCellValueExplicit('E' . $row, $dt['npsn'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            $sheet->setCellValueExplicit('F' . $row, $dt['idkelas'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            $sheet->setCellValueExplicit('G' . $row, $dt['nmrombel'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            $sheet->setCellValueExplicit('H' . $row, $dt['nmthpel'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);;
        }

        $dataStyle = [
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER
            ],
            'borders' => ['allBorders' => ['borderStyle' => 'thin', 'color' => ['rgb' => 'FF0000']]]
        ];
        $sheet->getStyle('A4:C' . $row)->applyFromArray($dataStyle);
        $sheet->getStyle('E4:' . $akhir . $row)->applyFromArray($dataStyle);

        $dataStyle = [
            'borders' => ['allBorders' => ['borderStyle' => 'thin', 'color' => ['rgb' => 'FF0000']]]
        ];
        $sheet->getStyle('D4:D' . $row)->applyFromArray($dataStyle);

        for ($col = 'A'; $col <= $akhir; $col++) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        $filename = 'dt_reg_' . date('YmdHis') . '.xlsx';
        $writer = new Xlsx($spreadsheet);
        header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header("Cache-Control: max-age=0");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Pragma: public");
        $writer->save("php://output");
        exit();
    }

    public function impor()
    {
        if (isset($_FILES['tmprombel']) && $_FILES['tmprombel']['error'] === UPLOAD_ERR_OK) {
            $inputFileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($_FILES['tmprombel']['tmp_name']);
            $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
            $spreadsheet = $reader->load($_FILES['tmprombel']['tmp_name']);
            $sheet = $spreadsheet->getActiveSheet();
            $awal = 5;
            $akhir = $sheet->getHighestRow();
            $data = [];
            $sukses = 0;
            for ($row = $awal; $row <= $akhir; $row++) {
                $data = [
                    'nis' => $sheet->getCell('B' . $row)->getValue(),
                    'nisn' => $sheet->getCell('C' . $row)->getValue(),
                    'rombel' => $sheet->getCell('G' . $row)->getValue(),
                    'thpel' => $sheet->getCell('H' . $row)->getValue()
                ];
                $this->regis->imporData($data);
                $sukses++;
            }
            session()->setFlashdata('sukses', 'Ada ' . $sukses . ' data berhasil diimpor!');
        } else {
            session()->setFlashdata('gagal', 'Cek kembali template yang diupload!');
        }
        return redirect()->to(base_url('registrasi'));
    }
}
