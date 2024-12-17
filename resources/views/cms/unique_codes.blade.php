<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CMS Kategori & Kode Unik</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>CMS Kategori & Kode Unik</h2>
    <hr>

    <!-- Pesan Sukses/Error -->
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <!-- Form Tambah Kategori -->
    <h4>Tambah Kategori</h4>
    <form method="POST" action="/cms/category">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nama Kategori</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="quota" class="form-label">Kuota</label>
            <input type="number" name="quota" class="form-control" min="1" required>
        </div>
        <button type="submit" class="btn btn-success">Tambah Kategori</button>
    </form>

    <hr>

    <!-- Form Tambah Kode Unik -->
    <h4>Tambah Kode Unik</h4>
    <form action="/cms/unique-code" method="POST">
        @csrf
        <label for="code">Kode Unik</label>
        <input type="text" id="code" name="code" required>
    
        <label for="category_id">Kategori</label>
        <select id="category_id" name="category_id" required>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    
        <button type="submit">Tambah Kode Unik</button>
    </form>

    <hr>

    <!-- Tabel Data Kategori -->
    <h4>Daftar Kategori</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kategori</th>
                <th>Kuota</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $index => $category)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->quota }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <hr>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Kode Unik</th>
                <th>Kategori</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($uniqueCodes as $code)
                <tr>
                    <td>{{ $code->code }}</td>
                    <td>
                        {{ $code->category ? $code->category->name : 'Kategori Tidak Ditemukan' }}
                    </td>
                    <td>{{ $code->is_used ? 'Sudah Digunakan' : 'Belum Digunakan' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
</div>
</body>
</html>
