@if (Auth::user()->image_path)
    <div class="container-avatar">
        <img src="{{route('account.avatar', ['filename' => Auth::user()->image_path])}}" alt="Avatar">
    </div>
@endif