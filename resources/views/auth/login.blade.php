<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
  <title>Halaman Masuk</title>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-sky-50">
  <div class="container w-screen h-screen flex justify-center items-center flex-col">
    <img src="{{ asset('mylist.png') }}" alt="logo" width="120px" class="mb-5">
    <div class="bg-white lg:w-2/6 p-7 rounded-md pt-7">
      <h1 class="text-center text-xl font-semibold text-zinc-600">Halaman Masuk</h1>
      <p class="text-center text-sm text-zinc-400 pt-3 mb-5">Masukkan email dan password anda.</p>
      <form action="/login" method="post">
        @csrf

        <div class="sm:col-span-4">
          <div class="mt-12">
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
    <h5 class="text-zinc-600 text-sm pt-5">Belum punya akun? <a class="text-indigo-500 hover:text-indigo-300" href="/register">klik disini</a> untuk daftar</h5>
  </div>

  <script src="{{ asset('js/jQuery.min.js') }}"></script>
  @if (@session('success'))
  <script>
    Swal.fire(
      'Good job!',
      `{{ @session('success') }}`,
      'success'
    )
  </script>
  @endif
  @if (@session('error'))
  <script>
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: `{{ @session('error') }}`,
    })
  </script>
  @endif
</body>

</html>