<?php

namespace App\View\Components\Blocks;

use Illuminate\View\Component;

class CenteredOnDarkPanel extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public array $blockData)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.blocks.centered-on-dark-panel');
    }
}
