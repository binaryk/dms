<?php namespace App\Comptechsoft\Ui\Html;

class StringHelper
{

    public static function Items( $items, $separator = ', ' )
    {
        $result = '';
        foreach($items as $i => $value)
        {
            if( $value )
            {
                $result .= $value . $separator;
            }
        }
        if(! $result )
        {
            return $result;
        }
        return substr($result, 0, strlen($result) - strlen($separator) );
    }

    public static function Checked( $value )
    {
        $value = (bool) $value;
        return \Html::image( asset('') . '/custom/img/symbols/' . ($value ? '' : 'un') . 'check.png' );
    }
}