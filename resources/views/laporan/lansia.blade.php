<!DOCTYPE html>
<html>
<head>
    <title>Laporan Data Lansia</title>
    <style>
        /* Anda bisa menambahkan CSS khusus untuk PDF di sini */
    </style>
</head>
<body>
    <h1>Laporan Data Lansia</h1>
    <table border="1" cellpadding="5" cellspacing="0" style="width: 100%;">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
                <th>Tanggal Lahir</th>
                <!-- Tambahkan kolom lain sesuai kebutuhan -->
            </tr>
        </thead>
        <tbody>
            @foreach ($lansia as $index => $a)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $a->nik }}</td>
                <td>{{ $a->nama }}</td>
                <td>{{ $a->tgl_lahir }}</td>
                <!-- Tampilkan data lain sesuai kebutuhan -->
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
