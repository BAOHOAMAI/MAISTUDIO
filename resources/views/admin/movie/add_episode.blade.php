@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
         <div class="card-body">
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
    <form method="POST" action="{{route('episode.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="film" class="form-label">Film</label>
            <input type="text" name="film_title" class="form-control" value="{{isset($movie) ? $movie->title : ''}}" readonly>
            <input type="hidden" name="film" class="form-control" value="{{isset($movie) ? $movie->id : ''}}" readonly>
        </div>
        <div class="mb-3">
            <label for="episode_title" class="form-label">Episode Title</label>
            <input type="text" name="episode_title" class="form-control" placeholder="Nhập dữ liệu"  value="{{isset($movie) ? $movie->episode_title : ''}}">
        </div>
        <div class="mb-3">
            <label for="episode_thumb" class="form-label">Episode Thumb</label>
            <input type="file" name="episode_thumb" class="form-control">
            @if(isset($episode))
            <img style="width: 15%;" src="{{asset('uploads/episode_thumb/'.$episode->episode_thumb)}}">
            @endif
        </div>

         <div class="mb-3">
            <label for="episode" class="form-label">Episode</label>
            <input type="text" name="episode" class="form-control" placeholder="Nhập dữ liệu" value="{{isset($episode) ? $episode->episode_num : ''}} "{{isset($episode) ? "readonly" : ""}}>
                 @error('episode')
                      <div class="error-message" style="color: red">{{ $message }}</div>
                 @enderror 
        </div>
        <div class="mb-3">
            <label for="link-film" class="form-label">Link</label>
            <input type="text" name="link-film" class="form-control" placeholder="Nhập dữ liệu"  value="{{isset($episode) ? $episode->link : ''}}">
              @error('link-film')
                <div class="error-message" style="color: red">{{ $message }}</div>
            @enderror 
        </div>
        <button type="submit" class="btn btn-success">{{ isset($episode) ? "Cập nhật" : "Thêm tập phim"}}</button>
    </form>
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
</div>
</div>
@endsection
