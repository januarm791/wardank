
@extends('layouts.app')

@section('title', 'Daftar Membership')

@section('content')
<div class="max-w-lg mx-auto mt-10 p-6 bg-white rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Daftar Membership</h2>
    <p class="mb-4">Silakan klik tombol di bawah untuk menjadi member.</p>

    @if(session('error'))
        <div class="bg-red-500 text-white p-2 mb-4 rounded">
            {{ session('error') }}
        </div>
    @endif

    @if(session('success'))
        <div class="bg-green-500 text-white p-2 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('membership.register') }}" method="POST">
        @csrf
        <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Daftar Sekarang</button>
    </form>
</div>
@endsection
