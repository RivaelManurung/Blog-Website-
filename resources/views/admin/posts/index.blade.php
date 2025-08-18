@extends('admin.layouts.admin')

@section('header')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="page-pretitle">Content Management</div>
                <h2 class="page-title">Posts</h2>
            </div>
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">
                        <i class="ti ti-plus icon"></i> Create new post
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
@if (session('success'))
    <div class="alert alert-success alert-dismissible" role="alert">
        <div><i class="ti ti-check icon alert-icon"></i> {{ session('success') }}</div>
        <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
    </div>
@endif

<div class="card">
    <div class="card-header">
        <h3 class="card-title">All Posts</h3>
    </div>
    <div class="table-responsive">
        <table class="table card-table table-vcenter text-nowrap datatable">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Categories</th>
                    <th>Published Date</th>
                    <th>Status</th>
                    <th class="w-1"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($posts as $post)
                <tr>
                    <td>
                        <div class="d-flex py-1 align-items-center">
                             @if($post->cover_image)
                                {{-- KODE YANG DIPERBAIKI ADA DI BARIS INI --}}
                                <span class="avatar me-2" style="background-image: url({{ asset('storage/' . $post->cover_image) }})"></span>
                             @else
                                <span class="avatar me-2">
                                    @if($post->user)
                                        {{ substr($post->user->name, 0, 2) }}
                                    @else
                                        ??
                                    @endif
                                </span>
                             @endif
                            <div class="flex-fill">
                                <div class="font-weight-medium">{{ Str::limit($post->title, 50) }}</div>
                                <div class="text-muted">
                                    @if($post->user)
                                        <a href="#" class="text-reset">{{ $post->user->name }}</a>
                                    @else
                                        <span class="text-danger">User Deleted</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>
                        @foreach($post->categories as $category)
                            <span class="badge bg-azure-lt">{{ $category->name }}</span>
                        @endforeach
                    </td>
                    <td class="text-muted">
                        {{ $post->published_at ? $post->published_at->format('d M Y') : 'N/A' }}
                    </td>
                    <td>
                        @if($post->status == 'published')
                            <span class="badge bg-success me-1"></span> Published
                        @else
                            <span class="badge bg-warning me-1"></span> Draft
                        @endif
                    </td>
                    <td>
                        <div class="btn-list flex-nowrap">
                            <a href="{{ route('admin.posts.edit', $post) }}" class="btn">Edit</a>
                            <div class="dropdown">
                                <button class="btn dropdown-toggle align-text-top" data-bs-toggle="dropdown">Actions</button>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="ti ti-trash icon dropdown-item-icon"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-4">No posts found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($posts->hasPages())
    <div class="card-footer d-flex align-items-center">
        <p class="m-0 text-muted">
            Showing {{ $posts->firstItem() }} to {{ $posts->lastItem() }} of {{ $posts->total() }} entries
        </p>
        {{ $posts->links('vendor.pagination.bootstrap-5') }}
    </div>
    @endif
</div>
@endsection