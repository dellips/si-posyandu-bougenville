<!DOCTYPE html>
<html>
<head>
    <title>Laporan Data Anak</title>
    <style>
        /* Anda bisa menambahkan CSS khusus untuk PDF di sini */
    </style>
</head>
<body>
    <h1>Laporan Data Anak</h1>
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
            @foreach ($ibu as $index => $i)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $i->nama }}</td>
                <td>{{ $i->jenis_kelamin }}</td>
                <td>{{ $i->tanggal_lahir }}</td>
                <!-- Tampilkan data lain sesuai kebutuhan -->
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
