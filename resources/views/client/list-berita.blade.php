@extends('client.app')
@section('content')
@php
    use App\Traits\Helper;
@endphp
    
    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-0">
        <div class="container py-5">
            <h1 class="display-3 text-white mb-3 animated slideInDown">Berita</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a class="text-white" href="{{url('/')}}">Home</a></li>
                    <li class="breadcrumb-item"><a class="text-white" href="#">Berita</a></li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->
    <!-- Projects Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <h6 class="text-primary">Berita</h6>
                <h1 class="mb-4">Pusat Segala Informasi Tentang Kami</h1>
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
                @forelse ($berita as $item)
                    <div class="col-lg-3 col-md-6 portfolio-item first">
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="portfolio-img rounded overflow-hidden">
                                    <img class="img-fluid" src="{{asset('image/pages/'.$item->cover_image)}}" alt="">
                                    <div class="portfolio-btn">
                                        <a class="btn btn-lg-square btn-outline-light rounded-circle mx-1" href="{{asset('image/pages/'.$item->cover_image)}}" data-lightbox="portfolio"><i class="fa fa-eye"></i></a>
                                        <a class="btn btn-lg-square btn-outline-light rounded-circle mx-1" href="{{url('pages/'.$item->slug)}}"><i class="fa fa-link"></i></a>
                                    </div>
                                </div>
                                <div class="pt-3">
                                    <p class="text-primary mb-0">{{Helper::convertDate($item->created_at,true,false)}}</p>
                                    <hr class="text-primary w-25 my-2">
                                    <h5 class="lh-base">{{$item->title}}</h5>
                                    <p>{!!Helper::limitText(strip_tags($item->deskripsi),100)!!}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="text-danger text-center">
                            Tidak ada berita
                        </div>
                    </div>
                @endforelse
            </div>
            <div class="m-auto mt-5">
                {{ $berita->links('panels.paginate') }}
            </div>
        </div>
    </div>
    <!-- Projects End -->
@endsection
@push('js')
<script>
    
</script>
@endpush