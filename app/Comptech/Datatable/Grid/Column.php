<?php namespace App\Comptech\Datatable\Grid;

class Column
{

    const ORDERABLE       = true;
    const NOT_ORDERABLE   = false;

    const NOT_SEARCHEABLE = NULL;

    const RIGHT           = ' h-right';
    const CENTER          = ' h-center';
    const LEFT            = ' h-left';

    const TOP             = ' v-top';
    const MIDDLE          = ' v-middle';  
    const BOTTOM          = ' v-bottom';

    const FONT_MEDIUM     = ' f_medium';

    protected $header   = NULL;
    protected $sortable = false;
    protected $class    = 'h-left v-top f-medium';
    protected $search   = NULL;


    public function __construct(Header $header, Search $search = NULL, $sortable = false, $class = NULL)
    {
        $this->header 	= $header;
        $this->sortable = $sortable;
        $this->search   = $search;
        if($class)
        {
            $this->class    = $class;
        }
    }

    public function getSearch()
    {
        return $this->search;
    }

    public function width()
    {
        return $this->header->width();
    }

    public function setWidth($width)
    {
        $this->header->setWidth($width);
    }

    public function renderHeader()
    {
        return $this->header->render($this->search);
    }

    public function renderSearch()
    {
        if( is_null( $this->search) )
        {
            return '<td></td>';
        }
        return '<td>' . $this->search->render() . '</td>';
    }

    public function setHeaderCaption($caption)
    {
        $this->header->setCaption($caption);
        return $this;
    }

    public function render($key)
    {
    	return "{data : '" . $key . "', orderable:" . ($this->sortable ? 'true' : 'false') . ", className:'" . $this->class . "'},";
    }

}
