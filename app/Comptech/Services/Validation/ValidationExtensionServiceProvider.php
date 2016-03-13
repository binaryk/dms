<?php namespace App\Comptech\Services\Validation;

use Illuminate\Support\ServiceProvider;

class ValidationExtensionServiceProvider extends ServiceProvider 
{

	public function register() {}

	public function boot() 
	{
		$this->app->validator->resolver( 
			function( $translator, $data, $rules, $messages = [], $customAttributes = [] ) 
			{
				return new ValidatorExtended( $translator, $data, $rules, $messages, $customAttributes );
			} 
		);
	}

}
