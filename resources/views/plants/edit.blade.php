<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Edit Plant — Platycerium Gallery</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Playfair+Display:wght@600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root{
            --accent: #2e7d32;
            --accent-dark: #1b5e20;
            --muted: #6b7280;
            --card-radius: 14px;
        }

        body{
            font-family: "Inter", system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
            background: linear-gradient(180deg, #f6fdf8 0%, #f1f7f3 100%);
            color: #0f172a;
            -webkit-font-smoothing:antialiased;
        }

        .container-edit {
            max-width: 920px;
            margin-top: 70px;
            margin-bottom: 60px;
        }

        /* Header */
        .page-header {
            display:flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
        }
        .brand-title {
            font-family: "Playfair Display", serif;
            color: var(--accent);
            font-size: 1.5rem;
            margin:0;
        }
        .subtle {
            color: var(--muted);
            font-size: .95rem;
        }

        /* Card */
        .card-edit {
            border: none;
            border-radius: var(--card-radius);
            box-shadow: 0 8px 30px rgba(16,24,40,0.06);
            overflow: hidden;
        }

        .card-body {
            padding: 1.5rem;
        }

        /* Form layout */
        label.form-label {
            font-weight: 600;
            color: #0f172a;
        }

        .input-focus:focus {
            border-color: var(--accent);
            box-shadow: 0 4px 18px rgba(46,125,50,0.12);
        }

        /* Drop zone */
        .dropzone {
            border: 2px dashed rgba(46,125,50,0.14);
            border-radius: 12px;
            padding: 18px;
            text-align: center;
            cursor: pointer;
            transition: all .18s ease;
            background: linear-gradient(180deg, rgba(255,255,255,0.6), rgba(255,255,255,0.4));
        }

        .dropzone.dragover {
            border-color: var(--accent);
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(46,125,50,0.08);
        }

        .thumb {
            display: inline-block;
            border-radius: 10px;
            overflow: hidden;
            border: 1px solid rgba(15,23,42,0.06);
            box-shadow: 0 6px 18px rgba(15,23,42,0.04);
        }

        .thumb img {
            display:block;
            width: 200px;
            height: auto;
            object-fit: cover;
        }

        .meta-note {
            font-size: .88rem;
            color: var(--muted);
        }

        /* Buttons */
        .btn-primary {
            background: linear-gradient(180deg, var(--accent) 0%, var(--accent-dark) 100%);
            border: none;
            padding: 0.6rem 1.1rem;
            border-radius: 10rem;
            box-shadow: 0 8px 20px rgba(46,125,50,0.12);
            font-weight: 600;
        }

        .btn-outline-secondary {
            border-radius: 10rem;
            padding: .55rem 0.9rem;
        }

        /* Errors */
        .alert-list li { margin-bottom: .25rem; }

        /* Footer actions */
        .actions {
            display:flex;
            gap: .6rem;
            align-items:center;
        }

        /* small screens */
        @media (max-width: 575px){
            .thumb img { width: 140px; }
            .brand-title { font-size: 1.25rem; }
        }
    </style>
</head>
<body>
    <div class="container container-edit">
        <!-- Header -->
        <div class="page-header mb-4">
            <div>
                <h1 class="brand-title">Edit Tanaman</h1>
                <div class="subtle">Perbarui detail tanaman — Platycerium Gallery</div>
            </div>

            <div class="text-end">
                <a href="{{ route('plants.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </div>

        <!-- Card -->
        <div class="card card-edit">
            <div class="card-body">
                <!-- Validation errors -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong class="d-block">Periksa input Anda:</strong>
                        <ul class="mb-0 alert-list">
                            @foreach ($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('plants.update', $plant) }}" method="POST" enctype="multipart/form-data" id="editForm" novalidate>
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="old_image" value="{{ $plant->image }}">
                    <div class="row g-3">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label class="form-label">Nama</label>
                                <input name="name" class="form-control input-focus" value="{{ old('name', $plant->name) }}" required maxlength="120" placeholder="Contoh: Platycerium bifurcatum">
                                <div class="form-text meta-note">Nama yang jelas akan membantu pencarian dan katalog.</div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Deskripsi</label>
                                <textarea name="description" rows="6" class="form-control input-focus" required maxlength="250" placeholder="Tuliskan deskripsi singkat tentang tanaman...">{{ old('description', $plant->description) }}</textarea>
                                <div class="form-text meta-note">Maks 250 karakter — tampil di kartu koleksi.</div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Kategori (opsional)</label>
                                <input name="category" class="form-control input-focus" value="{{ old('category', $plant->category ?? '') }}" placeholder="Contoh: Epiphyte / Indoor">
                            </div>

                            <div class="d-flex gap-2 align-items-center mt-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-save2-fill"></i> Perbarui
                                </button>
                                <a href="{{ route('plants.index') }}" class="btn btn-outline-secondary">Batal</a>

                                <!-- optional delete: -->
                                <form action="{{ route('plants.destroy', $plant) }}" method="POST" class="ms-auto" onsubmit="return confirm('Yakin ingin menghapus tanaman ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash-fill"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </div>

                        <!-- Right column: image preview + upload -->
                        <div class="col-md-4">
                            <label class="form-label">Foto Tanaman</label>

                            <div id="dropzone" class="dropzone" tabindex="0" title="Klik untuk pilih gambar atau seret file ke sini">
                                <input id="imageInput" name="image" type="file" accept="image/*" style="display:none;">
                                <div id="dzContent">
                                    <div class="mb-2">
                                        <i class="bi bi-cloud-arrow-up" style="font-size:28px; color:var(--accent)"></i>
                                    </div>
                                    <div><strong>Tarik & Lepas</strong> atau klik untuk memilih</div>
                                    <div class="form-text meta-note mt-2">PNG/JPG — maksimal 3MB</div>
                                </div>
                            </div>

                            <div class="mt-3 d-flex align-items-center gap-3">
                                @if($plant->image)
                                    <div class="thumb" id="currentThumb" role="button" data-bs-toggle="modal" data-bs-target="#imageModal">
                                        <img src="{{ asset('images/' . $plant->image) }}" alt="Current image">
                                    </div>
                                @else
                                    <div class="thumb" id="currentThumb" style="display:none;">
                                        <img src="#" alt="Current image">
                                    </div>
                                @endif

                                <div>
                                    <div class="meta-note">Gambar saat ini</div>
                                    @if($plant->image)
                                        <div class="fw-semibold">{{ $plant->name }}</div>
                                        <div class="meta-note">{{ \Carbon\Carbon::parse($plant->created_at)->translatedFormat('d F Y') }}</div>
                                    @else
                                        <div class="meta-note">Belum ada gambar</div>
                                    @endif
                                </div>
                            </div>

                            <!-- preview for newly chosen file -->
                            <div class="mt-3" id="previewArea" style="display:none;">
                                <div class="meta-note mb-2">Preview baru</div>
                                <div class="thumb" id="previewThumb"><img src="#" alt="Preview"></div>
                                <div class="mt-2">
                                    <button type="button" id="removePreview" class="btn btn-sm btn-outline-secondary mt-2">Hapus preview</button>
                                </div>
                            </div>

                            <div class="mt-3">
                                <div id="fileError" class="text-danger small" style="display:none;"></div>
                            </div>
                        </div>
                    </div>
                </form>

                <!-- Modal: full image -->
                <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered modal-sm">
                    <div class="modal-content">
                      <div class="modal-body p-0">
                        @if($plant->image)
                          <img src="{{ asset('images/' . $plant->image) }}" alt="Large" style="width:100%; display:block;">
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>

        <!-- small note -->
        <div class="text-center mt-3 subtle">Tip: Gunakan gambar landscape (min width 800px) untuk hasil terbaik di galeri.</div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Elements
        const dropzone = document.getElementById('dropzone');
        const imageInput = document.getElementById('imageInput');
        const previewArea = document.getElementById('previewArea');
        const previewThumb = document.getElementById('previewThumb');
        const previewImg = previewThumb?.querySelector('img');
        const removePreview = document.getElementById('removePreview');
        const fileError = document.getElementById('fileError');

        // Config
        const MAX_SIZE = 3 * 1024 * 1024; // 3MB
        const ALLOWED_TYPES = ['image/jpeg','image/png','image/webp'];

        // Click to open file dialog
        dropzone.addEventListener('click', () => imageInput.click());
        dropzone.addEventListener('keydown', (e) => {
            if (e.key === 'Enter' || e.key === ' ') imageInput.click();
        });

        // Drag events
        ['dragenter','dragover'].forEach(evt => {
            dropzone.addEventListener(evt, (e) => {
                e.preventDefault(); e.stopPropagation();
                dropzone.classList.add('dragover');
            });
        });
        ['dragleave','dragend','drop'].forEach(evt => {
            dropzone.addEventListener(evt, (e) => {
                e.preventDefault(); e.stopPropagation();
                dropzone.classList.remove('dragover');
            });
        });

        // Handle drop
        dropzone.addEventListener('drop', (e) => {
            const dt = e.dataTransfer;
            if (dt && dt.files && dt.files.length) handleFile(dt.files[0]);
        });

        // Handle file select
        imageInput.addEventListener('change', (e) => {
            const f = e.target.files[0];
            if (f) handleFile(f);
        });

        // Validate & show preview
        function handleFile(file) {
            fileError.style.display = 'none';
            fileError.textContent = '';
            if (!ALLOWED_TYPES.includes(file.type)) {
                fileError.style.display = 'block';
                fileError.textContent = 'Tipe file tidak didukung. Gunakan JPG/PNG/WEBP.';
                imageInput.value = '';
                return;
            }
            if (file.size > MAX_SIZE) {
                fileError.style.display = 'block';
                fileError.textContent = 'Ukuran file terlalu besar. Maks 3MB.';
                imageInput.value = '';
                return;
            }

            // show preview
            const url = URL.createObjectURL(file);
            if (previewImg) {
                previewImg.src = url;
                previewArea.style.display = 'block';

                // hide current thumb preview for clarity
                const current = document.getElementById('currentThumb');
                if (current) current.style.display = 'none';
            }
        }

        // remove preview
        removePreview.addEventListener('click', () => {
            imageInput.value = '';
            previewArea.style.display = 'none';
            fileError.style.display = 'none';

            const current = document.getElementById('currentThumb');
            if (current) current.style.display = '';
        });

        // Simple client-side required validation before submit
        document.getElementById('editForm').addEventListener('submit', function(e) {
            const name = this.querySelector('[name="name"]');
            const desc = this.querySelector('[name="description"]');
            if (!name.value.trim() || !desc.value.trim()) {
                e.preventDefault();
                alert('Nama dan deskripsi wajib diisi.');
                return false;
            }
            // allow submit: server-side validation will still run
        });
    </script>
</body>
</html>
