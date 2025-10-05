<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\PegawaiModel;

class Users extends BaseController
{
    protected $userModel;
    protected $pegawaiModel;

    public function __construct()
    {
        $this->userModel    = new UserModel();
        $this->pegawaiModel = new PegawaiModel();
    }

    public function index()
    {
        $data['users'] = $this->userModel
            ->select('users.*, pegawai.nama AS nama_pegawai')
            ->join('pegawai', 'pegawai.id = users.pegawai_id', 'left')
            ->findAll();

        return view('users/index', $data);
    }

    public function create()
    {
        // Ambil pegawai yang belum punya akun
        $data['pegawai'] = $this->pegawaiModel
            ->select('id, nama')
            ->whereNotIn('id', function ($builder) {
                return $builder->select('pegawai_id')->from('users');
            })
            ->findAll();

        return view('users/create', $data);
    }

public function store()
{
    $rules = [
        'pegawai_id' => 'required',
        'role'       => 'required|in_list[superadmin,teknisi]',
        'password'   => 'required|min_length[6]',
    ];

    if (!$this->validate($rules)) {
        return redirect()->back()
            ->withInput()
            ->with('errors', $this->validator->getErrors());
    }

    $pegawai_id = $this->request->getPost('pegawai_id');
    $role       = $this->request->getPost('role');
    $password   = $this->request->getPost('password');

    // Cek apakah pegawai sudah punya akun
    if ($this->userModel->where('pegawai_id', $pegawai_id)->first()) {
        return redirect()->back()->with('error', 'Pegawai ini sudah memiliki akun!');
    }

    $pegawai = $this->pegawaiModel->find($pegawai_id);

    // Buat username unik
    $baseUsername = strtolower(str_replace(' ', '', $pegawai['nama']));
    $username = $baseUsername;
    $counter = 1;
    while ($this->userModel->where('username', $username)->first()) {
        $username = $baseUsername . $counter++;
    }

    // Simpan user (password plain, UserModel akan hash otomatis)
    $this->userModel->save([
        'pegawai_id' => $pegawai_id,
        'username'   => $username,
        'password'   => $password, // KIRIM PLAIN, akan di-hash otomatis di UserModel
        'role'       => $role,
    ]);

    // Redirect dengan flashdata sukses
    return redirect()->to('/admin/users')
        ->with('success', "Akun berhasil dibuat.<br>Username: <b>{$username}</b>");
}
public function resetPassword($id)
{
    $user = $this->userModel->find($id);

    if (!$user) {
        return redirect()->back()->with('error', 'User tidak ditemukan');
    }

    // Reset password ke default 12345678
    $this->userModel->update($id, [
        'password' => '12345678' // akan di-hash otomatis oleh beforeUpdate
    ]);

    return redirect()->back()->with('success', "Password untuk user <b>{$user['username']}</b> telah di-reset menjadi <b>12345678</b>");
}

}
