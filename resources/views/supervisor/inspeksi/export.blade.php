<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Detail Inspeksi</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
            margin: 20px;
        }

        .header {
            text-align: center;
            border-bottom: 3px solid #2c3e50;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }

        .header h1 {
            font-size: 24px;
            color: #2c3e50;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .header .subtitle {
            font-size: 14px;
            color: #7f8c8d;
            font-style: italic;
        }

        .info-section {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            padding: 20px;
            margin-bottom: 25px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .info-item {
            margin-bottom: 10px;
        }

        .info-item label {
            font-weight: bold;
            color: #2c3e50;
            display: inline-block;
            min-width: 120px;
        }

        .info-item span {
            color: #555;
        }

        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 15px;
            font-size: 11px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .status-baik {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .status-rusak {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .status-perlu-perhatian {
            background-color: #fff3cd;
            color: #856404;
            border: 1px solid #ffeaa7;
        }

        .components-section {
            margin-top: 30px;
        }

        .section-title {
            font-size: 18px;
            color: #2c3e50;
            font-weight: bold;
            margin-bottom: 15px;
            padding-bottom: 8px;
            border-bottom: 2px solid #3498db;
        }

        .components-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .components-table th {
            background-color: #3498db;
            color: white;
            font-weight: bold;
            padding: 12px 8px;
            text-align: left;
            font-size: 13px;
        }

        .components-table td {
            padding: 10px 8px;
            border-bottom: 1px solid #dee2e6;
            vertical-align: top;
        }

        .components-table tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        .components-table tr:hover {
            background-color: #e8f4f8;
        }

        .component-name {
            font-weight: 600;
            color: #2c3e50;
        }

        .comment-cell {
            max-width: 200px;
            word-wrap: break-word;
            font-size: 11px;
            line-height: 1.3;
        }

        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #dee2e6;
            text-align: center;
            font-size: 10px;
            color: #6c757d;
        }

        .generated-date {
            font-style: italic;
        }

        /* Print optimization */
        @media print {
            body { margin: 15px; }
            .header { break-inside: avoid; }
            .info-section { break-inside: avoid; }
            .components-table { break-inside: auto; }
            .components-table tr { break-inside: avoid; }
        }

        /* Responsive adjustments */
        @media (max-width: 600px) {
            .info-grid {
                grid-template-columns: 1fr;
                gap: 10px;
            }

            .components-table {
                font-size: 11px;
            }

            .components-table th,
            .components-table td {
                padding: 8px 6px;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>LAPORAN DETAIL INSPEKSI</h1>
        <div class="subtitle">Sistem Manajemen Alat Berat</div>
    </div>

    <div class="info-section">
        <div class="info-grid">
            <div class="info-item">
                <label>Inspector:</label>
                <span>{{ $inspeksi->user->name }}</span>
            </div>
            <div class="info-item">
                <label>Tanggal Inspeksi:</label>
                <span>{{ $inspeksi->created_at->format('d M Y') }}</span>
            </div>
            <div class="info-item">
                <label>Alat Berat:</label>
                <span>{{ $inspeksi->alatBerat->merk }}</span>
            </div>
            <div class="info-item">
                <label>Serial Number:</label>
                <span>{{ $inspeksi->alatBerat->serial_number }}</span>
            </div>
            <div class="info-item">
                <label>Status Umum:</label>
                <span class="status-badge
                    @if($inspeksi->status == 'Baik') status-baik
                    @elseif($inspeksi->status == 'Rusak') status-rusak
                    @else status-perlu-perhatian
                    @endif">
                    {{ $inspeksi->status }}
                </span>
            </div>
            <div class="info-item">
                <label>Waktu Generate:</label>
                <span class="generated-date">{{ now()->format('d M Y H:i') }}</span>
            </div>
        </div>
    </div>

    <div class="components-section">
        <h2 class="section-title">Detail Komponen yang Diinspeksi</h2>

        <table class="components-table">
            <thead>
                <tr>
                    <th width="30%">Nama Komponen</th>
                    <th width="20%">Status</th>
                    <th width="50%">Komentar</th>
                </tr>
            </thead>
            <tbody>
                @foreach($inspeksi->komponens as $komponen)
                <tr>
                    <td class="component-name">{{ $komponen->name }}</td>
                    <td>
                        <span class="status-badge
                            @if($komponen->pivot->status == 'Baik') status-baik
                            @elseif($komponen->pivot->status == 'Rusak') status-rusak
                            @else status-perlu-perhatian
                            @endif">
                            {{ $komponen->pivot->status }}
                        </span>
                    </td>
                    <td class="comment-cell">
                        {{ $komponen->pivot->komentar ?: '-' }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="footer">
        <p>Laporan ini dibuat secara otomatis oleh sistem pada {{ now()->format('d M Y \p\u\k\u\l H:i') }}</p>
        <p>Dokumen ini bersifat rahasia dan hanya untuk keperluan internal</p>
    </div>
</body>
</html>
