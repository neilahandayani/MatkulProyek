<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Menampilkan data user dengan pagination
    public function index(Request $request)
    {
        // Pencarian berdasarkan nama_user, kode_user, dan username
        $users = User::with('role')
            ->where('nama_user', 'like', '%' . $request->search . '%')
            ->orWhere('kode_user', 'like', '%' . $request->search . '%')
            ->orWhere('username', 'like', '%' . $request->search . '%')
            ->paginate(10);

        return view('users.index', compact('users'));
    }


    // Menampilkan form tambah user
    public function create()
    {
        $lastUser = User::orderBy('id_user', 'desc')->first();

        if ($lastUser) {
            // Ambil angka dari kode_user terakhir dan tambahkan 1
            $lastCodeNumber = (int) substr($lastUser->kode_user, 3);
            $newCodeNumber = str_pad($lastCodeNumber + 1, 3, "0", STR_PAD_LEFT);
        } else {
            // Jika belum ada data, mulai dari US-001
            $newCodeNumber = "001";
        }

        // Format kode user baru
        $kode_user = "US-" . $newCodeNumber;

        // Ambil semua data role untuk dropdown
        $role = Role::all();
        return view('users.create', compact('kode_user', 'role'));
    }

    // Menyimpan user baru
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'kode_user' => 'required|unique:users,kode_user|regex:/^US-\d{3}$/', // Update regex
            'nama_user' => 'required|max:30',
            'username' => 'required|unique:users,username|max:30',
            'password' => 'required|min:6|confirmed',
            'id_role' => 'required|exists:role,id_role'
        ]);

        // Generate kode user otomatis (US-001, US-002, dst)
        $lastUser = User::orderBy('kode_user', 'desc')->first(); // Urutkan berdasarkan kode_user
        $new_code = 'US-001'; // Default jika belum ada user

        if ($lastUser) {
            // Ambil angka dari kode_user terakhir dan tambahkan 1
            $last_code = substr($lastUser->kode_user, 3);
            $new_code_number = str_pad($last_code + 1, 3, "0", STR_PAD_LEFT); // Format 3 digit
            $new_code = 'US-' . $new_code_number; // Set kode_user baru
        }

        // Simpan data user baru
        $user = new User();
        $user->kode_user = $new_code;
        $user->nama_user = $validated['nama_user'];
        $user->username = $validated['username'];
        $user->password = bcrypt($validated['password']);
        $user->id_role = $validated['id_role'];
        $user->save();

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan');
    }

    // Mengupdate data user
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_user' => 'required|string|max:30',
            'username' => 'required|string|max:30|unique:users,username,' . $id . ',id_user', // Mengecualikan username user yang sedang diedit
            'id_role' => 'required|exists:role,id_role',
            'password' => 'nullable|min:6|confirmed', // Password bisa kosong
        ]);

        // Temukan user berdasarkan ID
        $user = User::findOrFail($id);

        // Update data user
        $user->nama_user = $request->nama_user;
        $user->username = $request->username;
        $user->id_role = $request->id_role;

        // Jika password diisi, update password
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        // Simpan perubahan
        $user->save();

        return redirect()->route('users.index')->with('success', 'User berhasil diperbarui');
    }


    // Menampilkan form edit user
    public function edit($id)
    {
        // Temukan user berdasarkan ID
        $user = User::findOrFail($id);
        $role = Role::all(); // Ambil semua role

        return view('users.edit', compact('user', 'role'));
    }

    public function destroy($id)
    {
        // Mencari user berdasarkan ID
        $user = User::findOrFail($id);

        // Menghapus user
        $user->delete();

        // Redirect kembali ke halaman daftar user dengan pesan sukses
        return redirect()->route('users.index')->with('success', 'User berhasil dihapus');
    }
}
