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
                            <span class="card-title mb-0">Dashboard</span>
                        </div>
                        {{-- <div class="col-6 d-flex flex-row-reverse bd-highlight">
                            <a class="btn btn-success" href="{{ route('admin.category.add') }}">Add category</a>    
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
