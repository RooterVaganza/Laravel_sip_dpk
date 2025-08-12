@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        Sales Graph
                    </h3>
                </div>
                <div class="card-body">
                    <canvas class="chart" id="sales-chart" style="height: 250px"></canvas>
                </div>
            </div>
        </div>
        {{-- ini buat awalan --}}
        <div class="col-md-6">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Latest Transactions</h3>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped mb-0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Product</th>
                        <th>Date</th>
                        <th class="text-end">Price</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($latestTransactions as $trx)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $trx->product->name }}</td>
                            <td>{{ \Carbon\Carbon::parse($trx->trx_date)->format('d M Y') }}</td>
                            <td class="text-end">{{ number_format($trx->price, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">No transactions found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
        {{-- ini buat nandain --}}
    </div>
@endsection
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.5.0/chart.min.js"
        integrity="sha512-n/G+dROKbKL3GVngGWmWfwK0yPctjZQM752diVYnXZtD/48agpUKLIn0xDQL9ydZ91x6BiOmTIFwWjjFi2kEFg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('sales-chart').getContext('2d'); // ✅ Pakai getContext('2d')

    const salesChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($chart['months']),
            datasets: [{
                label: 'Overall Sales',
                data: @json($chart['totals']),
                borderColor: 'green',
                backgroundColor: 'rgba(0,128,0,0.2)',
                fill: true,
                tension: 0.3
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: true },
                tooltip: { enabled: true }
            }
        }
    });
</script>

@endsection
