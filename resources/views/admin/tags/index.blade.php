@extends('admin.layouts.admin')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold font-poppins text-slate-900">Manage Tags</h1>
        <a href="{{ route('admin.tags.create') }}" class="bg-sky-500 text-white px-5 py-2 rounded-lg font-medium hover:bg-sky-600">
            <i class="fas fa-plus mr-2"></i> Create New Tag
        </a>
    </div>

    @if (session('success'))
        <div class="bg-emerald-100 text-emerald-800 p-4 rounded-lg mb-6">{{ session('success') }}</div>
    @endif

    <div class="bg-white rounded-xl shadow-md">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="p-4 font-semibold">Name</th>
                        <th class="p-4 font-semibold">Slug</th>
                        <th class="p-4 font-semibold">Post Count</th>
                        <th class="p-4 font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($tags as $tag)
                        <tr class="border-b hover:bg-slate-50">
                            <td class="p-4 font-medium">{{ $tag->name }}</td>
                            <td class="p-4 text-slate-600 font-mono">{{ $tag->slug }}</td>
                            <td class="p-4 text-slate-600">{{ $tag->posts_count }}</td>
                            <td class="p-4 flex space-x-3">
                                <a href="{{ route('admin.tags.edit', $tag->id) }}" class="text-slate-500 hover:text-amber-600"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('admin.tags.destroy', $tag->id) }}" method="POST" onsubmit="return confirm('Yakin?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-slate-500 hover:text-rose-600"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="p-8 text-center text-slate-500">
                                Belum ada tag. <a href="{{ route('admin.tags.create') }}" class="text-sky-600 font-semibold">Buat satu!</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4">{{ $tags->links() }}</div>
    </div>
@endsection