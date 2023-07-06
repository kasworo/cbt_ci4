<?php

namespace App\Models;

use CodeIgniter\Model;

class GtkModel extends Model
{
    protected $table = 'tbgtk';
    protected $primaryKey = 'idgtk';
    protected $allowedFields = ['nama', 'nip', 'nik', 'kepeg', 'jbtdinas', 'tmplahir', 'tgllahir', 'agama', 'gender', 'alamat', 'kdpos', 'nohp', 'email', 'foto', 'ttd', 'idskul', 'username', 'passwd'];
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';

    public function getData($id = '')
    {
        $builder = $this->db->table('tbgtk gt')
            ->select('gt.*, sk.nmskul')
            ->join('tbskul sk', 'gt.idskul = sk.idskul', 'inner');

        if ($id != '') {
            $builder->where('gt.idskul', $id);
        }
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function CountData($id = '')
    {
        if ($id == '') {
            return count($this->getData());
        } else {
            return count($this->getData($id));
        }
    }

    public function getDataByID($id)
    {
        return $this->where(array('idgtk' => $id))->first();
    }
}
