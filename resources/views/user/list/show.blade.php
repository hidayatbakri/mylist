@extends('template.user')
@section('content')

<div class="breadcrumb flex text-slate-400 text-sm py-5">
  <a href="/user/list" class="text-indigo-500 pe-2">List</a>
  <p> / Detail</p>
</div>

<div class="grid sm:grid-rows-1 grid-rows-2 grid-flow-col gap-2">
  <div class="bg-white rounded p-5">
    <h3 class="text-slate-500 font-medium">Tambah List</h3>
    <form action="/user/list/item" method="post">
      @csrf
      <div class="sm:col-span-4">
        <div class="mt-5">
          <label for="title" class="text-red-500">*</label>
          <input id="title" name="title" type="text" required class="block w-full rounded-md border-0 py-3 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-1 focus:ring-outset focus:ring-indigo-200 sm:text-sm sm:leading-6 @error('title') ring-red-600 @enderror" placeholder="Judul" value="{{ @old('title') }}">
        </div>
        @error('title')
        <div class="invalid-feedback text-red-500 text-sm py-2">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="sm:col-span-4">
        <div class="mt-5">
          <input id="subtitle" name="subtitle" type="text" maxlength="25" class="block w-full rounded-md border-0 py-3 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-1 focus:ring-outset focus:ring-indigo-200 sm:text-sm sm:leading-6 @error('subtitle') ring-red-600 @enderror" placeholder="Sub Judul (Max 25)" value="{{ @old('subtitle') }}">
        </div>
        @error('subtitle')
        <div class="invalid-feedback text-red-500 text-sm py-2">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="sm:col-span-4">
        <div class="mt-5" id="h-url">
          <label for="url" class="text-red-500">*</label>
          <input id="url" name="url" type="text" class="block w-full rounded-md border-0 py-3 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-1 focus:ring-outset focus:ring-indigo-200 sm:text-sm sm:leading-6 @error('url') ring-red-600 @enderror" placeholder="Alamar url" value="{{ @old('url') }}">
        </div>
        @error('url')
        <div class="invalid-feedback text-red-500 text-sm py-2">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="sm:col-span-4">
        <div class="mt-5">
          <input id="wa-check" class="wa-check" name="wa_check" type="checkbox">
          <label for="wa-check" class="text-slate-500 text-sm">Whatsapp</label>
        </div>
      </div>
      <div id="is-wa">
        <div class="sm:col-span-4">
          <div class="mt-5">
            <label for="wa" class="text-red-500">*</label>
            <input id="wa" name="wa" type="number" class="block w-full rounded-md border-0 py-3 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-1 focus:ring-outset focus:ring-indigo-200 sm:text-sm sm:leading-6 @error('wa') ring-red-600 @enderror" placeholder="Nomor Whatsapp" value="{{ @old('wa') }}">
          </div>
          @error('wa')
          <div class="invalid-feedback text-red-500 text-sm py-2">
            {{ $message }}
          </div>
          @enderror
        </div>
        <input type="text" style="opacity: 0; position: absolute; left: -9999px;" name="setting_id" value="{{ $listid }}">
        <div class="sm:col-span-4">
          <div class="mt-5">
            <label for="message" class="text-red-500">*</label>
            <textarea id="message" name="message" class="block w-full rounded-md border-0 py-3 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-1 focus:ring-outset focus:ring-indigo-200 sm:text-sm sm:leading-6 @error('message') ring-red-600 @enderror" placeholder="Pesan" value="{{ @old('message') }}"></textarea>
          </div>
          @error('message')
          <div class="invalid-feedback text-red-500 text-sm py-2">
            {{ $message }}
          </div>
          @enderror
        </div>
      </div>
      <div class="sm:col-span-4">
        <div class="mt-4">
          <button class="bg-indigo-600 hover:bg-indigo-500 ease-in duration-300 text-white w-full py-3 rounded-md mt-5">Tambah</button>
        </div>
      </div>
    </form>
  </div>
  <livewire:list-user :listid="$listid" />


</div>

@livewireScripts
@stack('js')
<script>
  $('#is-wa').hide()
  $('#wa-check').on('click', () => {
    if ($('#wa-check').is(':checked')) {
      $('#is-wa').show(150)
      $('#h-url').hide(150)
    } else {
      $('#h-url').show(150)
      $('#is-wa').hide(150)
    }
    console.log($('.wa-check').is(':checked'))
  })
</script>

@endsection