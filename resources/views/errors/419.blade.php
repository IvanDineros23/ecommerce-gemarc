@extends('layouts.app')
@section('title', 'Page Expired')
@section('content')
<div class="flex flex-col items-center justify-center min-h-screen bg-gray-50">
    <div class="bg-white p-8 rounded shadow text-center">
        <h1 class="text-3xl font-bold text-red-600 mb-4">Session Expired</h1>
        <p class="mb-4 text-gray-700">Your session has expired or the page was open too long.<br>Please <a href="/login" class="text-green-700 underline">log in again</a> to continue.</p>
        <a href="/" class="bg-green-700 text-white px-6 py-2 rounded hover:bg-green-800 font-semibold">Go to Home</a>
    </div>
</div>
@endsection
