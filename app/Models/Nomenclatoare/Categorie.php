<?php namespace App\Models\Nomenclatoare;


class Categorie extends \App\Comptech\Model\Model
{


    protected $table = 'nom_categories';
    protected $guarded = ['id'];

    public static function Combobox()
    {
        $result = ['0' => trans('actions.no-selection')];
        $records = self::orderBy('id')->get();
        foreach( $records as $i => $record )
        {
            $result[$record->id] = $record->categorie;
        }
        return $result;

    }
}
