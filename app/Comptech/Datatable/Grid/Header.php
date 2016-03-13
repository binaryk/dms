<?php namespace App\Comptech\Datatable\Grid;

class Header
{

    protected $caption = NULL;
    protected $id      = NULL;
    protected $style   = NULL;
    protected $class   = NULL;
    protected $width   = NULL;

    public function __construct($caption, $id, $width = 0, $class = NULL, $style = NULL)
    {
    	$this->caption = $caption;
    	$this->id      = $id;
        $this->width   = $width;
    	$this->style   = $style;
    	$this->class   = $class;
    }

    public function width()
    {
        return $this->width;
    }

    public function setWidth($width)
    {
        $this->width = $width;
        return $this;
    }

    public function setCaption($caption)
    {
        $this->caption = $caption;
        return $this;
    }

    public function render(Search $search = NULL)
    {
        if( $this->width )
        {
            $this->style .=  (($this->style ? ';' : '') . 'width:' . $this->width . '%');
        }
        return 
            view('datatable.header')
            ->withStyle($this->style)
            ->withCaption($this->caption)
            ->withClass($this->class)
            ->withId($this->id)
            ->withSearch( $search ? $search->render() : '' )
            ->render();
    	// return '<th id="' . $this->id . '" class="' . $this->class . '" style="' . $this->style . '">' . $this->caption . '</th>';
    }

}
