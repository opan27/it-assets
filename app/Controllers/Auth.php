<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        return view('auth/login');
    }

    public function attemptLogin()
    {
        $session   = session();
        $userModel = new UserModel();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // Cari user berdasarkan username
        $user = $userModel->where('username', $username)->first();

        if ($user && password_verify($password, $user['password'])) {
            // Set session
            $session->set([
                'isLoggedIn' => true,
                'user_id'    => $user['id'],
                'role'       => $user['role'],
                'username'   => $user['username']
            ]);

            // Redirect sesuai role
            switch ($user['role']) {
                case 'superadmin':
                    return redirect()->to('/dashboard');
                case 'teknisi':
                    return redirect()->to('/teknisi/dashboard');
                default:
                    session()->destroy();
                    return redirect()->back()->with('error', 'Role tidak dikenali');
            }
        }

        // Handling error
        if (! $user) {
            return redirect()->back()->with('error', 'User tidak ditemukan');
        }

        if (! password_verify($password, $user['password'])) {
            return redirect()->back()->with('error', 'Password salah');
        }

        return redirect()->back()->with('error', 'Username atau password salah');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
