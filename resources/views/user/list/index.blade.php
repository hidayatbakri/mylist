@extends('template.user')
@section('content')

<style>
  .bi-clipboard:hover {
    cursor: pointer;
    color: black;
  }

  #add:hover {
    cursor: pointer;
  }

  .copyTarget {
    position: absolute;
    left: -999999px;
    opacity: 0;
  }
</style>

<div class="notif">
  <div class=" bg-indigo-200 p-3 rounded mb-5">
    <h1 class="text-slate-600 text-light">Berhasil salin alamat link</h1>
  </div>
</div>


<div class="container mx-auto mt-5">
  <div class="bg-white w-64 p-3 rounded mb-5">
    <div id="add" class="bg-zinc-200 p-3 rounded text-slate-600 font-light hover:bg-zinc-300 hover:text-slate-100 duration-150 ease">
      <i class="bi bi-plus-circle pe-2"></i> Buat list baru
    </div>
  </div>
  <div class="grid sm:grid-cols-2 md:grid-cols-3 grid-cols-1 gap-4">
    @foreach($lists as $list)
    <div class="bg-white p-3 w-full rounded">
      <a href="/user/list/{{ $list->id }}">
        <div class="flex justify-between bg-zinc-100 p-3 rounded text-slate-600 font-light hover:bg-zinc-200  duration-150 ease">
          <h1>{{ $list->title }}</h1>
          <form action="/user/list/{{ $list->id }}" method="post" class="top-1 right-2">
            @csrf
            @method('delete')
            <button onclick="return confirm('Apakah anda yakin?')" class="bg-red-400 text-white rounded p-2 hover:bg-red-600"><i class="bi bi-trash3"></i></button>
            <a href="/user/list/{{ $list->id }}/edit" class="bg-gray-400 hover:bg-gray-600 text-white p-2 rounded"><i class="bi bi-gear"></i></a>
          </form>
        </div>
      </a>
      <div class="mt-2 ">
        <h2 class="text-slate-400" style="font-size: 12px;">{{ env('APP_URL') . '/' . $list->slug }} · <span class="{{ $list->status ? 'text-green-400' : 'text-red-400' }}">{{ $list->status ? 'Online' : 'Offline' }}</span> · <i class="bi bi-clipboard clipboard-{{ $list->slug }}"></i></h2>
        <input id="copyTarget{{ $list->slug }}" class="copyTarget" type="text" value="{{ env('APP_URL') . '/' . $list->slug }}">
      </div>
    </div>
    @endforeach
  </div>
</div>


<div class="relative z-10" id="modal" aria-labelledby="modal-title" role="dialog" aria-modal="true">
  <!--
    Background backdrop, show/hide based on modal state.

    Entering: "ease-out duration-300"
      From: "opacity-0"
      To: "opacity-100"
    Leaving: "ease-in duration-200"
      From: "opacity-100"
      To: "opacity-0"
  -->
  <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

  <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
      <!--
        Modal panel, show/hide based on modal state.

        Entering: "ease-out duration-300"
          From: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
          To: "opacity-100 translate-y-0 sm:scale-100"
        Leaving: "ease-in duration-200"
          From: "opacity-100 translate-y-0 sm:scale-100"
          To: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
      -->
      <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
        <form action="/user/list/settings" method="post">
          @csrf
          <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
            <div class="sm:flex sm:items-start">
              <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-indigo-100 sm:mx-0 sm:h-10 sm:w-10">
                <i class="bi bi-journal-plus"></i>
              </div>
              <div class="mt-3 text-center w-full sm:ml-4 sm:mt-0 sm:text-left">
                <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">Buat Baru</h3>
                <div class="mt-2 w-full">
                  @csrf
                  <label for="title" class="text-red-500">*</label>
                  <input id="title" name="title" type="text" required class="block w-full rounded-md border-0 py-3 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-1 focus:ring-outset focus:ring-indigo-200 sm:text-sm sm:leading-6 @error('title') ring-red-600 @enderror" placeholder="Judul" value="{{ @old('title') }}">
                  @error('title')
                  <div class="invalid-feedback text-red-500 text-sm py-2">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
              </div>
            </div>
          </div>
          <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
            <button type="submit" class=" inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 sm:ml-3 sm:w-auto">Tambah</button>
            <button type="button" class="close-modal mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Batal</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@if (@session('success'))
<script>
  Swal.fire(
    'Sukses!',
    `{{ @session('success') }}`,
    'success'
  )
</script>
@endif

<script>
  $('#modal').hide()
  $('.notif').hide()
  $('#add').on('click', () => $('#modal').show(100))
  $('.close-modal').on('click', () => {
    $('#modal').hide(100)
    $('#title').val("")
  })

  $(document).ready(function() {
    @foreach($lists as $ls)
    $('.clipboard-{{$ls->slug}}').click(function() {
      var copyText = $('#copyTarget{{ $ls->slug }}');
      copyText.select();
      document.execCommand('copy');

      $('.notif').show(100)
      setTimeout(() => $('.notif').hide(100), 1500)
    });
    @endforeach
  });
</script>

@endsection