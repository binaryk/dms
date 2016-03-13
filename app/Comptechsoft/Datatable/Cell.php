<?php namespace App\Comptechsoft\Datatable;

class Cell
{

	/*
	 * referinta catre obiectul "cells" care contine celulele
	 */
	protected $cells = NULL;

	/*
	 * Asta va produce textul din celula
	 */
	protected $source = NULL;

	public function cells(Cells $cells)
	{
		$this->cells = $cells;
		return $this;
	}

	public function source($source)
	{
		$this->source = $source;
		return $this;
	}

	public function render($record)
    {
    	if( ! $this->source )
    	{
    		throw new \Exception('Nu avem source pentru celula ' . $this->key . ' (index:' . $this->index . ')', 1);
    	}
	    if( is_string($this->source) ) 
        {
	    	/*
	    	 * View
	    	 */
            return view($this->source)->with([
            	'record' => $record
            ])->render();
        }
        if( (new \ReflectionFunction($this->source))->isClosure() )
        {
        	/*
	    	 * Closeure
	    	 */
        	$source = $this->source;
        	return $source($record);
        }
        return NULL;
    }


	public function __call($method, $arguments)
	{
		if( substr($method, 0, 6) == 'option' )
		{
			$property = strtolower(substr($method, 6));
			if( is_array($arguments) )
			{
				if( array_key_exists(0, $arguments) )
				{
					$this->{$property} = $arguments[0];
					return $this;	
				}
				return $this->{$property};
			}
			return $this->{$property}; 
		}
		throw new \Exception('Invalid method ' . $method . '::' .__CLASS__, 1);
	}

}