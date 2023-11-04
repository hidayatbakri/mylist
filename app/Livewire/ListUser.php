<?php

namespace App\Livewire;

use App\Models\Lists;
use App\Models\Setting;
use Livewire\Component;

class ListUser extends Component
{
    protected $listeners = ['updatePosition' => 'updatePosition', 'getData' => 'getData'];
    public $lists = [];
    public $listid;
    public function render()
    {
        return view('livewire.list-user');
    }

    public function mount($listid)
    {
        $this->listid = $listid;
        $this->lists = Setting::with('lists')->where('id', $listid)->first();
    }

    public function getData()
    {
        $this->lists = Setting::with('lists')->where('id', $this->listid)->first();
    }

    public function updatePosition($id, $position)
    {
        Lists::find($id)->update(['position' => $position]);
    }
}
