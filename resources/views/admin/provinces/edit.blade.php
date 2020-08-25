@extends('layouts.admin_template')

@section('title')
<title>Edit Provinsi</title>
@endsection

@section('content-title')
<h1>Edit Provinsi</h1>
@endsection

@section('content')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.provinces.update', $province->id) }}" method="POST">
                    @csrf
                    @method("PUT")

                    <div class="form-group">
                        <label>Nama Provinsi</label>

                        <input name="name" type="text" class="form-control" id="name"
                            placeholder="Masukkan nama provinsi" value="{{ $province->name }}">

                        <p class="text-danger">{{ $errors->first("name") }}</p>
                    </div>

                    <button class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection