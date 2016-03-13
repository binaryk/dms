<?php namespace App\Comptech\Datatable\Rows\Collection;

use \App\Comptech\Datatable\Rows\Searchables;
use \App\Comptech\Datatable\Rows\Orderables;
use \App\Comptech\Datatable\Rows\Collection\Queries;
use \App\Comptech\Datatable\Rows\Cell;

class Collection extends \App\Comptech\Datatable\Rows\Rows
{

	protected $queries     = NULL;

	protected function searcheablesFromConfig( $configs )
	{
		$result = new Searchables();
		$i = -1;
		foreach($configs['grid']['columns'] as $key => $column)
		{
			$i++;
			if( $column['searcheable'] )
			{
				$result->add($i, $column['field']);
			}
		}
		return $result;
	}

	protected function orderablesFromConfig( $configs )
	{
		$result = new Orderables();
		$i = -1;
		foreach($configs['grid']['columns'] as $key => $column)
		{
			$i++;
			if( $column['orderable'] )
			{
				$result->add($i, $column['field']);
			}
		}
		return $result;
	}

	protected function makeColumnsFromConfig( $configs )
	{
		foreach($configs['grid']['columns'] as $key => $column)
		{
			$this->addCell($key, new Cell($key, $column['source']));
		}
	}

	public function __construct($input)
	{
		parent::__construct($input);
		if($this->config_file)
		{
			$configs = config($this->config_file); 
			$this->queries = new Queries(
				$input,
	            $configs['model'] . '::getTotal',
	            $configs['model'] . '::getFiltered',
	            $configs['model'] . '::getRows',
	            $this->searcheablesFromConfig($configs),
	            $this->orderablesFromConfig($configs)
	        );
	        $this->makeColumnsFromConfig($configs);
		}
	}

	protected function totalRecordsCount()
	{
		return $this->queries->totalRecordsCount();
	}

	protected function filteredRecordsCount()
	{
		return $this->queries->filteredRecordsCount();
	}

	protected function dataSet()
	{
		$result = $this->prepare( $this->queries->dataSet() );
		return $result;
	}

}