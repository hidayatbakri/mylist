@extends('template.user')
@section('content')

<div class="breadcrumb flex text-slate-400 text-sm py-5">
  <a href="/user" class="text-indigo-500 pe-2">Akun</a>
  <p> / Edit</p>
</div>

<div class="bg-white lg:w-1/2 p-7 rounded-md pt-7">
  <form action="/user/account/edit" method="post">
    @method('put')
    @csrf
    <h1 class="text-center text-xl font-semibold text-zinc-600">Edit akun</h1>

    <div class="sm:col-span-4">
      <div class="mt-12">
        <input id="username" name="username" autocomplete="off" type="text" class="block w-full rounded-md border-0 py-3 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-1 focus:ring-outset focus:ring-indigo-200 sm:text-sm sm:leading-6 @error('username') ring-red-600 @enderror" placeholder="Username" value="{{ Auth::user()->username }}">
        @error('username')
        <div class="invalid-feedback text-red-500 text-sm py-2">
          {{ $message }}
        </div>
        @enderror
      </div>
    </div>
    <div class="sm:col-span-4">
      <div class="mt-4">
        <select id="type" name="type" class="text-zinc-400 block w-full rounded-md border-0 py-3 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-1 focus:ring-outset focus:ring-indigo-200 sm:text-sm sm:leading-6 @error('type') ring-red-600 @enderror" placeholder="type">
          <option value="{{ Auth::user()->type }}" selected>{{ Auth::user()->type == 1 ? 'Personal' : 'Bisnis' }}</option>
          <option value="1" class="text-black">Personal</option>
          <option value="2" class="text-black">Bisnis</option>
        </select>
      </div>
      @error('type')
      <div class="invalid-feedback text-red-500 text-sm py-2">
        {{ $message }}
      </div>
      @enderror
    </div>

    <div class="sm:col-span-4">
      <div class="mt-4">
        <input id="password" name="password" type="password" class="block w-full rounded-md border-0 py-3 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-1 focus:ring-outset focus:ring-indigo-200 sm:text-sm sm:leading-6 @error('password') ring-red-600 @enderror" placeholder="Password">
      </div>
      @error('password')
      <div class="invalid-feedback text-red-500 text-sm py-2">
        {{ $message }}
      </div>
      @enderror
    </div>
    <div class="sm:col-span-4">
      <div class="mt-4">
        <button class="bg-indigo-600 hover:bg-indigo-500 ease-in duration-300 text-white w-full py-3 rounded-md mt-5">Simpan</button>
        <a href="/user/account">
          <button class="bg-slate-200 hover:bg-slate-500 hover:text-white ease-in duration-300 text-black w-full py-3 rounded-md mt-3">Batal</button>
        </a>
      </div>
    </div>
  </form>
</div>
@endsection