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
                            <span class="card-title mb-0">List Posts</span>
                        </div>
                        <div class="col-6 d-flex flex-row-reverse bd-highlight">
                            <a class="btn btn-success" href="{{ route('admin.post.add') }}">Add post</a>    
                        </div>
                    </div>
                </div>
                <table class="table table-hover my-0">
                    <thead>
                        <tr>
                            <th>Avatar</th>
                            <th>Title</th>
                            <th class="d-none d-xl-table-cell">Summary</th>
                            <th class="d-none d-xl-table-cell">Content</th>
                            <th class="d-none d-xl-table-cell">Category</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $item)
                        <tr>
                            <td class="w-25">
                                <img alt="{{ $item->title }}" src="{{ asset('post/'.$item->avatar) }}" class="img-thumbnail w-50" />
                            </td>
                            <td><p>{{ $item->title }}</p></td>
                            <td class="d-none d-xl-table-cell">{!! $item->summary !!}</td>
                            <td class="d-none d-xl-table-cell w-25">{!! $item->content !!}</td>
                            <td class="d-none d-xl-table-cell">
                                @if(count($item->category) > 0)
                                <ul class="pl-0 list-unstyled">
                                @foreach ($item->category as $category)
                                    <li>{{ $category->title }}</li>
                                @endforeach
                                </ul>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.post.edit', ['id' => $item->id]) }}" class="btn btn-success">Edit</a>
                                <a href="{{ route('admin.post.delete', ['id' => $item->id]) }}" class="btn btn-success">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    
                    <tfoot>
                        <tr>
                            <td colspan="6">
                                {{ $posts->links() }}
                            </td>
                        </tr>
                    </tfoot>
                    
                </table>
            </div>
        </div>

    </div>
@endsection
