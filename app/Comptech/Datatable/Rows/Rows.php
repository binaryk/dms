<?php namespace App\Comptech\Datatable\Rows;

abstract class Rows
{

	protected $config_file          = NULL;
	
	protected $input              	= NULL;
	protected $cells                = NULL;

	abstract protected function totalRecordsCount();
	abstract protected function filteredRecordsCount();
	abstract protected function dataSet();

	public function __construct($input)
	{
		$this->input = $input;
		$this->cells =  new \Illuminate\Support\Collection();
	}

	protected function draw()
	{
		return $this->input['draw'];
	}

	protected function start()
	{
		return $this->input['start'];
	}

	protected function addCell($key, Cell $cell)
    {
        $this->cells->put( $key, $cell);
        return $this;
    }

    public function setPresenter($key, $presenter)
    {
    	$cell = $this->cells->get($key);
    	if( is_null($cell) )
    	{
    		throw new \Exception('Invalid cell key: ' . $key);
    	}
    	$cell->setPresenter($presenter);
    	return $this;
    }

    public function setPresenterData($key, $data)
    {
    	$cell = $this->cells->get($key);
    	if( is_null($cell) )
    	{
    		throw new \Exception('Invalid cell key: ' . $key);
    	}
    	$cell->setData($data);
    	return $this;
    }

	protected function createRow($i, $record)
	{
		if( is_null($this->cells) )
		{
			throw new \Exception('Nu avem celule definite in obiectul Rows', 1);
		}
		$result = []; 
		$j = 0;
		$recCount = $this->start() + $i + 1;
		$record->properties = new \StdClass();
		foreach($this->cells as $id => $cell)
		{
			/*
			 * Attach extra infos to record
			 */
			$record->properties->i 			= $i;
			$record->properties->j 			= ++$j;
			$record->properties->id 		= $id;
			$record->properties->recCount 	= $recCount;
			// $record->properties->options 	= $this->extra_data;

			$result[$cell->id()] = $cell->render($record);
		}
		$result["DT_RowClass"] = 'custom-class';
		$result["DT_RowId"] = 'custom-id';
		return $result;
	}

	protected function prepare( $data )
	{
		$result = [];
		foreach($data as $i => $record)
		{
			$result[] = $this->createRow($i, $record);
		}
		return $result;
	}

	public function response()
	{
		return \Response::json([
			'draw'            => $this->draw(),
			'recordsTotal'    => $this->totalRecordsCount(),
			'recordsFiltered' => $this->filteredRecordsCount(),
			'data'            => $this->dataSet(),
		]);
	}
}