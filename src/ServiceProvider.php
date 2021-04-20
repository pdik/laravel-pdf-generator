<?php

namespace Pdik\laravelPdfGenerator;

use Illuminate\Support\ServiceProvider as Provider;
use Livewire\Livewire;
use Illuminate\Routing\Router;

class ServiceProvider extends Provider
{
	public function boot()
	{
		$this->registerConfigs();

	}


	private function registerConfigs()
	{
		if ($this->app->runningInConsole()) {
			$this->publishes([
				__DIR__ . '/../config/config.php' => config_path('Generatepdf.php'),
			], 'Generatepdf_config');
		}
		$this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'Generatepdf');

	}


}