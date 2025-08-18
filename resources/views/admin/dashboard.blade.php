@extends('admin.layouts.admin')

@section('header')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="page-pretitle">Overview</div>
                <h2 class="page-title">Dashboard</h2>
            </div>
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">
                        <i class="ti ti-plus icon"></i>
                        Create new post
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row row-deck row-cards">
    {{-- Stat Cards --}}
    <div class="col-sm-6 col-lg-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="subheader">Total Posts</div>
                </div>
                <div class="h1 mb-3">125</div>
                <div class="d-flex mb-2">
                    <div>Published this month</div>
                    <div class="ms-auto">
                        <span class="text-green d-inline-flex align-items-center lh-1">
                            8% <i class="ti ti-trending-up icon ms-1"></i>
                        </span>
                    </div>
                </div>
                <div class="progress progress-sm">
                    <div class="progress-bar bg-primary" style="width: 75%" role="progressbar"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- Cards lainnya ... (Ganti dengan data dinamis dari controller Anda) --}}
    
    {{-- Tabel Recent Posts --}}
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Recent Posts</h3>
            </div>
            <div class="table-responsive">
                <table class="table card-table table-vcenter text-nowrap table-striped">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Loop data recent posts dari controller Anda --}}
                        <tr>
                            <td>
                                <div class="d-flex py-1 align-items-center">
                                    <span class="avatar me-2" style="background-image: url(https://i.pravatar.cc/150?u=riva.manurung@example.com)"></span>
                                    <div class="flex-fill">
                                        <div class="font-weight-medium">The Future of Web Development</div>
                                        <div class="text-muted"><a href="#" class="text-reset">Rivael Manurung</a></div>
                                    </div>
                                </div>
                            </td>
                            <td><span class="badge bg-primary-lt">Technology</span></td>
                            <td class="text-muted">{{ now()->subDays(1)->format('d M Y') }}</td>
                            <td><span class="badge bg-success me-1"></span> Published</td>
                            <td class="text-end">
                                <a href="#" class="btn btn-sm btn-ghost-primary">Edit</a>
                            </td>
                        </tr>
                        {{-- Akhir Loop --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection