<?php

namespace SalvaTerol\FormTorchlight\Commands;

use Illuminate\Console\Command;

class FormTorchlightCommand extends Command
{
    public $signature = 'form-torchlight';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
