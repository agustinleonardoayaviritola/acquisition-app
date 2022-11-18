<?php

namespace App\Http\Livewire\OrderDetail;

use Livewire\Component;
use App\Models\Order;

class OrderDetailDashboard extends Component
{
    public $slug;
    public $order;
    public function mount($slug)
    {
        $this->order = Order::where('slug', $slug)->firstOrFail();
    }
    public function render()
    {
        return view('livewire.order-detail.order-detail-dashboard', ['order' => $this->order]);
    }
}
