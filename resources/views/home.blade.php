@extends('layout.depan.app')
@section('content')
<div role="main" class="main">

	<div class="slider-container rev_slider_wrapper" style="height: 670px;">
		<div id="revolutionSlider" class="slider rev_slider" data-version="5.4.8" data-plugin-revolution-slider data-plugin-options="{'delay': 9000, 'gridwidth': 1170, 'gridheight': 670, 'disableProgressBar': 'on', 'responsiveLevels': [4096,1200,992,500], 'parallax': { 'type': 'scroll', 'origo': 'enterpoint', 'speed': 1000, 'levels': [2,3,4,5,6,7,8,9,12,50], 'disable_onmobile': 'on' }, 'navigation' : {'arrows': { 'enable': true }, 'bullets': {'enable': true, 'style': 'bullets-style-1', 'h_align': 'center', 'v_align': 'bottom', 'space': 7, 'v_offset': 70, 'h_offset': 0}}}">
			<ul>
				<li data-transition="fade">
					<img src="{{ asset('uploads/imagesliders/flm-slider.png') }}"  
						alt=""
						data-bgposition="center center" 
						data-bgfit="cover" 
						data-bgrepeat="no-repeat" 
						class="rev-slidebg">
				</li>
				{{-- <li data-transition="fade">
					<img src="{{ asset('uploads/imagesliders/flm-slider2.png') }}"  
						alt=""
						data-bgposition="center center" 
						data-bgfit="cover" 
						data-bgrepeat="no-repeat" 
						class="rev-slidebg">
				</li> --}}
			</ul>
		</div>
	</div>

	<div class="container">
		<div class="row pt-5">
			<div class="col">

				<div class="row text-center pb-5">
					<div class="col-md-9 mx-md-auto">
						<div class="overflow-hidden mb-3">
							<h4 class="word-rotator slide font-weight-bold text-8 mb-0 appear-animation" data-appear-animation="maskUp">
								<span>Forum Lingkar Merapi</span>
							</h4>
						</div>
					</div>
				</div>

				<div class="post-content">
					<p style="text-align: justify;">Forum Lingkar Merapi adalah sebuah wadah kolaboratif sebagai pusat koordinasi, komunikasi dan sinergi bagi berbagai pemangku kepentingan (stakeholders) di wilayah lingkar Gunung Merapi. Forum ini terdiri dari lembaga pemerintah pusat dan daerah, pemerintah pusat melalui Badan Geologi Kementerian ESDM c.q. BPPTKG dan BPBD 4 kabupaten di 2 provinsi (Yogyakarta dan Jawa Tengah) yaitu Sleman, Magelang, Boyolali dan Klaten.</p>
					<p style="text-align: justify;">
						Tujuan utama dari Forum Lingkar Merapi adalah untuk memperkuat kapasitas komunitas dan kelembagaan dalam pengurangan risiko bencana (PRB) terkait aktivitas Gunung Merapi yang dinamis. Sekber ini berfungsi sebagai jembatan yang menghubungkan berbagai inisiatif mandiri di setiap daerah menjadi sebuah gerakan yang lebih terorganisir dan komprehensif.
					</p>
					<p style="text-align: justify;">
						Beberapa pilar kegiatan utama yang dikelola oleh Sekber Forum Lingkar Merapai meliputi:
						<ul>
							<li>Pemberdayaan dan Pelatihan: Sekber menyelenggarakan program peningkatan kapasitas masyarakat tentang risiko bencana Gunung Merapi melalui pelatihan mitigasi bencana</li>
							<li>Koordinasi dan Komunikasi: Sekber menjadi pusat informasi dan pertukaran pengetahuan antar anggota forum, memastikan tersedianya aliran informasi yang cepat dan akurat dari lembaga teknis seperti BPPTKG dan BPBD Daerah ke masyarakat, serta memfasilitasi dialog konstruktif antar lembaga</li>
						</ul>
					</p>
					<p style="text-align: justify;">
						Melalui pendekatan yang inklusif, partisipatif dan kolaboratif, Sekber Forum Lingkar Merapi bertujuan untuk menciptakan masyarakat lingkar Merapi yang tidak hanya siap menghadapi ancaman bencana, namun juga mampu tumbuh dan berkembang secara berkelanjutan dalam harmoni dengan lingkungan Gunung Merapi.
					</p>
				</div>

			</div>
		</div>
	</div>

	<div class="container">
		<div class="row pt-5 mt-4">
			<div class="col">
				<h2 class="font-weight-normal text-6 mb-4"><strong class="font-weight-extra-bold text-color-primary">Postingan</strong> Terbaru</h2>
			</div>
		</div>
		<div class="row recent-posts pb-5 mb-4">
			<div class="col-md-6 col-lg-3 mb-4 mb-lg-0">
				<article>
					<div class="row">
						<div class="col">
							<a href="blog-post.html" class="text-decoration-none">
								<img src="{{ asset('uploads/berita/flm-16april2026.png') }}" class="img-fluid hover-effect-2 mb-3" alt="" />
							</a>
						</div>
					</div>
					<div class="row">
						<div class="col-auto pe-0">
							<div class="date">
								<span class="day text-color-dark font-weight-extra-bold">16</span>
								<span class="month text-1">APR</span>
							</div>
						</div>
						<div class="col ps-1">
							<h4 class="line-height-3 text-4"><a href="blog-post.html" class="text-dark">Rapat Forum Lingkar Merapi 16 April 2026</a></h4>
							<p class="line-height-3 pe-4 mb-1" style="font-size: 13px;">Forum Lingkar Merapi melaksanakan rapat dengan pembahasan pemutakhiran informasi aktivitas Gunung Merapi dan pembahasan program kegiatan Forum Lingkar Merapi tahun 2026.</p>
							<a href="/" class="read-more text-color-primary font-weight-bold text-2">selengkapnya <i class="fas fa-chevron-right text-1 ms-1"></i></a>
						</div>
					</div>
				</article>
			</div>
			<div class="col-md-6 col-lg-3 mb-4 mb-lg-0">
				<article>
					<div class="row">
						<div class="col">
							<a href="blog-post.html" class="text-decoration-none">
								<img src="{{ asset('uploads/berita/flm-18feb2026.png') }}" class="img-fluid hover-effect-2 mb-3" alt="" />
							</a>
						</div>
					</div>
					<div class="row">
						<div class="col-auto pe-0">
							<div class="date">
								<span class="day text-color-dark font-weight-extra-bold">18</span>
								<span class="month text-1">FEB</span>
							</div>
						</div>
						<div class="col ps-1">
							<h4 class="line-height-3 text-4"><a href="blog-post.html" class="text-dark">Rapat Forum Lingkar Merapi 18 April 2026</a></h4>
							<p class="line-height-3 pe-4 mb-1" style="font-size: 13px;">Forum Lingkar Merapi melaksanakan rapat dengan pembahasan pemutakhiran informasi aktivitas Gunung Merapi dan pembahasan program kegiatan Forum Lingkar Merapi tahun 2026.</p>
							<a href="/" class="read-more text-color-primary font-weight-bold text-2">selengkapnya <i class="fas fa-chevron-right text-1 ms-1"></i></a>
						</div>
					</div>
				</article>
			</div>
			<div class="col-md-6 col-lg-3 mb-4 mb-lg-0">
				<article>
					<div class="row">
						<div class="col">
							<a href="blog-post.html" class="text-decoration-none">
								<img src="{{ asset('uploads/berita/merapi.png') }}" class="img-fluid hover-effect-2 mb-3" alt="" />
							</a>
						</div>
					</div>
					<div class="row">
						<div class="col-auto pe-0">
							<div class="date">
								<span class="day text-color-dark font-weight-extra-bold">30</span>
								<span class="month text-1">JAN</span>
							</div>
						</div>
						<div class="col ps-1">
							<h4 class="line-height-3 text-4"><a href="blog-post.html" class="text-dark">Gunung Merapi, Salah Satu Gunung Api Paling Aktif di Dunia</a></h4>
							<p class="line-height-3 pe-4 mb-1" style="font-size: 13px;">Sebagai salah satu gunung api paling aktif, tentunya akan sangat menarik jika kita menilik sejarah Gunung Merapi.</p>
							<a href="/" class="read-more text-color-primary font-weight-bold text-2">selengkapnya <i class="fas fa-chevron-right text-1 ms-1"></i></a>
						</div>
					</div>
				</article>
			</div>
			<div class="col-md-6 col-lg-3 mb-4 mb-lg-0">
				<article>
					<div class="row">
						<div class="col">
							<a href="blog-post.html" class="text-decoration-none">
								<img src="{{ asset('uploads/berita/merapi-erupsi.png') }}" class="img-fluid hover-effect-2 mb-3" alt="" />
							</a>
						</div>
					</div>
					<div class="row">
						<div class="col-auto pe-0">
							<div class="date">
								<span class="day text-color-dark font-weight-extra-bold">17</span>
								<span class="month text-1">JAN</span>
							</div>
						</div>
						<div class="col ps-1">
							<h4 class="line-height-3 text-4"><a href="blog-post.html" class="text-dark">Sejarah Letusan Gunung Merapi Berdasarkan Fasies Gunung Api</a></h4>
							<p class="line-height-3 pe-4 mb-1" style="font-size: 13px;">Fasies Gunungapi Merapi yang terletak di DAS Bedog Propinsi Daerah Istimewa Yogyakarta dan bahaya gunungapi yang diakibatkan oleh erupsi Gunungapi Merapi berdasarkan pada fasies gunungapinya.</p>
							<a href="/" class="read-more text-color-primary font-weight-bold text-2">selengkapnya <i class="fas fa-chevron-right text-1 ms-1"></i></a>
						</div>
					</div>
				</article>
			</div>
		</div>
	</div>

	<section class="section bg-color-grey-- section-height-3 border-0 m-0" style="background-color: #0E3367 !important;">
		<div class="container pb-2">
			<div class="row">
				<div class="col-lg-5 text-center text-md-start mb-5 mb-lg-0">
					<h2 class="text-color-light font-weight-normal text-6 mb-2">Publikasi <strong class="font-weight-extra-bold text-color-light">Terkini</strong></h2>
					<p class="lead" style="color: #D3E3FD !important;">Temukan tulisan, buletin, dokumentasi yang terkait dengan Gunung Merapi disini.</p>
					<a href="#" class="btn btn-primary font-weight-semibold btn-px-4 btn-py-2 text-2">Selengkapnya</a>
				</div>
				<div class="col-md-7 order-2 order-md-1 text-center text-md-start">
					<div class="owl-carousel owl-theme nav-style-1 nav-center-images-only stage-margin mb-0" data-plugin-options="{'responsive': {'576': {'items': 1}, '768': {'items': 1}, '992': {'items': 2}, '1200': {'items': 2}}, 'margin': 25, 'loop': false, 'nav': true, 'dots': false, 'stagePadding': 40}">
						@for ($i = 0; $i < 3; $i++)
							@php
							$cover = "uploads/publikasi/cover/2025-buletin-edisi".$i+1;
							$filename = "uploads/publikasi/2025-buletin-edisi".$i+1;
							@endphp
							{{-- <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#modalku" onclick="showFormRead()" style="text-decoration: none;"> --}}
							<a href="{{ asset($filename.'.pdf') }}" target="_blank" style="text-decoration: none;">
								<img class="img-fluid rounded-0 mb-2" src="{{ asset($cover.".png") }}" alt="" />
								<p class="text-2 mb-0 lineheight-17 ratatengah warna-putih" style="color: #0E3350;text-align: center !important;">
									Buletin Merapi Edisi {{ $i+1 }} Tahun 2025
									{{-- {{ $prokumden->judul_publikasi }} --}}
									{{-- <a href="javascript:void(0)" class="btn btn-primary btn-sm mb-2">
										Selengkapnya
									</a> --}}
								</p>
							</a>
						@endfor
					</div>
				</div>
			</div>
		</div>
	</section>

	</div>
@endsection