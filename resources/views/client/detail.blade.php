@extends('client.app')
@section('content')
@php
    use App\Traits\Helper;
@endphp

    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-0" style="background: linear-gradient(rgba(0, 0, 0, .1), rgba(0, 0, 0, .1)), url({{asset('image/pages/'.$data->cover_image)}}) center center no-repeat;">
        <div class="container py-5">
            <h1 class="display-3 text-white mb-3 animated slideInDown">{{Helper::searchTipe($data->tipe)}}</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                    <li class="breadcrumb-item"><a class="text-white" href="#">{{$data->title}}</a></li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- About Start -->

    <div class="row mx-auto container-fluid px-lg-3">
        <div class="col-12 col-md-8">
            <div class="overflow-hidden mb-5 px-lg-0">
                <div class="container about">
                    <div class="row g-0 mx-lg-4">
                        <div class="col about-text py-5 wow fadeIn" data-wow-delay="0.5s">
                            <div class="p-lg-5 pe-lg-0">
                                @if($data->tipe == 1)
                                <h6 class="text-primary">Tentang Kami</h6>
                                @else
                                <h6 class="text-primary">{{Helper::convertDate($data->created_at,true,false)}}</h6>
                                @endif
                                <h1 class="mb-4">{{$data->title}}</h1>
                                <div class="desc">
                                    {!!$data->deskripsi!!}
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
    <!-- About End -->
            @if(count($data->galery) !== 0)
            <!-- Galery Start -->
            <div class="container-xxl py-5">
                <div class="container">
                    <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                        <h6 class="text-primary">Galery Foto</h6>
                        <h1 class="mb-4">Spot Foto kami sangat menarik loh !!</h1>
                    </div>
                    <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.1s">
                        @foreach ($data->galery as $foto)   
                            @if($foto->tipe == 1)
                            <div class="testimonial-item text-center">
                                <div class="position-relative">
                                    <img src="{{asset('image/pages/galery_foto/'.$foto->nama_file)}}">
                                </div>
                            </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- Galery End -->
            @endif
            @if(count($data->galery) !== 0)
            <!-- Galery Start -->
            @php
                $vidioCek = false;
            @endphp
            @foreach ($data->galery as $vidio)   
            @if($vidio->tipe == 2)
                @php
                    $vidioCek = true;
                @endphp
            @endif
            @endforeach
            @if($vidioCek)
            <div class="container-xxl py-5">
                <div class="container">
                    <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                        <h6 class="text-primary">Galery Vidio</h6>
                        <h1 class="mb-4">Yuk Tonton Vidio kami</h1>
                    </div>
                    <iframe class="fadeInUp" style="width:100%;height:300px;" src="https://www.youtube.com/embed/{{$vidio->nama_file}}"></iframe>
                </div>
            </div>
            @endif
            <!-- Galery End -->
            @endif
        </div>
        <div class="col-12 col-md-4 pe-5">
            <div class="py-5 sticky-top shadow-none">
                <div class="card mt-5 me-lg-5 ">
                    <div class="card-body">
                        @include('client.berita-alternatif')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
<script>
    $(document).ready(function () {
        $(".desc").find('p img').css('width','100%')
    });
</script>
@endpush