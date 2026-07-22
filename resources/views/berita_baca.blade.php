@extends('layout.depan.app')

@section('content')
<div role="main" class="main">

    <section class="page-header page-header-modern bg-color-light-scale-1 page-header-md" style="background: url('{{ asset('theme/img/ndr-banner-green.png') }}'); background-size:cover; background-position: 0 100%;">
        <div class="container">
            <div class="row">
                <div class="col-md-12 align-self-center order-1">
                    <ul class="breadcrumb d-block text-center">
                        <li><a href="#" class="warna-putih">Home</a></li>
                        <li class="active warna-hitam">Berita</li>
                    </ul>
                </div>
                <div class="col-md-12 align-self-center p-static order-2 text-center">
                    <h1 class="font-weight-bold text-6 warna-putih">Baca Berita Terbaru Kami</h1>
                    <span class="sub-title warna-putih">{{ $berita->judul }}</span>
                </div>
            </div>
        </div>
    </section>

    <div class="container py-4">
        <div class="row">

            {{-- KONTEN INTI --}}
            <div class="col-lg-9 order-lg-1">
                <div class="blog-posts single-post">
                    <article class="post post-large blog-single-post border-0 m-0 p-0">
                        <div class="post-image ms-0">
                            <img src="{{asset('uploads/berita/'.$berita->gambar)}}" class="img-fluid img-thumbnail img-thumbnail-no-borders rounded-0" alt="" />
                        </div>

                        <div class="post-date ms-0">
                            <span class="day">{{ App\Helpers\Gudangfungsi::tanggalsaja($berita->tanggal_publikasi) }}</span>
                            <span class="month">{{ App\Helpers\Gudangfungsi::bulantahunsaja($berita->tanggal_publikasi) }}</span>
                        </div>

                        <div class="post-content ms-0">

                            <h2 class="font-weight-semi-bold fontsize-23 lineheight-30">
                                {{ $berita->judul }}
                            </h2>

                            <div class="post-meta">
                                <span><a href="{{ url('/berita-kategori/'.$berita->kategori_slug) }}" class="tautanku2"><i class="far fa-folder"></i> {{ $berita->kategori_berita }}</a> </span>
                                <span><i class="far fa-comments"></i> Dibaca {{ $berita->hits }} kali</span>
                            </div>

                            @php
                                echo $berita->isi_berita;
                            @endphp

                            {{-- <div class="post-block mt-5 post-share">
                                <h4 class="fontsize-14" style="margin-bottom:0px !important;"><i class="fas fa-share"></i> Bagikan ini</h4>
                                <a href="https://www.facebook.com/sharer.php?u={{ url('berita/'.$berita->slug) }}" class="mb-1 mt-1 me-1 btn sosmed-biru warna-putih"><i class="fa-brands fa-facebook-f"></i></a>
                                <a href="https://wa.me/?text={{ $berita->judul }}%20{{ url('berita/'.$berita->slug) }}" class="mb-1 mt-1 me-1 btn sosmed-hijau warna-putih"><i class="fa-brands fa-whatsapp"></i></a>
                                <a href="mailto:?subject={{ $berita->judul }}&body={{ url('berita/'.$berita->slug) }}" class="mb-1 mt-1 me-1 btn sosmed-merah warna-putih"><i class="fa-solid fa-envelope"></i></a>
                            </div> --}}
                        </div>
                    </article>
                </div>
            </div>

            {{-- SIDEBAR KANAN --}}
            <div class="col-lg-3 order-lg-2">
                <aside class="sidebar">
                    <form action="{{ url('/berita-cari') }}" method="post">
                        @csrf
                        <div class="input-group mb-3 pb-1">
                            <input class="form-control text-1" placeholder="Search..." name="katakunci" id="katakunci" type="text">
                            <button type="submit" class="btn btn-primary text-1 p-2"><i class="fas fa-search m-2"></i></button>
                        </div>
                    </form>
                    
                    <a href="{{ url('/publikasi') }}">
                        <h5>Publikasi</h5>
                    </a>
                    <div class="owl-carousel owl-theme nav-inside nav-inside-edge nav-squared nav-with-transparency nav-dark" data-plugin-options="{'items': 1, 'margin': 10, 'loop': false, 'nav': true, 'dots': false}">
                        @foreach ($publikasi as $pub)
                        <div style="text-align: center;">
                            <a class="img-thumbnail img-thumbnail-no-borders img-thumbnail-hover-icon" href="{{ asset("uploads/publikasi/cover/".$pub->gambar_sampul) }}">
                                <img class="img-fluid rounded-0 mb-2 kotakku" src="{{ asset("uploads/publikasi/cover/".$pub->gambar_sampul) }}" alt="" />
                            </a>
                            <a href="#" style="text-decoration: none;">
                                <p class="text-2 mb-0 lineheight-17 ratatengah cetaktebal">{{ $pub->judul_publikasi }}</p>
                            </a>
                        </div>
                        @endforeach
                    </div>

                    <a href="{{ url('/berita') }}">
                        <h5>Berita</h5>
                    </a>
                    <div class="tabs tabs-dark mb-4 pb-2">
                        <ul class="nav nav-tabs">
                            <li class="nav-item"><a class="nav-link show active text-1 font-weight-bold text-uppercase" href="#popularPosts" data-bs-toggle="tab">Terpopuler</a></li>
                            <li class="nav-item"><a class="nav-link text-1 font-weight-bold text-uppercase" href="#recentPosts" data-bs-toggle="tab">Terkini</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="popularPosts">
                                <ul class="simple-post-list">
                                    @foreach ($popularnews as $popnews)
                                    <li>
                                        <div class="post-info fontsize-12 lineheight-17">
                                            <a href="{{ url('/beritabaca', $popnews->slug) }}" class="tautanku1" style="text-decoration: none;">{{ $popnews->judul }}</a>
                                            <div class="post-meta">
                                                <span>
                                                {{ App\Helpers\Gudangfungsi::tanggalindo_hari($popnews->tanggal_publikasi) }}
                                                </span>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="tab-pane" id="recentPosts">
                                <ul class="simple-post-list">
                                    @foreach ($recentnews as $recent)
                                    <li>
                                        <div class="post-info fontsize-12 lineheight-17">
                                            <a href="{{ url('/beritabaca', $recent->slug) }}" class="fontsize-12" style="text-decoration: none;">{{ $recent->judul }}</a>
                                            <div class="post-meta">
                                                <span>
                                                    {{ App\Helpers\Gudangfungsi::tanggalindo_hari($popnews->tanggal_publikasi) }}
                                                </span>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>

    <div style="height: 100px">&nbsp;</div>
</div>

<script>
$(document).ready(function() {
    
});
</script>
@endsection