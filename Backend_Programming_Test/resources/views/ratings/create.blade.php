<!DOCTYPE html>
<html>
<head>
    <title>Add Rating</title>
</head>
<body>

@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <form method="GET" action="{{ route('ratings.create') }}" class="mb-4">
        <!-- Filter Author -->
        <div class="mb-4">
            <label for="author_id" class="block text-gray-700 text-sm font-bold mb-2">Author:</label>
            <select name="author_id" id="author_id" class="form-select mt-1 block w-full">
                <option value="">Select Author</option>
                @foreach ($authors as $author)
                    <option value="{{ $author->id }}" {{ request('author_id') == $author->id ? 'selected' : '' }}>
                        {{ $author->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Filter Book Title -->
        <div class="mb-4">
            <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Book Title:</label>
            <select name="title" id="title" class="form-select mt-1 block w-full">
                <option value="">Select Book Title</option>
                @foreach ($titles as $id => $title)
                    <option value="{{ $id }}" {{ request('title') == $id ? 'selected' : '' }}>
                        {{ $title }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Filter Rating -->
        <div class="mb-4">
            <label for="rating" class="block text-gray-700 text-sm font-bold mb-2">Rating:</label>
            <select name="rating" id="rating" class="form-select mt-1 block w-full">
                <option value="">Select Rating</option>
                @for ($i = 1; $i <= 10; $i++)
                    <option value="{{ $i }}" {{ request('rating') == $i ? 'selected' : '' }}>
                        {{ $i }}
                    </option>
                @endfor
            </select>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Filter</button>
    </form>

</div>
@endsection
</body>
</html>
