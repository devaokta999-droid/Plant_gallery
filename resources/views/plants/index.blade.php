<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Platycerium Gallery 🌿</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --primary-green: #2e7d32;
            --secondary-green: #66bb6a;
            --light-green: #e8f5e9;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #f9fdfb;
            color: #333;
            overflow-x: hidden;
        }

        /* Navbar */
        .navbar {
            position: fixed;
            top: 0;
            width: 100%;
            background: rgba(46, 125, 50, 0.9);
            backdrop-filter: blur(10px);
            transition: all 0.4s ease;
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .navbar.scrolled {
            background: #1b5e20;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 700;
            color: white !important;
            font-family: 'Playfair Display', serif;
            font-size: 1.6rem;
            letter-spacing: 1px;
        }

        .navbar-brand img {
            width: 60px;
            height: 60px;
            object-fit: contain;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.2);
            padding: 6px;
            transition: all 0.3s ease;
        }

        .navbar-brand img:hover {
            transform: scale(1.1) rotate(-5deg);
        }

        .btn-success {
            background: var(--primary-green);
            border: none;
            border-radius: 30px;
            padding: 0.6rem 1.5rem;
            transition: all 0.3s ease;
        }

        .btn-success:hover {
            background: #1b5e20;
            transform: translateY(-2px);
        }

        /* Hero Section */
        .hero {
            height: 100vh;
            background: linear-gradient(to bottom right, rgba(46,125,50,0.8), rgba(102,187,106,0.7)),
                        url('https://images.unsplash.com/photo-1613743989442-f2b2736b9b32?auto=format&fit=crop&w=1950&q=80') center/cover;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .hero::after {
            content: "";
            position: absolute;
            bottom: 0;
            height: 150px;
            width: 100%;
            background: linear-gradient(to top, #f9fdfb, transparent);
        }

        .hero-logo {
            width: 300px;
            height: 300px;
            object-fit: contain;
            border-radius: 30px;
            background: rgba(255,255,255,0.2);
            padding: 20px;
            box-shadow: 0 0 25px rgba(255,255,255,0.4);
            animation: glow 3s infinite alternate, fadeIn 2s ease;
        }

        @keyframes glow {
            from { box-shadow: 0 0 20px rgba(255,255,255,0.4); }
            to { box-shadow: 0 0 35px rgba(255,255,255,0.7); }
        }

        .hero h1 {
            font-size: 4rem;
            margin-top: 20px;
            font-family: 'Playfair Display', serif;
            text-shadow: 0 5px 20px rgba(0,0,0,0.3);
            animation: fadeIn 2s ease;
        }

        .hero p {
            font-size: 1.3rem;
            opacity: 0.9;
            max-width: 750px;
            margin: 20px auto 0;
            animation: fadeIn 2.3s ease;
        }

        /* Cards */
        .fade-in {
            opacity: 0;
            transform: translateY(30px);
            animation: fadeInUp 1s forwards;
        }

        @keyframes fadeInUp {
            to { opacity: 1; transform: translateY(0); }
        }

        .card {
            border: none;
            border-radius: 20px;
            overflow: hidden;
            background: white;
            transition: all 0.4s ease;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        }

        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 25px rgba(0,0,0,0.15);
        }

        .card-img-top {
            height: 250px;
            object-fit: cover;
            cursor: zoom-in;
            transition: transform 0.4s ease;
        }

        .card:hover .card-img-top {
            transform: scale(1.08);
        }

        .card-title {
            color: var(--primary-green);
            font-weight: 600;
            margin-bottom: 8px;
        }

        /* Tambahan gaya waktu */
        .card-date {
            font-size: 0.9rem;
            color: #555;
            line-height: 1.6;
        }

        .card-date strong {
            color: var(--primary-green);
        }

        .card-date p {
            margin-bottom: 4px;
        }

        /* Modal Gambar Fullscreen */
        .modal-content {
            background: rgba(0, 0, 0, 0.9);
            color: white;
            border: none;
            border-radius: 15px;
            text-align: center;
            padding: 20px;
        }

        .modal-img {
            max-height: 70vh;
            width: auto;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 0 20px rgba(255,255,255,0.2);
        }

        /* Footer */
        footer {
            background: var(--primary-green);
            color: white;
            text-align: center;
            padding: 35px 0;
            margin-top: 80px;
            border-top-left-radius: 25px;
            border-top-right-radius: 25px;
            box-shadow: 0 -5px 20px rgba(0,0,0,0.1);
        }

        footer a {
            color: #4FFF70;
            text-decoration: none;
        }

        footer a:hover {
            color: white;
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .hero h1 { font-size: 2.3rem; }
            .hero p { font-size: 1rem; }
            .hero-logo { width: 130px; height: 130px; }
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark py-3">
        <div class="container">
            <a class="navbar-brand" href="{{ route('plants.index') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Logo Platycerium">
                ℙ𝕃𝔸𝕋𝕐ℂ𝔼ℝ𝕀𝕌𝕄 𝔾𝔸𝕃𝕃𝔼ℝ𝕐
            </a>
            <div>
                <a href="{{ route('plants.create') }}" class="btn btn-light text-success fw-semibold shadow-sm">+ Tambah Tanaman</a>
            </div>
        </div>
    </nav>

    <!-- Hero -->
    <section class="hero">
        <img src="{{ asset('images/logo.png') }}" alt="Logo Hero" class="hero-logo">
        <div class="container">
            <h1>𝙎𝙚𝙡𝙖𝙢𝙖𝙩 𝘿𝙖𝙩𝙖𝙣𝙜 𝙙𝙞 𝙂𝙖𝙡𝙚𝙧𝙞 𝙋𝙡𝙖𝙩𝙮𝙘𝙚𝙧𝙞𝙪𝙢</h1>
            <p>𝓟𝓵𝓪𝓽𝔂𝓬𝓮𝓻𝓲𝓾𝓶, 𝓪𝓽𝓪𝓾 𝓽𝓪𝓷𝓭𝓾𝓴 𝓻𝓾𝓼𝓪, 𝓪𝓭𝓪𝓵𝓪𝓱 𝓽𝓪𝓷𝓪𝓶𝓪𝓷 𝓹𝓪𝓴𝓾 𝓾𝓷𝓲𝓴 𝓭𝓮𝓷𝓰𝓪𝓷 𝓫𝓮𝓷𝓽𝓾𝓴 𝓭𝓪𝓾𝓷 𝓶𝓮𝓷𝔂𝓮𝓻𝓾𝓹𝓪𝓲 𝓽𝓪𝓷𝓭𝓾𝓴 𝔂𝓪𝓷𝓰 𝓲𝓷𝓭𝓪𝓱 𝓭𝓪𝓷 𝓮𝓴𝓼𝓸𝓽𝓲𝓼.</p>
        </div>
    </section>

    <!-- Main -->
    <div class="container py-5 fade-in">
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
            <h2 class="fw-bold text-success">𝑲𝒐𝒍𝒆𝒌𝒔𝒊 𝑻𝒂𝒏𝒂𝒎𝒂𝒏 𝑲𝒂𝒎𝒊</h2>
            <form method="GET" action="{{ route('plants.index') }}" class="d-flex search-bar mt-3 mt-md-0">
                <input type="text" name="search" class="form-control me-2 rounded-pill shadow-sm" placeholder="🔍 Cari Tanaman..." value="{{ request('search') }}">
                <button class="btn btn-success">Cari</button>
            </form>
        </div>

        @if(session('success'))
            <div class="alert alert-success text-center shadow-sm rounded-pill">{{ session('success') }}</div>
        @endif

        <div class="row g-4">
            @forelse($plants as $plant)
                <div class="col-lg-4 col-md-6 fade-in">
                    <div class="card h-100">
                        @if($plant->image)
                            <img src="{{ asset('images/' . $plant->image) }}"
                                 class="card-img-top"
                                 alt="{{ $plant->name }}"
                                 data-name="{{ $plant->name }}"
                                 data-description="{{ $plant->description }}">
                        @else
                            <div class="bg-light text-muted text-center p-5">Tidak ada gambar</div>
                        @endif

                        <!-- Bagian card body dengan waktu dibuat & diperbarui -->
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $plant->name }}</h5>

                            <div class="card-date">
                                <p class="mb-1">
                                    🗓️ <strong>Dibuat:</strong>
                                    {{ \Carbon\Carbon::parse($plant->created_at)->setTimezone('Asia/Jakarta')->translatedFormat('d F Y') }} <br>
                                    🕒 {{ \Carbon\Carbon::parse($plant->created_at)->setTimezone('Asia/Jakarta')->format('H:i') }} WIB
                                </p>

                                @if($plant->updated_at && $plant->updated_at != $plant->created_at)
                                    <p class="text-muted mb-0">
                                        🔄 <strong>Diperbarui:</strong>
                                        {{ \Carbon\Carbon::parse($plant->updated_at)->setTimezone('Asia/Jakarta')->translatedFormat('d F Y') }} <br>
                                        🕘 {{ \Carbon\Carbon::parse($plant->updated_at)->setTimezone('Asia/Jakarta')->format('H:i') }} WIB
                                    </p>
                                @endif
                            </div>

                            <p class="card-text text-muted mt-3">{{ \Illuminate\Support\Str::limit($plant->description, 100) }}</p>

                            <div class="mt-auto d-flex justify-content-between">
                                <a href="{{ route('plants.edit', $plant) }}" class="btn btn-warning btn-sm shadow-sm">Edit</a>
                                <form action="{{ route('plants.destroy', $plant) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm shadow-sm" onclick="return confirm('Hapus tanaman ini?')">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center mt-5">
                    <img src="{{ asset('images/iconplatycerium.png') }}" width="120" alt="no plants">
                    <p class="text-muted mt-3">Belum ada tanaman yang ditambahkan</p>
                </div>
            @endforelse
        </div>

        <div class="d-flex justify-content-center mt-5">
            {{ $plants->links() }}
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p class="mb-1">&copy; {{ date('Y') }} <strong>Platycerium Gallery</strong> | Dibuat oleh Deva Okta</p>
        <small><a href="https://www.tiktok.com/@tuanplaty?is_from_webapp=1&sender_device=pc" target="_blank">Ikuti kami di TikTok</a></small>
    </footer>

    <!-- Modal Fullscreen Gambar -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content text-center">
                <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3" data-bs-dismiss="modal"></button>
                <img id="modalImage" src="" alt="" class="modal-img mb-3">
                <h3 id="modalName" class="fw-bold mb-3"></h3>
                <p id="modalDescription" class="text-light px-4"></p>
            </div>
        </div>
    </div>

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', () => {
            document.querySelector('.navbar').classList.toggle('scrolled', window.scrollY > 50);
        });

        // Modal Gambar Fullscreen
        document.addEventListener('DOMContentLoaded', () => {
            const modal = new bootstrap.Modal(document.getElementById('imageModal'));
            const modalImage = document.getElementById('modalImage');
            const modalName = document.getElementById('modalName');
            const modalDescription = document.getElementById('modalDescription');

            document.querySelectorAll('.card-img-top').forEach(img => {
                img.addEventListener('click', () => {
                    modalImage.src = img.src;
                    modalName.textContent = img.dataset.name;
                    modalDescription.textContent = img.dataset.description;
                    modal.show();
                });
            });
        });
    </script>
</body>
</html>
