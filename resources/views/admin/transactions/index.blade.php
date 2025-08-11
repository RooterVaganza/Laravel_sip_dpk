@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fa fa-tags"></i> Transactions
                    </h3>
                    <div class="card-tools">
                        <a href="{{ route('transactions.create') }}" class="btn btn-tool">
                            <i class="fa fa-plus"></i> Import
                        </a>
                        <a href="{{ route('transactions.export') }}" class="btn btn-tool"
                            onclick="return confirm('Are you sure you want to export these transactions?')">
                            <i class="fa fa-table"></i> Export
                        </a>
                        <a href="{{ route('transactions.export-pdf') }}" class="btn btn-tool"
                            onclick="return confirm('Are you sure you want to export these transactions?')">
                            <i class="fa fa-table"></i> Export To Pdf
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if (Session::has('message'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa fa-check"></i>&nbsp; {{ Session::get('message') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Product</th>
                                    <th>Transaction Date</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transactions as $key => $value)
                                    <tr>
                                        <td>{{ ($transactions->currentPage() - 1) * $transactions->perPage() + $loop->index + 1 }}
                                        </td>
                                        <td>{{ $value->product->name }}</td>
                                        <td>{{ $value->formatTrxDate() }}</td>
                                        <td>{{ $value->priceFormat() }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div>
                            {{ $transactions->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
