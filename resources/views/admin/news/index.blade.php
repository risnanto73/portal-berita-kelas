@extends('admin.parent')

@section('content')

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">News</h5>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="bi bi-house-door"></i></a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('news.index') }}">News</a></li>
                </ol>
            </nav>

            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-octagon me-1"></i>
                        {{ $error }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endforeach
            @endif

            <div class="container d-flex justify-content-end">
                <a class="btn btn-primary" href="{{ route('news.create') }}">
                    <i class="bx bxs-plus-square"><span> Add News</span></i>
                </a>
            </div>

            <div class="card container mt-3">
                <!-- Table with stripped rows -->
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Category</th>
                                <th scope="col">Image</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($news as $row)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <img src="" class="w-25" alt="">
                                    </td>
                                    <td></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- End Table with stripped rows -->
            </div>

        </div>
    </div>
@endsection
