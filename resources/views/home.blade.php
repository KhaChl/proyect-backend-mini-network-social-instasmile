@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="infinite-scroll">
                {{-- Card all publication --}}
                @foreach ($images as $image)
                    <div class="card publication">
                        <div class="card-header">
                            <a href="{{route('profile', ['id' => $image->user->id])}}">
                                <div class="container-avatar">
                                    <img src="{{route('account.avatar', ['filename' => $image->user->image_path])}}" alt="Avatar">
                                </div>
                                <div class="data-user">
                                    {{$image->user->nick}}
                                </div>
                            </a>
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
                            <hr>
                            {{-- Comments --}}
                            <div class="comments">
                                <form id="form-comment" action="{{route('save.comment')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="image_id" value="{{$image->id}}">
                                    <textarea id="comment" name="content" class="form-control" required></textarea>
                                    <button type="submit" class="btn btn-outline-success">Enviar</button>
                                </form>
                                <hr>
                                @foreach ($image->comments as $comment)
                                    <div class="comment">
                                        <span class="nickname">{{'@'.$comment->user->nick}}</span>
                                        <span class="nickname date">{{'| '.\FormatTime::LongTimeFilter($comment->created_at)}}</span>
                                        @if (Auth::check() && ($comment->user_id == Auth::user()->id || $comment->image->user_id == Auth::user()->id))
                                                <a href="{{route('comment.delete', ['id' => $comment->id])}}">
                                                    <i class="fas fa-minus-circle"></i>
                                                </a>
                                            @endif
                                        <p>
                                            {{$comment->content}}
                                        </p>   
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
                {{$images->links()}}
            </div>
        </div>
    </div>
</div>
@endsection
