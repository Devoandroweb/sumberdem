@extends('client.app')
@section('content')
@php
    use App\Traits\Helper;
@endphp
<!-- Carousel Start -->
<div class="container-fluid p-0 pb-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="owl-carousel header-carousel position-relative">
        @forelse ($pages as $item)
        <div class="owl-carousel-item position-relative" data-dot="<img src='{{asset('image/pages/'.$item->cover_image)}}'>">
            <img class="img-fluid" src="{{asset('image/pages/'.$item->cover_image)}}" alt="">
            <div class="owl-carousel-inner">
                <div class="container">
                    <div class="row justify-content-start">
                        <div class="col-10 col-lg-8">
                            <h1 class="display-2 text-white animated slideInDown">{!!$item->title!!}</h1>
                            <p class="fs-5 fw-medium text-white mb-4 pb-3">{!!Helper::limitText(strip_tags($item->deskripsi),150)!!}</p>
                            <a href="{{$item->url}}" class="btn btn-primary rounded-pill py-3 px-5 animated slideInLeft">Selengkapnya</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty    
        <div class="owl-carousel-item position-relative" data-dot="<img src='{{asset('client')}}/img/carousel-1.jpg'>">
            <img class="img-fluid" src="{{asset('client')}}/img/carousel-1.jpg" alt="">
            <div class="owl-carousel-inner">
                <div class="container">
                    <div class="row justify-content-start">
                        <div class="col-10 col-lg-8">
                            <h1 class="display-2 text-white animated slideInDown">Tidak ada Content</h1>
                            <p class="fs-5 fw-medium text-white mb-4 pb-3">-</p>
                            <a href="#" class="btn btn-primary rounded-pill py-3 px-5 animated slideInLeft">Selengkapnya</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforelse
        
        
    </div>
</div>
<!-- Carousel End -->

<!-- About Start -->

@if($visiMisi != null)
<div class="container-fluid bg-light overflow-hidden my-5 px-lg-0">
    <div class="container about px-lg-0">
        <div class="row g-0 mx-lg-0">
            <div class="col-lg-6 ps-lg-0 wow fadeIn" data-wow-delay="0.1s" style="min-height: 400px;">
                <div class="position-relative h-100">
                    <img class="position-absolute img-fluid w-100 h-100" src="{{asset('image/pages/'.$visiMisi->cover_image)}}" style="object-fit: cover;" alt="">
                </div>
            </div>
            <div class="col-lg-6 about-text py-5 wow fadeIn" data-wow-delay="0.5s">
                <div class="p-lg-5 pe-lg-0">
                    <h6 class="text-primary">Tentang Kami</h6>
                    <h1 class="mb-4">{{$visiMisi->title}}</h1>
                    {!!Helper::limitText(strip_tags($visiMisi->deskripsi),150)!!}
                    <a href="{{url($visiMisi->url)}}" class="btn btn-primary rounded-pill py-3 px-5 mt-3">Selengkapnya</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
<!-- About End -->

<!-- Projects Start -->

<div class="container-xxl py-5" id="list_wisata">
    <div class="container">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <h6 class="text-primary">Kampung Wisata</h6>
            <h1 class="mb-4">Yuk kunjungi Kampung Wisata Kami, banyak Spot Foto bagus loh ... </h1>
        </div>
        <div class="row mt-n2 wow fadeInUp d-none" data-wow-delay="0.3s">
            <div class="col-12 text-center">
                <ul class="list-inline mb-5" id="portfolio-flters">
                    <li class="mx-2 active" data-filter="*">All</li>
                    <li class="mx-2" data-filter=".first">Solar Panels</li>
                    <li class="mx-2" data-filter=".second">Wind Turbines</li>
                    <li class="mx-2" data-filter=".third">Hydropower Plants</li>
                </ul>
            </div>
        </div>
        <div class="row g-4 portfolio-container wow fadeInUp" data-wow-delay="0.5s">
            @forelse ($kampungWisata as $kw)
            <div class="col-lg-4 col-md-6 portfolio-item first">
                <div class="portfolio-img rounded overflow-hidden">
                    <img class="img-fluid" src="{{asset('image/pages/'.$kw->cover_image)}}" alt="">
                    <div class="portfolio-btn">
                        <a class="btn btn-lg-square btn-outline-light rounded-circle mx-1" href="{{asset('image/pages/'.$kw->cover_image)}}" data-lightbox="{{$kw->title}}"><i class="fa fa-eye"></i></a>
                        <a class="btn btn-lg-square btn-outline-light rounded-circle mx-1" href="{{url($kw->url)}}"><i class="fa fa-link"></i></a>
                    </div>
                </div>
                <div class="pt-3">
                    <p class="text-primary mb-0">{{$kw->title}}</p>
                    <hr class="text-primary w-25 my-2">
                    <h5 class="lh-base">
                    {!!Helper::limitText(strip_tags($kw->deskripsi),50)!!}
                    </h5>
                </div>
            </div>
            @empty
            <div class="col-lg-4 col-md-6 portfolio-item first">
                <h4>Tidak ada Content</h4>
            </div>
            @endforelse
        </div>
    </div>
</div>
<!-- Projects End -->


<!-- Quote Start -->
<div class="container-fluid bg-light overflow-hidden my-5 px-lg-0" id="form_kritik_saran">
    <div class="container quote px-lg-0">
        <div class="row g-0 mx-lg-0">
            
            <div class="col-lg-6 quote-text py-5 wow fadeIn" data-wow-delay="0.5s">
                <div class="p-lg-5 pe-lg-0">
                    <h6 class="text-primary">Kritik dan Saran</h6>
                    <h1 class="mb-4">Kirim Kritik dan Saran anda kepada Kami</h1>
                    <form id="form-kritik" action="" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-12 col-sm-6">
                                <input type="text" name="nama_pengunjung" class="form-control border-0" placeholder="Nama Kamu" style="height: 55px;">
                            </div>
                            <div class="col-12 col-sm-6">
                                <input type="email" name="email" class="form-control border-0" placeholder="Email Kamu" style="height: 55px;">
                            </div>
                            <div class="col-12">
                                <input type="text" name="no_telp" class="form-control border-0" placeholder="No Handphone Kamu" style="height: 55px;">
                            </div>
                            <div class="col-12">
                                <textarea name="deskripsi" class="form-control border-0" rows="10" placeholder="Ketik Kritik dan Saran anda disini ... "></textarea>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary rounded-pill py-3 px-5" type="submit">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-6 ps-lg-0 wow fadeIn" data-wow-delay="0.1s" style="min-height: 400px;">
                <div class="position-relative h-100">
                    <img class="position-absolute img-fluid w-100 h-100" src="{{asset('client')}}/img/quote.jpg" style="object-fit: cover;" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Quote End -->
@endsection