@extends('layouts.user_template')

@section('title')
<title>Riwayat Laporan</title>
@endsection

@section('content-title')
<h1>Riwayat Laporan</h1>
@endsection

@section('content')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h4>Riwayat Laporan</h4>
            </div>

            <div class="card-body">
                <div class="card">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Tujuan</th>
                                <th scope="col">Provinsi</th>
                                <th scope="col">Kota/Kabupaten</th>
                                <th scope="col">Alasan</th>
                                <th scope="col">Tanggal Lapor</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($reports as $report)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $report->user->name }}</td>
                                <td>
                                    @if ($report->request)
                                    <span class="badge badge-primary">Keluar Desa</span>
                                    @else
                                    <span class="badge badge-secondary">Masuk Desa</span>
                                    @endif
                                </td>
                                <td>{{ $report->province->name }}</td>
                                <td>{{ $report->city->name }}</td>
                                <td>{{ $report->description }}</td>
                                <td>{{ $report->created_at->format("d-M-Y") }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center">Riwayat laporan kosong ...</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="row float-right">
                        <div class="col">
                            {{ $reports->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection