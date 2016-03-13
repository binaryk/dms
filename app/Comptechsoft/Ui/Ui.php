<?php namespace App\Comptechsoft\Ui;

use Illuminate\Support\Collection;

class Ui
{

	/*
	 * In care folder gasesc sabloanele controalelor de formular
	 * se preia din config/comptech in __construct
	 */
	protected $controls_view_path = NULL;
	
	/*
	 * fisierul view-blade efectiv
	 */
	protected $view_file = NULL;

	/*
	 * ce date se transmit view-ului
	 */
	protected $data = [
		'attributes' => [
			'style' => '',
			'class' => '',
			'id'    => '',
		]
	];

	
	public function __call( $method, $args)
	{
		$this->data[ strtolower($method) ] = $args[0];
		return $this;
	}

	public function __construct($view_file = NULL)
	{
		$this->controls_view_path = config('comptech.ui.controls_view_path');
		if( ! is_null($view_file) )
		{
			$this->view_file = $view_file;
		}
	}

	public function id($id)
	{
		$this->data['attributes']['id'] = $id;
		return $this;
	}

	public function addClass($class)
	{
		$current_classes = explode(' ', $this->data['attributes']['class']);
		if( is_array( $class) )
		{
			foreach($class as $i => $item)
			{
				$current_classes[] = $item;
			}
		}
		else
		{
			if( is_string($class))
			{
				$current_classes[] = $class;
			}
		}
		$this->data['attributes']['class'] = trim(implode(' ',$current_classes));
		return $this;
	}

	protected function addToCollection(Collection $collection, $items, $key = NULL)
	{
		if( is_array($items) )
		{
			foreach ($items as $key => $value) 
			{
				$this->addToCollection($collection, $value, $key);
			}
			return $this;
		}
		if( is_null($key) )
		{
			$collection->push($items);
			return $this;
		}
		$collection->put($key, $items);
		return $this;
	}

	public function render()
    {
    	// dd($this->data);
    	return  view( $this->controls_view_path . '.' . $this->view_file)->with( $this->data )->render();
    }
}