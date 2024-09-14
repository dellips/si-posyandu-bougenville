<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        h1, h2, h3 {
            color: black;
        }
        table {
            width: auto;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .table-konten, .td, .th {
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
    <h2 class="text-center">Laporan Posyandu Bougenville</h2>
    <hr>
    <table style="width: auto">
        <tr>
            <th>Posyandu</th>
            <td>:</td>
            <td>Bougenville RW 05</td>
            <th>Kecamatan</th>
            <td>:</td>
            <td>Gedebage</td>
        </tr>
        <tr>
            <th>Kelurahan</th>
            <td>:</td>
            <td>Rancanumpang</td>
            <th>Kota</th>
            <td>:</td>
            <td>Bandung</td>
        </tr>
    </table>

    @foreach($kegiatan as $kegiatan)
    <table class="table">
        <tr>
            <th>Kegiatan {{ $kegiatan->nm_kegiatan }}</th>
        </tr>
        <tr>
            <th>Tanggal Pelaksanaan</th>
            <td>:</td>
            <td>{{ \Carbon\Carbon::parse($kegiatan->tgl_kegiatan)->format('j F Y') }}</td>
        </tr>
    </table>

    <!-- Ringkasan pemberian Vitamin A dan Obat Cacing -->
    @php
        $totalNaik = $kegiatan->pemeriksaan->where('perubahan_berat.status', 'naik')->count();
        $totalTurun = $kegiatan->pemeriksaan->where('perubahan_berat.status', 'turun')->count();
        $totalTetap = $kegiatan->pemeriksaan->where('perubahan_berat.status', 'tetap')->count();
    @endphp


<h3 class="section-title">Perubahan Berat</h3>
<table class="table">
    <tr>
        <th>Total Berat Badan Naik</th>
        <td>: {{ $totalNaik }} orang</td>
    </tr>
    <tr>
        <th>Total Berat Badan Turun</th>
        <td>: {{ $totalTurun }} orang</td>
    </tr>
    <tr>
        <th>Total Berat Badan Tetap</th>
        <td>: {{ $totalTetap }} orang</td>
    </tr>
</table>

    @foreach($kegiatan->pemeriksaan as $pemeriksaan)
        @if ($pemeriksaan->anak)
            <h3 class="section-title">Data Bayi dan Balita</h3>
            <table class="table-konten tr th">
                <thead>
                    <tr>
                        <th class="th">Nama</th>
                        <th class="th">Usia</th>
                        <th class="th">Berat Badan (kg)</th>
                        <th class="th">Tinggi Badan (cm)</th>
                        <th class="th">Lingkar Kepala (cm)</th>
                        <th class="th">Panjang Lengan Atas (cm)</th>
                        <th class="th">Ligkar Lengan Atas (cm)</th>
                        <th class="th">Perubahan Berat</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="td">{{ $pemeriksaan->anak->nama}}</td>
                        <td class="td">{{ number_format(\Carbon\Carbon::parse($pemeriksaan->anak->tgl_lahir)->diffInMonths(\Carbon\Carbon::now())) . ' Bulan' }}</td>
                        <td class="td">{{ $pemeriksaan->bb }}</td>
                        <td class="td">{{ $pemeriksaan->tb }}</td>
                        <td class="td">{{ $pemeriksaan->lk }}</td>
                        <td class="td">{{ $pemeriksaan->pl }}</td>
                        <td class="td">{{ $pemeriksaan->lila }}</td>
                        <td class="td">@php
                            $perubahanBerat = $pemeriksaan->perubahan_berat; 
                        @endphp
                        @if($perubahanBerat)
                            {{ ucfirst($perubahanBerat['status']) }}
                        @else
                            Tidak Ada Data
                        @endif</td>
                    </tr>
                </tbody>
            </table>

        @elseif ($pemeriksaan->sasaran->kategori == 'Ibu')
            <h3 class="section-title">Data Pemeriksaan PTM Ibu</h3>
            <table class="table-konten tr th">
                <thead>
                    <tr>
                        <th class="th">Nama</th>
                        <th class="th">Usia</th>
                        <th class="th">Berat Badan (kg)</th>
                        <th class="th">Tinggi Badan (cm)</th>
                        <th class="th">Lingkar Perut (cm)</th>
                        <th class="th">Tensi Darah</th>
                        <th class="th">Keterangan IMT</th>
                        <th class="th">Perubahan Berat</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="td">{{ $pemeriksaan->sasaran->nama}}</td>
                        <td class="td">{{ \Carbon\Carbon::parse($pemeriksaan->sasaran->tgl_lahir)->age . ' Tahun' }}</td>
                        <td class="td">{{ $pemeriksaan->bb }}</td>
                        <td class="td">{{ $pemeriksaan->tb }}</td>
                        <td class="td">{{ $pemeriksaan->lp }}</td>
                        <td class="td">{{ $pemeriksaan->sistolik }}/{{ $pemeriksaan->diastolik }}</td>
                        <td class="td">{{ $pemeriksaan->keterangan }}</td>
                        <td class="td">@php
                            $perubahanBerat = $pemeriksaan->perubahan_berat; 
                        @endphp
                        @if($perubahanBerat)
                            {{ ucfirst($perubahanBerat['status']) }}
                        @else
                            Tidak Ada Data
                        @endif</td>
                    </tr>
                </tbody>
            </table>

        @elseif ($pemeriksaan->sasaran->kategori == 'Ibu Hamil')
            <h3 class="section-title">Data Pemeriksaan PTM Ibu Hamil</h3>
            <table class="table-konten tr th">
                <thead>
                    <tr>
                        <th class="th">Nama</th>
                        <th class="th">Usia</th>
                        <th class="th">Berat Badan (kg)</th>
                        <th class="th">Tinggi Badan (cm)</th>
                        <th class="th">Lingkar Perut (cm)</th>
                        <th class="th">Tensi Darah</th>
                        <th class="th">Keterangan IMT</th>
                        <th class="th">Perubahan Berat</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="td">{{ $pemeriksaan->sasaran->nama}}</td>
                        <td class="td">{{ \Carbon\Carbon::parse($pemeriksaan->sasaran->tgl_lahir)->age . ' Tahun' }}</td>
                        <td class="td">{{ $pemeriksaan->bb }}</td>
                        <td class="td">{{ $pemeriksaan->tb }}</td>
                        <td class="td">{{ $pemeriksaan->lp }}</td>
                        <td class="td">{{ $pemeriksaan->sistolik }}/{{ $pemeriksaan->diastolik }}</td>
                        <td class="td">{{ $pemeriksaan->keterangan }}</td>
                        <td class="td">@php
                            $perubahanBerat = $pemeriksaan->perubahan_berat; 
                        @endphp
                        @if($perubahanBerat)
                            {{ ucfirst($perubahanBerat['status']) }}
                        @else
                            Tidak Ada Data
                        @endif</td>
                    </tr>
                </tbody>
            </table>

        @elseif ($pemeriksaan->sasaran->kategori == 'Lansia')
            <h3 class="section-title">Data Pemeriksaan PTM Lansia</h3>
            <table class="table-konten tr th">
                <thead>
                    <tr>
                        <th class="th">Nama</th>
                        <th class="th">Usia</th>
                        <th class="th">Berat Badan (kg)</th>
                        <th class="th">Tinggi Badan (cm)</th>
                        <th class="th">Lingkar Perut (cm)</th>
                        <th class="th">Tensi Darah</th>
                        <th class="th">Keterangan IMT</th>
                        <th class="th">Perubahan Berat</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="td">{{ $pemeriksaan->sasaran->nama}}</td>
                        <td class="td">{{ \Carbon\Carbon::parse($pemeriksaan->sasaran->tgl_lahir)->age . ' Tahun' }}</td>
                        <td class="td">{{ $pemeriksaan->bb }}</td>
                        <td class="td">{{ $pemeriksaan->tb }}</td>
                        <td class="td">{{ $pemeriksaan->lp }}</td>
                        <td class="td">{{ $pemeriksaan->sistolik }}/{{ $pemeriksaan->diastolik }}</td>
                        <td class="td">{{ $pemeriksaan->keterangan }}</td>
                        <td class="td">@php
                            $perubahanBerat = $pemeriksaan->perubahan_berat; 
                        @endphp
                        @if($perubahanBerat)
                            {{ ucfirst($perubahanBerat['status']) }}
                        @else
                            Tidak Ada Data
                        @endif</td>
                    </tr>
                </tbody>
            </table>
        @else
        @endif
    @endforeach

    <!-- Ringkasan pemberian Vitamin A dan Obat Cacing -->
    @php
    $totalVitaminAm = $kegiatan->pemeriksaan->where('vit_a', 'Kapsul Merah',)->count();
    $totalVitaminAb = $kegiatan->pemeriksaan->where('vit_a', 'Kapsul Biru',)->count();
    $totalObatCacing = $kegiatan->pemeriksaan->where('obat_cacing', 'Diberikan')->count();
    $totalTambahDarah = $kegiatan->pemeriksaan->where('tambah_darah', 'Diberikan')->count();
@endphp

<h3 class="section-title">Pemberian</h3>
<table class="table">
    <tr>
        <th>Vitamin A Kapsul Merah</th>
        <td>: {{ $totalVitaminAm }} orang</td>
    </tr>
    <tr>
        <th>Vitamin A Kapsul Biru</th>
        <td>: {{ $totalVitaminAb }} orang</td>
    </tr>
    <tr>
        <th>Obat Cacing</th>
        <td>: {{ $totalObatCacing }} orang</td>
    </tr>
    <tr>
        <th>Kapsul Tambah Darah</th>
        <td>: {{ $totalTambahDarah }} orang</td>
    </tr>
</table>

        <h3 class="section-title">Data Pemberian Suplemen dan Obat-Obatan</h3>
        <table class="table-konten tr th">
            <thead>
                <tr>
                    <th class="th">Nama</th>
                    <th class="th">Usia</th>
                    <th class="th">Vitamin A</th>
                    <th class="th">Obat Cacing</th>
                    <th class="th">Penambah Darah</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kegiatan->pemeriksaan as $pemeriksaan)
                    <tr>
                        <td class="td">{{ $pemeriksaan->sasaran ? $pemeriksaan->sasaran->nama : ($pemeriksaan->anak ? $pemeriksaan->anak->nama : '-')}}</td>
                        <td class="td">{{ $pemeriksaan->sasaran ? \Carbon\Carbon::parse($pemeriksaan->sasaran->tgl_lahir)->age . ' Tahun' : ($pemeriksaan->anak ? number_format(\Carbon\Carbon::parse($pemeriksaan->anak->tgl_lahir)->diffInMonths(\Carbon\Carbon::now())) . ' Bulan' : '-') }}</td>
                        <td class="td">{{ $pemeriksaan->vit_a != '-' ? $pemeriksaan->vit_a : 'Tidak Diberikan' }}</td>
                        <td class="td">{{ $pemeriksaan->obat_cacing != '-' ? $pemeriksaan->obat_cacing : 'Tidak Diberikan'}}</td>
                        <td class="td">{{ $pemeriksaan->tambah_darah != '-' ? $pemeriksaan->tambah_darah : 'Tidak Diberikan'}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        

        <!-- Daftar Nama Penerima Vitamin A
        <h3 class="section-title">Penerima Vitamin A Kapusl Merah</h3>
        <ul>
            @foreach($kegiatan->pemeriksaan->where('vit_a', 'Kapsul Merah') as $penerimaVitaminA)
                <li>{{ $penerimaVitaminA->sasaran ? $penerimaVitaminA->sasaran->nama : ($penerimaVitaminA->anak ? $penerimaVitaminA->anak->nama : '-') }}</li>
            @endforeach
        </ul>

        <h3 class="section-title">Penerima Vitamin A Kapsul Biru</h3>
        <ul>
            @foreach($kegiatan->pemeriksaan->where('vit_a', 'Kapsul Buru') as $penerimaVitaminA)
                <li>{{ $penerimaVitaminA->sasaran ? $penerimaVitaminA->sasaran->nama : ($penerimaVitaminA->anak ? $penerimaVitaminA->anak->nama : '-') }}</li>
            @endforeach
        </ul>

        
        <h3 class="section-title">Penerima Obat Cacing</h3>
        <ul>
            @foreach($kegiatan->pemeriksaan->where('obat_cacing', 'Diberikan') as $penerimaObatCacing)
                <li>{{ $penerimaObatCacing->nama }}</li>
            @endforeach
        </ul>  -->

        <hr>
    @endforeach
</body>
</html>