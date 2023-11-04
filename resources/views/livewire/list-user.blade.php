<style>
  ul#items li {
    background-color: #eaeaea;
    padding: 8px;
    margin: 10px 0;
    border-radius: 5px;
    position: relative;
  }

  .position {
    width: 40px;
  }
</style>

<div>
  <div class="bg-white rounded p-5">
    <h1 class="text-center text-xl text-slate-600 font-medium mb-10">{{ $lists->title }}</h1>
    <ul id="items">
      @foreach($lists->lists as $row)

      <li data-id="{{ $row->id }}" class="flex justify-between flex-row">
        <div class="flex">
          <div class="bg-slate-100 h-full position flex justify-center items-center me-2 rounded">
            {{ $row->position }}
          </div>
          <div>
            <h1>{{ $row->title }}</h1>
            <h5 class="text-slate-500 text-sm font-light">{{ $row->subtitle }}</h5>
          </div>
        </div>
        <form action="/user/list/item/{{ $row->id }}" class=" top-2 end-2" method="post">
          @csrf
          @method('delete')
          <button class="bg-zinc-500 text-white rounded-md text-sm p-1   hover:bg-zinc-600"><i class="bi bi-trash3"></i></button>
        </form>
      </li>
      @endforeach
    </ul>
  </div>
</div>


@push('js')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
<script>
  var el = document.getElementById('items');
  var sortable = new Sortable(el, {
    animation: 150,
    ghostClass: 'blue-background-class',
    onEnd: function(event) {
      // Mengakses elemen yang diurutkan
      var sortedItems = event.from.children;

      // Melakukan iterasi untuk mendapatkan posisi masing-masing elemen
      for (var i = 0; i < sortedItems.length; i++) {
        var itemId = sortedItems[i].getAttribute('data-id');
        Livewire.dispatch('updatePosition', [itemId, i + 1])
      }
      setTimeout(() => Livewire.dispatch('getData'), 1000)

    },
  });
</script>

@endpush