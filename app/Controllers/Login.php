<?php

namespace App\Controllers;

use App\Models\LoginModel;
use CodeIgniter\Controller;

class Login extends BaseController
{
    protected $login;

    public function __construct()
    {
        $this->login = new LoginModel();
    }

    public function index()
    {
        return view('login');
    }

    public function ceklogin()
    {
        $validationRules = [
            'user' => [
                'label' => 'Username',
                'rules' => 'required'
            ],
            'pass' => [
                'label' => 'Password',
                'rules' => 'required'
            ]
        ];

        if ($this->validate($validationRules)) {
            $user = $this->request->getVar('user');
            $passwd = $this->request->getVar('pass');
            $userTypes = ['checkUser', 'checkSkul', 'checkGtk', 'checkSiswa', 'checkPeserta'];

            foreach ($userTypes as $userType) {
                if ($this->login->{$userType}($user)) {
                    $row = $this->login->{$userType}($user);
                    if (password_verify($passwd, $row['passwd'])) {
                        session()->set('log', true);
                        session()->set('user', $row['user']);
                        session()->set('nama', $row['namatmp']);
                        session()->set('level', $this->getUserLevel($userType));

                        if ($this->request->getPost('ingat')) {
                            $token = bin2hex(random_bytes(16)); // Generate a random token
                            $cookie = [
                                'name'   => 'ingat',
                                'value'  => $token,
                                'expire' => 2592000, // Expiration time of 30 days (in seconds)
                                'secure' => false,
                            ];
                            $this->response->setCookie($cookie);
                        }

                        return redirect()->to(base_url('home')); // Pengalihan hanya dilakukan jika login berhasil
                    } else {
                        break;
                    }
                }
            }
            session()->setFlashdata('gagal', 'Cek Username dan Password Anda!');
        } else {
            session()->setFlashdata('gagal', 'Username dan Password harus Diisi!');
        }
        return redirect()->to(base_url('login')); // Pengalihan jika login gagal atau validasi gagal
    }


    public function logout()
    {
        session()->remove(['log', 'user', 'level', 'nama']);
        return redirect()->to(base_url('login'));
    }

    private function getUserLevel($userType)
    {
        switch ($userType) {
            case 'checkUser':
                return 1;
            case 'checkSkul':
                return 2;
            case 'checkGtk':
                return 3;
            case 'checkSiswa':
            case 'checkPeserta':
                return 4;
            default:
                return 0;
        }
    }
}
