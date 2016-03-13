<?php namespace App\Comptechsoft\Datatable\Traits;

/*
 *  $this->orders() returneaza un array cu structura 
        array:1 [
            0 => array:2 [
                    "column" => "0"
                    "dir" => "asc"
                ]
            ]
    este preluat din inputul dat de Datatable in functie de coloana selectata pentru sortare
    sau de declansarea programatica a sortarii prin metodele Datatable
 */
trait OrderBy
{
    public function orderBy()
    {
        $result = '';
        foreach($this->orders() as $i => $item)
        {
            /*
             * $item este un array cu doua element: column, dir
             * $item['column'] = coloana sortata: 0, 1, 2, ...
             * $item['dir']    = sirectia de sortare  asc|desc
             *
             * $this->orderables = vectorul care contine criteriile de sortare
             * [0 => 'id', ... ] => cloana 0 inseamna sortare dupa id
             */
            if( array_key_exists( $index = $item['column' ], $this->orderables) )
            {
                $order_criteria = $this->orderables[$index];
                if( is_string($order_criteria) )
                {
                    return ['field' => $order_criteria, 'direction' => $item['dir']];
                }
            }
        }
        throw new \Exception('Please define the order criteria for this column', 1);
    }
}