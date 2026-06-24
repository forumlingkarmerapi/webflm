<nav class="pcoded-navbar menupos-fixed menu-light ">
	<div class="navbar-wrapper">
		<div class="navbar-content scroll-div ">
			<ul class="nav pcoded-inner-navbar ">

				<li class="nav-item pcoded-menu-caption">
					<label>Menu Pengelolaan</label>
				</li>

                <li class="nav-item">
                    <a href="{{ url('/dashboard') }}" class="nav-link">
                        <span class="pcoded-micon"><i class="feather icon-clipboard"></i></span><span class="pcoded-mtext">Dashboard</span>
                    </a>
                </li>

                <li class="nav-item pcoded-hasmenu">
                    <a href="#" class="nav-link ">
                        <span class="pcoded-micon"><i class="feather icon-video"></i></span>
                        <span class="pcoded-mtext">Media dan Publikasi</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li><a href="{{ url('/kategoriberita') }}">Kategori Berita</a></li>
                        <li><a href="{{ url('/dap/berita') }}">Berita</a></li>
						<li><a href="{{ url('/dap/infopublik-grouping') }}">Info Publik Grouping</a></li>
                        <li><a href="{{ url('/dap/dip') }}">Daftar Informasi Publik</a></li>
                        <li><a href="{{ url('/kategoripublikasi') }}">Kategori Publikasi</a></li>
                        <li><a href="{{ url('/dap/publikasi') }}">Publikasi</a></li>
                        <li><a href="{{ url('/dap/imageslider') }}">Image Slider</a></li>
                        <li><a href="{{ url('/dap/ruedp') }}">RUED P</a></li>
                        <li><a href="{{ url('/dap/infografis') }}">Infografis</a></li>
                        {{-- <li><a href="{{ url('/dap/galerifoto') }}">Galeri Foto</a></li> --}}
                        <li><a href="#">Galeri Foto</a></li>
                        <li><a href="{{ url('/dap/galerivideo') }}">Galeri Video</a></li>
                        <li><a href="{{ url('/dap/layananpublik') }}">Layanan Publik</a></li>
                    </ul>
                </li>
                <li class="nav-item pcoded-hasmenu">
                    <a href="#" class="nav-link ">
                        <span class="pcoded-micon"><i class="feather icon-trending-up"></i></span>
                        <span class="pcoded-mtext">RB</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li><a href="{{ url('/dap/kategorirb') }}">Kategori RB</a></li>
                        <li><a href="{{ url('/dap/rb') }}">Reformasi Birokrasi</a></li>
                    </ul>
                </li>
                <li class="nav-item pcoded-hasmenu">
                    <a href="#" class="nav-link ">
                        <span class="pcoded-micon"><i class="feather icon-bookmark"></i></span>
                        <span class="pcoded-mtext">Profil</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li><a href="{{ url('/dap/identitasorganisasi') }}">Identitas Organisasi</a></li>
                        <li><a href="{{ url('/dap/profilden') }}">Profil DEN</a></li>
                        <li><a href="{{ url('/dap/organisasiden') }}">Organisasi DEN</a></li>
                        <li><a href="{{ url('/dap/profilsetjen') }}">Profil Setjen</a></li>
                    </ul>
                </li>                

				<li class="nav-item pcoded-menu-caption">
					<label>Pengaturan</label>
				</li>
                
                @if (Session::get('sesLevel') == 'admin-sistem')
                {{-- <li data-username="Form Validation" class="nav-item">
					<a href="{{ url('/dap/menuutama') }}" class="nav-link">
						<span class="pcoded-micon"><i class="feather icon-align-justify"></i></span><span class="pcoded-mtext">Menu Utama</span>
					</a>
				</li> --}}
				<li data-username="Form Validation" class="nav-item">
					<a href="{{ url('/dap/levelpengguna') }}" class="nav-link">
						<span class="pcoded-micon"><i class="feather icon-user-check"></i></span><span class="pcoded-mtext">Level Pengguna</span>
					</a>
				</li>
				<li data-username="Form Validation" class="nav-item">
					<a href="{{ url('/dap/pengguna') }}" class="nav-link">
						<span class="pcoded-micon"><i class="feather icon-users"></i></span><span class="pcoded-mtext">Pengguna</span>
					</a>
				</li>
                @endif

				<li data-username="Form Validation" class="nav-item">
					<a href="{{ url('/dap/pengguna/gantipassword') }}" class="nav-link">
						<span class="pcoded-micon"><i class="feather icon-check-circle"></i></span><span class="pcoded-mtext">Ganti Password</span>
					</a>
				</li>
				<li data-username="Form Validation" class="nav-item">
					<a href="{{ url('logout') }}" class="dud-logout" title="Logout">
						<span class="pcoded-micon"><i class="feather icon-log-out"></i></span><span class="pcoded-mtext">Logout</span>
					</a>
				</li>
			</ul>
		</div>
	</div>
</nav>