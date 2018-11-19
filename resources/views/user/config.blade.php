@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            {{-- Message --}}
            @include('includes.messages')
            {{-- Card --}}
            <div class="card">
                <div class="card-header">Configuracion de mi cuenta</div>

                <div class="card-body">
                    <form method="POST" action="{{route('account.edit')}}" enctype="multipart/form-data">
                        @csrf
                        {{-- Image --}}
                        <div class="form-group row">
                            <label for="image_profile" class="col-md-4 col-form-label text-md-right">{{ __('Image Profile') }}</label>

                            <div class="col-md-6">
                                <div class="input-group image-preview">
                                    <input type="text" class="form-control image-preview-filename" disabled="disabled">
                                    <span class="input-group-btn">
                                        {{-- image-preview-clear button --}}
                                        <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                                            <i class="fas fa-eraser"></i>
                                        </button>
                                        {{-- image-preview-input --}}
                                        <div class="btn btn-default image-preview-input">
                                            <i class="far fa-image"></i>
                                            <input id="image_profile" type="file" class="form-control{{ $errors->has('image_profile') ? ' is-invalid' : '' }}" accept="image/png, image/jpeg, image/gif" name="image_profile"/>
                                        </div>
                                    </span>
                                </div>

                                @if ($errors->has('image_profile'))
                                    <label class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('image_profile') }}</strong>
                                    </label>
                                @endif
                            </div>
                        </div>
                        {{-- Name --}}
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ Auth::user()->name }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        {{-- Surname --}}
                        <div class="form-group row">
                            <label for="surname" class="col-md-4 col-form-label text-md-right">{{ __('Surname') }}</label>

                            <div class="col-md-6">
                                <input id="surname" type="text" class="form-control{{ $errors->has('surname') ? ' is-invalid' : '' }}" name="surname" value="{{ Auth::user()->surname }}" required autofocus>

                                @if ($errors->has('surname'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('surname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        {{-- Nick --}}
                        <div class="form-group row">
                            <label for="nick" class="col-md-4 col-form-label text-md-right">{{ __('Nick') }}</label>

                            <div class="col-md-6">
                                <input id="nick" type="text" class="form-control{{ $errors->has('nick') ? ' is-invalid' : '' }}" name="nick" value="{{ Auth::user()->nick }}" required autofocus>

                                @if ($errors->has('nick'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nick') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        {{-- Email --}}
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ Auth::user()->email }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        {{-- Button --}}
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Guardar cambios
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<br>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            {{-- Message --}}
            @if (session('message-success-password'))
                <div class="alert alert-success">
                        {{session('message-success-password')}}
                </div>
            @elseif (session('message-error-password'))
                <div class="alert alert-danger">
                        {{session('message-error-password')}}
                </div>
            @endif
            {{-- Card --}}
            <div class="card">
                <div class="card-header">Cambiar contraseña</div>

                <div class="card-body">
                    <form method="POST" action="{{route('account.password.change')}}">
                        @csrf
                        {{-- Password current --}}
                        <div class="form-group row">
                            <label for="password-current" class="col-md-4 col-form-label text-md-right">{{ __('Current Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-current" type="password" class="form-control{{ $errors->has('password-current') ? ' is-invalid' : '' }}" name="password-current" required>

                                @if ($errors->has('password-current'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password-current') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        {{-- New password --}}
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('New Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password-new') ? ' is-invalid' : '' }}" name="password-new" required>

                                @if ($errors->has('password-new'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password-new') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        {{-- Confirm password --}}
                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>
                        {{-- Button --}}
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Guardar cambios
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
