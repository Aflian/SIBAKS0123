<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Pesanan</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }
        .header h1 {
            margin: 0;
            font-size: 18px;
        }
        .header p {
            margin: 5px 0 0;
            font-size: 11px;
            color: #666;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th {
            background-color: #f5f5f5;
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            font-size: 11px;
        }
        td {
            border: 1px solid #ddd;
            padding: 6px 8px;
            font-size: 10px;
        }
        .badge {
            display: inline-block;
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 9px;
        }
        .badge-success {
            background: #d4edda;
            color: #155724;
        }
        .badge-warning {
            background: #fff3cd;
            color: #856404;
        }
        .badge-info {
            background: #d1ecf1;
            color: #0c5460;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 9px;
            color: #999;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }
        .filter-info {
            font-size: 10px;
            color: #666;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Laporan Pesanan</h1>
        <p>SIBAKSO - Bakso Management App</p>
        <p>Dicetak: {{ now()->format('d M Y H:i') }}</p>
    </div>

    @if(isset($filterInfo) && $filterInfo)
        <div class="filter-info">
            <strong>Filter:</strong> {{ $filterInfo }}
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Pelanggan</th>
                <th>Jumlah</th>
                <th>Satuan</th>
                <th>Total Berat</th>
                <th>Harga</th>
                <th>Tanggal Ambil</th>
                <th>Pembayaran</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pesanans as $index => $pesanan)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $pesanan->pelanggan?->nama ?? '-' }}</td>
                    <td>{{ number_format($pesanan->jumlah) }}</td>
                    <td>{{ $pesanan->satuan === 'kg' ? 'Kg' : 'Pcs' }}</td>
                    <td>{{ number_format($pesanan->berat_total_gram) }} gr</td>
                    <td>{{ $pesanan->harga ? 'Rp ' . number_format($pesanan->harga, 0, ',', '.') : '-' }}</td>
                    <td>{{ \Carbon\Carbon::parse($pesanan->tanggal_ambil)->format('d M Y') }}</td>
                    <td>
                        <span class="badge {{ $pesanan->status_pembayaran === 'lunas' ? 'badge-success' : 'badge-warning' }}">
                            {{ $pesanan->status_pembayaran === 'lunas' ? 'Lunas' : 'Belum Lunas' }}
                        </span>
                    </td>
                    <td>
                        <span class="badge {{ $pesanan->status_produksi === 'selesai' ? 'badge-success' : ($pesanan->status_produksi === 'diproduksi' ? 'badge-info' : 'badge-warning') }}">
                            {{ $pesanan->status_produksi }}
                        </span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" style="text-align: center; padding: 20px;">
                        Tidak ada data pesanan
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    @if($pesanans->count() > 0)
        <div style="margin-top: 15px; font-size: 10px;">
            <strong>Ringkasan:</strong><br>
            Total Pesanan: {{ $pesanans->count() }}<br>
            Total Lunas: {{ $pesanans->where('status_pembayaran', 'lunas')->count() }}<br>
            Total Belum Lunas: {{ $pesanans->where('status_pembayaran', 'belum_lunas')->count() }}
        </div>
    @endif

    <div class="footer">
        SIBAKSO - Sistem Informasi Bakso | Dicetak oleh {{ auth()->user()?->name ?? 'Sistem' }}
    </div>
</body>
</html>
