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
    public $fees;
    public function __construct($dates, $user, $times, $fees)
    {
        $this->user = $user;
        $this->dates = $dates;
        $this->times = $times;
        $this->fees = $fees;
    }
    public function view(): View
    {
        $user = $this->user;
        $dates = $this->dates;
        $times = $this->times;
        $fees = $this->fees;
        return view('excel.users.stats.index', compact('user', 'dates', 'times', 'fees'));
    }
}
