<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>{{ $title ?? 'Laporan Data' }}</title>
    <style>
        /* DomPDF Compatible Styles */
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            margin: 0;
            padding: 20px;
            color: #333;
        }

        /* Page Settings */
        @page {
            margin: 2cm;
            size: A4;
        }

        /* Header Styles */
        .header {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 16px;
            font-weight: bold;
            margin: 0 0 5px 0;
        }

        .header .subtitle {
            font-size: 12px;
            margin: 0 0 5px 0;
            color: #666;
        }

        .header .meta {
            font-size: 9px;
            color: #888;
        }

        /* Table Styles - DomPDF Compatible */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-size: 10px;
        }

        th {
            background-color: #f0f0f0;
            border: 1px solid #333;
            padding: 5px;
            text-align: center;
            font-weight: bold;
            font-size: 9px;
        }

        td {
            border: 1px solid #333;
            padding: 4px;
            vertical-align: top;
        }

        /* Row Striping - DomPDF Compatible */
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        /* Column Widths */
        .col-no {
            width: 5%;
            text-align: center;
        }

        .col-item {
            width: 25%;
        }

        .col-desc {
            width: 35%;
        }

        .col-date {
            width: 10%;
            text-align: center;
        }

        .col-qty {
            width: 8%;
            text-align: center;
        }

        .col-price {
            width: 12%;
            text-align: right;
        }

        .col-total {
            width: 15%;
            text-align: right;
        }

        /* Text Alignment Classes */
        .text-left {
            text-align: left;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .text-bold {
            font-weight: bold;
        }

        /* Number Formatting */
        .number {
            text-align: right;
            font-family: Arial, sans-serif;
        }

        /* Total Row Styling */
        .total-row {
            background-color: #e8e8e8 !important;
            font-weight: bold;
        }

        .total-row td {
            border-top: 2px solid #000;
            font-weight: bold;
        }

        /* Page Break */
        .page-break {
            page-break-after: always;
        }
    </style>
</head>

<body>
    <!-- Header Section -->
    <div class="header">
        <h1>{{ $header_title ?? 'LAPORAN DATA TRANSAKSI' }}</h1>
        <div class="meta">
            Dicetak pada: {{ $print_date ?? now()->format('d/m/Y') }}
        </div>
    </div>

    <!-- Main Data Table -->
    <table>
        <thead>
            <tr>
                <th class="col-no">No</th>
                <th class="col-item">Product</th>
                <th class="col-desc">Transaction Date</th>
                <th class="col-date">Price</th>
            </tr>
        </thead>
        <tbody>
            {{-- Loop data menggunakan Blade template --}}
            @foreach($data ?? [] as $index => $item)
                <tr>
                    <td class="col-no text-center">{{ $index + 1 }}</td>
                    <td class="col-item">{{ $item['name'] ?? 'Produk ' . ($index + 1) }}</td>
                    <td class="col-desc">{{ date('d/m/Y') }}</td>
                    <td class="col-date text-center">{{ 'Rp ' . number_format($item['price'] ?? 0, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
