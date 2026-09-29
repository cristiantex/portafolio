<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class SiteLayout extends Component
{
    public function __construct(
        public string $titulo,
        public string $descripcion,
        public ?string $imagen = null,
        public ?array $jsonLd = null,
    ) {}

    public function render(): View
    {
        return view('layouts.site');
    }
}
