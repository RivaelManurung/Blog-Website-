@extends('user.layouts.app')
@section('content')
<div class="container mx-auto pt-32 pb-12 flex justify-center">
    <div class="w-full max-w-md">
        <form class="bg-white shadow-xl rounded-xl px-8 pt-6 pb-8" method="POST" action="{{ route('login') }}">
            @csrf
            <h1 class="text-2xl font-bold text-center mb-6">Admin Login</h1>
            <div class="mb-4">
                <label class="block text-slate-700 text-sm font-bold mb-2" for="email">Email</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-slate-700" id="email" type="email" name="email" required>
            </div>
            <div class="mb-6">
                <label class="block text-slate-700 text-sm font-bold mb-2" for="password">Password</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-slate-700" id="password" type="password" name="password" required>
            </div>
            <div class="flex items-center justify-between">
                <button class="bg-sky-500 hover:bg-sky-700 text-white font-bold py-2 px-4 rounded" type="submit">
                    Sign In
                </button>
            </div>
        </form>
    </div>
</div>
@endsection