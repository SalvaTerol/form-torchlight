<?php

namespace SalvaTerol\FormTorchlight\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \SalvaTerol\FormTorchlight\FormTorchlight
 */
class FormTorchlight extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \SalvaTerol\FormTorchlight\FormTorchlight::class;
    }
}
