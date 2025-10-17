<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Tanaman | Platycerium Gallery</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --primary: #57ba98;
            --secondary: #2f5233;
            --accent: #e0f7ef;
            --gradient: linear-gradient(135deg, #6dd5a3, #56ab2f);
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: radial-gradient(circle at top left, #e8f5e9, #c8e6c9);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow-x: hidden;
        }

        /* Background motion leaves */
        .floating-leaf {
            position: absolute;
            width: 80px;
            height: 80px;
            background: url('https://cdn-icons-png.flaticon.com/512/7662/7662644.png') no-repeat center/contain;
            opacity: 0.15;
            animation: floatLeaf 20s infinite ease-in-out;
        }
        .floating-leaf:nth-child(1) {top: 10%; left: 5%; animation-delay: 0s;}
        .floating-leaf:nth-child(2) {bottom: 15%; right: 8%; animation-delay: 4s;}
        .floating-leaf:nth-child(3) {top: 30%; right: 15%; animation-delay: 8s;}

        @keyframes floatLeaf {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-40px) rotate(10deg); }
        }

        /* Card Style */
        .glass-card {
            background: rgba(255, 255, 255, 0.4);
            backdrop-filter: blur(20px);
            border-radius: 30px;
            box-shadow: 0 25px 45px rgba(0,0,0,0.1);
            overflow: hidden;
            animation: fadeUp 1s ease both;
        }

        @keyframes fadeUp {
            from {opacity: 0; transform: translateY(50px);}
            to {opacity: 1; transform: translateY(0);}
        }

        .card-header {
            background: var(--gradient);
            color: white;
            text-align: center;
            padding: 2.5rem 1rem;
            position: relative;
        }

        .card-header img {
            width: 80px;
            height: 80px;
            margin-bottom: 1rem;
            filter: drop-shadow(0 4px 8px rgba(0,0,0,0.2));
            border-radius: 16px;
            transition: transform 0.4s ease;
        }

        .card-header img:hover {
            transform: scale(1.1) rotate(-3deg);
        }

        .card-header h2 {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            letter-spacing: 0.5px;
            text-shadow: 0 2px 8px rgba(0,0,0,0.2);
        }

        .divider {
            height: 4px;
            width: 80px;
            background: #fff;
            border-radius: 4px;
            margin: 12px auto 0;
            opacity: 0.8;
        }

        .card-body {
            padding: 2.5rem;
            background: rgba(255,255,255,0.85);
        }

        label.form-label {
            font-weight: 600;
            color: var(--secondary);
        }

        .form-control {
            border-radius: 14px;
            border: 1px solid #ccc;
            padding: 0.75rem;
            transition: 0.3s;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.25rem rgba(87, 186, 152, 0.3);
        }

        textarea {
            resize: none;
        }

        .btn-success {
            background: var(--gradient);
            border: none;
            border-radius: 14px;
            font-weight: 600;
            padding: 0.8rem 1.8rem;
            color: #fff;
            transition: all 0.3s ease;
        }

        .btn-success:hover {
            background: linear-gradient(135deg, #4c9a2a, #91d95b);
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(87,186,152,0.4);
        }

        .btn-secondary {
            border-radius: 14px;
            font-weight: 500;
            padding: 0.8rem 1.8rem;
        }

        #preview {
            display: none;
            max-width: 100%;
            border-radius: 16px;
            margin-top: 12px;
            box-shadow: 0 6px 18px rgba(0,0,0,0.15);
            transition: transform 0.3s ease;
        }

        #preview:hover {
            transform: scale(1.05);
        }

        .footer {
            text-align: center;
            background: rgba(255,255,255,0.65);
            padding: 1.3rem;
            font-size: 0.9rem;
            color: #444;
        }

        .footer strong {
            color: var(--secondary);
        }

        .alert {
            border-radius: 12px;
        }
    </style>
</head>
<body>

<!-- Background elements -->
<div class="floating-leaf"></div>
<div class="floating-leaf"></div>
<div class="floating-leaf"></div>

<div class="container py-5">
    <div class="glass-card col-lg-6 col-md-8 col-11 mx-auto">

        <!-- Header -->
        <div class="card-header">
            <img src="{{ asset('images/logo.png') }}" alt="Logo">
            <h2>Tambah Tanaman Baru</h2>
            <div class="divider"></div>
        </div>

        <!-- Body -->
        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Terjadi kesalahan:</strong>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('plants.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label"><i class="bi bi-leaf me-2"></i>Nama Tanaman</label>
                    <input name="name" class="form-control" value="{{ old('name') }}" placeholder="Masukkan nama tanaman" required>
                </div>

                <div class="mb-3">
                    <label class="form-label"><i class="bi bi-info-circle me-2"></i>Deskripsi</label>
                    <textarea name="description" class="form-control" rows="4" placeholder="Tuliskan deskripsi singkat tanaman kamu..." required>{{ old('description') }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label"><i class="bi bi-tags me-2"></i>Kategori (Opsional)</label>
                    <input name="category" class="form-control" value="{{ old('category') }}" placeholder="Contoh: Platycerium, Tanaman Hias, Anggrek...">
                </div>

                <div class="mb-3">
                    <label class="form-label"><i class="bi bi-image me-2"></i>Gambar Tanaman (Opsional)</label>
                    <input type="file" name="image" class="form-control" id="imageInput" accept="image/*">
                    <img id="preview" alt="Preview Gambar">
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('plants.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
                    <button type="submit" class="btn btn-success"><i class="bi bi-check-circle"></i> Simpan</button>
                </div>
            </form>
        </div>

        <!-- Footer -->
        <div class="footer">
            © {{ date('Y') }} <strong>Platycerium Gallery</strong> | Dibuat <i class="bi bi-heart-fill text-danger"></i> oleh <strong>Deva Okta</strong>
        </div>
    </div>
</div>

<!-- Script Preview -->
<script>
    document.getElementById('imageInput')?.addEventListener('change', function (e) {
        const [file] = e.target.files;
        const preview = document.getElementById('preview');
        if (file) {
            preview.src = URL.createObjectURL(file);
            preview.style.display = 'block';
        } else {
            preview.style.display = 'none';
        }
    });
</script>

</body>
</html>
