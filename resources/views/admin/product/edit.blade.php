@extends('layout.admin')

@section('sidebar')
    @include('admin._partials.sidebar')
@endsection

@section('content')
    <div class="container-fluid p-0">


        <div class="mb-3">
            <h1 class="h3 d-inline align-middle">Edit Post</h1>
            <a class="badge bg-dark text-white ms-2" href="{{ route('admin.post.index') }}">
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
                <form method="post" action="{{ route('admin.post.doEdit', ['id' => $post->id]) }}" enctype="multipart/form-data">
                    <input type="hidden" name="method" value="edit" />
                    @csrf
                    <div class="card">
                        <div class="m-3 row">
                            <label for="name" class="col-sm-2 col-form-label">Title</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="title" name="title"
                                    value="{{ old('title', $post->title) }}" />
                                @if ($errors->has('title'))
                                    <div class="alert text-danger">{{ $errors->first('title') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="m-3 row">
                            <label for="name" class="col-sm-2 col-form-label">Category</label>
                            <div class="col-sm-10">
                                <select name="category_id[]" title="category_id">
                                    <option value=""></option>
                                    @foreach ($categories as $item)
                                        @php
                                            $selected = '';
                                            $oldCategoryId = old('category_id', $postCategory);
                                            if (in_array($item->id, $oldCategoryId)) {
                                                $selected = 'selected';
                                            }
                                        @endphp
                                        <option {{ $selected }} value="{{ $item->id }}">{{ $item->title }}
                                        </option>
                                        @if (count($item->childCategory) > 0)
                                            @foreach ($item->childCategory as $children)
                                                @php
                                                    $selected = '';
                                                    if (in_array($children->id, $oldCategoryId)) {
                                                        $selected = 'selected';
                                                    }
                                                @endphp
                                                <option {{ $selected }} value="{{ $children->id }}"> --
                                                    {{ $children->title }}
                                                </option>
                                            @endforeach
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="m-3 row">
                            <label for="content" class="col-sm-2 col-form-label">Summary</label>
                            <div class="col-sm-10">
                                <textarea id="summary" name="summary">{{ old('summary', $post->summary) }}</textarea>
                                @if ($errors->has('summary'))
                                    <div class="alert text-danger">{{ $errors->first('summary') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="m-3 row">
                            <label for="content" class="col-sm-2 col-form-label">Content</label>
                            <div class="col-sm-10">
                                <textarea id="content" name="content">{{ old('content', $post->content) }}</textarea>
                                @if ($errors->has('content'))
                                    <div class="alert text-danger">{{ $errors->first('content') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="m-3 row">
                            <label for="content" class="col-sm-2 col-form-label">Avatar</label>
                            <div class="col-sm-10">
                                <input type="file" name="avatar" accept="image/*" />
                                <img alt="{{ $post->title }}" src="{{ asset('post/'.$post->avatar) }}" class="img-thumbnail w-25" />
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
