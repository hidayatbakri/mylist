<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
  <title>{{ $title ?? '-' }}</title>
  <link rel="stylesheet" href="{{ asset('css/template.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="{{ asset('js/jQuery.min.js') }}"></script>
</head>

<body class="bg-sky-50">
  <div class="flex relative">

    <div class="sidebar bg-white flex-none border-r-2 border-neutral-50">
      <div class="sidebar-header relative flex justify-center items-center">
        <img src="{{ asset('mylist.png') }}" alt="logo">
        <div class="btn-mini absolute bg-white border-2 w-10 h-10 flex items-center justify-center rounded-full">
          <i class="fas fa-angle-left"></i>
        </div>
      </div>
      <div class="sidebar-content p-3 mt-10">
        <h3 class="text-slate-300 text-sm font-medium">DASHBOARD</h3>
        <ul class="sidebar-menu mt-3">
          <a href="/user" class="">
            <li class="rounded-md {{ $activeL == 'home' ? 'active' : '' }} text-slate-500 font-light hover:font-regular hover:text-slate-700 duration-300 ease">
              <i class="bi bi-house pe-3"></i> <span>Home</span>
            </li>
          </a>
          <a href="/user/account" class="">
            <li class="rounded-md {{ $activeL == 'account' ? 'active' : '' }} text-slate-500 font-light hover:font-regular hover:text-slate-700 duration-300 ease">
              <i class="bi bi-person-circle pe-3"></i> <span>Akun</span>
            </li>
          </a>
        </ul>
      </div>
      <div class="sidebar-content p-3 mt-1">
        <h3 class="text-slate-300 text-sm font-medium">OVERVIEW</h3>
        <ul class="sidebar-menu mt-3">
          <a href="/user/list" class="">
            <li class="rounded-md {{ $activeL == 'list' ? 'active' : '' }} text-slate-500 font-light hover:font-regular hover:text-slate-700 duration-300 ease">
              <i class="bi bi-card-list pe-3"></i> <span>List</span>
            </li>
          </a>
          <a href="" class="">
            <li class="rounded-md text-slate-500 font-light hover:font-regular hover:text-slate-700 duration-300 ease">
              <i class="bi bi-archive pe-3"></i> <span>Draf list</span>
            </li>
          </a>
          <a href="" class="">
            <li class="rounded-md text-slate-500 font-light hover:font-regular hover:text-slate-700 duration-300 ease">
              <i class="bi bi-gear pe-3"></i> <span>Pengaturan</span></span>
            </li>
          </a>
        </ul>
      </div>
      <div class="sidebar-content p-3 mt-1">
        <h3 class="text-slate-300 text-sm font-medium">LAINNYA</h3>
        <ul class="sidebar-menu mt-3">
          <a href="/logout" class="">
            <li class="rounded-md text-red-500 font-light hover:font-regular hover:text-red-700 duration-300 ease">
              <i class="bi bi-box-arrow-left pe-3"></i> <span>Keluar</span>
            </li>
          </a>
        </ul>
      </div>
    </div>
    <div class="right-content flex-1">
      <div class="header bg-white flex relative justify-end items-center px-5">
        <div class="account-settings">
          <img src="{{ asset('avatar/avatar-1.png') }}" alt="avatar" class="avatar rounded-full">
        </div>
        <div class="dropdown-account absolute bg-white rounded-md border-2">
          <ul>
            <a href="/user/account">
              <li>Akun</li>
            </a>
            <a href="/logout">
              <li>Keluar</li>
            </a>
          </ul>
        </div>
      </div>
      <div class="main-content">
        @yield('content')
      </div>
    </div>

  </div>
  <script src="{{ asset('js/template.js') }}"></script>
  <!-- jsDelivr :: Sortable :: Latest (https://www.jsdelivr.com/package/npm/sortablejs) -->

  <script>
    $('.dropdown-account').hide()
    $('.btn-mini').on('click', () => $('.sidebar').toggleClass('mini'))
    $('.account-settings').on('click', () => $('.dropdown-account').toggle(100))
  </script>
</body>

</html>