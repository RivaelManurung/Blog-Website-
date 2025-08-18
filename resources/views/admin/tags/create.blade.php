@extends('admin.layouts.admin')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold font-poppins text-slate-900">Create New Tag</h1>
        <a href="{{ route('admin.tags.index') }}" class="text-slate-600 hover:text-sky-600 font-semibold">&larr; Back to Tags</a>
    </div>

    <div class="bg-white rounded-xl shadow-md p-8">
        <form action="{{ route('admin.tags.store') }}" method="POST">
            @csrf
            <div class="space-y-4">
                <div>
                    <label for="name" class="block font-semibold mb-1">Tag Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" class="w-full p-2 border rounded @error('name') border-rose-500 @enderror" required>
                    @error('name')<p class="text-rose-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>
                <div class="text-right">
                    <button type="submit" class="bg-sky-500 text-white px-6 py-2 rounded-lg font-semibold hover:bg-sky-600">Save</button>
                </div>
            </div>
        </form>
    </div>
@endsection