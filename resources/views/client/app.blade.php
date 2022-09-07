<!DOCTYPE html>
<html lang="en">
@php
use App\Traits\Helper;
$setting = App\Models\MProfilApp::first();
$menu = App\Models\MMenu::with('pages')->where('aktif',1)->where('parent',0)->get();
$allMenu = App\Models\MMenu::with('pages')->where('aktif',1)->get();
function cariParent($menu,$id_menu)
{
    $result = [];
    foreach ($menu as $key) {
        if($id_menu == $key->parent){
            return $result = ['url'=>$key->url,'label'=>$key->label];
        }
    }
    return $result;
}
@endphp
<head>
    <meta charset="utf-8">
    <title>{{$setting->nama}}</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="{{asset('image/setting/'.$setting->favicon)}}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Roboto:wght@500;700;900&display=swap" rel="stylesheet"> 

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{asset('client')}}/lib/animate/animate.min.css" rel="stylesheet">
    <link href="{{asset('client')}}/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="{{asset('client')}}/lib/lightbox/css/lightbox.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{asset('client')}}/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{asset('client')}}/css/style.css" rel="stylesheet">
    <link href="{{asset('client')}}/cute-alert/cute-alert.css" rel="stylesheet">
</head>

<body>
    
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->


    <!-- Topbar Start -->
    <div class="container-fluid bg-dark p-0">
        <div class="row gx-0 d-none d-lg-flex">
            <div class="col-lg-7 px-5 text-start">
                <div class="h-100 d-inline-flex align-items-center me-4">
                    <small class="fa fa-map-marker-alt text-primary me-2"></small>
                    <small>{{$setting->alamat}}</small>
                </div>
                {{-- <div class="h-100 d-inline-flex align-items-center">
                    <small class="far fa-clock text-primary me-2"></small>
                    <small>Mon - Fri : 09.00 AM - 09.00 PM</small>
                </div> --}}
            </div>
            <div class="col-lg-5 px-5 text-end">
                <div class="h-100 d-inline-flex align-items-center me-4">
                    <small class="fa fa-phone-alt text-primary me-2"></small>
                    <small>{{$setting->no_telp}}</small>
                </div>
                <div class="h-100 d-inline-flex align-items-center mx-n2">
                    <a class="btn btn-square btn-link rounded-0 border-0 border-end border-secondary" href="{{$setting->facebook}}"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-square btn-link rounded-0 border-0 border-end border-secondary" href="{{$setting->twitter}}"><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-square btn-link rounded-0 border-0 border-end border-secondary" href="{{$setting->instagram}}"><i class="fab fa-instagram"></i></a>
                    <a class="btn btn-square btn-link rounded-0" style="width: 70px !important" href="{{$setting->tiktok}}">Tiktok</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top p-0" style="z-index: 9999">
        <a href="index.html" class="navbar-brand d-flex align-items-center border-end px-4 px-lg-5">
            <h2 class="m-0 text-primary">
                <img src="{{asset('image/setting/'.$setting->logo)}}" width="" alt="">
                {{-- {{$setting->nama}} --}}
            </h2>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="{{url('/')}}" class="nav-item nav-link {{Helper::makeActiveNavbar(url('/'))}}">Beranda</a>
                
                @foreach ($menu as $m)
                    @if($m->pages != null)
                    <a href="{{url('pages/'.$m->pages->slug)}}" class="nav-item nav-link">{{$m->label}}</a>
                    @else
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">{{$m->label}}</a>
                        <div class="dropdown-menu bg-light m-0">
                            @php 
                                $menuParent = App\Models\MMenu::with('pages')->where('aktif',1)->where('parent',$m->id_menu)->get();
                            @endphp
                            @foreach ($menuParent as $item)
                                @if($item->pages != NULL)
                                    <a href="{{url('pages/'.$item->pages->slug)}}" class="dropdown-item">{{$item->label}}</a>
                                @else
                                    <a href="#" class="dropdown-item">{{$item->label}}</a>
                                @endif
                            @endforeach
                            @if($m->id_menu == 3)
                            <a href="perangkatdesa" class="dropdown-item">Perangkat Desa</a>
                            @endif
                        </div>
                    </div>
                    @endif
                @endforeach
                <a href="{{url('berita')}}" class="nav-item nav-link {{Helper::makeActiveNavbar(url('berita'))}}">Berita</a>
                @if(url()->current() == url("/"))
                <a href="#" id="kritiksaran" class="nav-item nav-link">Kritik/Saran</a>
                @else
                <a href="{{url('kritik-saran')}}" class="nav-item nav-link {{Helper::makeActiveNavbar(url('kritik-saran'))}}">Kritik/Saran</a>
                @endif
            </div>
            {{-- <a id="wisata" href="#" class="btn btn-primary rounded-0 py-4 px-lg-5 d-none d-lg-block">Kunjungi Wisata Kami<i class="fa fa-arrow-right ms-3"></i></a> --}}
        </div>
    </nav>
    <!-- Navbar End -->
    @yield('content')
    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-body footer mt-5 pt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-white mb-4">Alamat</h5>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>{{$setting->alamat}}</p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>{{$setting->no_telp}}</p>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i>{{$setting->email}}</p>
                    <div class="d-flex pt-2">
                        <a class="btn btn-square btn-outline-light btn-social" href="{{$setting->twitter}}"><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-square btn-outline-light btn-social" href="{{$setting->facebook}}"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-square btn-outline-light btn-social" href="{{$setting->youtube}}"><i class="fab fa-youtube"></i></a>
                        <a class="btn btn-square btn-outline-light btn-social" href="{{$setting->instagram}}"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-white mb-4">Link Alternatif</h5>
                    @foreach ($allMenu as $men)
                        @if($men->id_pages != 0)
                        <a class="btn btn-link" href="{{url('pages/'.$men->pages->slug)}}">{{$men->label}}</a>
                        @endif
                    @endforeach
                    
                </div>
                @php
                    $fotos = App\Models\MFoto::limit(6)->get();
                @endphp
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-white mb-4">Foto Galeri</h5>
                    <div class="row g-2">
                        @forelse ($fotos as $foto)
                            <div class="col-4">
                                <img class="img-fluid rounded" src="{{asset('image/foto/'.$foto->image)}}" alt="">
                            </div>
                        @empty
                            <div class="col-4">
                                Tidak Ada Galeri
                            </div>
                        @endforelse
                        
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-white mb-4">Butuh Informasi lain?</h5>
                    <p>Kirim Informasi yang anda minta melalui Email kami.</p>
                    <div class="position-relative mx-auto" style="max-width: 400px;">
                        <input class="form-control border-0 w-100 py-3 ps-4 pe-5" type="text" placeholder="Ketik disini">
                        <button type="button" class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">Kirim</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; <a href="#">{{$setting->nama}}</a>, All Right Reserved.
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                        Designed By <a href="https://htmlcodex.com">HTML Codex</a>
                        <br>Distributed By: <a href="https://themewagon.com" target="_blank">ThemeWagon</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('client')}}/lib/wow/wow.min.js"></script>
    <script src="{{asset('client')}}/lib/easing/easing.min.js"></script>
    <script src="{{asset('client')}}/lib/waypoints/waypoints.min.js"></script>
    <script src="{{asset('client')}}/lib/counterup/counterup.min.js"></script>
    <script src="{{asset('client')}}/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="{{asset('client')}}/lib/isotope/isotope.pkgd.min.js"></script>
    <script src="{{asset('client')}}/lib/lightbox/js/lightbox.min.js"></script>
    <script src="{{asset('client')}}/cute-alert/cute-alert.js"></script>

    <!-- Template Javascript -->
    <script src="{{asset('client')}}/js/main.js"></script>
    <script>
        $("#wisata").click(function() {
            $([document.documentElement, document.body]).animate({
                scrollTop: $("#list_wisata").offset().top
            }, 1000);
        });
        $("#kritiksaran").click(function() {
            $([document.documentElement, document.body]).animate({
                scrollTop: $("#form_kritik_saran").offset().top
            }, 1000);
        });
        $("#perangkat_desa").click(function() {
            $([document.documentElement, document.body]).animate({
                scrollTop: $("#perangkat_desa_list").offset().top
            }, 1000);
        });
        $("#form-kritik").submit(function (e) { 
            e.preventDefault();
            $(this).find('button').attr("disabled","disabled");
            $.ajax({
                type: "post",
                url: "{{url('kritik-saran-save')}}",
                data: $(this).serialize(),
                dataType: "JSON",
                success: function (response) {
                    if(response.status){
                        cuteAlert({
                            type:'success',
                            message: response.msg,
                            timer:5000,
                            title:"Makasih"
                        });
                    }
                }
            });
        });
    </script>
    @stack('js')
</body>

</html>

