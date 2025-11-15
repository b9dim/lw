<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Pagination\LengthAwarePaginator;

class PaginationLinks extends Component
{
    public function render()
    {
        return view('components.pagination-links');
    }
}

