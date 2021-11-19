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
                            <span class="card-title mb-0">List Product</span>
                        </div>
                        <div class="col-6 d-flex flex-row-reverse bd-highlight">
                            <a class="btn btn-success" href="{{ route('admin.product.add') }}">Add product</a>    
                        </div>
                    </div>
                </div>
                <table class="table table-hover my-0">
                    <thead>
                        <tr>
                            <th>Avatar</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th class="d-none d-xl-table-cell">Price</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $item)
                        <tr>
                            <td class="w-25">
                                <img alt="{{ $item->name }}" src="{{ asset('product/'.$item->avatar) }}" class="img-thumbnail w-50" />
                            </td>
                            <td><p>{{ $item->name }}</p></td>
                            <td><p>{{ $item->genre->name }}</p></td>
                            <td class="d-none d-xl-table-cell">
                            </td>
                            <td>
                                <a href="{{ route('admin.product.edit', ['id' => $item->id]) }}" class="btn btn-success">Edit</a>
                                <a href="{{ route('admin.product.delete', ['id' => $item->id]) }}" class="btn btn-success">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    
                    <tfoot>
                        <tr>
                            <td colspan="4">
                                {{ $products->links() }}
                            </td>
                        </tr>
                    </tfoot>
                    
                </table>
            </div>
        </div>

    </div>
@endsection
