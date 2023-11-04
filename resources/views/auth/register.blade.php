<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
  <title>Halaman Daftar</title>
</head>

<body class="bg-sky-50">
  <div class="container w-screen h-screen flex justify-center items-center flex-col">
    <img src="{{ asset('mylist.png') }}" alt="logo" width="120px" class="mb-5">
    <div class="bg-white lg:w-2/6 p-7 rounded-md pt-7">
      <form action="/register" method="post">
        @csrf
        <h1 class="text-center text-xl font-semibold text-zinc-600">Halaman Daftar</h1>
        <p class="text-center text-sm text-zinc-400 pt-3 mb-5">Isi formulir untuk buat akun baru.</p>

        <div class="sm:col-span-4">
          <div class="mt-12">
            <input id="username" name="username" autocomplete="off" type="text" class="block w-full rounded-md border-0 py-3 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-1 focus:ring-outset focus:ring-indigo-200 sm:text-sm sm:leading-6 @error('username') ring-red-600 @enderror" placeholder="Username" value="{{ @old('username') }}">
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
              <option value="">Pilih</option>
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
            <input id="email" name="email" type="email" class="block w-full rounded-md border-0 py-3 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-1 focus:ring-outset focus:ring-indigo-200 sm:text-sm sm:leading-6 @error('email') ring-red-600 @enderror" placeholder="Alamat email" value="{{ @old('email') }}">
          </div>
          @error('email')
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
            <button class="bg-indigo-600 hover:bg-indigo-500 ease-in duration-300 text-white w-full py-3 rounded-md mt-5">Masuk</button>
          </div>
        </div>
      </form>
    </div>
    <h5 class="text-zinc-600 text-sm pt-5">Sudah punya akun? <a class="text-indigo-500 hover:text-indigo-300" href="/">klik disini</a> untuk masuk</h5>
  </div>
</body>

</html>