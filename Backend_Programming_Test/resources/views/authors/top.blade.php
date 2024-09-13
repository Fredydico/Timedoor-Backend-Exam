<!DOCTYPE html>
<html>
<head>
    <title>Top Authors</title>
</head>
<body>
@extends('layouts.app')

@section('content')
   <h1>Top 10 Authors with Highest Votes</h1>
   <table class="table mt-4">
       <thead>
           <tr>
               <th>Author</th>
               <th>Vote Count</th>
           </tr>
       </thead>
       <tbody>
           @foreach($topAuthors as $author)
               <tr>
                   <td>{{ $author->name }}</td>
                   <td>{{ $author->vote_count }}</td>
               </tr>
           @endforeach
       </tbody>
   </table>
@endsection
</body>
</html>
