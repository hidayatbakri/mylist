<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
  <title>{{ $lists->title }} | {{ env('APP_NAME') }}</title>
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

    .bg-list {
      min-height: 100vh;
    }
  </style>

  @if($lists->type_bg)
  <style>
    .bg-list {
      background-image: url("{{ asset('storage/' . $lists->bg_list) }}");
      background-size: cover;
      background-repeat: no-repeat;
    }
  </style>
  @endif
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-sky-50">
  <div class="flex justify-center p-10 bg-list" @if(!$lists->type_bg) style="background-color: {{ $lists->bg_list }} !important" @endif>
    <div class="rounded p-5 w-96 back-color">
      <h1 class="text-center text-xl font-medium mb-10 title-color">{{ $lists->title }}</h1>
      <ul id="items">
        @foreach($lists->lists as $row)
        <a href="{{ $row->wa == null ? $row->url : 'https://wa.me/+62' . substr($row->wa, 1) . '?text=' . $row->message }}" target="_blank">

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
  <script src="{{ asset('js/jQuery.min.js') }}"></script>
  <script>
    $('.position-color').css({
      'background-color': '{{ $lists->text_color }}',
      'color': '{{ $lists->list_color }}'
    })
    $('.title-color').css('color', '{{ $lists->title_color }}')
    $('.list-text').css('color', '{{ $lists->text_color }}')
    $('.list-color').css('background-color', '{{ $lists->list_color }}')
    $('.back-color').css('background-color', '{{ $lists->bg_color }}')
  </script>
</body>

</html>