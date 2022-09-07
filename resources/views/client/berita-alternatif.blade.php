
@php
    use App\Traits\Helper;
    use App\Models\MPages;
    $berita = MPages::where('tipe',5)->orderBy('created_at','desc')->limit(6)->get()
@endphp
<style>
    .alt-news:hover{
        margin-left: 1rem;
        transition: margin-left 0.5s;
    }
    .alt-news{
        margin-left: 0rem;
        transition: margin-left 0.5s;
    }
</style>
<div class="mb-4">
    <h5>Berita Terkini</h3>
    <hr>
</div>
@forelse ($berita as $item)
<a href="{{url('pages/'.$item->slug)}}" class="">
<div class="d-flex alt-news mb-2 w-100">
    <div class="flex-shrink-0">
        <img class="mt-2" width="100px"  src="{{asset('image/pages/'.$item->cover_image)}}" alt="">
    </div>
    <div class="flex-grow-1 ms-3">
        <small class="text-primary mb-0" style="font-size: 8pt">{{Helper::convertDate($item->created_at,true,false)}}</small>
        <h6>
            {!!Helper::limitText(strip_tags($item->title),100)!!}
        </h6>
    </div>
</div>
</a>
@empty
<div class="row">
    <div class="col-12">
        <div class="text-danger text-center">
            Tidak ada berita
        </div>
    </div>
</div>
@endforelse