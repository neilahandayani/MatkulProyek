<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    // Menampilkan data role
    public function index(Request $request)
    {
        $roles = Role::where('nama_role', 'like', '%' . $request->search . '%')->paginate(10);
        return view('role.index', compact('roles'));
    }

    // Menampilkan form edit role
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        return view('role.edit', compact('role'));
    }

    // Menyimpan perubahan role
    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        $role->nama_role = $request->nama_role;
        $role->save();

        return redirect()->route('role.index')->with('success', 'Role Berhasil di Update');
    }

    // Menampilkan form tambah role
    public function create()
    {
        // Ambil kode role terakhir tanpa urutan berdasarkan created_at
        $last_role = Role::orderBy('id_role', 'desc')->first(); // Menggunakan 'id_role' untuk urutan

        if ($last_role) {
            // Ambil angka dari kode_role terakhir dan tambahkan 1
            $last_code_number = (int) substr($last_role->kode_role, 3);
            $new_code_number = str_pad($last_code_number + 1, 3, "0", STR_PAD_LEFT);
        } else {
            // Jika belum ada data, mulai dari RO-001
            $new_code_number = "001";
        }

        $kode_role = "RO-" . $new_code_number;

        return view('role.create', compact('kode_role'));
    }

    // Menyimpan role baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_role' => 'required|string|max:50',
        ]);

        // Logika untuk generate kode_role otomatis
        $last_role = Role::orderBy('id_role', 'desc')->first(); // Ambil data role terakhir berdasarkan id_role
        if ($last_role) {
            // Ambil angka dari kode_role terakhir dan tambahkan 1
            $last_code_number = (int) substr($last_role->kode_role, 3);
            $new_code_number = str_pad($last_code_number + 1, 3, "0", STR_PAD_LEFT);
        } else {
            // Jika belum ada data, mulai dari RO-001
            $new_code_number = "001";
        }

        $kode_role = "RO-" . $new_code_number;

        // Simpan role baru
        $role = new Role();
        $role->kode_role = $kode_role; // Set kode_role otomatis
        $role->nama_role = $request->nama_role;
        $role->save();

        return redirect()->route('role.index')->with('success', 'Role berhasil ditambahkan');
    }
}
