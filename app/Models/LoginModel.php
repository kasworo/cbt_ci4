<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginModel extends Model
{
    public function checkUser($user)
    {
        return $this->db->table('tbuser')
            ->select('username as user, namatmp, passwd')
            ->where('username', $user)
            ->get()
            ->getRowArray();
    }

    public function checkSkul($user)
    {
        return $this->db->table('tbskul sk')
            ->select('sk.idskul as user,sk.nmskul as namatmp, sk.passwd')
            ->where('sk.kdskul', $user)
            ->get()
            ->getRowArray();
    }

    public function checkGtk($user)
    {
        return $this->db->table('tbgtk gt')
            ->select('idgtk as user')
            ->where('username', $user)
            ->get()
            ->getRowArray();
    }

    public function checkSiswa($user)
    {
        return $this->db->table('tbsiswa')
            ->select('idsiswa as user, nmsiswa as namatmp, passwd')
            ->where('nisn', $user)
            ->get()
            ->getRowArray();
    }

    public function checkPeserta($user)
    {
        return $this->db->table('tbpeserta')
            ->select('idsiswa as user, nmpeserta as namatmp, passwd')
            ->where('nmpeserta', $user)
            ->get()
            ->getRowArray();
    }
}
