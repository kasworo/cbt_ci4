<?php

namespace App\Models;

use CodeIgniter\Model;

class StimulusModel extends Model
{
    protected $table = 'tbstimulus';
    protected $primaryKey = 'idstimulus';
    protected $allowedFields = ['idbank', 'petunjuk', 'stimulus', 'gambar', 'audio', 'video'];
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
}
