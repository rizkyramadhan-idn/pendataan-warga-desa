@extends('layouts.admin_template')

@section('title')
<title>Edit Kota</title>
@endsection

@section('content-title')
<h1>Edit Kota</h1>
@endsection

@section('content')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.cities.update', $city->id) }}" method="POST">
                    @csrf
                    @method("PUT")

                    <div class="form-group">
                        <label>Pilih Provinsi</label>

                        <select name="province_id" class="form-control" id="province_id">
                            @foreach ($provinces as $province)
                            <option value="{{ $province->id }}"
                                {{ $city->province->id == $province->id ? "selected" : "" }}>{{ $province->name }}
                            </option>
                            @endforeach
                        </select>

                        <p class="text-danger">{{ $errors->first("province_id") }}</p>
                    </div>

                    <div class="form-group">
                        <label>Nama Kota</label>

                        <input name="name" type="text" class="form-control" id="name"
                            placeholder="Masukkan nama provinsi" value="{{ $city->name }}">

                        <p class="text-danger">{{ $errors->first("name") }}</p>
                    </div>

                    <div class="form-group">
                        <label>Pilih Tipe</label>

                        <select name="type" class="form-control">
                            <option value="Kabupaten" {{ $city->type == "Kabupaten" ? "selected" : "" }}>Kabupaten
                            </option>
                            <option value="Kota" {{ $city->type == "Kota" ? "selected" : "" }}>Kota</option>
                        </select>

                        <p class="text-danger">{{ $errors->first("type") }}</p>
                    </div>

                    <div class="form-group">
                        <label>Kode POS</label>

                        <input name="postal_code" type="number" class="form-control" id="postal_code"
                            placeholder="Masukkan kode POS" value="{{ $city->postal_code }}">

                        <p class="text-danger">{{ $errors->first("postal_code") }}</p>
                    </div>

                    <button class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection