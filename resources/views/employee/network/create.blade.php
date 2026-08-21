@extends('employee.layouts.app')
@section('title', 'Create store')
@section('content')
<div class="row text-capitalize">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <h4 class="header-title">Create store</h4>
                <form name="CreateStore" id="CreateStore" method="POST" enctype="multipart/form-data" action="{{ route('employee.network.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <title>hello</title>
                                        <label for="name">name<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" required>
                                        @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                        <br>
                                    <button type="submit" class="btn btn-primary">Create Network</button>

                    </div>
                </form>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
<!-- end row-->
@endsection
