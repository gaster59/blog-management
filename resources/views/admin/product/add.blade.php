@extends('layout.admin')

@section('sidebar')
    @include('admin._partials.sidebar')
@endsection

@section('content')
    <div class="container-fluid p-0">


        <div class="mb-3">
            <h1 class="h3 d-inline align-middle">Add Post</h1>
            <a class="badge bg-dark text-white ms-2" href="{{ route('admin.product.index') }}">
                Return to list
            </a>
            @if (session('success'))
                <div class="alert alert-primary" role="alert">
                    {{ session('success') }}
                </div>
            @endif
        </div>

        <div class="row">
            <div class="col-12 col-lg-12">
                <form method="post" action="{{ route('admin.product.doAdd') }}" enctype="multipart/form-data">
                    <input name="method" type="hidden" value="add" />
                    @csrf
                    <div class="card">
                        <div class="m-3 row">
                            <label for="name" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ old('name', '') }}" />
                                @if ($errors->has('name'))
                                    <div class="alert text-danger">{{ $errors->first('name') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="m-3 row">
                            <label for="name" class="col-sm-2 col-form-label">Genre</label>
                            <div class="col-sm-10">
                                <select name="genre_id" title="genre_id">
                                    <option value=""></option>
                                    @foreach ($genres as $item)
                                        @php
                                            $selected = '';
                                            $oldCategoryId = old('genre_id', '');
                                            if ($item->id == $oldCategoryId) {
                                                $selected = 'selected';
                                            }
                                        @endphp
                                        <option {{ $selected }} value="{{ $item->id }}">{{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="m-3 row">
                            <label for="description" class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-10">
                                <textarea id="description" class="form-control" name="description">{{ old('description', '') }}</textarea>
                                @if ($errors->has('description'))
                                    <div class="alert text-danger">{{ $errors->first('description') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="m-3 row">
                            <label for="summary" class="col-sm-2 col-form-label">Summary</label>
                            <div class="col-sm-10">
                                <textarea id="summary" class="form-control" name="summary">{{ old('summary', '') }}</textarea>
                                @if ($errors->has('summary'))
                                    <div class="alert text-danger">{{ $errors->first('summary') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="m-3 row">
                            <label for="price" class="col-sm-2 col-form-label">Price</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="price" name="price"
                                    value="{{ old('price', '') }}" />
                                @if ($errors->has('price'))
                                    <div class="alert text-danger">{{ $errors->first('price') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="m-3 row">
                            <label for="meta_description" class="col-sm-2 col-form-label">Meta description</label>
                            <div class="col-sm-10">
                                <textarea id="meta_description" class="form-control" name="meta_description">{{ old('meta_description', '') }}</textarea>
                                @if ($errors->has('meta_description'))
                                    <div class="alert text-danger">{{ $errors->first('meta_description') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="m-3 row">
                            <label for="meta_keyword" class="col-sm-2 col-form-label">Meta keyword</label>
                            <div class="col-sm-10">
                                <textarea id="meta_keyword" class="form-control" name="meta_keyword">{{ old('meta_keyword', '') }}</textarea>
                                @if ($errors->has('meta_keyword'))
                                    <div class="alert text-danger">{{ $errors->first('meta_keyword') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="m-3 row">
                            <label for="content" class="col-sm-2 col-form-label">Avatar</label>
                            <div class="col-sm-10">
                                <input type="file" name="avatar" accept="image/*" />
                                @if ($errors->has('avatar'))
                                    <div class="alert text-danger">{{ $errors->first('avatar') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="m-3 row">
                            <div class="col-sm-2">
                            </div>
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-success">Add</button>
                                <button type="reset" class="btn btn-success">Reset</button>
                            </div>
                        </div>

                    </div>
                </form>

            </div>
        </div>

    </div>



@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {

            CKEDITOR.replace('content', {
                filebrowserUploadUrl: "{{ route('ckeditor.image-upload', ['_token' => csrf_token()]) }}",
                filebrowserUploadMethod: 'form'
            });
            CKEDITOR.replace('summary', {
                filebrowserUploadUrl: "{{ route('ckeditor.image-upload', ['_token' => csrf_token()]) }}",
                filebrowserUploadMethod: 'form'
            });
        });
    </script>
@endsection
