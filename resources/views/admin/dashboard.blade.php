{{-- Menggunakan layout khusus admin --}}
@extends('layouts.admin')

@section('content')
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold font-poppins text-slate-900">Dashboard</h1>
            <p class="text-slate-600 mt-1">Welcome back, {{ Auth::user()->name }}!</p>
        </div>
        <div>
            <a href="{{ route('admin.posts.create') }}" class="bg-sky-500 text-white px-5 py-2 rounded-lg font-medium hover:bg-sky-600 transition-all duration-300 shadow-sm hover:shadow-md">
                <i class="fas fa-plus mr-2"></i> Create New Post
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white p-6 rounded-xl shadow-md flex items-center space-x-4">
            <div class="bg-sky-100 text-sky-600 p-3 rounded-full">
                <i class="fas fa-newspaper fa-lg"></i>
            </div>
            <div>
                <div class="text-3xl font-bold">125</div>
                <div class="text-slate-500">Total Posts</div>
            </div>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-md flex items-center space-x-4">
            <div class="bg-emerald-100 text-emerald-600 p-3 rounded-full">
                <i class="fas fa-tags fa-lg"></i>
            </div>
            <div>
                <div class="text-3xl font-bold">12</div>
                <div class="text-slate-500">Categories</div>
            </div>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-md flex items-center space-x-4">
            <div class="bg-amber-100 text-amber-600 p-3 rounded-full">
                <i class="fas fa-hashtag fa-lg"></i>
            </div>
            <div>
                <div class="text-3xl font-bold">48</div>
                <div class="text-slate-500">Tags</div>
            </div>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-md flex items-center space-x-4">
            <div class="bg-rose-100 text-rose-600 p-3 rounded-full">
                <i class="fas fa-comments fa-lg"></i>
            </div>
            <div>
                <div class="text-3xl font-bold">342</div>
                <div class="text-slate-500">Comments</div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-md">
        <div class="p-6 border-b">
            <h2 class="text-xl font-bold font-poppins text-slate-900">Recent Posts</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="p-4 font-semibold">Title</th>
                        <th class="p-4 font-semibold">Category</th>
                        <th class="p-4 font-semibold">Date</th>
                        <th class="p-4 font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Data di sini akan di-loop dari database --}}
                    <tr class="border-b hover:bg-slate-50">
                        <td class="p-4">The Future of Web Development</td>
                        <td class="p-4">
                            <span class="bg-sky-100 text-sky-800 text-xs font-medium px-2 py-1 rounded-full">Technology</span>
                        </td>
                        <td class="p-4 text-slate-600">{{ now()->subDays(1)->format('d M Y') }}</td>
                        <td class="p-4 flex space-x-2">
                            <a href="#" class="text-slate-500 hover:text-sky-600"><i class="fas fa-eye"></i></a>
                            <a href="#" class="text-slate-500 hover:text-amber-600"><i class="fas fa-edit"></i></a>
                            <a href="#" class="text-slate-500 hover:text-rose-600"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    <tr class="border-b hover:bg-slate-50">
                        <td class="p-4">A Beginner's Guide to Machine Learning</td>
                        <td class="p-4">
                            <span class="bg-sky-100 text-sky-800 text-xs font-medium px-2 py-1 rounded-full">AI & ML</span>
                        </td>
                        <td class="p-4 text-slate-600">{{ now()->subDays(3)->format('d M Y') }}</td>
                        <td class="p-4 flex space-x-2">
                            <a href="#" class="text-slate-500 hover:text-sky-600"><i class="fas fa-eye"></i></a>
                            <a href="#" class="text-slate-500 hover:text-amber-600"><i class="fas fa-edit"></i></a>
                            <a href="#" class="text-slate-500 hover:text-rose-600"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection