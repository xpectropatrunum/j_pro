<?php

namespace App\Http\Controllers\Admin\Excel;

use App\Models\Letter;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromView;

class UserStats implements FromView
{
    public $dates;
    public $user;
    public $times;
    public function __construct($dates, $user, $times)
    {
        $this->user = $user;
        $this->dates = $dates;
        $this->times = $times;
    }
    public function view(): View
    {
        $user = $this->user;
        $dates = $this->dates;
        $times = $this->times;
        return view('excel.users.stats.index', compact('user', 'dates', 'times'));
    }
}
