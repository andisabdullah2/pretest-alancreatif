@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="row">
            @foreach ($products as $p)
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                    <img src="{{ asset('uploads/products/' . $p->gambar) }}" alt="{{ $p['nama'] }}" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title">{{ $p['nama'] }}</h5>
                        <p class="card-text">Rp {{ $p['harga'] }}</p>
                        <button class="btn btn-primary btn-block btn-beli" data-nama="{{ $p['nama'] }}" data-harga="{{ $p['harga'] }}">Beli</button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="col-md-4">
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <h5 class="card-title">New Customer</h5>
                <p class="card-text">List produk yang di beli:</p>
                <ul class="list-group list-group-flush produk-beli"></ul>
                <p class="card-text">Total Belanjaan: <span class="total-belanjaan">Rp 0</span></p>
                <button class="btn btn-primary btn-block btn-save">Save Bill</button>
                <button class="btn btn-primary btn-block btn-print">Print Bill</button>
                <button class="btn btn-primary btn-block btn-charge">Charge</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-saved" tabindex="-1" role="dialog" aria-labelledby="modal-saved-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-saved-title">Saved</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Bill telah berhasil disimpan.
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-charge" tabindex="-1" role="dialog" aria-labelledby="modal-charge-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-charge-title">Charge</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="total-charge">Total Charge</label>
                    <input type="text" class="form-control" id="total-charge" readonly>
                </div>
                <div class="form-group">
                    <label for="uang-pembeli">Uang Pembeli</label>
                    <input type="text" class="form-control" id="uang-pembeli">
                </div>
                <div class="form-group">
                    <label for="kembalian">Kembalian</label>
                    <input type="text" class="form-control" id="kembalian" readonly>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary btn-charge-ok">OK</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')

<script>
    $(document).ready(function() {
        var produkBeli = {};

        $('.btn-beli').on('click', function() {
            var nama = $(this).data('nama');
            var harga = $(this).data('harga');

            if (produkBeli[nama] === undefined) {
                produkBeli[nama] = {
                    jumlah: 1,
                    harga: harga
                };
            } else {
                produkBeli[nama].jumlah++;
            }

            $('.produk-beli').html('');
            var total = 0;
            $.each(produkBeli, function(index, value) {
                var hargaTotal = value.jumlah * value.harga;
                total += hargaTotal;

                $('.produk-beli').append('<li class="list-group-item">' + index + ' x' + value.jumlah + ' <span class="float-right">Rp ' + hargaTotal + '</span></li>');
            });

            $('.total-belanjaan').text('Rp ' + total);
        });

        $('.btn-save').on('click', function() {
            $('#modal-saved').modal('show');
        });

        $('.btn-print').on('click', function() {
            window.print();
        });

        $('.btn-charge').on('click', function() {
            var total = $('.total-belanjaan').text().replace('Rp ', '');
            $('#total-charge').val(total);
            $('#uang-pembeli').val('');
            $('#kembalian').val('');
            $('#modal-charge').modal('show');
        });

        $('.btn-charge-ok').on('click', function() {
            var totalCharge = parseInt($('#total-charge').val());
            var uangPembeli = parseInt($('#uang-pembeli').val());
            if (uangPembeli < totalCharge) {
            alert('Uang pembeli tidak cukup');
        } else {
            var kembalian = uangPembeli - totalCharge;
            $('#kembalian').val('Rp ' + kembalian);
            produkBeli = {};
            $('.produk-beli').html('');
            $('.total-belanjaan').text('Rp 0');
            $('#modal-charge').modal('hide');
            $('#modal-saved').modal('show');
        }
    });
});
</script>
@endsection