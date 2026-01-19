<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Nota Transaksi - {{ $penyewaan->id_penyewaan }}</title>
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
            color: #333;
            background-color: #f9f9f9;
            padding: 20px;
        }

        .nota-box {
            width: 100%;
            max-width: 600px;
            margin: auto;
            border: 1px solid #ddd;
            padding: 30px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            border-bottom: 2px dashed #2B2118;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        .info p {
            margin: 5px 0;
            font-size: 14px;
        }

        .info-highlight {
            color: #B37428;
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th {
            text-align: left;
            border-bottom: 1px solid #ddd;
            padding: 10px 5px;
            font-size: 14px;
        }

        td {
            padding: 10px 5px;
            font-size: 14px;
            border-bottom: 1px solid #f5f5f5;
        }

        .total-section {
            font-weight: bold;
            font-size: 18px;
            text-align: right;
            margin-top: 30px;
            border-top: 2px solid #2B2118;
            padding-top: 15px;
        }

        .footer-note {
            margin-top: 25px;
            text-align: center;
            font-size: 11px;
            font-style: italic;
            color: #666;
        }

        .no-print {
            margin-top: 40px;
            text-align: center;
        }

        .btn-print {
            background-color: #2B2118;
            color: white;
            padding: 10px 25px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            transition: 0.3s;
        }

        .btn-print:hover {
            background-color: #B37428;
        }

        @media print {
            body {
                background-color: white;
                padding: 0;
            }

            .nota-box {
                border: none;
                box-shadow: none;
                max-width: 100%;
            }

            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="nota-box">
        <div class="header">
            <h2 style="margin: 0; color: #2B2118;">BUSANA LARAS</h2>
            <p style="margin: 5px 0;">Penyewaan Baju Tari & Adat</p>
        </div>

        <div class="info">
            <p><strong>No. Nota:</strong> #{{ $penyewaan->id_penyewaan }}</p>
            <p><strong>Pelanggan:</strong>
                {{ $penyewaan->nama_pelanggan ?? ($penyewaan->pelanggan->nama_pelanggan ?? 'Umum') }}</p>
            <p><strong>Tgl Sewa :</strong>
                {{ \Carbon\Carbon::parse($penyewaan->tgl_sewa ?? ($penyewaan->tanggal ?? $penyewaan->created_at))->format('d/m/Y') }}
            </p>

            <p class="info-highlight"><strong>Wajib Kembali:</strong>
                @php
                    $tglAwal = \Carbon\Carbon::parse(
                        $penyewaan->tgl_sewa ?? ($penyewaan->tanggal ?? $penyewaan->created_at),
                    );

                    $durasi = $penyewaan->durasi ?? 3;

                    $tglKembali = $tglAwal->addDays($durasi);
                @endphp
                {{ $tglKembali->format('d/m/Y') }}
            </p>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Busana</th>
                    <th style="text-align: right;">Harga</th>
                    <th style="text-align: center;">Jml</th>
                    <th style="text-align: right;">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($penyewaan->details as $detail)
                    <tr>
                        <td>{{ $detail->baju->nama_baju }}</td>
                        <td style="text-align: right;">
                            Rp
                            {{ number_format($detail->harga ?? ($detail->harga_sewa ?? ($detail->jumlah > 0 ? $detail->subtotal / $detail->jumlah : 0)), 0, ',', '.') }}
                        </td>
                        <td style="text-align: center;">{{ $detail->jumlah }}</td>
                        <td style="text-align: right;">
                            Rp {{ number_format($detail->subtotal, 0, ',', '.') }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="total-section">
            Total Bayar: Rp
            {{ number_format($penyewaan->total_harga ?? $penyewaan->details->sum('subtotal'), 0, ',', '.') }}
        </div>

        <div class="footer-note">
            * Harap mengembalikan busana tepat waktu.<br>
            Keterlambatan akan dikenakan denda sesuai ketentuan.
        </div>

        <div class="no-print">
            <button onclick="window.print()" class="btn-print">Cetak Nota (Print)</button>
            <br><br>
            <a href="{{ route('admin.penyewaan.index') }}"
                style="color: #666; text-decoration: none; font-size: 13px;">← Kembali ke Daftar</a>
        </div>
    </div>
</body>

</html>
