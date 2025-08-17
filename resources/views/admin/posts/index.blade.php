@extends('admin.layouts.admin')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold font-poppins text-slate-900">Manage Posts</h1>
        <a href="{{ route('admin.posts.create') }}" class="bg-sky-500 text-white px-5 py-2 rounded-lg font-medium hover:bg-sky-600 transition-colors">
            <i class="fas fa-plus mr-2"></i> Create New Post
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-md">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="p-4 font-semibold">Title</th>
                        <th class="p-4 font-semibold">Category</th>
                        <th class="p-4 font-semibold">Published Date</th>
                        <th class="p-4 font-semibold">Status</th>
                        <th class="p-4 font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Ganti dengan @forelse ($posts as $post) dari controller --}}
                    @forelse ([] as $post)
                        <tr class="border-b hover:bg-slate-50">
                            <td class="p-4 font-medium">{{ $post->title }}</td>
                            <td class="p-4 text-slate-600">{{ $post->category->name }}</td>
                            <td class="p-4 text-slate-600">{{ $post->created_at->format('d M Y') }}</td>
                            <td class="p-4">
                                <span class="bg-emerald-100 text-emerald-800 text-xs font-medium px-2 py-1 rounded-full">Published</span>
                            </td>
                            <td class="p-4 flex space-x-3">
                                <a href="{{ route('admin.posts.edit', $post->id) }}" class="text-slate-500 hover:text-amber-600" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-slate-500 hover:text-rose-600" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-8 text-center text-slate-500">
                                There are no posts yet. <a href="{{ route('admin.posts.create') }}" class="text-sky-600 font-semibold">Create one!</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection