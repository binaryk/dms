<?php namespace App\Repositories\Ui\Helper\Comboboxsources;

class Year
{

	protected $min  = 0;
	protected $max  = 0;
	protected $step = 1;
	protected $select = '-';
	protected $direction    = 'asc';

	public function __construct( $year_min, $year_max = NULL, $step = NULL )
	{
		$this->min = $year_min;
		$this->max = $year_max;
		$this->step = $step;
		if( is_null( $this->max) )
		{
			$this->max = \Carbon\Carbon::now()->format('Y');
		}
		if( is_null( $this->step) )
		{
			$this->step = 1;
		}
	}

	public function select( $text )
	{
		$this->select = $text;
		return $this;
	}

	public function desc()
	{
		$this->direction = 'desc';
		return $this;
	}

	public static function make( $year_min, $year_max = NULL, $step = NULL)
    {
        return new static($year_min, $year_max, $step);
    }
    
    public function out()
    {
    	$result = [ 0 => $this->select ];
    	if( $this->direction == 'asc')
    	{
    		for($year = $this->min; $year <= $this->max; $year += $this->step)
	    	{
	    		$result[$year] = $year;
	    	}
	    }
	    else
	    {
	    	for($year = $this->max; $year >= $this->min; $year -= $this->step)
	    	{
	    		$result[$year] = $year;
	    	}
	    }
    	return $result;
    }

}
