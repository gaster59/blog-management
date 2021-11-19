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
                            <span class="card-title mb-0">List Genre</span>
                        </div>
                        <div class="col-6 d-flex flex-row-reverse bd-highlight">
                            <a class="btn btn-success" href="{{ route('admin.genre.add') }}">Add genre</a>
                        </div>
                    </div>
                </div>
                <table class="table table-hover my-0">
                    <thead>
                        <tr>
                            <th>Title</th>
                            {{-- <th></th> --}}
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($genres as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>
                                    <a href="{{ route('admin.genre.edit', ['id' => $item->id]) }}"
                                        class="btn btn-success">Edit</a>
                                    <a href="{{ route('admin.genre.delete', ['id' => $item->id]) }}"
                                        class="btn btn-success">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
