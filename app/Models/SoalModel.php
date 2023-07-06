<?php

namespace App\Models;

use CodeIgniter\Model;

class SoalModel extends Model
{
    protected $table = 'tbsoal';
    protected $primaryKey = 'idbutir';
    protected $allowedFields = ['idstimulus', 'nosoal', 'jnssoal', 'tksukar', 'butirsoal', 'skormaks', 'headeropsi', 'file'];
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';

    public function getData($id)
    {
        $query = $this->db->table('tbsoal')
            ->select('tbsoal.*')
            ->join('tbstimulus', 'tbstimulus.idstimulus = tbsoal.idstimulus', 'inner')
            ->join('tbopsi', 'tbopsi.idbutir = tbsoal.idbutir', 'left')
            ->where('tbsoal.idstimulus', $id)
            ->get();
        return $query->getRowArray();
    }
}
