<?php

namespace SalvaTerol\FormTorchlight;

use Filament\Forms\Components\Field;

class FormTorchlight extends Field
{
    public string $language = '';
    public string $theme = '';
    protected string $view = 'form-torchlight::torchlight';

    public function language(string $value): static
    {
        $this->language = $value;

        return $this;
    }

    public function theme(string $value): static
    {
        $this->theme = $value;

        return $this;
    }

    public function getLanguage(): ?string
    {
        return $this->language;
    }

    public function getTheme(): ?string
    {
        return $this->theme;
    }
}
