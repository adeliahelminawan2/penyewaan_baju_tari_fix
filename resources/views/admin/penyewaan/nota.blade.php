<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Transaksi - {{ $penyewaan->id_penyewaan }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .nota-box { max-width: 800px; margin: auto; background: white; }
        @media print {
            body { background-color: white; }
            .nota-box { shadow: none; border: none; max-width: 100%; }
            .d-print-none { display: none !important; }
        }
    </style>
</head>
<body class="p-3 p-md-5">

    <div class="card nota-box shadow-sm border-0 rounded-0 p-4 p-md-5">
        
        <div class="text-center border-bottom border-2 border-dark pb-4 mb-4">
            <h2 class="fw-bold text-uppercase mb-1 text-dark">Busana Laras</h2>
            <p class="text-muted small text-uppercase mb-0">Penyewaan Baju Tari & Adat</p>
        </div>

        <div class="row mb-4">
            <div class="col-6">
                <p class="mb-1 small text-muted text-uppercase fw-bold">No. Nota</p>
                <h5 class="fw-bold">{{ $penyewaan->kode_sewa }}</h5>
            </div>
            <div class="col-6 text-end">
                <p class="mb-1 small text-muted text-uppercase fw-bold">Tanggal Sewa</p>
                <h5 class="fw-bold">{{ date('d/m/Y', strtotime($penyewaan->tanggal_sewa)) }}</h5>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-6">
                <p class="mb-1 small text-muted text-uppercase fw-bold">Pelanggan</p>
                <h6 class="fw-bold text-uppercase">{{ $penyewaan->nama_pelanggan }}</h6>
                <p class="mb-0 small text-muted">{{ $penyewaan->no_hp }}</p>
                <p class="mb-0 small text-muted">Jaminan: <strong>{{ $penyewaan->jaminan ?? '-' }}</strong></p>
            </div>
            <div class="col-6 text-end">
                <p class="mb-1 small text-muted text-uppercase fw-bold">Wajib Kembali</p>
                <h6 class="fw-bold text-danger">{{ date('d/m/Y', strtotime($penyewaan->tanggal_kembali_rencana)) }}</h6>
            </div>
        </div>

        <div class="table-responsive mb-4">
            <table class="table table-bordered border-dark mb-0">
                <thead class="bg-light">
                    <tr class="text-uppercase small fw-bold text-center">
                        <th class="text-start">Busana</th>
                        <th class="text-end">Harga</th>
                        <th>Qty</th>
                        <th class="text-end">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($penyewaan->details as $detail)
                        <tr>
                            <td>{{ $detail->baju->nama_baju }}</td>
                            <td class="text-end">
                                Rp {{ number_format($detail->harga_sewa, 0, ',', '.') }}
                            </td>
                            <td class="text-center">{{ $detail->jumlah }}</td>
                            <td class="text-end fw-bold">
                                Rp {{ number_format($detail->subtotal, 0, ',', '.') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot class="border-top border-2 border-dark">
                    <tr>
                        <td colspan="3" class="text-end fw-bold text-uppercase small pt-3">Total Biaya</td>
                        <td class="text-end fw-bold pt-3">
                            Rp {{ number_format($penyewaan->total_harga, 0, ',', '.') }}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-end fw-bold text-uppercase small text-success">Dibayar</td>
                        <td class="text-end fw-bold text-success">
                            Rp {{ number_format($penyewaan->total_bayar, 0, ',', '.') }}
                        </td>
                    </tr>
                    @php $sisa = $penyewaan->total_harga - $penyewaan->total_bayar; @endphp
                    @if($sisa > 0)
                    <tr>
                        <td colspan="3" class="text-end fw-bold text-uppercase small text-danger">Sisa Tagihan</td>
                        <td class="text-end fw-bold text-danger border border-2 border-danger">
                            Rp {{ number_format($sisa, 0, ',', '.') }}
                        </td>
                    </tr>
                    @else
                    <tr>
                        <td colspan="4" class="text-center fw-black text-uppercase p-2 bg-success text-white">LUNAS</td>
                    </tr>
                    @endif
                </tfoot>
            </table>
        </div>

        <div class="text-center mt-5">
            <p class="text-muted small fst-italic mb-0">
                * Harap mengembalikan busana tepat waktu.<br>
                Keterlambatan akan dikenakan denda sesuai ketentuan.
            </p>
        </div>

        <div class="d-print-none text-center mt-5">
            <button onclick="window.print()" class="btn btn-dark fw-bold px-4 rounded-pill shadow-sm me-2">
                <i class="fas fa-print me-2"></i> Cetak Nota
            </button>
            <a href="{{ route('admin.penyewaan.index') }}" class="btn btn-outline-secondary fw-bold px-4 rounded-pill">
                Kembali
            </a>
        </div>
    </div>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</body>
</html>
