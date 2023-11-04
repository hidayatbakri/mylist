@extends('template.user')
@section('content')

<style>
  ul#items li {
    padding: 8px;
    margin: 10px 0;
    border-radius: 5px;
    position: relative;
    min-height: 60px;
  }

  .position {
    width: 40px;
  }
</style>

@if($lists->type_bg)
<style>
  .bg-list {
    background-image: url("{{ asset('storage/' . $lists->bg_list) }}");
    /* background-size: ; */
  }
</style>
@endif

<div class="breadcrumb flex text-slate-400 text-sm py-5">
  <a href="/user/list" class="text-indigo-500 pe-2">List</a>
  <p> / Detail</p>
</div>

<div class="grid sm:grid-rows-1 grid-rows-2 grid-flow-col gap-2">
  <div class="bg-white rounded p-5">
    <h3 class="text-slate-500 font-medium">Pengaturan List</h3>
    <form action="/user/list/{{ $lists->id }}" method="post" enctype="multipart/form-data">
      @csrf
      @method('put')
      <div class="sm:col-span-4">
        <div class="mt-5">
          <label for="title" class="text-slate-500 text-sm">Judul <span class="text-red-500">*</span></label>
          <input id="title" name="title" type="text" required class="block w-full rounded-md border-0 py-3 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-1 focus:ring-outset focus:ring-indigo-200 sm:text-sm sm:leading-6 @error('title') ring-red-600 @enderror" placeholder="Judul" value="{{ $lists->title }}">
        </div>
        @error('title')
        <div class="invalid-feedback text-red-500 text-sm py-2">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="sm:col-span-4">
        <div class="mt-5">
          <label for="title_color" class="text-slate-500 text-sm">Warna Judul <span class="text-red-500">*</span></label>
          <input id="title_color" name="title_color" type="color" required class="" placeholder="Judul" value="{{ $lists->title_color }}">
        </div>
        @error('title_color')
        <div class="invalid-feedback text-red-500 text-sm py-2">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="sm:col-span-4">
        <div class="mt-5">
          <label for="bg_color" class="text-slate-500 text-sm">Warna Latar Depan <span class="text-red-500">*</span></label>
          <input id="bg_color" name="bg_color" type="color" required class="" placeholder="Judul" value="{{ $lists->bg_color }}">
        </div>
        @error('bg_color')
        <div class="invalid-feedback text-red-500 text-sm py-2">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="sm:col-span-4">
        <div class="mt-5">
          <label for="text_color" class="text-slate-500 text-sm">Warna Tulisan <span class="text-red-500">*</span></label>
          <input id="text_color" name="text_color" type="color" required class="" placeholder="Judul" value="{{ $lists->text_color }}">
        </div>
        @error('text_color')
        <div class="invalid-feedback text-red-500 text-sm py-2">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="sm:col-span-4">
        <div class="mt-5">
          <label for="list_color" class="text-slate-500 text-sm">Warna List <span class="text-red-500">*</span></label>
          <input id="list_color" name="list_color" type="color" required class="" placeholder="Judul" value="{{ $lists->list_color }}">
        </div>
        @error('list_color')
        <div class="invalid-feedback text-red-500 text-sm py-2">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="sm:col-span-4">
        <div class="mt-5">
          <label for="type-bg" class="text-slate-500 text-sm ">Latar belakang <span class="text-red-500">*</span></label><br>
          <input id="type-bg-color" class="check-bg" @if(!$lists->type_bg) checked @endif name="type_bg" type="radio" value="0"> <label for="type-bg-color" class="text-slate-500 text-sm me-3">Warna</label>
          <input id="type-bg-img" class="check-bg" name="type_bg" @if($lists->type_bg) checked @endif type="radio" value="1"> <label for="type-bg-img" class="text-slate-500 text-sm">Gambar</label>
        </div>
        <div class="input-bg"></div>
      </div>
      @error('bg_list')
      <div class="invalid-feedback text-red-500 text-sm py-2">
        {{ $message }}
      </div>
      @enderror
      <div class="sm:col-span-4">
        <div class="mt-4">
          <button class="bg-indigo-600 hover:bg-indigo-500 ease-in duration-300 text-white w-full py-3 rounded-md mt-5">Simpan</button>
        </div>
      </div>
    </form>
  </div>

  <div class="flex justify-center p-10 bg-list" @if(!$lists->type_bg) style="background-color: {{ $lists->bg_list }} !important" @endif>
    <div class="rounded p-5 w-96 back-color">
      <h1 class="text-center text-xl font-medium mb-10 title-color">{{ $lists->title }}</h1>
      <ul id="items">
        @foreach($lists->lists as $row)
        <a href="{{ $row->url }}" target="_blank">

          <li class="flex justify-between flex-row list-color">
            <div class="flex">
              <div class="position-color h-full position flex justify-center items-center me-2 rounded">
                {{ $row->position }}
              </div>
              <div class="list-text">
                <h1>{{ $row->title }}</h1>
                <h5 class="text-sm font-light">{{ $row->subtitle }}</h5>
              </div>
            </div>
          </li>
        </a>
        @endforeach
      </ul>
    </div>
  </div>

</div>
@if (@session('success'))
<script>
  Swal.fire(
    'Good job!',
    `{{ @session('success') }}`,
    'success'
  )
</script>
@endif
<script>
  $('.position-color').css({
    'background-color': '{{ $lists->text_color }}',
    'color': '{{ $lists->list_color }}'
  })
  $('.title-color').css('color', '{{ $lists->title_color }}')
  $('.list-text').css('color', '{{ $lists->text_color }}')
  $('.list-color').css('background-color', '{{ $lists->list_color }}')
  $('.back-color').css('background-color', '{{ $lists->bg_color }}')
  if ($('#type-bg-color').is(':checked')) {
    $('.input-bg').html('<input type="color" name="bg_list" id="bg-color" value="{{ $lists->bg_list }}">')
  } else {
    $('.input-bg').html('<input type="file" name="bg_list" id="bg-img">')
  }
  $('.check-bg').on('click', () => {
    if ($('#type-bg-color').is(':checked')) {
      $('.input-bg').html('<input type="color" name="bg_list" id="bg-color" value="{{ $lists->bg_list }}">')
    } else {
      $('.input-bg').html('<input type="file" name="bg_list" id="bg-img">')
    }

  })
</script>

<!-- <input type="color" name="bg_list" id="bg-color">
<input type="file" name="bg_list" id="bg-img"> -->

@endsection