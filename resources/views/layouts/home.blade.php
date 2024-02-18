<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <title>SPK Atlet Gulat Terbaik Kota Bengkulu</title>
		<link rel="icon" href="{{ url('frontend/logo.png') }}" type="image/x-icon">
		<link rel="shortcut icon" href="{{ url('frontend/logo.png') }}" type="image/x-icon">

    <!-- Bootstrap core CSS -->
    <link href="{{ url('frontend/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="{{ url('frontend/assets/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ url('frontend/assets/css/templatemo-lugx-gaming.css') }}">
    <link rel="stylesheet" href="{{ url('frontend/assets/css/owl.css') }}">
    <link rel="stylesheet" href="{{ url('frontend/assets/css/animate.css') }}">
    <link rel="stylesheet"href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>
<!--

TemplateMo 589 lugx gaming

https://templatemo.com/tm-589-lugx-gaming

-->
  </head>

<body>

  <!-- ***** Preloader Start ***** -->
  <div id="js-preloader" class="js-preloader">
    <div class="preloader-inner">
      <span class="dot"></span>
      <div class="dots">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
  </div>
  <!-- ***** Preloader End ***** -->

  <!-- ***** Header Area Start ***** -->
  <header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <!-- ***** Logo Start ***** -->
                    <a href="{{ route('home') }}" class="logo mr-3">
                        <img src="{{ url('frontend/prov.png') }}" alt="" style="height: 50px;">
                    </a>
                    <!-- ***** Logo End ***** -->
                    <!-- ***** Menu Start ***** -->
                    <ul class="nav">
                      <li><a href="{{ route('home') }}" class="active">Home</a></li>
                      <li><a href="#perangkingan">Perangkingan</a></li>
                      @if (Auth::user())
                      <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                      @endif
                      @if (Auth::user())
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="dropdown-item preview-item">
                                    <i class="icon-power"></i> Logout
                                </a>
                            </form>
                        </li>
                      @else
                      <li><a href="{{ route('login') }}">Login</a></li>
                      @endif
                  </ul>
                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>
                    <!-- ***** Menu End ***** -->
                </nav>
            </div>
        </div>
    </div>
  </header>
  <!-- ***** Header Area End ***** -->

  <div class="main-banner">
		@include('sweetalert::alert')
    <div class="container">
      <div class="row">
        <div class="col-lg-6 align-self-center">
          <div class="caption header-text">
            <h6>Selamat Datang di Sistem Pendukung Keputusan</h6>
            <h2>PEMILIHAN ATLET GULAT TERBAIK BENGKULU</h2>
            <p>Sistem pendukung keputusan penentuan atlet gulat terbaik untuk kejuaraan nasional PraPON adalah sistem pendukung keputusan yang dapat membantu pelatih gulat dalam menentukan atlet gulat terbaik untuk mengikuti kejuaraan nasional PraPON di Pusat Pendidikan dan Latihan Olahraga Pelajar di Provinsi Bengkulu.</p>
          </div>
        </div>
        <div class="col-lg-4 offset-lg-2">
          <div class="right-image">
            <img src="{{ url('header.png') }}" alt="">
            {{-- <span class="price">$22</span>
            <span class="offer">-40%</span> --}}
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- <div class="features">
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-6">
          <a href="#">
            <div class="item">
              <div class="image">
                <img src="{{ url('frontend/assets/images/featured-01.png') }}" alt="" style="max-width: 44px;">
              </div>
              <h4>Free Storage</h4>
            </div>
          </a>
        </div>
        <div class="col-lg-3 col-md-6">
          <a href="#">
            <div class="item">
              <div class="image">
                <img src="{{ url('frontend/assets/images/featured-02.png') }}" alt="" style="max-width: 44px;">
              </div>
              <h4>User More</h4>
            </div>
          </a>
        </div>
        <div class="col-lg-3 col-md-6">
          <a href="#">
            <div class="item">
              <div class="image">
                <img src="{{ url('frontend/assets/images/featured-03.png') }}" alt="" style="max-width: 44px;">
              </div>
              <h4>Reply Ready</h4>
            </div>
          </a>
        </div>
        <div class="col-lg-3 col-md-6">
          <a href="#">
            <div class="item">
              <div class="image">
                <img src="{{ url('frontend/assets/images/featured-04.png') }}" alt="" style="max-width: 44px;">
              </div>
              <h4>Easy Layout</h4>
            </div>
          </a>
        </div>
      </div>
    </div>
  </div> --}}

  <div class="section trending" id="perangkingan">
    <div class="container">
      <div class="row justify-content-between">
        @if ($tahun != NULL)
				<div class="col-lg-6">
          <div class="section-heading">
            <h6>Perangkingan</h6>
            <h2>Perangkingan Tahun {{ $tahun }}</h2>
          </div>
        </div>
				<div class="col-lg-2">
					<select class="form-select" aria-label="Default select example" onchange="location = this.value;">
						<option hidden selected>-- Pilih Tahun --</option>
						@forelse ($tahunPeriode as $item)
						<option value="{{ route('tahun', $item->nama_periode) }}" @if($tahun == $item->nama_periode) selected @endif>{{ $item->nama_periode }}</option>
						@empty
								
						@endforelse
						
					</select>
				</div>
				@else
				<div class="col-lg-6">
          <div class="section-heading">
            <h2>Data Periode Kosong</h2>
          </div>
        </div>
				@endif
      </div>
			@if ($tahun != NULL)
			<div class="container">
        <div class="row justify-content-center">
					<div class="col-lg-8 col-md-8">
						<div class="">
							<table class="table table-bordered table-hover">
								<thead>
									<tr>
										<th class="text-center" style="width: 50% !importtant">Ranking</th>
										<th class="text-center" style="width: 50% !importtant">Nama</th>
									</tr>
								</thead>
								<tbody>
									@if ($items != NULL)
										@forelse ($items as $item)
										<tr>
											<th scope="row" class="text-center">{{ $item->rank }}</th>
											<td class="text-center">{{ $item->guru->nama }}</td>
										</tr>
										@empty
										<tr class="text-center">
											<td colspan="2">-- Data Kosong --</td>
										</tr>
										@endforelse
									@else
									<tr class="text-center">
										<td colspan="2">-- Data Kosong --</td>
									</tr>
									@endif                      
								</tbody>
							</table>
						</div>
					</div>
				</div>
      </div>
			@endif
      
    </div>
  </div>

  {{-- <div class="section most-played">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div class="section-heading">
            <h6>TOP GAMES</h6>
            <h2>Most Played</h2>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="main-button">
            <a href="shop.html">View All</a>
          </div>
        </div>
        <div class="col-lg-2 col-md-6 col-sm-6">
          <div class="item">
            <div class="thumb">
              <a href="product-details.html"><img src="{{ url('frontend/assets/images/top-game-01.jpg') }}" alt=""></a>
            </div>
            <div class="down-content">
                <span class="category">Adventure</span>
                <h4>Assasin Creed</h4>
                <a href="product-details.html">Explore</a>
            </div>
          </div>
        </div>
        <div class="col-lg-2 col-md-6 col-sm-6">
          <div class="item">
            <div class="thumb">
              <a href="product-details.html"><img src="{{ url('frontend/assets/images/top-game-02.jpg') }}" alt=""></a>
            </div>
            <div class="down-content">
                <span class="category">Adventure</span>
                <h4>Assasin Creed</h4>
                <a href="product-details.html">Explore</a>
            </div>
          </div>
        </div>
        <div class="col-lg-2 col-md-6 col-sm-6">
          <div class="item">
            <div class="thumb">
              <a href="product-details.html"><img src="{{ url('frontend/assets/images/top-game-03.jpg') }}" alt=""></a>
            </div>
            <div class="down-content">
                <span class="category">Adventure</span>
                <h4>Assasin Creed</h4>
                <a href="product-details.html">Explore</a>
            </div>
          </div>
        </div>
        <div class="col-lg-2 col-md-6 col-sm-6">
          <div class="item">
            <div class="thumb">
              <a href="product-details.html"><img src="{{ url('frontend/assets/images/top-game-04.jpg') }}" alt=""></a>
            </div>
            <div class="down-content">
                <span class="category">Adventure</span>
                <h4>Assasin Creed</h4>
                <a href="product-details.html">Explore</a>
            </div>
          </div>
        </div>
        <div class="col-lg-2 col-md-6 col-sm-6">
          <div class="item">
            <div class="thumb">
              <a href="product-details.html"><img src="{{ url('frontend/assets/images/top-game-05.jpg') }}" alt=""></a>
            </div>
            <div class="down-content">
                <span class="category">Adventure</span>
                <h4>Assasin Creed</h4>
                <a href="product-details.html">Explore</a>
            </div>
          </div>
        </div>
        <div class="col-lg-2 col-md-6 col-sm-6">
          <div class="item">
            <div class="thumb">
              <a href="product-details.html"><img src="{{ url('frontend/assets/images/top-game-06.jpg') }}" alt=""></a>
            </div>
            <div class="down-content">
                <span class="category">Adventure</span>
                <h4>Assasin Creed</h4>
                <a href="product-details.html">Explore</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="section categories">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <div class="section-heading">
            <h6>Categories</h6>
            <h2>Top Categories</h2>
          </div>
        </div>
        <div class="col-lg col-sm-6 col-xs-12">
          <div class="item">
            <h4>Action</h4>
            <div class="thumb">
              <a href="product-details.html"><img src="{{ url('frontend/assets/images/categories-01.jpg') }}" alt=""></a>
            </div>
          </div>
        </div>
        <div class="col-lg col-sm-6 col-xs-12">
          <div class="item">
            <h4>Action</h4>
            <div class="thumb">
              <a href="product-details.html"><img src="{{ url('frontend/assets/images/categories-05.jpg') }}" alt=""></a>
            </div>
          </div>
        </div>
        <div class="col-lg col-sm-6 col-xs-12">
          <div class="item">
            <h4>Action</h4>
            <div class="thumb">
              <a href="product-details.html"><img src="{{ url('frontend/assets/images/categories-03.jpg') }}" alt=""></a>
            </div>
          </div>
        </div>
        <div class="col-lg col-sm-6 col-xs-12">
          <div class="item">
            <h4>Action</h4>
            <div class="thumb">
              <a href="product-details.html"><img src="{{ url('frontend/assets/images/categories-04.jpg') }}" alt=""></a>
            </div>
          </div>
        </div>
        <div class="col-lg col-sm-6 col-xs-12">
          <div class="item">
            <h4>Action</h4>
            <div class="thumb">
              <a href="product-details.html"><img src="{{ url('frontend/assets/images/categories-05.jpg') }}" alt=""></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="section cta">
    <div class="container">
      <div class="row">
        <div class="col-lg-5">
          <div class="shop">
            <div class="row">
              <div class="col-lg-12">
                <div class="section-heading">
                  <h6>Our Shop</h6>
                  <h2>Go Pre-Order Buy & Get Best <em>Prices</em> For You!</h2>
                </div>
                <p>Lorem ipsum dolor consectetur adipiscing, sed do eiusmod tempor incididunt.</p>
                <div class="main-button">
                  <a href="shop.html">Shop Now</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-5 offset-lg-2 align-self-end">
          <div class="subscribe">
            <div class="row">
              <div class="col-lg-12">
                <div class="section-heading">
                  <h6>NEWSLETTER</h6>
                  <h2>Get Up To $100 Off Just Buy <em>Subscribe</em> Newsletter!</h2>
                </div>
                <div class="search-input">
                  <form id="subscribe" action="#">
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Your email...">
                    <button type="submit">Subscribe Now</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> --}}

  <footer>
    <div class="container">
      <div class="col-lg-12">
        <p>Copyright © 2024 Andrei Jonior Gustari. All rights reserved.
      </div>
    </div>
  </footer>

  <!-- Scripts -->
  <!-- Bootstrap core JavaScript -->
  <script src="{{ url('frontend/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ url('frontend/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
  <script src="{{ url('frontend/assets/js/isotope.min.js') }}"></script>
  <script src="{{ url('frontend/assets/js/owl-carousel.js') }}"></script>
  <script src="{{ url('frontend/assets/js/counter.js') }}"></script>
  <script src="{{ url('frontend/assets/js/custom.js') }}"></script>

  </body>
</html>
