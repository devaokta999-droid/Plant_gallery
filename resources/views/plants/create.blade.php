<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Tanaman | Platycerium Gallery — Premium Edition</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --primary: #37b182;
            --secondary: #1a3c34;
            --gold: #d4af37;
            --bg-gradient: linear-gradient(135deg, #f2f7f4, #cde6d3);
            --glass: rgba(255, 255, 255, 0.25);
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--bg-gradient);
            min-height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow-x: hidden;
        }

        /* Background ornaments */
        .orb {
            position: absolute;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(212,175,55,0.3) 0%, transparent 70%);
            filter: blur(80px);
            animation: float 12s ease-in-out infinite alternate;
        }
        .orb.one { width: 250px; height: 250px; top: -60px; left: -60px; }
        .orb.two { width: 300px; height: 300px; bottom: -100px; right: -80px; animation-delay: 3s; }

        @keyframes float {
            0% { transform: translateY(0); }
            100% { transform: translateY(-20px); }
        }

        /* Card styling */
        .card-premium {
            background: var(--glass);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 30px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            max-width: 650px;
            width: 90%;
            animation: fadeInUp 1s ease both;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(40px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Header */
        .card-header {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: #fff;
            text-align: center;
            padding: 3rem 1rem 2.5rem;
            position: relative;
        }

        .card-header::after {
            content: "";
            position: absolute;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: var(--gold);
            border-radius: 3px;
        }

        .card-header img {
            width: 95px;
            height: 95px;
            object-fit: cover;
            margin-bottom: 1rem;
            border-radius: 18px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.3);
            transition: transform 0.4s ease;
        }

        .card-header img:hover { transform: scale(1.1) rotate(-3deg); }

        .card-header h2 {
            font-family: 'Playfair Display', serif;
            font-size: 1.9rem;
            font-weight: 700;
            letter-spacing: 0.5px;
            margin-top: 0.5rem;
        }

        /* Body */
        .card-body {
            background: rgba(255, 255, 255, 0.65);
            padding: 3rem;
        }

        label.form-label {
            font-weight: 600;
            color: var(--secondary);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-control {
            border-radius: 14px;
            border: 1px solid #ccc;
            padding: 0.8rem 1rem;
            background: rgba(255, 255, 255, 0.9);
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.25rem rgba(55,177,130,0.2);
        }

        textarea {
            resize: none;
        }

        /* Buttons */
        .btn-success {
            background: linear-gradient(135deg, var(--primary), #2c604b);
            border: none;
            border-radius: 14px;
            font-weight: 600;
            padding: 0.9rem 2rem;
            color: #fff;
            transition: all 0.3s ease;
        }

        .btn-success:hover {
            transform: translateY(-2px);
            background: linear-gradient(135deg, #2e5237, #1a3c34);
            box-shadow: 0 6px 20px rgba(55,177,130,0.3);
        }

        .btn-secondary {
            border: 1px solid var(--secondary);
            background: transparent;
            color: var(--secondary);
            border-radius: 14px;
            padding: 0.9rem 2rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background: var(--secondary);
            color: #fff;
        }

        /* Image preview */
        #preview {
            display: none;
            max-width: 100%;
            border-radius: 20px;
            margin-top: 14px;
            box-shadow: 0 6px 18px rgba(0,0,0,0.15);
            transition: transform 0.3s ease;
        }

        #preview:hover {
            transform: scale(1.04);
        }

        /* Footer */
        .footer {
            text-align: center;
            background: rgba(255,255,255,0.35);
            padding: 1.3rem;
            font-size: 0.9rem;
            color: #333;
            border-top: 1px solid rgba(0,0,0,0.1);
        }

        .footer strong {
            color: var(--secondary);
        }

        /* Alert */
        .alert {
            border-radius: 12px;
        }
    </style>
</head>
<body>

    <!-- Background Ornaments -->
    <div class="orb one"></div>
    <div class="orb two"></div>

    <div class="container py-5">
        <div class="card-premium mx-auto">

            <!-- Header -->
            <div class="card-header">
                <img src="{{ asset('images/logo.png') }}" alt="Logo">
                <h2>Tambah Tanaman Baru</h2>
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
                        <label class="form-label"><i class="bi bi-leaf-fill text-success"></i> Nama Tanaman</label>
                        <input name="name" class="form-control" value="{{ old('name') }}" placeholder="Masukkan nama tanaman" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><i class="bi bi-info-circle-fill text-success"></i> Deskripsi</label>
                        <textarea name="description" class="form-control" rows="4" placeholder="Tuliskan deskripsi singkat tanaman kamu..." required>{{ old('description') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><i class="bi bi-tags-fill text-success"></i> Kategori (Opsional)</label>
                        <input name="category" class="form-control" value="{{ old('category') }}" placeholder="Contoh: Platycerium, Tanaman Hias, Anggrek...">
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><i class="bi bi-image-fill text-success"></i> Gambar Tanaman (Opsional)</label>
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
                © {{ date('Y') }} <strong>Platycerium Gallery</strong> — Dibuat dengan <i class="bi bi-heart-fill text-danger"></i> oleh <strong>Deva Okta</strong>
            </div>
        </div>
    </div>

    <!-- Preview Script -->
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
