<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\UniqueCode;
use App\Models\Registration;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('registrations.create'); // Form pendaftaran
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Validasi input
    $request->validate([
        'name' => 'required|string',
        'email' => 'required|email|unique:registrations,email',
        'phone_number' => 'required|string',
        'unique_code' => 'required|string|exists:unique_codes,code', // Validasi kode unik
    ]);

    // Cari kode unik yang sesuai
    $uniqueCode = UniqueCode::where('code', $request->unique_code)->first();

    // Cek apakah kode unik ditemukan dan belum digunakan
    if (!$uniqueCode || $uniqueCode->is_used) {
        return redirect()->route('register.form')->with('error', 'Kode unik tidak valid atau sudah digunakan.');
    }

    // Cari kategori yang terkait dengan kode unik
    $category = $uniqueCode->category;

    // Cek apakah kategori memiliki stok yang cukup
    if ($category->quota <= 0) {
        return redirect()->route('register.form')->with('error', 'Stok kategori habis.');
    }

    // Simpan data registrasi
    Registration::create([
        'name' => $request->name,
        'email' => $request->email,
        'phone_number' => $request->phone_number,
        'unique_code' => $request->unique_code,
    ]);

    // Tandai kode unik sebagai telah digunakan
    $uniqueCode->update(['is_used' => true]);

    // Kurangi kuota kategori
    $category->decrement('quota');

    return redirect()->route('register.form')->with('success', 'Registrasi berhasil.');
}


    /**
     * Display the specified resource.
     */
    public function show(Registration $registration)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Registration $registration)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Registration $registration)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Registration $registration)
    {
        //
    }
}
