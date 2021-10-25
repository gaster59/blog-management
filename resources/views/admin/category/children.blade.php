@extends('layout.admin')

@section('sidebar')
    @include('admin._partials.sidebar')
@endsection

@section('content')
    <div class="container-fluid p-0">

        <div class="col-12 col-lg-12 col-xxl-12 d-flex">
            <div class="card flex-fill">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <span class="card-title mb-0">Category: {{ $category->title }}</span>
                        </div>
                        <div class="col-6 d-flex flex-row-reverse bd-highlight">
                            <a class="btn btn-success ms-1 me-1" href="{{ route('admin.category.add') }}">Add category</a>
                            <a class="btn btn-success ms-1 me-1" href="{{ route('admin.category.index') }}">List categories</a>
                        </div>
                    </div>
                </div>
                <table class="table table-hover my-0">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th class="d-none d-xl-table-cell">Content</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($category->childCategory as $item)
                        <tr>
                            <td>{{ $item->title }}</td>
                            <td class="d-none d-xl-table-cell w-50">{!! $item->content !!}</td>
                            <td>
                                <a href="{{ route('admin.category.edit', ['id' => $item->id]) }}" class="btn btn-success">Edit</a>
                                <a href="{{ route('admin.category.delete', ['id' => $item->id]) }}" class="btn btn-success">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    
                </table>
            </div>
        </div>

    </div>
@endsection
