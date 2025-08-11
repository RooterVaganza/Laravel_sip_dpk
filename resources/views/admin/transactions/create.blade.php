@extends('admin.layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    Import Excel
                </h3>
            </div>

            {!! Form::open(['route' => 'transactions.import', 'files' => true, 'method' => 'POST']) !!}

            <div class="card-body">

                @if (!empty($errors->all()))
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $item)
                        <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="row">
                    <div class="form-group col-sm-12">
                        {!! Form::label('excel', 'File Excel') !!}
                        {!! Form::file('excel', ['class' => 'form-control']) !!}
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('transactions.index') }}" class="btn btn-outline-secondary"><i
                        class="fa fa arrow-right"></i> Back</a>
                <button class="btn btn-primary float-right" type="submit">Import</button>
            </div>  
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection