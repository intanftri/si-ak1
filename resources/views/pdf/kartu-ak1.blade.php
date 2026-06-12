<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Kartu AK-1</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 12px;
            color: #333;
        }

        .card {
            border: 2px solid #000;
            padding: 20px;
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            border-radius: 8px;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .header h3 {
            margin: 0;
            font-size: 16px;
            text-transform: uppercase;
        }

        .header h4 {
            margin: 5px 0 0 0;
            font-size: 14px;
        }

        table.info-table {
            width: 100%;
            border-collapse: collapse;
        }

        table.info-table td {
            padding: 6px;
            vertical-align: top;
        }

        .label {
            width: 30%;
            font-weight: bold;
        }

        .colon {
            width: 2%;
        }

        .value {
            width: 68%;
        }

        .footer {
            margin-top: 30px;
            width: 100%;
        }

        .ttd-container {
            float: right;
            text-align: center;
            width: 200px;
        }

        .ttd-box {
            height: 80px;
        }

        .clear {
            clear: both;
        }
    </style>
</head>

<body>

    <div class="card">
        <div class="header">
            <h3>KARTu TANDA BUKTI PENDAFTARAN PENCARI KERJA</h3>
            <h4>(KARTU AK-1)</h4>
            <p style="margin-top: 5px; font-weight: bold;">Nomor: {{ $kartu->nomor_ak1 }}</p>
        </div>

        <table class="info-table">
            <tr>
                <td class="label">NIK</td>
                <td class="colon">:</td>
                <td class="value">{{ $pencari->nik ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Nama Lengkap</td>
                <td class="colon">:</td>
                <td class="value">{{ strtoupper($pencari->nama) }}</td>
            </tr>
            <tr>
                <td class="label">Tempat, Tgl Lahir</td>
                <td class="colon">:</td>
                <td class="value">
                    {{ $pencari->tempat_lahir ?? '-' }},
                    {{ $pencari->tanggal_lahir ? \Carbon\Carbon::parse($pencari->tanggal_lahir)->translatedFormat('d F Y') : '-' }}
                </td>
            </tr>
            <tr>
                <td class="label">Jenis Kelamin</td>
                <td class="colon">:</td>
                <td class="value">{{ $pencari->jenis_kelamin ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Alamat Lengkap</td>
                <td class="colon">:</td>
                <td class="value">{{ $pencari->alamat ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Status Saat Ini</td>
                <td class="colon">:</td>
                <td class="value">{{ $pencari->status_kerja ?? 'Aktif (Mencari Kerja)' }}</td>
            </tr>
        </table>

        <div style="margin-top: 20px;">
            <p><strong>Masa Berlaku:</strong>
                {{ \Carbon\Carbon::parse($kartu->tanggal_terbit)->translatedFormat('d M Y') }} s/d
                {{ \Carbon\Carbon::parse($kartu->tanggal_berlaku)->translatedFormat('d M Y') }}</p>
        </div>

        <div class="footer">
            <div class="ttd-container">
                <p>Diterbitkan di: .......................</p>
                <p>Pada Tanggal: {{ \Carbon\Carbon::parse($kartu->tanggal_terbit)->translatedFormat('d F Y') }}</p>
                <br>
                <p>Pengantar Kerja / Petugas Pendaftar</p>
                <div class="ttd-box"></div>
                <p><strong>(.......................................)</strong></p>
            </div>
            <div class="clear"></div>
        </div>
    </div>

</body>

</html>