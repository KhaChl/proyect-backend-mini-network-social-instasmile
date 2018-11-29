@extends('layouts.app')

@section('content')
<main role="main">
    <section class="text-center">
        <div class="container">
            <div class="jumbotron-heading">
                <div class="profile-avatar">
                    <img src="{{route('account.avatar', ['filename' => $user->image_path])}}" alt="Avatar">
                </div>
                <div class="name surname">
                    {{$user->name. ' ' . $user->surname}}
                </div>
                <div class="nick">
                    {{'@' . $user->nick}}
                </div>
            </div>
        </div>
    </section>
    <div class="album py-5 bg-light">
        <div class="container">
            <div class="text-center">
                <h2>Publicaciones</h2><br>
            </div>
            {{-- Message --}}
            @include('includes.messages')
            <div class="row">
                @foreach ($user->images->sortByDesc('id') as $image)
                    <div class="col-md-4">
                        <div class="card publication">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="container-avatar">
                                            <img src="{{route('account.avatar', ['filename' => $image->user->image_path])}}" alt="Avatar">
                                        </div>
                                        <div class="data-user">
                                            {{$image->user->nick}}
                                        </div>
                                    </div>
                                    {{-- Delete or Update publication --}}
                                    <div class="action text-right col-sm-4">
                                        @if (Auth::user() && (Auth::user()->id == $user->id))
                                            <a href="{{route('publication.delete', ['id' => $image->id])}}"><i class="far fa-trash-alt fa-lg"></i></a>   
                                        @endif
                                    </div>
                                </div>      
                            </div>
                            <div class="card-body">
                                {{-- Image --}}
                                <div class="publication-image">
                                    <img src="{{ route('publication.image', ['filename' => $image->image_path]) }}" alt="publication-image">
                                </div>
                                {{-- Likes --}}
                                <div class="likes">
                                    {{-- Check user like image --}}
                                    <?php $user_like = false;?>
                                    @foreach ($image->likes as $like)
                                        @if ($like->user->id == Auth::user()->id)
                                            <?php $user_like = true;?>
                                        @endif
                                    @endforeach
        
                                    @if ($user_like)
                                        <img src="{{asset('img/hearts-red.png')}}" data-id="{{$image->id}}" class="btn-like">
                                    @else
                                        <img src="{{asset('img/hearts-grey.png')}}" data-id="{{$image->id}}" class="btn-dislike">
                                    @endif
                                </div> 
                                <div class="count-like">
                                    <span class="grey like">{{$image->likes->count()}} me gusta</span>
                                </div>
                                {{-- Description --}}
                                <div class="description">  
                                    <span class="grey">{{'@'.$image->user->nick}}</span>
                                    <span class="grey date">{{'| '.\FormatTime::LongTimeFilter($image->created_at)}}</span>
                                    <p>{{$image->description}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>  
</main>
@endsection
