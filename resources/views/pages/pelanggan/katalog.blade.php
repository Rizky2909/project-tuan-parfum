@extends('layouts.app')
@section('title', 'Katalog – Tuan Parfum')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@500;600&family=Figtree:wght@400;500;600&display=swap" rel="stylesheet">
<style>
  :root{--green:#0d3024;--gold:#c9a227;--line:rgba(255,255,255,.08);--text:#E6E9EF;--muted:#9AA3B2;--teal:#9fb5aa;--card:#101623}
  .katalog-dark{background:var(--bg);color:var(--text);margin:-3rem 0 -4rem 0;padding:10px 0 80px}
  .katalog-dark .wrap{max-width:1440px;margin:0 auto;padding:0 36px}
  .katalog-dark .search{display:flex;gap:14px;margin:36px 0}
  .katalog-dark .search input{flex:1;height:56px;border:1px solid var(--line);padding:0 24px 0 50px;font:16px Figtree,sans-serif;background:var(--card) url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='18' height='18' fill='none' stroke='%23c9a227' stroke-width='2'%3E%3Ccircle cx='7.5' cy='7.5' r='6'/%3E%3Cpath d='M12 12l5 5'/%3E%3C/svg%3E") no-repeat 18px center;color:var(--text)}
  .katalog-dark .search input::placeholder{color:var(--muted)}
  .katalog-dark .search input:focus{outline:none;border-color:rgba(201,162,39,.6);box-shadow:0 0 0 1px rgba(201,162,39,.25)}
  .katalog-dark .btn{font:600 14px Figtree,sans-serif;letter-spacing:.16em;text-transform:uppercase;cursor:pointer;border:1px solid rgba(201,162,39,.9)}
  .katalog-dark .btn-dark{background:linear-gradient(90deg,#b8941f 0%,#d9b63b 100%);color:#101623}
  .katalog-dark .search .btn{width:150px;height:56px}
  .katalog-dark .layout{display:grid;grid-template-columns:314px 1fr;gap:36px;align-items:start}
  .katalog-dark aside{background:radial-gradient(circle at top,rgba(255,255,255,.01) 0%,transparent 70%),var(--card);border:1px solid var(--line);padding:30px 28px;box-shadow:0 60px 90px -70px rgba(201,162,39,.18)}
  .katalog-dark .side-head{display:flex;justify-content:space-between;align-items:baseline;padding-bottom:18px;border-bottom:1px solid var(--line)}
  .katalog-dark .side-head h2{font-family:'Cormorant Garamond',serif;font-weight:500;font-size:21px;letter-spacing:.18em;margin:0}
  .katalog-dark .side-head a{color:var(--gold);font-size:14px;font-weight:500;text-decoration:none}
  .katalog-dark .group{padding:22px 0;border-bottom:1px solid var(--line)}
  .katalog-dark .group:last-child{border:0;padding-bottom:0}
  .katalog-dark .group h3{font-size:12px;letter-spacing:.16em;font-weight:600;margin-bottom:18px;color:var(--muted)}
  .katalog-dark .opt{display:flex;align-items:center;gap:12px;font-size:16px;color:var(--muted);margin-bottom:16px;cursor:pointer}
  .katalog-dark .opt:last-child{margin-bottom:0}
  .katalog-dark .opt input{appearance:none;width:18px;height:18px;border:1px solid rgba(255,255,255,.25);background:transparent;flex:none}
  .katalog-dark .opt input[type=radio]{border-radius:50%}
  .katalog-dark .opt input[type=checkbox]{border-radius:3px}
  .katalog-dark .opt input[type=radio]:checked{border:5px solid var(--gold)}
  .katalog-dark .opt input[type=checkbox]:checked{background:var(--gold) url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3E%3Cpath d='M3.5 8.5l3 3 6-7' fill='none' stroke='%23101623' stroke-width='2'/%3E%3C/svg%3E");border-color:var(--gold)}
  .katalog-dark .opt.on{color:var(--text);font-weight:500}
  .katalog-dark .range{width:100%;accent-color:var(--gold)}
  .katalog-dark .range-labels{display:flex;justify-content:space-between;font-size:14px;color:var(--muted);margin-top:14px}
  .katalog-dark .grid{display:grid;grid-template-columns:repeat(3,1fr);gap:28px}
  .katalog-dark .card{background:radial-gradient(circle at top,rgba(255,255,255,.01) 0%,transparent 70%),var(--card);border:1px solid var(--line);border-radius:14px;box-shadow:0 60px 100px -80px rgba(201,162,39,.22);overflow:hidden;transition:transform .25s ease,box-shadow .25s ease,border-color .25s ease}
  .katalog-dark .card:hover{transform:translateY(-6px);box-shadow:0 70px 110px -70px rgba(201,162,39,.28);border-color:rgba(201,162,39,.5)}
  .katalog-dark .thumb{position:relative;aspect-ratio:1/.995;background:radial-gradient(circle at top,#b99a5d 0%,#3a2816 100%)}
  .katalog-dark .thumb.t2{background:radial-gradient(circle at top,#e7c99a 0%,#7a5a2c 100%)}
  .katalog-dark .thumb.t3{background:radial-gradient(circle at top,#b9b9b6 0%,#3f3f3d 100%)}
  .katalog-dark .thumb.t4{background:radial-gradient(circle at top,#d9b06a 0%,#705022 100%)}
  .katalog-dark .thumb.t5{background:radial-gradient(circle at top,#7c5a32 0%,#22170d 100%)}
  .katalog-dark .thumb.t6{background:radial-gradient(circle at top,#f0ebe2 0%,#b9b3a6 100%)}
  .katalog-dark .tag{position:absolute;top:16px;left:16px;font-size:11px;font-weight:600;letter-spacing:.16em;padding:6px 12px;background:rgba(16,22,35,.9);color:var(--gold);border:1px solid rgba(201,162,39,.8);text-transform:uppercase}
  .katalog-dark .tag.new{background:linear-gradient(90deg,#b8941f 0%,#d9b63b 100%);color:#101623;border:none}
  .katalog-dark .body{padding:22px 22px 20px}
  .katalog-dark .body h4{font-family:'Cormorant Garamond',serif;font-weight:600;font-size:24px;letter-spacing:.08em;text-transform:uppercase;margin:0}
  .katalog-dark .meta{font-size:14px;color:var(--teal);margin-top:8px}
  .katalog-dark .row{display:flex;justify-content:space-between;align-items:center;margin:18px 0 22px}
  .katalog-dark .price{font-size:18px;font-weight:500}
  .katalog-dark .stock{font-size:12px;color:#b9f3d0;background:rgba(20,83,45,.4);border:1px solid rgba(52,211,153,.4);padding:4px 12px;letter-spacing:.08em;text-transform:uppercase}
  .katalog-dark .stock.low{background:rgba(120,53,15,.4);border-color:rgba(251,191,36,.5);color:#f5d16e}
  .katalog-dark .actions{display:grid;grid-template-columns:1fr 1.1fr;gap:10px}
  .katalog-dark .actions .btn{height:40px;font-size:12px;display:flex;align-items:center;justify-content:center;text-decoration:none}
  .katalog-dark .btn-light{background:transparent;color:var(--text);border-color:var(--line)}
  .katalog-dark .btn-light:hover{border-color:rgba(201,162,39,.7)}
  .katalog-dark .btn-dark em{font-style:normal;color:#101623;margin-right:6px}
  .katalog-dark .pager{border-top:1px solid var(--line);margin-top:40px;padding:36px 0 60px;display:flex;justify-content:center;gap:10px}
  .katalog-dark .pager a{width:42px;height:42px;border:1px solid var(--line);background:transparent;display:grid;place-items:center;font-size:16px;text-decoration:none;color:var(--muted)}
  .katalog-dark .pager a.cur{background:linear-gradient(90deg,#b8941f 0%,#d9b63b 100%);color:#101623;border:none}
    .katalog-dark .range-labels{display:flex;align-items:center;justify-content:space-between;font-size:13px;color:var(--muted);margin-top:16px;gap:10px}
  .katalog-dark .range-labels span{flex:1;text-align:center}
  .katalog-dark .range-labels span:nth-child(2){color:var(--text);font-weight:600}
  @media(max-width:980px){.katalog-dark .layout{grid-template-columns:1fr}.katalog-dark .grid{grid-template-columns:repeat(2,1fr)}}
  @media(max-width:620px){.katalog-dark .wrap{padding:0 18px}.katalog-dark .grid{grid-template-columns:1fr}}
</style>

<div class="katalog-dark">
  <div class="wrap">
    <div class="search">
      <input type="text" placeholder="Cari parfum impian Anda (misal: Oud, Vanille, Woody)...">
      <button class="btn btn-dark">CARI</button>
    </div>

    <div class="layout">
      <aside>
        <div class="side-head"><h2>KATEGORI</h2><a href="#">RESET</a></div>
        <div class="group">
          <label class="opt on"><input type="radio" name="kat" checked> Semua Kategori</label>
          <label class="opt"><input type="radio" name="kat"> Pria</label>
          <label class="opt"><input type="radio" name="kat"> Wanita</label>
          <label class="opt"><input type="radio" name="kat"> Unisex</label>
          <label class="opt"><input type="radio" name="kat"> Koleksi Eksklusif</label>
        </div>
        <div class="group">
          <h3>KARAKTER AROMA</h3>
          <label class="opt on"><input type="checkbox" checked> Woody &amp; Amber</label>
          <label class="opt"><input type="checkbox"> Floral &amp; Powdery</label>
          <label class="opt"><input type="checkbox"> Citrus &amp; Fresh</label>
          <label class="opt"><input type="checkbox"> Oriental Gourmand</label>
        </div>
                <div class="group">
          <h3>RENTANG HARGA</h3>
          <input class="range" id="hargaRange" type="range" min="200000" max="2500000" step="10000" value="900000">
          <div class="range-labels">
            <span>Rp 200.000</span>
            <span id="hargaValue">Rp 900.000</span>
            <span>Rp 2.500.000</span>
          </div>
        </div>
        <script>
          const hargaRange = document.getElementById('hargaRange');
          const hargaValue = document.getElementById('hargaValue');
          const formatRupiah = (angka) => new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(angka);
          const updateHarga = () => { hargaValue.textContent = formatRupiah(hargaRange.value); };
          hargaRange.addEventListener('input', updateHarga);
          updateHarga();
        </script>
      </aside>

      <section>
        <div class="grid">
          <article class="card">
            <div class="thumb"><span class="tag">BEST SELLER</span></div>
            <div class="body"><h4>Oud Imperial</h4><p class="meta">Unisex | 100 ml</p>
              <div class="row"><span class="price">Rp 650.000</span><span class="stock">Tersedia</span></div>
              <div class="actions"><a href="{{ route('katalog.detail', 1) }}" class="btn btn-light">DETAIL</a><button class="btn btn-dark"><em>+</em> KERANJANG</button></div></div>
          </article>
          <article class="card">
            <div class="thumb t2"><span class="tag new">NEW</span></div>
            <div class="body"><h4>Santal Velvet</h4><p class="meta">Pria | 100 ml</p>
              <div class="row"><span class="price">Rp 520.000</span><span class="stock">Tersedia</span></div>
              <div class="actions"><a href="{{ route('katalog.detail', 2) }}" class="btn btn-light">DETAIL</a><button class="btn btn-dark"><em>+</em> KERANJANG</button></div></div>
          </article>
          <article class="card">
            <div class="thumb t3"></div>
            <div class="body"><h4>Rose Ébène</h4><p class="meta">Wanita | 100 ml</p>
              <div class="row"><span class="price">Rp 580.000</span><span class="stock">Tersedia</span></div>
              <div class="actions"><a href="{{ route('katalog.detail', 3) }}" class="btn btn-light">DETAIL</a><button class="btn btn-dark"><em>+</em> KERANJANG</button></div></div>
          </article>
          <article class="card">
            <div class="thumb t4"></div>
            <div class="body"><h4>Bergamot Drift</h4><p class="meta">Unisex | 100 ml</p>
              <div class="row"><span class="price">Rp 480.000</span><span class="stock">Tersedia</span></div>
              <div class="actions"><a href="{{ route('katalog.detail', 4) }}" class="btn btn-light">DETAIL</a><button class="btn btn-dark"><em>+</em> KERANJANG</button></div></div>
          </article>
          <article class="card">
            <div class="thumb t5"><span class="tag">BEST SELLER</span></div>
            <div class="body"><h4>Tobacco Nectar</h4><p class="meta">Pria | 100 ml</p>
              <div class="row"><span class="price">Rp 720.000</span><span class="stock low">Stok Terbatas</span></div>
              <div class="actions"><a href="{{ route('katalog.detail', 5) }}" class="btn btn-light">DETAIL</a><button class="btn btn-dark"><em>+</em> KERANJANG</button></div></div>
          </article>
          <article class="card">
            <div class="thumb t6"></div>
            <div class="body"><h4>Blanc Musk</h4><p class="meta">Unisex | 100 ml</p>
              <div class="row"><span class="price">Rp 450.000</span><span class="stock">Tersedia</span></div>
              <div class="actions"><a href="{{ route('katalog.detail', 6) }}" class="btn btn-light">DETAIL</a><button class="btn btn-dark"><em>+</em> KERANJANG</button></div></div>
          </article>
        </div>

        <div class="pager">
          <a href="#">‹</a><a class="cur" href="#">1</a><a href="#">2</a><a href="#">3</a><a href="#">›</a>
        </div>
      </section>
    </div>
  </div>
</div>
@endsection