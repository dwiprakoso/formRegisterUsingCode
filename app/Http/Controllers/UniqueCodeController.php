<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\UniqueCode;
use Illuminate\Http\Request;

class UniqueCodeController extends Controller
{
     // Tampilkan form input CMS
     public function index()
     {
        $categories = Category::all();  // Ambil semua kategori
        $uniqueCodes = UniqueCode::with('category')->get();  // Ambil kode unik dengan kategori terkait
    
        return view('cms.unique_codes', compact('categories', 'uniqueCodes'));
    }
 
     // Simpan data kode unik
     public function storeCategory(Request $request)
{
    $request->validate([
        'name' => 'required|string|unique:categories,name',
        'quota' => 'required|integer|min:0',
    ]);

    Category::create([
        'name' => $request->name,
        'quota' => $request->quota,
    ]);

    return redirect()->back()->with('success', 'Kategori berhasil ditambahkan.');
}
 
     public function storeUniqueCode(Request $request)
    {
        // dd($request->all());
        // Validasi input kode unik
        $request->validate([
            'code' => 'required|string|unique:unique_codes,code',
            'category_id' => 'required|exists:categories,id',
        ]);

        UniqueCode::create([
            'code' => $request->code,
            'category_id' => $request->category_id,
            'is_used' => false,
        ]);

    return redirect()->back()->with('success', 'Kode unik berhasil ditambahkan.');
    }


     // Simpan atau update kuota kategori
     public function updateQuota(Request $request)
     {
         // Validasi input
         $request->validate([
             'category_id' => 'required|exists:categories,id',
             'quota' => 'required|integer|min:0',
         ]);
 
         // Update kuota kategori
         $category = Category::findOrFail($request->category_id);
         $category->quota = $request->quota;
         $category->save();
 
         return redirect()->back()->with('success', 'Kuota kategori berhasil diperbarui.');
     }
}
