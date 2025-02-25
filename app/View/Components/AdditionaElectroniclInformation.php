<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AdditionaElectroniclInformation extends Component
{
    public $cat_id;
    public $sub_cat_id;

    public function __construct($cat_id = null, $sub_cat_id=null)
    {
        
        $this->cat_id = $cat_id;
        $this->sub_cat_id = $sub_cat_id;
    }
    public function render(): View|Closure|string
    {
        return view('components.additiona-electronicl-information');
    }
}
