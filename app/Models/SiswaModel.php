<?php

namespace App\Models;

use CodeIgniter\Model;

class SiswaModel extends Model
{
    protected $table = 'tbsiswa';
    protected $primaryKey = 'idsiswa';
    protected $allowedFields = ['nmsiswa', 'nis', 'nisn', 'tmplahir', 'tgllahir', 'agama', 'gender', 'alamat', 'fotosiswa', 'aktif', 'deleted', 'idskul'];
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';

    public function getData($id = '')
    {
        $builder = $this->db->table('tbsiswa si');
        $builder->select('si.*, sk.nmskul');
        $builder->join('tbskul sk', 'si.idskul = sk.idskul', 'inner');
        $builder->where('si.deleted', '0');

        if ($id !== '') {
            $builder->where('si.idskul', $id);
        }

        $builder->orderBy('si.nis', 'asc');
        return $builder->get()->getResultArray();
    }

    public function CountData($id = '')
    {
        return count($this->getData($id));
    }

    public function getDataByID($id)
    {
        return $this->where(['idsiswa' => $id])->first();
    }

    public function getKls($skul)
    {
        $builder = $this->db->table('tbkelas kl');
        $builder->select('kl.*, sk.idskul');
        $builder->join('tbskul sk', 'kl.idjenjang = sk.idjenjang', 'inner');
        $builder->where('sk.idskul', $skul);
        return $builder->get()->getResultArray();
    }
}
