@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        create Category
                    </h3>
                </div>
                <form action="{{ route('categories.store') }}" method="post">
                @csrf
                    <div class="card-body">
                        @if (!empty($errors->all()))
                        <div class="allert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $item)
                                <li>{{ $item }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <div class="form-group">
                            <label for="name">name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter Name..."/>
                        </div>
                        <div class="form-group">
                            <label for="stat
                            us">status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="">-- Pilih --</option>
                                <option value="active">-- Active --</option>
                                 <option value="Inactive">-- Inactive --</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('categories.index') }}" class="btn btn-secondary">back</a>
                        <button type="submit" class="btn btn-secondary">Submit</buton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection
                   


                        
