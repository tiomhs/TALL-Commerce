<?php

namespace App\Livewire;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\WithPagination;

#[Title('Product - Mlanjow')]
class ProductsPage extends Component
{
    use WithPagination;

    public function render()
    {
        $productQuery = Product::query()->where('is_active', 1)->paginate(10);
        return view('livewire.products-page',[
            'products' => $productQuery,
            'brands' => Brand::where('is_active', 1)->get(['id','name','slug']),
            'categories' => Category::where('is_active', 1)->get(['id','name','slug']),
        ]);
    }
}
