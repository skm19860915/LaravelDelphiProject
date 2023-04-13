<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use App\Models\Container;

class TrackingContainerView implements FromView, ShouldAutoSize
{
    public function view(): View
    {
        $list = Container::select('*')->get();

        return view('container/excel', ['list' => $list]);
    }
}
