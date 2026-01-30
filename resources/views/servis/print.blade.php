<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Nota Servis - {{ $servis->nomor_servis }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        @page {
            size: A5 landscape;
            margin: 6mm;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            font-size: 9pt;
            color: #1a1a1a;
            line-height: 1.4;
            background: white;
        }

        .nota-container {
            width: 198mm;
            height: 136mm;
            margin: 0 auto;
        }

        table { width: 100%; border-collapse: collapse; }
        
        .label {
            font-size: 7pt;
            color: #666;
            text-transform: uppercase;
            font-weight: 600;
            letter-spacing: 0.3px;
            margin-bottom: 2px;
        }
        
        .value { 
            font-weight: 600; 
            color: #1a1a1a;
            font-size: 9pt;
        }

        .section {
            border: 1.5px solid #2563EB;
            margin-bottom: 6px;
        }

        .section-header {
            background: #2563EB;
            color: white;
            padding: 4px 8px;
            font-weight: 600;
            font-size: 7.5pt;
            text-transform: uppercase;
            letter-spacing: 0.4px;
        }

        .section-body {
            padding: 6px 8px;
            background: white;
        }

        .section-body td {
            padding: 3px 6px;
            vertical-align: top;
        }

        .nomor-servis-box {
            background: #F59E0B;
            color: white;
            padding: 6px 14px;
            font-weight: 700;
            font-size: 12pt;
            text-align: center;
            display: inline-block;
        }

        .checkbox {
            display: inline-block;
            width: 11px;
            height: 11px;
            border: 1.5px solid #333;
            text-align: center;
            line-height: 9px;
            margin-right: 3px;
            font-weight: bold;
            font-size: 7pt;
            vertical-align: middle;
        }
        
        .checkbox.checked {
            background: #2563EB;
            border-color: #2563EB;
            color: white;
        }

        .kelengkapan-item {
            display: inline-block;
            margin-right: 10px;
            font-size: 8pt;
        }

        .biaya-box {
            background: #E0F2FE;
            border: 1.5px solid #0EA5E9;
            padding: 6px 10px;
            text-align: center;
        }

        .biaya-label {
            font-size: 6.5pt;
            color: #0369A1;
            text-transform: uppercase;
            font-weight: 600;
        }

        .biaya-value {
            font-size: 11pt;
            font-weight: 700;
            color: #0C4A6E;
        }

        .biaya-box.highlight {
            background: #FEF3C7;
            border-color: #F59E0B;
        }

        .biaya-box.highlight .biaya-label {
            color: #B45309;
        }

        .biaya-box.highlight .biaya-value {
            color: #92400E;
        }

        .ttd-box {
            border: 1.5px solid #CBD5E1;
            padding: 6px 8px;
            text-align: center;
            background: #FAFAFA;
            height: 55px;
        }

        .ttd-label {
            font-size: 7pt;
            color: #64748B;
            text-transform: uppercase;
            font-weight: 600;
        }

        .ttd-space {
            height: 28px;
        }

        .ttd-line {
            border-top: 1px solid #1a1a1a;
            margin: 0 10px;
        }

        .ttd-name {
            font-weight: 600;
            font-size: 7.5pt;
            color: #1a1a1a;
            margin-top: 3px;
        }

        .info-box {
            background: #EFF6FF;
            border: 1px solid #BFDBFE;
            padding: 5px 10px;
            text-align: center;
            font-size: 7.5pt;
            color: #1E40AF;
        }

        .ketentuan {
            font-size: 6.5pt;
            color: #666;
            line-height: 1.5;
            margin-top: 5px;
        }

        .ketentuan strong {
            color: #333;
        }

        .wa-icon {
            color: #25D366;
            margin-right: 3px;
        }

        .brand-name {
            font-size: 14pt;
            font-weight: 700;
            color: #2563EB;
            margin-bottom: 2px;
            letter-spacing: -0.3px;
        }

        .print-actions {
            position: fixed;
            top: 10px;
            right: 10px;
            z-index: 1000;
            display: flex;
            gap: 6px;
        }

        .btn-print {
            background: #2563EB;
            color: white;
            border: none;
            padding: 8px 16px;
            cursor: pointer;
            font-weight: 600;
            font-size: 13px;
        }

        .btn-back {
            background: #64748B;
            color: white;
            text-decoration: none;
            padding: 8px 16px;
            font-weight: 500;
            font-size: 13px;
        }

        @media print {
            .print-actions { display: none !important; }
            body { -webkit-print-color-adjust: exact; print-color-adjust: exact; }
        }
    </style>
</head>

<body>

<div class="print-actions">
    <a href="{{ route('servis.show', $servis->id) }}" class="btn-back">← Kembali</a>
    <button class="btn-print" onclick="window.print()">🖨️ Cetak</button>
</div>

<div class="nota-container">
    <!-- HEADER -->
    <table style="margin-bottom: 8px;">
        <tr>
            <td style="width: 10%; vertical-align: middle;">
                <img src="{{ asset('images/logo.png') }}" style="width: 45px; height: 45px;">
            </td>
            <td style="width: 55%; vertical-align: middle;">
                <div class="brand-name">{{ strtoupper($pengaturan->nama_toko ?? 'DEFKAN COMPUTER') }}</div>
                <div style="font-size: 7pt; color: #666; line-height: 1.4;">{{ $pengaturan->alamat }}</div>
                <div style="font-size: 8pt; color: #1a1a1a; margin-top: 2px;">
                    <i class="fa-brands fa-whatsapp wa-icon"></i><strong>{{ $pengaturan->no_kontak }}</strong>
                </div>
            </td>
            <td style="width: 35%; text-align: right; vertical-align: middle;">
                <div class="nomor-servis-box">{{ $servis->nomor_servis }}</div>
            </td>
        </tr>
    </table>

    <hr style="border: none; border-top: 2px solid #2563EB; margin-bottom: 8px;">

    <!-- MAIN CONTENT -->
    <table>
        <tr>
            <!-- LEFT COLUMN -->
            <td style="width: 55%; padding-right: 6px; vertical-align: top;">
                <!-- Data Pelanggan -->
                <div class="section">
                    <div class="section-header">
                        <i class="fa-solid fa-user" style="margin-right: 5px;"></i> Data Pelanggan
                    </div>
                    <div class="section-body">
                        <table>
                            <tr>
                                <td style="width: 50%;">
                                    <div class="label">Nama Pelanggan</div>
                                    <div class="value">{{ strtoupper($servis->nama_konsumen) }}</div>
                                </td>
                                <td style="width: 50%;">
                                    <div class="label">No. WhatsApp</div>
                                    <div class="value">
                                        <i class="fa-brands fa-whatsapp wa-icon"></i>{{ $servis->no_hp }}
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <!-- Data Perangkat -->
                <div class="section">
                    <div class="section-header">
                        <i class="fa-solid fa-laptop" style="margin-right: 5px;"></i> Data Perangkat
                    </div>
                    <div class="section-body">
                        <table>
                            <tr>
                                <td colspan="2">
                                    <div class="label">Tipe Laptop</div>
                                    <div class="value" style="font-size: 10pt; color: #2563EB;">{{ $servis->type_laptop }}</div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" style="padding-top: 5px;">
                                    <div class="label">Kerusakan / Keluhan</div>
                                    <div style="font-size: 8pt; background: #f5f5f5; padding: 5px 6px; border: 1px solid #ddd; margin-top: 2px;">
                                        {{ Str::limit($servis->jenis_kerusakan, 120) }}
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" style="padding-top: 5px;">
                                    <div class="label" style="margin-bottom: 3px;">Kelengkapan</div>
                                    <span class="kelengkapan-item">
                                        <span class="checkbox {{ $servis->kelengkapan_laptop ? 'checked' : '' }}">{{ $servis->kelengkapan_laptop ? '✓' : '' }}</span>Laptop
                                    </span>
                                    <span class="kelengkapan-item">
                                        <span class="checkbox {{ $servis->kelengkapan_charger ? 'checked' : '' }}">{{ $servis->kelengkapan_charger ? '✓' : '' }}</span>Charger
                                    </span>
                                    <span class="kelengkapan-item">
                                        <span class="checkbox {{ $servis->kelengkapan_baterai ? 'checked' : '' }}">{{ $servis->kelengkapan_baterai ? '✓' : '' }}</span>Baterai
                                    </span>
                                    <span class="kelengkapan-item">
                                        <span class="checkbox {{ $servis->kelengkapan_tas ? 'checked' : '' }}">{{ $servis->kelengkapan_tas ? '✓' : '' }}</span>Tas
                                    </span>
                                    @if($servis->kelengkapan_lainnya)
                                        <span class="kelengkapan-item">
                                            <span class="checkbox checked">✓</span>{{ $servis->kelengkapan_lainnya }}
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </td>

            <!-- RIGHT COLUMN -->
            <td style="width: 45%; padding-left: 6px; vertical-align: top;">
                <!-- Info Servis -->
                <div class="section">
                    <div class="section-header">
                        <i class="fa-solid fa-info-circle" style="margin-right: 5px;"></i> Informasi Servis
                    </div>
                    <div class="section-body">
                        <table>
                            <tr>
                                <td style="width: 50%;">
                                    <div class="label">Tanggal Masuk</div>
                                    <div class="value">{{ $servis->tanggal_masuk->format('d/m/Y') }}</div>
                                </td>
                                <td style="width: 50%;">
                                    <div class="label">Tanggal Jadi</div>
                                    <div class="value">{{ $servis->tanggal_jadi ? $servis->tanggal_jadi->format('d/m/Y') : '-' }}</div>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-top: 5px;">
                                    <div class="label">Teknisi</div>
                                    <div class="value">{{ $servis->nama_teknisi }}</div>
                                </td>
                                <td style="padding-top: 5px;">
                                    <div class="label">Garansi</div>
                                    <div class="value" style="color: #7C3AED;">{{ $servis->garansi_nilai ?: '-' }} {{ $servis->garansi_satuan }}</div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <!-- Biaya -->
                <table style="margin-bottom: 6px;">
                    <tr>
                        <td style="width: 50%; padding-right: 3px;">
                            <div class="biaya-box">
                                <div class="biaya-label">Panjar / DP</div>
                                <div class="biaya-value">Rp {{ number_format($servis->panjar, 0, ',', '.') }}</div>
                            </div>
                        </td>
                        <td style="width: 50%; padding-left: 3px;">
                            <div class="biaya-box highlight">
                                <div class="biaya-label">Total Biaya</div>
                                <div class="biaya-value">Rp {{ number_format($servis->total_biaya, 0, ',', '.') }}</div>
                            </div>
                        </td>
                    </tr>
                </table>

                <!-- TTD -->
                <table>
                    <tr>
                        <td style="width: 48%; vertical-align: top;">
                            <div class="ttd-box">
                                <div class="ttd-label">Penerima</div>
                                <div class="ttd-space"></div>
                                <div class="ttd-line"></div>
                                <div class="ttd-name">{{ ucwords(strtolower($servis->nama_konsumen)) }}</div>
                            </div>
                        </td>
                        <td style="width: 4%;"></td>
                        <td style="width: 48%; vertical-align: top;">
                            <div class="ttd-box">
                                <div class="ttd-label">Teknisi</div>
                                <div class="ttd-space"></div>
                                <div class="ttd-line"></div>
                                <div class="ttd-name">{{ ucwords(strtolower($servis->nama_teknisi)) }}</div>
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <!-- FOOTER -->
    <div class="info-box" style="margin-top: 6px;">
        <i class="fa-solid fa-mobile-screen-button" style="margin-right: 4px;"></i>
        <strong>Cek Status Online:</strong> Kunjungi website kami → masukkan nomor servis <strong>{{ $servis->nomor_servis }}</strong>
    </div>

    <div class="ketentuan">
        <strong>Ketentuan:</strong>
        1) Garansi sesuai sparepart yang diganti. 
        2) Garansi batal jika segel rusak. 
        3) Barang tidak diambil >1 bulan bukan tanggung jawab kami.
        4) Panjar minimal 50% untuk pengerjaan.
    </div>
</div>

</body>
</html>
