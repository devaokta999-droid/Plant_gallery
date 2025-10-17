<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Platycerium Gallery — Premium</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Google Fonts (Premium pairing) -->
    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:wght@400;700&family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap (kept for compatibility with Blade routes/pagination) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root{
            --bg:#fbfcfb;
            --muted:#6b6b6b;
            --accent:#0b6b3a; /* deep green */
            --accent-2:#79b884; /* softer green */
            --glass: rgba(255,255,255,0.6);
            --card: #ffffff;
            --radius-lg: 18px;
            --radius-md: 12px;
            --shadow-1: 0 6px 24px rgba(11,107,58,0.08);
            --shadow-2: 0 12px 40px rgba(11,107,58,0.06);
        }

        /* Reset & base */
        *{box-sizing:border-box}
        html,body{height:100%}
        body{
            margin:0;
            background: linear-gradient(180deg, var(--bg) 0%, #f4fbf6 100%);
            font-family: 'Inter', system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial;
            color:#13241b;
            -webkit-font-smoothing:antialiased;
            -moz-osx-font-smoothing:grayscale;
            overflow-x:hidden;
        }

        /* Navigation */
        .navbar{
            position:fixed;top:18px;left:50%;transform:translateX(-50%);
            width:calc(100% - 48px);max-width:1200px;border-radius:14px;padding:12px 18px;
            background: linear-gradient(180deg, rgba(255,255,255,0.6), rgba(255,255,255,0.45));
            box-shadow:var(--shadow-1);
            backdrop-filter: blur(8px) saturate(120%);
            border:1px solid rgba(11,107,58,0.06);
            z-index:1100;transition:all .35s ease;
        }
        .navbar.scrolled{box-shadow:var(--shadow-2);transform:translateX(-50%) translateY(-6px)}

        .navbar-brand{
            display:flex;align-items:center;gap:14px;font-weight:700;font-family:'Libre Baskerville', serif;color:var(--accent);
        }
        .nav-logo{width:54px;height:54px;border-radius:12px;overflow:hidden;display:inline-block;background:linear-gradient(135deg,var(--accent-2),var(--accent));padding:6px}
        .nav-logo img{width:100%;height:100%;object-fit:cover;border-radius:8px;filter:grayscale(.02);}

        .btn-add{
            border-radius:999px;padding:.5rem 1.15rem;font-weight:600;box-shadow:0 6px 18px rgba(11,107,58,0.12);
        }

        /* Hero */
        .hero{
            height:72vh;min-height:480px;display:flex;align-items:center;justify-content:center;padding:120px 18px 40px;position:relative;overflow:hidden;
            background: linear-gradient(145deg, rgba(10,73,33,0.06), rgba(12,88,42,0.03)), url('https://images.unsplash.com/photo-1613743989442-f2b2736b9b32?auto=format&fit=crop&w=1950&q=80') center/cover no-repeat;
            border-bottom-left-radius:40px;border-bottom-right-radius:40px;
        }
        .hero-overlay{position:absolute;inset:0;background:linear-gradient(180deg, rgba(255,255,255,0.15), rgba(248,251,249,0.75));mix-blend-mode:normal}

        .hero-inner{z-index:2;display:flex;gap:40px;align-items:center;max-width:1200px;width:100%;padding:20px}
        .hero-card{flex:1;background:linear-gradient(180deg, rgba(255,255,255,0.85), rgba(255,255,255,0.95));border-radius:20px;padding:28px;box-shadow:var(--shadow-1);backdrop-filter: blur(6px);}

        .hero-logo{width:180px;height:180px;border-radius:16px;overflow:hidden;display:block;margin:auto;box-shadow:0 12px 30px rgba(11,107,58,0.08);}
        .hero-logo img{width:100%;height:100%;object-fit:cover}

        .hero h1{font-family:'Libre Baskerville', serif;font-size:2.6rem;margin:8px 0 6px;color:#0e3622;letter-spacing:.2px}
        .hero p{color:var(--muted);font-size:1.05rem;line-height:1.6}

        /* Search & header */
        .collection-header{display:flex;align-items:center;justify-content:space-between;gap:16px;margin-top:-26px;max-width:1200px;margin-left:auto;margin-right:auto;padding:0 18px}
        .collection-header h2{font-family:'Libre Baskerville', serif;color:#0b6b3a;margin:0}

        .search-bar .form-control{border-radius:999px;padding:12px 16px;background:linear-gradient(90deg,#ffffff,#fbfffb);border:1px solid rgba(11,107,58,0.06);box-shadow:0 6px 18px rgba(11,107,58,0.04)}
        .search-bar .btn-success{border-radius:999px;padding:.5rem 1rem;background:var(--accent);border:none}

        /* Cards grid */
        .gallery{max-width:1200px;margin:28px auto;padding:8px 18px}
        .card-plant{border-radius:16px;border:none;background:var(--card);overflow:hidden;box-shadow:var(--shadow-1);transition:transform .35s ease, box-shadow .35s ease}
        .card-plant:hover{transform:translateY(-10px);box-shadow:var(--shadow-2)}

        .card-img-top{height:260px;object-fit:cover;display:block;width:100%;transition:transform .6s ease}
        .card-plant:hover .card-img-top{transform:scale(1.06)}

        .card-body{padding:18px}
        .card-title{font-weight:700;color:#123e2a;margin-bottom:6px}
        .card-date{font-size:.9rem;color:var(--muted)}
        .card-text{text-overflow:ellipsis;overflow:hidden;display:-webkit-box;-webkit-line-clamp:3;-webkit-box-orient:vertical;color:#42514a}

        .card-controls a,.card-controls button{min-width:86px}

        /* Empty state */
        .empty-state{padding:40px;border-radius:14px;background:linear-gradient(180deg,#fff,#f7fff8);box-shadow:0 6px 20px rgba(11,107,58,0.04);}

        /* Footer */
        footer{margin-top:48px;background:linear-gradient(180deg,var(--accent),var(--accent-2));color:white;padding:40px 18px;border-top-left-radius:28px;border-top-right-radius:28px}
        footer a{color:rgba(255,255,255,0.92)}

        /* Modal */
        .modal-content{background:linear-gradient(180deg,#05140a, #0a2a19);border-radius:14px;border:none}
        .modal .modal-img{max-height:70vh;width:auto;border-radius:10px;display:block;margin:0 auto}
        .modal h3{color:#fff}
        .modal p{color:rgba(255,255,255,0.85)}

        /* Responsive tweaks */
        @media (max-width:992px){
            .hero-inner{flex-direction:column;text-align:center}
            .hero-logo{width:140px;height:140px}
            .hero h1{font-size:1.8rem}
            .collection-header{flex-direction:column;align-items:flex-start}
        }

        @media (max-width:576px){
            .navbar{left:12px;transform:none;width:calc(100% - 24px)}
            .hero{padding-top:100px}
        }

        /* Subtle focus styles for accessibility */
        a:focus,button:focus,input:focus{outline:3px solid rgba(11,107,58,0.12);outline-offset:2px}

        /* Small animation utility */
        .fade-in-up{opacity:0;transform:translateY(12px);animation:fadeUp .7s ease forwards}
        @keyframes fadeUp{to{opacity:1;transform:none}}

    </style>
</head>
<body>

    <!-- Navbar (functional Blade placeholders preserved) -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid d-flex align-items-center justify-content-between px-3">
            <a class="navbar-brand" href="{{ route('plants.index') }}">
                <span class="nav-logo"><img src="{{ asset('images/logo.png') }}" alt="logo"></span>
                <span style="font-size:1.05rem;">Platycerium <small style="display:block;font-weight:600;letter-spacing:.6px;color:var(--accent-2);font-size:.72rem">Gallery</small></span>
            </a>

            <div class="d-flex gap-2 align-items-center">
                <a href="{{ route('plants.create') }}" class="btn btn-light btn-add shadow-sm"> <i class="bi bi-plus-lg me-2 text-success"></i>Tambah Tanaman</a>
            </div>
        </div>
    </nav>

    <!-- Hero -->
    <section class="hero">
        <div class="hero-overlay" aria-hidden="true"></div>
        <div class="hero-inner container fade-in-up">
            <div class="hero-card">
                <div class="row align-items-center g-3">
                    <div class="col-md-4 text-center">
                        <div class="hero-logo">
                            <img src="{{ asset('images/logo.png') }}" alt="Logo Hero">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <h1>Selamat Datang di Galeri Platycerium</h1>
                        <p>Platycerium, atau "tanduk rusa", adalah tanaman paku epifit yang memikat dengan daun menyerupai tanduk. Jelajahi koleksi kami, tambahkan tanaman baru, dan pelajari cerita di balik setiap specimen.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content Header (kept features) -->
    <div class="collection-header container mt-4">
        <h2 class="fw-bold">Koleksi Tanaman Kami</h2>

        <form method="GET" action="{{ route('plants.index') }}" class="d-flex search-bar">
            <input type="text" name="search" class="form-control me-2" placeholder="🔍 Cari Tanaman..." value="{{ request('search') }}">
            <button class="btn btn-success">Cari</button>
        </form>
    </div>

    <main class="gallery">
        <div class="container">

            @if(session('success'))
                <div class="alert alert-success text-center shadow-sm rounded-pill fade-in-up">{{ session('success') }}</div>
            @endif

            <div class="row g-4 mt-3">
                @forelse($plants as $plant)
                    <div class="col-lg-4 col-md-6 d-flex fade-in-up">
                        <div class="card card-plant w-100">
                            @if($plant->image)
                                <img src="{{ asset('images/' . $plant->image) }}"
                                     class="card-img-top"
                                     alt="{{ $plant->name }}"
                                     loading="lazy"
                                     data-name="{{ $plant->name }}"
                                     data-description="{{ $plant->description }}">
                            @else
                                <div class="bg-light text-muted text-center p-5">Tidak ada gambar</div>
                            @endif

                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $plant->name }}</h5>

                                <div class="card-date mb-2">
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

                                <p class="card-text text-muted mt-2">{{ \Illuminate\Support\Str::limit($plant->description, 100) }}</p>

                                <div class="mt-auto d-flex justify-content-between card-controls">
                                    <a href="{{ route('plants.edit', $plant) }}" class="btn btn-outline-warning btn-sm shadow-sm">Edit</a>
                                    <form action="{{ route('plants.destroy', $plant) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-outline-danger btn-sm shadow-sm" onclick="return confirm('Hapus tanaman ini?')">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="text-center empty-state">
                            <img src="{{ asset('images/iconplatycerium.png') }}" width="120" alt="no plants">
                            <p class="text-muted mt-3">Belum ada tanaman yang ditambahkan</p>
                        </div>
                    </div>
                @endforelse
            </div>

            <div class="d-flex justify-content-center mt-5">
                {{ $plants->links() }}
            </div>

        </div>
    </main>

    <!-- Footer (content preserved) -->
    <footer>
        <div class="container text-center">
            <p class="mb-1">&copy; {{ date('Y') }} <strong>Platycerium Gallery</strong> | Dibuat oleh Deva Okta</p>

            <div class="mb-2">
                <p class="mb-1"><i class="bi bi-telephone-fill me-1"></i><strong>Telepon:</strong> <a href="tel:+6285333634884">+62 8533634884</a></p>
                <p class="mb-1"><i class="bi bi-envelope-fill me-1"></i><strong>Email:</strong> <a href="mailto:platycerium.gallery@gmail.com">platycerium.gallery@gmail.com</a></p>
                <p class="mb-1"><i class="bi bi-instagram me-1"></i><strong>Instagram:</strong> <a href="https://www.instagram.com/platycerium.gallery" target="_blank">@platycerium.gallery</a></p>
                <p class="mb-1"><i class="bi bi-tiktok me-1"></i><strong>TikTok:</strong> <a href="https://www.tiktok.com/@tuanplaty?is_from_webapp=1&sender_device=pc" target="_blank">@Tuanplaty</a></p>
            </div>

            <small class="text-light">Terima kasih telah mengunjungi Galeri Tanaman Platycerium 🌿</small>
        </div>
    </footer>

    <!-- Modal Fullscreen Gambar (preserved structure, modernized styling) -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content text-center p-4">
                <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Tutup"></button>
                <img id="modalImage" src="" alt="" class="modal-img mb-3 img-fluid">
                <h3 id="modalName" class="fw-bold mb-3"></h3>
                <p id="modalDescription" class="px-3"></p>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', () => {
            const nav = document.querySelector('.navbar');
            nav.classList.toggle('scrolled', window.scrollY > 40);
        });

        // Modal: keyboard accessible + graceful image loading
        document.addEventListener('DOMContentLoaded', () => {
            const modalEl = document.getElementById('imageModal');
            const modal = new bootstrap.Modal(modalEl);
            const modalImage = document.getElementById('modalImage');
            const modalName = document.getElementById('modalName');
            const modalDescription = document.getElementById('modalDescription');

            document.querySelectorAll('.card-img-top').forEach(img => {
                img.addEventListener('click', () => openModal(img));
                img.addEventListener('keydown', (e) => { if(e.key === 'Enter' || e.key === ' ') openModal(img); });
                img.setAttribute('tabindex', '0'); // make focusable
                img.setAttribute('role', 'button');
            });

            function openModal(img){
                modalImage.src = img.src;
                modalName.textContent = img.dataset.name || '';
                modalDescription.textContent = img.dataset.description || '';
                modal.show();
            }

            // Improve image loading: show low-res blurred placeholder if desired (requires server-side)
        });
    </script>
</body>
</html>