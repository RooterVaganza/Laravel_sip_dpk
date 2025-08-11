@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        Edit Product
                    </h3>
                </div>

                {!! Form::model($product,[
                    'route' => ['products.update', $product->id],
                    'method' => 'put',
                    'files' => true,
                    'id' => 'my-form', 
                    ]) !!}

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
                        <div class="form-group col-sm-6">
                            {!! Form::label('category', 'Category') !!}
                            {!! Form::select('category_id', $categories, null, [
                                'class' => 'form-control',
                                'placeholder' => 'Select Category',
                            ]) !!}
                        </div>

                        <div class="form-group col-sm-6">
                            {!! Form::label('name', 'Nama') !!}
                            {!! Form::text('name', null, ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group col-sm-6">
                            {!! Form::label('price', 'Price') !!}
                            {!! Form::number('price', null, ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group col-sm-6">
                            {!! Form::label('sku', 'SKU') !!}
                            {!! Form::text('sku', null, ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group col-sm-6">
                            {!! Form::label('image', 'Image') !!}
                            {!! Form::file('image', ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group col-sm-6">
                            {!! Form::label('status', 'Status') !!}
                            {!! Form::select('status', ['Active' => 'Active', 'Inactive' => 'Inactive'], null, [
                                'class' => 'form-control',
                                'placeholder' => 'Select Status',
                            ]) !!}
                        </div>

                        <div class="form-group col-sm-12">
                            {!! Form::label('description', 'Description') !!}
                            {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Description']) !!}
                        </div>

                    </div>
                    <div class="card-footer">
                        <a href="{{ route('products.index') }}" class="btn btn-secondary">Back</a>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    @endsection