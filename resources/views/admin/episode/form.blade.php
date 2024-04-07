@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <a href="{{route('episode.index')}}" class="btn btn-primary">Liệt kê tập phim</a>
        <div class="card-header">Quản lý danh mục</div>

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
            @if (!isset($episode))
            <form method="POST" action="{{route('episode.store')}}" enctype="multipart/form-data">
            @csrf
            @else 
            <form method="POST" action="{{route('episode.update',$episode->id)}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @endif
                
                <div class="mb-3">
                    <label for="title" class="form-label">Choose Film</label>
                    <select class="form-select" name="film">
                    @foreach ( $list as $key => $mov)
                      <option value="{{$mov->id}}">
                        {{$mov->title}}
                    </option>
                      @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="episode_title" class="form-label">Episode Title</label>
                    <input type="text" name="episode_title" class="form-control" placeholder="Nhập dữ liệu"  value="{{isset($episode) ? $episode->episode_title : ''}}">
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
        </div>
    </div>
</div>
@endsection
