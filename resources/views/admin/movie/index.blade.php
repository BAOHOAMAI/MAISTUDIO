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
        <a href="{{route('movie.create')}}" class="btn btn-primary">Thêm phim</a>
    <table class="table table-responsive" id="tablephim">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Title</th>
      <th scope="col">Image</th>
      <th scope="col">Image Thumb</th>
      <th scope="col">Slug</th>
      <th scope="col">Duration</th>
      <th scope="col">Episode Total</th>
      <th scope="col"> Add Episode</th>
      <th scope="col">Rated</th>
      <th scope="col">User Rated</th>
      <th scope="col">Trailer Title</th>
      <th scope="col">Trailer Link</th>
      <th scope="col">Active/Inactive</th>
      <th scope="col">Category</th>
      <th scope="col">Genre</th>
      <th scope="col">Ngày tạo</th>
      <th scope="col">Ngày cập nhật</th>
      <th scope="col">Manage</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($list as $key => $movie)
    <tr>
      <th scope="row">{{$key}}</th>
      <td>{{$movie->title}}</td>
      @php 
      $image_check = substr($movie->image,0,5);
      @endphp

      @if ($image_check == 'https')
            <td><img style="width: 70px; height: 70px" src="{{$movie->image}}"></td>
      @else
            <td><img style="width: 70px; height: 70px" src="{{asset('uploads/movie/'.$movie->image)}}"></td>
      @endif
      <td>
      @php 
      $image_check = substr($movie->image_thumb,0,5);
      @endphp

      @if ($image_check == 'https')
        <img style="width: 70px; height: 70px" src="{{$movie->image_thumb}}">
      @else
        <img style="width: 70px; height: 70px" src="{{asset('uploads/movie_thumb/'.$movie->image_thumb)}}">
      @endif
      </td>
      <td>{{$movie->slug}}</td>
      <td>{{$movie->duration}}</td>
      <td>
        @if($movie->episode_count === 1)
        Full / {{$movie->episode_total}}
        @else
        {{$movie->episode_count}} / {{$movie->episode_total}}
        @endif
        </td>
      <td><a href="{{route('add_episode',['id'=>$movie->id])}}" class="btn btn-danger">Add Episode</a></td>
      <td>{{$movie->rated}}</td>
      <td>{{$movie->user_rated}}</td>
      <td>{{$movie->trailer_title}}</td>
      <td>{{$movie->trailer_link}}</td>
      <td>
        @if($movie->status)
            Hiển thị
        @else 
            Không hiển thị
        @endif
      </td>
      <td>{{$movie->category->title}}</td>
      <td>
        @foreach ($movie->movie_genre as $gen)
         <span class="badge bg-dark">{{$gen->title}}</span>
        @endforeach
      </td>
      <td>{{$movie->ngaytao}}</td>
      <td>{{$movie->ngaycapnhat}}</td>
      <td>
        <form method="POST" action="{{route('movie.destroy',$movie->id)}}">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger" type="submit">Xóa</button>
        </form>
        <a class="btn btn-warning" href="{{route('movie.edit',$movie->id)}}">Sửa</a>
      </td>
    </tr>
    @endforeach

  </tbody>
</table>
</div>
@endsection
