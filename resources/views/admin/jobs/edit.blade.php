@extends('layouts.admin_template')

@section('title')
<title>Edit Pekerjaan</title>
@endsection

@section('content-title')
<h1>Edit Pekerjaan</h1>
@endsection

@section('content')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.jobs.update', $job->id) }}" method="POST">
                    @csrf
                    @method("PUT")

                    <div class="form-group">
                        <label>Nama Pekerjaan</label>

                        <input name="name" type="text" class="form-control" id="name"
                            placeholder="Masukkan nama pekerjaan" value="{{ $job->name }}">

                        <p class="text-danger">{{ $errors->first("name") }}</p>
                    </div>

                    <button class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection