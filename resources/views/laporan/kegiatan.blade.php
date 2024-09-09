<!DOCTYPE html>
<html>
<head>
    <title>Laporan Kegiatan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        h1, h2, h3 {
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        .text-center {
            text-align: center;
        }
        .section-title {
            background-color: #f2f2f2;
            padding: 10px;
            margin-top: 20px;
            border-bottom: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <h1 class="text-center">Laporan Pemeriksaan Kegiatan</h1>

    @foreach($kegiatan as $kegiatan)
        <h2>{{ $kegiatan->nm_kegiatan }}</h2>
        <p>Tanggal Kegiatan: {{ $kegiatan->tgl_kegiatan }}</p>

        <h3 class="section-title">Data Pemeriksaan</h3>
        <table>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Usia</th>
                    <th>Berat Badan (kg)</th>
                    <th>Tinggi Badan (cm)</th>
                    <th>Vitamin A</th>
                    <th>Obat Cacing</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kegiatan->pemeriksaan as $pemeriksaan)
                    <tr>
                        <td>{{ $pemeriksaan->sasaran ? $pemeriksaan->sasaran->nama : ($pemeriksaan->anak ? $pemeriksaan->anak->nama : '-') }}</td>
                        <td>{{ $pemeriksaan->sasaran ? \Carbon\Carbon::parse($pemeriksaan->sasaran->tgl_lahir)->age . ' Tahun' : ($pemeriksaan->anak ? number_format(\Carbon\Carbon::parse($pemeriksaan->anak->tgl_lahir)->diffInMonths(\Carbon\Carbon::now())) . ' Bulan' : '-') }}</td>
                        <td>{{ $pemeriksaan->bb }}</td>
                        <td>{{ $pemeriksaan->tb }}</td>
                        <td>{{ $pemeriksaan->vit_a }}</td>
                        <td>{{ $pemeriksaan->obat_cacing }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Ringkasan pemberian Vitamin A dan Obat Cacing -->
        @php
            $totalVitaminAm = $kegiatan->pemeriksaan->where('vit_a', 'Kapsul Merah',)->count();
            $totalVitaminAb = $kegiatan->pemeriksaan->where('vit_a', 'Kapsul Biru',)->count();
            $totalObatCacing = $kegiatan->pemeriksaan->where('obat_cacing', 'Diberikan')->count();
        @endphp

        <h3 class="section-title">Ringkasan</h3>
        <p>Jumlah Pemberian Vitamin A Kapsul Merah: <strong>{{ $totalVitaminAm }} orang</strong></p>
        <p>Jumlah Pemberian Vitamin A Kapsul Biru: <strong>{{ $totalVitaminAb }} orang</strong></p>
        <p>Jumlah Pemberian Obat Cacing: <strong>{{ $totalObatCacing }} orang</strong></p>

        <!-- Daftar Nama Penerima Vitamin A -->
        <h3 class="section-title">Penerima Vitamin A</h3>
        <ul>
            @foreach($kegiatan->pemeriksaan->where('vit_a', 'Kapsul Merah') as $penerimaVitaminA)
                <li>{{ $penerimaVitaminA->sasaran ? $penerimaVitaminA->sasaran->nama : ($penerimaVitaminA->anak ? $penerimaVitaminA->anak->nama : '-') }}</li>
            @endforeach
        </ul>

        <!-- Daftar Nama Penerima Obat Cacing -->
        <h3 class="section-title">Penerima Obat Cacing</h3>
        <ul>
            @foreach($kegiatan->pemeriksaan->where('obat_cacing', 'Diberikan') as $penerimaObatCacing)
                <li>{{ $penerimaObatCacing->nama }}</li>
            @endforeach
        </ul>

        <hr>
    @endforeach
</body>
</html>
