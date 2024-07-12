<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;

class ProductsList extends Component
{
    use WithPagination;

    #[Url()]
    public $sort = 'desc';

    #[Url()]
    public ?string $search = '';

    #[Url()]
    public $category = '';


    public function setSort($sort)
    {
        $this->sort = ($sort === 'desc') ? 'desc' : 'asc';
        
    }

    #[On('search')]
    public function updateSearch($search)
    {
        $this->search = $search;
        $this->category = '';
        $this->resetPage();
    }

    public function clearFilters()
    {
        $this->search = '';
        $this->category = '';
        $this->resetPage();
    }


    #[Computed()]
    public function products()
    {
        return Product::orderBy('date_posted', $this->sort)->where('status',true)
        // ->whereHas('categories', function($query)
        // {
        //     $query->where('slug', $this->category);
        // })
        ->when($this->activeCategory, function ($query)
        {
            $query->withCategory($this->category);
        })
        ->where('title','like',"%{$this->search}%")
        ->paginate(8);
    }

    #[Computed()]
    public function activeCategory()
    {
        return Category::where('slug', $this->category)->first();
    }
    
    public function render()
    {
        return view('livewire.products-list');
    }
}
