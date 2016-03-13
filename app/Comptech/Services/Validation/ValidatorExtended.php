<?php namespace App\Comptech\Services\Validation;

use Illuminate\Validation\Validator as IlluminateValidator;

class ValidatorExtended extends IlluminateValidator 
{

	private $_custom_messages = [
		"alpha_dash_spaces" => "The :attribute may only contain letters, spaces, and dashes.",
		"alpha_num_spaces"  => "The :attribute may only contain letters, numbers, and spaces.",
		"cont_iban"         => "The :attribute is not a valid IBAN account.",
	];

	public function __construct( $translator, $data, $rules, $messages = array(), $customAttributes = array() ) 
	{
		parent::__construct( $translator, $data, $rules, $messages, $customAttributes );
		$this->_set_custom_stuff();
	}

	protected function _set_custom_stuff() 
	{
		$this->setCustomMessages( $this->_custom_messages );
	}

	protected function validateAlphaDashSpaces( $attribute, $value ) 
	{
		return (bool) preg_match( "/^[A-Za-z\s-_]+$/", $value );
	}

	protected function validateAlphaNumSpaces( $attribute, $value ) 
	{
		return (bool) preg_match( "/^[A-Za-z0-9\s]+$/", $value );
	}

	protected function validateContIban( $attribute, $value, $parameters ) 
	{
		$id_banca = (int) \Input::get('data.' . $parameters[0] );
		if( ! $id_banca )
		{
			return false;
		}
		$banca = \App\Models\Nomenclatoare\Banca::find($id_banca);
		if( is_null($banca) )
		{
			return false;
		}
		if( 'RO' != substr($value, 0, 2) )
		{
			return false;
		}
		if( $banca->iban != substr($value, 4, 4) )
		{
			return false;
		}
		return true;
	}

	protected function validatePartenerUnic($attribute, $value, $parameters )
	{
		if( $parameters[0] == 1)
		{
			return true;
		}
		$record = \App\Models\Admin\Gal\Partener::where('id_gal', $parameters[1])->where('id_partener', $value)->first();
		if( $record )
		{
			return false;
		}
		return true;
	}

	protected function validateCategoriePartener($attribute, $value, $parameters )
	{
		if( \Input::get('data.' . $parameters[0]) == 1)
		{
			// partener nou
			if($value == 0)
			{
				return false;
			}
		}
		return true;
	}

}
