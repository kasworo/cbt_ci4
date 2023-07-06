<?php

namespace App\Models;

use CodeIgniter\Model;

class RegistrasiModel extends Model
{
    protected $table = 'tbregistrasi';
    protected $primaryKey = 'idreg';
    protected $allowedFields = ['idrombel', 'idsiswa'];
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';

    public function getData($id = '')
    {
        $query = $this->db->table('tbsiswa si')
            ->select('si.idsiswa, si.nmsiswa, si.nis, si.nisn, rb.nmrombel, sk.npsn, sk.nmskul, rb.idkelas, tp.nmthpel')
            ->join('tbskul sk', 'si.idskul = sk.idskul', 'inner')
            ->join('tbregistrasi rg', 'rg.idsiswa = si.idsiswa', 'left')
            ->join('tbrombel rb', 'rb.idrombel = rg.idrombel', 'left')
            ->join('tbthpel tp', 'tp.idthpel = rb.idthpel', 'left')
            ->where('tp.aktif', '1')
            ->where('si.deleted', '0')
            ->orderBy('rb.idrombel DESC, si.nmsiswa ASC');

        if ($id != '') {
            $query->where('si.idskul', $id);
        }

        $result = $query->get()->getResultArray();
        return $result;
    }

    public function imporData($data)
    {
        $postid = [
            'nis' => $data['nis'],
            'nisn' => $data['nisn']
        ];

        $siswa = $this->db->table('tbsiswa')
            ->select('idsiswa')
            ->where($postid)
            ->get()
            ->getRowArray();

        $rombel = $this->db->table('tbrombel rb')
            ->select('rb.idrombel')
            ->join('tbthpel tp', 'tp.idthpel=rb.idthpel', 'inner')
            ->where('rb.nmrombel', $data['rombel'])
            ->where('tp.nmthpel', $data['thpel'])
            ->get()
            ->getRowArray();

        $existingData = $this->db->table('tbregistrasi')
            ->select('idsiswa')
            ->where('idsiswa', $siswa['idsiswa'])
            ->get()
            ->getRowArray();

        if ($existingData) {
            $updateData = [
                'idrombel' => $rombel['idrombel']
            ];

            $this->db->table('tbregistrasi')
                ->where('idsiswa', $siswa['idsiswa'])
                ->update($updateData);

            return $this->db->affectedRows();
        } else {
            $insertData = [
                'idsiswa' => $siswa['idsiswa'],
                'idrombel' => $rombel['idrombel']
            ];

            $this->db->table('tbregistrasi')
                ->insert($insertData);

            return $this->db->affectedRows();
        }
    }
}
