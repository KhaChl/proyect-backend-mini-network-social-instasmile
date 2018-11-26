@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            {{-- Message --}}
            @include('includes.messages')
            <div class="infinite-scroll">
                {{-- Card all publication --}}
                @foreach ($images as $image)
                    <div class="card publication">
                        <div class="card-header">
                            <a href="">
                                <div class="container-avatar">
                                    <img src="{{route('account.avatar', ['filename' => $image->user->image_path])}}" alt="Avatar">
                                </div>
                                <div class="data-user">
                                    {{$image->user->nick}}
                                </div>
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="publication-image">
                                <img src="{{ route('publication.image', ['filename' => $image->image_path]) }}" alt="publication-image">
                            </div>
                            <div class="likes">
                                <img src="{{asset('img/hearts-grey.png')}}">
                            </div> 
                            <div class="description">  
                                <span class="nickname">{{'@'.$image->user->nick}}</span>
                                <span class="nickname date">{{'| '.\FormatTime::LongTimeFilter($image->created_at)}}</span>
                                <p>{{$image->description}}</p>
                            </div>
                            <a href="" class="btn btn-comments">
                                Comentarios
                            </a>
                        </div>
                    </div>
                @endforeach
                {{$images->links()}}
            </div>
        </div>
    </div>
</div>
@endsection
