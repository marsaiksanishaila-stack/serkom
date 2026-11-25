@extends('layouts.landing')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">

                <h2 class="fw-bold mb-4 text-center">Input Data Barang</h2>

                <form action="{{ route('ujikom.hitung') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Nama Barang 1</label>
                        <input type="text" name="barang1" class="form-control" value="{{ old('barang1', $request->barang1 ?? '') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Harga Barang 1</label>
                        <input type="number" name="harga1" class="form-control" value="{{ old('harga1', $request->harga1 ?? '') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nama Barang 2</label>
                        <input type="text" name="barang2" class="form-control" value="{{ old('barang2', $request->barang2 ?? '') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Harga Barang 2</label>
                        <input type="number" name="harga2" class="form-control" value="{{ old('harga2', $request->harga2 ?? '') }}">
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        Hitung Total
                    </button>
                </form>

                @if(@isset($total))
                    <hr class="my-4">

                    <h4 class="fw-bold text-center mb-3">
                        Hasil Perhitungan
                    </h4>

                    <p>Nama Barang 1: {{ $request->barang1 }}</p>
                    <p>Harga Barang 1: Rp{{ number_format($request->harga1, 0, ',', '.') }}</p>

                    <p>Nama Barang 2: {{ $request->barang2 }}</p>
                    <p>Harga Barang 2: Rp{{ number_format($request->harga2, 0, ',', '.') }}</p>

                    <div class="fw-bold mb-4 mb-3">
                        <h5 class="fw-bold mb-0">
                            Total Belanja: Rp{{ number_format($total, 0, ',', '.') }}
                        </h5>
                    </div>

                    <p class="fw-bold mb-0">
                        Bonus: {{ $bonus }}
                    </p>
                @endif

    </div>
</div>
@endsection

