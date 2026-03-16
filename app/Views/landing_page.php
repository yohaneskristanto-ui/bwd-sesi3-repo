<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Melody Music Store | Alat Musik Berkualitas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700&family=Inter:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f0f2f5; }
        h1, h2, h3, .navbar-brand { font-family: 'Poppins', sans-serif; }

        /* Animasi */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .product-item { animation: fadeInUp 0.5s ease backwards; }
        
        /* Card Styling */
        .product-card { 
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1); 
            border: none; border-radius: 16px; overflow: hidden; background: #fff;
        }
        .product-card:hover { transform: translateY(-10px); box-shadow: 0 15px 30px rgba(0,0,0,0.12); }
        .card-img-top { height: 180px; object-fit: cover; }

        /* UI Elements */
        .badge-category { 
            position: absolute; top: 12px; left: 12px; 
            background: rgba(13, 110, 253, 0.9); backdrop-filter: blur(4px);
            color: white; padding: 4px 12px; border-radius: 50px; 
            font-size: 0.7rem; font-weight: 600;
        }
        .star-rating { color: #ffc107; font-size: 0.85rem; }
        .btn-filter.active { background-color: #0d6efd !important; color: white !important; }
        
        /* Modal Styling */
        .cart-item-img { width: 50px; height: 50px; object-fit: cover; border-radius: 8px; }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top shadow">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">
                <i class="fa-solid fa-guitar text-warning me-2"></i>MELODY MUSIC
            </a>
            <button class="btn btn-outline-light position-relative rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#cartModal">
                <i class="fa-solid fa-cart-shopping me-1"></i>
                <span id="cart-badge" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">0</span>
            </button>
        </div>
    </nav>

    <header class="bg-dark text-white text-center py-5" style="background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('https://images.unsplash.com/photo-1511192336575-5a79af67a629?auto=format&fit=crop&q=80&w=1200'); background-size: cover; background-position: center;">
        <div class="container py-3">
            <h1 class="display-5 fw-bold mb-2">ALAT MUSIK ORIGINAL & BERKUALITAS</h1>
            <p class="lead opacity-75">Temukan instrumen impianmu dari berbagai brand ternama dunia.</p>
        </div>
    </header>

    <main class="container my-5">
        
        <section class="mb-5">
            <div class="row align-items-center mb-4">
                <div class="col-md-6">
                    <h2 class="fw-bold m-0 text-dark">Katalog Produk</h2>
                    <div id="filter-buttons" class="mt-3 d-flex gap-2 flex-wrap">
                        <button class="btn btn-outline-secondary btn-sm rounded-pill px-3 btn-filter active" onclick="filterKategori('all', this)">Semua</button>
                        <button class="btn btn-outline-secondary btn-sm rounded-pill px-3 btn-filter" onclick="filterKategori('Gitar & Bass', this)">Gitar & Bass</button>
                        <button class="btn btn-outline-secondary btn-sm rounded-pill px-3 btn-filter" onclick="filterKategori('Keyboard & Piano', this)">Keyboard & Piano</button>
                        <button class="btn btn-outline-secondary btn-sm rounded-pill px-3 btn-filter" onclick="filterKategori('Drum & Perkusi', this)">Drum & Perkusi</button>
                        <button class="btn btn-outline-secondary btn-sm rounded-pill px-3 btn-filter" onclick="filterKategori('Aksesoris', this)">Aksesoris</button>
                    </div>
                </div>
                <div class="col-md-6 text-md-end mt-3 mt-md-0">
                    <button id="btn-tampilkan-produk" class="btn btn-success px-4 shadow-sm rounded-pill fw-bold">
                        <i class="fa-solid fa-play me-2"></i>Muat Katalog
                    </button>
                </div>
            </div>
            
            <div id="katalog-container" class="row g-4">
                <div class="col-12 text-center text-muted py-5">
                    <i class="fa-solid fa-music fa-3x mb-3 opacity-25"></i>
                    <p>Mulai memuat data untuk melihat koleksi alat musik kami.</p>
                </div>
            </div>
        </section>

        <section class="bg-white p-4 rounded-4 shadow-sm border mb-5">
            <div class="row g-4 align-items-center">
                <div class="col-md-6 border-md-end">
                    <p class="text-muted small mb-1 text-uppercase fw-bold">Estimasi Total</p>
                    <h2 id="display-total" class="fw-bold text-dark m-0">Rp 0</h2>
                    <div id="promo-alert" class="alert alert-primary d-none mt-3 border-0 py-2">
                        <small><i class="fa-solid fa-bolt me-2"></i><span id="promo-text"></span></small>
                    </div>
                </div>
                <div class="col-md-6 ps-md-4">
                    <div class="input-group mb-3">
                        <input type="text" id="input-voucher" class="form-control rounded-start-pill border-end-0 ps-3" placeholder="Kode: DISKON20">
                        <button class="btn btn-dark rounded-end-pill px-4" id="btn-klaim-voucher">Pakai</button>
                    </div>
                    <button id="btn-checkout" class="btn btn-primary btn-lg w-100 fw-bold disabled rounded-pill shadow-sm">
                        Checkout Sekarang <i class="fa-solid fa-arrow-right ms-2"></i>
                    </button>
                </div>
            </div>
        </section>
    </main>

    <div class="modal fade" id="cartModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 border-0 shadow">
                <div class="modal-header border-0">
                    <h5 class="modal-title fw-bold"><i class="fa-solid fa-cart-shopping me-2"></i>Isi Keranjang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body py-0">
                    <div id="cart-items-list">
                        <p class="text-center text-muted py-4">Keranjang masih kosong...</p>
                    </div>
                </div>
                <div class="modal-footer border-0 d-flex flex-column">
                    <div class="d-flex justify-content-between w-100 mb-2">
                        <span class="fw-bold">Subtotal:</span>
                        <span id="modal-subtotal" class="fw-bold text-primary">Rp 0</span>
                    </div>
                    <button class="btn btn-danger btn-sm w-100 rounded-pill mb-2" onclick="resetKeranjang()">Kosongkan Keranjang</button>
                    <button class="btn btn-primary w-100 rounded-pill fw-bold" data-bs-dismiss="modal">Lanjut Belanja</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const dataProduk = [
            { id: 1, nama: "Yamaha F310 Gitar Akustik", harga: 1650000, kategori: "Gitar & Bass", rating: 4.8, reviews: 324, img: "https://images.unsplash.com/photo-1550291652-6ea9114a47b1?w=400" },
            { id: 2, nama: "Roland GO:KEYS Keyboard", harga: 5800000, kategori: "Keyboard & Piano", rating: 4.9, reviews: 145, img: "https://images.unsplash.com/photo-1552422535-c45813c61732?w=400" },
            { id: 3, nama: "Fender Stratocaster Elektrik", harga: 15500000, kategori: "Gitar & Bass", rating: 5.0, reviews: 412, img: "https://images.unsplash.com/photo-1564186763535-ebb21ef5277f?w=400" },
            { id: 4, nama: "Pearl Roadshow Drum Set", harga: 8500000, kategori: "Drum & Perkusi", rating: 4.7, reviews: 89, img: "https://images.unsplash.com/photo-1519892300165-cb5542fb47c7?w=400" },
            { id: 5, nama: "Zildjian Planet Z Cymbal Set", harga: 2300000, kategori: "Drum & Perkusi", rating: 4.6, reviews: 156, img: "https://images.unsplash.com/photo-1524368535928-5b5e00ddc76b?w=400" },
            { id: 6, nama: "Senar Gitar D'Addario EXL110", harga: 110000, kategori: "Aksesoris", rating: 4.9, reviews: 875, img: "https://images.unsplash.com/photo-1510915361894-db8b60106cb1?w=400" },
            { id: 7, nama: "Yamaha P-45 Digital Piano", harga: 7200000, kategori: "Keyboard & Piano", rating: 4.8, reviews: 210, img: "https://images.unsplash.com/photo-1520523839897-bd0b52f945a0?w=400" },
            { id: 8, nama: "Kabel Jack Instrumen 5m", harga: 85000, kategori: "Aksesoris", rating: 4.5, reviews: 320, img: "https://images.unsplash.com/photo-1574971842060-da8ccf5a6dc6?w=400" }
        ];

        let keranjang = [];
        let diskonPersen = 0;

        const container = document.getElementById('katalog-container');
        const badge = document.getElementById('cart-badge');
        const totalDisplay = document.getElementById('display-total');
        const btnCheckout = document.getElementById('btn-checkout');
        const cartItemsList = document.getElementById('cart-items-list');
        const modalSubtotal = document.getElementById('modal-subtotal');

        function render(filter = 'all') {
            container.innerHTML = '';
            const filtered = filter === 'all' ? dataProduk : dataProduk.filter(p => p.kategori === filter);
            
            filtered.forEach((p, index) => {
                const cardHtml = `
                    <div class="col-md-4 product-item" style="animation-delay: ${index * 0.1}s">
                        <div class="card product-card h-100 shadow-sm">
                            <span class="badge-category">${p.kategori}</span>
                            <img src="${p.img}" class="card-img-top" alt="${p.nama}">
                            <div class="card-body d-flex flex-column">
                                <h6 class="fw-bold mb-1">${p.nama}</h6>
                                <div class="mb-2">
                                    <span class="star-rating"><i class="fa-solid fa-star"></i> ${p.rating}</span>
                                    <span class="review-count">(${p.reviews})</span>
                                </div>
                                <p class="text-primary fw-bold mb-3 mt-auto">Rp ${p.harga.toLocaleString('id-ID')}</p>
                                <button class="btn btn-outline-dark btn-sm rounded-pill fw-bold" onclick="tambahKeKeranjang(${p.id})">
                                    <i class="fa-solid fa-cart-plus me-1"></i> Tambah
                                </button>
                            </div>
                        </div>
                    </div>`;
                container.innerHTML += cardHtml;
            });
        }

        window.tambahKeKeranjang = (id) => {
            const produk = dataProduk.find(p => p.id === id);
            keranjang.push(produk);
            updateUI();
        };

        function updateUI() {
            // Update Badge & Status Tombol
            badge.innerText = keranjang.length;
            if (keranjang.length > 0) btnCheckout.classList.remove('disabled');
            else btnCheckout.classList.add('disabled');
            
            // Hitung Total
            let subtotal = keranjang.reduce((sum, item) => sum + item.harga, 0);
            let total = subtotal - (subtotal * diskonPersen);
            totalDisplay.innerText = `Rp ${total.toLocaleString('id-ID')}`;
            modalSubtotal.innerText = `Rp ${subtotal.toLocaleString('id-ID')}`;

            // Render Isi Modal
            cartItemsList.innerHTML = '';
            if (keranjang.length === 0) {
                cartItemsList.innerHTML = '<p class="text-center text-muted py-4">Keranjang masih kosong...</p>';
            } else {
                keranjang.forEach((item, index) => {
                    cartItemsList.innerHTML += `
                        <div class="d-flex align-items-center mb-3 p-2 border-bottom">
                            <img src="${item.img}" class="cart-item-img me-3" alt="${item.nama}">
                            <div class="flex-grow-1">
                                <h6 class="mb-0 fw-bold small">${item.nama}</h6>
                                <small class="text-primary">Rp ${item.harga.toLocaleString('id-ID')}</small>
                            </div>
                            <button class="btn btn-sm text-danger" onclick="hapusSatu(${index})"><i class="fa-solid fa-trash-can"></i></button>
                        </div>`;
                });
            }
        }

        window.hapusSatu = (index) => {
            keranjang.splice(index, 1);
            updateUI();
        };

        window.resetKeranjang = () => {
            if(confirm('Kosongkan semua item di keranjang?')) {
                keranjang = [];
                updateUI();
            }
        };

        window.filterKategori = (kategori, element) => {
            document.querySelectorAll('.btn-filter').forEach(btn => btn.classList.remove('active'));
            element.classList.add('active');
            render(kategori);
        };

        document.getElementById('btn-tampilkan-produk').addEventListener('click', function() {
            render();
            this.innerHTML = '<i class="fa-solid fa-sync me-2"></i>Segarkan';
        });

        document.getElementById('btn-klaim-voucher').addEventListener('click', () => {
            const code = document.getElementById('input-voucher').value.trim().toUpperCase();
            if(code === 'DISKON20') {
                diskonPersen = 0.2;
                document.getElementById('promo-alert').classList.remove('d-none');
                document.getElementById('promo-text').innerText = "Voucher Aktif: Diskon 20% Berhasil!";
                updateUI();
            } else {
                alert("Voucher Salah atau Tidak Berlaku!");
            }
        });

        btnCheckout.addEventListener('click', () => {
            if(keranjang.length === 0) return;
            alert(`Pesanan Berhasil Diproses!\nInformasi pengiriman dan resi akan dikirim ke email Anda.\nTotal Pembayaran: ${totalDisplay.innerText}`);
            window.location.reload();
        });
    </script>
</body>
</html>