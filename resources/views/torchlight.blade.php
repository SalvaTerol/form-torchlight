@php use Filament\Support\Facades\FilamentAsset; @endphp
<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"
>
    <pre
        x-load-css="[@js(FilamentAsset::getStyleHref('form-torchlight', package: 'SalvaTerol/form-torchlight'))]"
    >
        <x-torchlight-code
            language="{{ $field->getLanguage() ?? ''  }}"
            theme="{{ $field->getTheme() ?? '' }}"
            {{ $attributes }}
        >{!! $getState() !!}</x-torchlight-code>
    </pre>
</x-dynamic-component>
