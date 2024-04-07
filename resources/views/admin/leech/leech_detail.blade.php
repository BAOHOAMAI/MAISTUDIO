@extends('layouts.app')
 
@section('content')
<div class="container-fluid">
      @if (session('success'))
        <script>
            Swal.fire({
              position: "center",
              icon: "success",
              title: "{{ session('success') }}",
              showConfirmButton: false,
              timer: 1500,
              width : '400px',
              height: '200px',
            });
        </script>
    @endif
    <div class="card">
    <table class="table table-responsive" id="tablephim">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Title</th>
      <th scope="col">Image</th>
      <th scope="col">Image Thumb</th>
      <th scope="col">Description</th>
      <th scope="col">Duration</th>
      <th scope="col">Slug</th>
      <th scope="col">Trailer Url</th>

      <th scope="col">Episode Current</th>
      <th scope="col">Episode Total</th>
      <th scope="col">Genre</th>


    </tr>
  </thead>
  <tbody>
    @foreach ($resp_movie as $key => $res)
    <tr>
      <th scope="row">{{$key}}</th>
      <td>{{$res['origin_name']}}</td>
      <td><img style="width: 70px; height: 70px" src="{{$res['thumb_url']}}"></td>
      <td><img style="width: 70px; height: 70px" src="{{$res['poster_url']}}"></td>
      <td>{{$res['content']}}</td>
      <td>{{$res['time']}}</td>
      <td>{{$res['slug']}}</td>
      <td>{{$res['trailer_url ']}}</td>
      <td>{{$res['episode_current']}}</td>
      <td>{{$res['episode_total']}}</td>
      <td>
        @foreach($res['category'] as $res)
           <span class="badge bg-dark">{{$res['name']}}</span>
        @endforeach
      </td>

    </tr>
    @endforeach

  </tbody>
</table>
</div>
@endsection
