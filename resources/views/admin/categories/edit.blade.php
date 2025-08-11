@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        Edit Category
                    </h3>
                </div>
                <form action="{{ route('categories.update', ['id' => $category->id]) }}" method="post">
                    <input type="hidden" name="_method" value="PUT">
                    @csrf
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
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter Name..." value="{{ $category->name }}">
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="">-- Pilih --</option>
                                <option value="active" {{ $category->status == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ $category->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Back</a>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection