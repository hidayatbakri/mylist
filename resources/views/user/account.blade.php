@extends('template.user')
@section('content')

<style>
  .bg-profile {
    background-image: url("{{ asset('background/default.jpg') }}");
    height: 200px;
    background-repeat: no-repeat;
    background-size: cover;
    border-radius: 5px;
  }

  .profile-avatar {
    width: 80px;
    height: 80px;
    object-fit: cover;
    top: -95px;
    left: 10px;
  }

  ul li {
    padding: 10px 0;
    font-size: 14px;
    font-weight: 300;
  }
</style>

<div class="bg-white w-full rounded-md p-5">
  <div class="bg-profile"></div>
  <div class="profile relative">
    <img src="{{ asset('avatar/avatar-1.png') }}" class="shadow absolute rounded-full profile-avatar" alt="avatar">
    <div class="detail mt-12 px-5">
      <h1>{{ Auth::user()->username }}</h1>
      <div class="grid grid-rows-2 sm:grid-flow-col grid-flow-row gap-4 mt-12 text-slate-500">
        <div class="row-span-3">Detail Info</div>
        <div class="row-span-2 col-span-2 text-end">
          <ul>
            <li>{{ Auth::user()->email }}</li>
            <li>{{ Auth::user()->type == 1 ? 'Personal' : 'Bisnis' }}</li>
            <li>{{ Auth::user()->created_at }}</li>
          </ul>
        </div>
      </div>
      <div class="grid grid-rows-3 sm:grid-flow-col grid-flow-row gap-4 mt-2 text-slate-500">
        <div class="row-span-3">Pengaturan akun</div>
        <div class="row-span-2 col-span-2 text-end">
          <a href="/user/account/edit" class="bg-indigo-500 text-white px-3 py-2 rounded hover:bg-indigo-600 duration-150 ease">Edit akun</a>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection