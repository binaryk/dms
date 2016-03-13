<?php namespace App\Comptechsoft\Ui\Controls\Traits;

trait Control
{

	public function checked()
	{
		$this->data['checked'] = true;
		return $this;
	}

	public function nochecked()
	{
		$this->data['checked'] = false;
		return $this;
	}

	public function nolabel()
	{
		$this->data['label'] = NULL;
		return $this;
	}

	public function noautocomplete()
	{
		$this->data['attributes']['autocomplete'] = 'off';
		return $this;
	}

	public function placeholder( $placeholder )
	{
		$this->data['attributes']['placeholder'] = $placeholder;
		return $this;
	}

	public function noplaceholder()
	{
		$this->data['attributes']['placeholder'] = NULL;
		return $this;
	}

	public function type( $type )
	{
		$this->data['attributes']['type'] = $type;
		return $this;
	}

	public function withAttribute( $attribute, $value)
	{
		$this->data['attributes'][$attribute] = $value;
		return $this;
	}

	public function maxlength( $length )
	{
		return $this->withAttribute('maxlength', $length);
	}

	public function disabled( $flag )
	{
		if( $flag )
		{
			$this->withAttribute('disabled', 'disabled');
		}
		return $this;
	}

	public function name($name)
	{
		$this->data['name'] = $name;
		$this->data['attributes']['id'] = $name;
		$this->data['attributes']['name'] = $name;
		return $this;
	}
}