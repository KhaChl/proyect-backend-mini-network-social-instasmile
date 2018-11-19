@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Nueva publicación</div>

                <div class="card-body">
                    <form action="{{route('save.publication')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        {{-- image --}}
                        <div class="form-group row">
                            <label for="image_publication" class="col-md-4 col-form-label text-md-right">Imagen</label>
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
                                            <input id="image_publication" type="file" class="form-control{{ $errors->has('image_publication') ? ' is-invalid' : '' }}" accept="image/png, image/jpeg, image/gif" name="image_publication" required/>
                                        </div>
                                    </span>
                                </div>

                                @if ($errors->has('image_publication'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('image_publication') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        {{-- descripcion --}}
                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">Descripción</label>

                            <div class="col-md-6">
                                <textarea id="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" required autofocus></textarea>

                                @if ($errors->has('description'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        {{-- Button --}}
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Publicar
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
