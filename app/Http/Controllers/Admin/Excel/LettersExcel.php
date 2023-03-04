<?php

namespace App\Http\Controllers\Admin\Excel;

use App\Models\Letter;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromView;

class LettersExcel implements FromView
{
    public $items;
    public function __construct($items){
        $this->items = $items;
    }
    public function view(): View
    {
        return view('excel.letters.index', [
            'items' =>  $this->items
        ]);
    }
}