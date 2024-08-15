<?php

namespace SalvaTerol\FormTorchlight;

use Filament\Support\Assets\Asset;
use Filament\Support\Assets\Css;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Filament\Support\Facades\FilamentIcon;
use Illuminate\Filesystem\Filesystem;
use Livewire\Features\SupportTesting\Testable;
use SalvaTerol\FormTorchlight\Commands\FormTorchlightCommand;
use SalvaTerol\FormTorchlight\Testing\TestsFormTorchlight;
use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FormTorchlightServiceProvider extends PackageServiceProvider
{
    public static string $name = 'form-torchlight';

    public static string $viewNamespace = 'form-torchlight';

    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package->name(static::$name)->hasCommands($this->getCommands())->hasInstallCommand(function (InstallCommand $command) {
                $command->publishConfigFile()->publishMigrations()->askToRunMigrations()->askToStarRepoOnGitHub('salvaterol/form-torchlight');
            });

        $configFileName = $package->shortName();

        if (file_exists($package->basePath("/../config/{$configFileName}.php"))) {
            $package->hasConfigFile();
        }

        if (file_exists($package->basePath('/../database/migrations'))) {
            $package->hasMigrations($this->getMigrations());
        }

        if (file_exists($package->basePath('/../resources/lang'))) {
            $package->hasTranslations();
        }

        if (file_exists($package->basePath('/../resources/views'))) {
            $package->hasViews(static::$viewNamespace);
        }
    }

    /**
     * @return array<class-string>
     */
    protected function getCommands(): array
    {
        return [
            FormTorchlightCommand::class,
        ];
    }

    /**
     * @return array<string>
     */
    protected function getMigrations(): array
    {
        return [//'create_form-torchlight_table',
        ];
    }

    public function packageRegistered(): void
    {
    }

    public function packageBooted(): void
    {
        // Asset Registration
        FilamentAsset::register($this->getAssets(), $this->getAssetPackageName());

        FilamentAsset::registerScriptData($this->getScriptData(), $this->getAssetPackageName());

        // Icon Registration
        FilamentIcon::register($this->getIcons());

        // Handle Stubs
        if (app()->runningInConsole()) {
            foreach (app(Filesystem::class)->files(__DIR__.'/../stubs/') as $file) {
                $this->publishes([
                    $file->getRealPath() => base_path("stubs/form-torchlight/{$file->getFilename()}"),
                ], 'form-torchlight-stubs');
            }
        }

        // Testing
        Testable::mixin(new TestsFormTorchlight);
    }

    /**
     * @return array<Asset>
     */
    protected function getAssets(): array
    {
        return [
            // AlpineComponent::make('form-torchlight', __DIR__ . '/../resources/dist/components/form-torchlight.js'),
            Css::make('form-torchlight-styles', __DIR__.'/../resources/dist/form-torchlight.css'),
            Js::make('form-torchlight-scripts', __DIR__.'/../resources/dist/form-torchlight.js'),
        ];
    }

    protected function getAssetPackageName(): ?string
    {
        return 'salvaterol/form-torchlight';
    }

    /**
     * @return array<string, mixed>
     */
    protected function getScriptData(): array
    {
        return [];
    }

    /**
     * @return array<string>
     */
    protected function getIcons(): array
    {
        return [];
    }

    /**
     * @return array<string>
     */
    protected function getRoutes(): array
    {
        return [];
    }
}
