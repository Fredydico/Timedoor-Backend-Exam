<!DOCTYPE html>
<html>
<head>
    <title>Books</title>
</head>
<body>
@extends('layouts.app')

@section('content')
   <form method="GET" action="{{ route('books.index') }}">
       <input type="text" name="search" placeholder="Search for books" value="{{ request('search') }}" class="form-control mb-3">
       <div class="mb-3">
           <label for="per_page" class="form-label">Rows per Page</label>
           <select name="per_page" id="per_page" class="form-select">
               <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
               <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
               <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
           </select>
       </div>
       <button type="submit" class="btn btn-primary">Search</button>
   </form>

   <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">Title</th>
                    <th class="py-2 px-4 border-b">Author</th>
                    <th class="py-2 px-4 border-b">Category</th>
                    <th class="py-2 px-4 border-b">Average Rating</th>
                    <th class="py-2 px-4 border-b">Vote Count</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($books as $book)
                <tr>
                    <td class="py-2 px-4 border-b">{{ $book->title }}</td>
                    <td class="py-2 px-4 border-b">{{ $book->author->name ?? 'Unknown' }}</td>
                    <td class="py-2 px-4 border-b">{{ $book->category->name ?? 'Unknown' }}</td>
                    <td class="py-2 px-4 border-b">{{ number_format($book->average_rating, 2) ?? 'N/A' }}</td>
                    <td class="py-2 px-4 border-b">{{ $book->vote_count ?? '0' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

   {{ $books->appends(['search' => request('search'), 'per_page' => request('per_page')])->links() }}
   
@endsection

</body>
</html>
