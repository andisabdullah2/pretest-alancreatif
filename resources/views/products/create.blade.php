@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h2>Add New Product</h2>
            <hr>
            <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="nama">Nama:</label>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama') }}">
                    @error('nama')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="deskripsi">Deskripsi:</label>
                    <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="harga">Harga:</label>
                    <input type="number" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga" value="{{ old('harga') }}">
                    @error('harga')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                    <div class="form-group">
                    <label for="gambar">Gambar:</label>
                    <input type="file" class="form-control @error('gambar') is-invalid @enderror" id="gambar" name="gambar">
                    @error('gambar')
                <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            <button type="submit" class="btn btn-primary">Add Product</button>
            </form>
        </div>
    </div>

</div>
@endsection