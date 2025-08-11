@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        list Categories
                    </h3>
                    <div class="card-tools">
                    <a href="{{ route('categories.create') }}" class="btn btn-tool">
                        <i class="fa fa-plus"></i> Add category
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
                        <table class="table tablle-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $key => $category)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->status }}</td>
                                        <td>
                                            <form action="{{ route('categories.destroy', ['id' => $category['id']]) }}" method="post">
                                                @csrf
                                                <input type="hidden" name="_method" value="DELETE">
                                                <div class="btn-group" role="group" aria-label="Button group">
                                                    <a href="{{ route ('categories.show', $category->id)  }}" class="btn btn-sm btn-info" style="color: #fff"><i
                                                            class="fa fa-eye"></i></a>
                                                    <a href="{{ route('categories.edit', $category->id)  }}" class="btn btn-sm btn-success" style="color: #fff"><i
                                                            class="fa fa-edit"></i></a>
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Yakin mau hapus data?')"
                                                        style="color: #fff"><i class="fa fa-trash"></i></button>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>  
@endsection
