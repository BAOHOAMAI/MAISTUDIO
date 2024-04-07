@extends('layouts.app')

@section('content')
<div class="container">
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
        <a href="{{route('episode.create')}}" class="btn btn-primary">Thêm tập phim</a>
    <table class="table" id="tablephim">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Film Name</th>
      <th scope="col">Episode</th>
      <th scope="col">Episode Title</th>
      <th scope="col">Episode Thumb</th>
      <th scope="col">Link</th>
      <th scope="col">Manage</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($list as $key => $episode)
    <tr>
      <th scope="row">{{$key}}</th>
      <td>{{$episode->movie->title}}</td>
      <td>{{$episode->episode_num}}</td>
      <td>{{$episode->episode_title}}</td>
      <td><img style="width: 70px; height: 70px" src="{{asset('uploads/episode_thumb/'.$episode->episode_thumb)}}"></td>
      <td>{{$episode->link}}</td>

    <td>
        <form method="POST" action="{{route('episode.destroy',$episode->id)}}">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger" type="submit">Xóa</button>
        </form>
        <a class="btn btn-warning" href="{{route('episode.edit',$episode->id)}}">Sửa</a>
      </td>
    </tr>
    @endforeach

  </tbody>
</table>
</div>
@endsection
