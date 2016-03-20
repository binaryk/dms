<?php namespace App\Models;

class DirectorFiles extends \App\Comptech\Model\Model
{


    protected $table = 'director_files';
    protected $guarded = ['id'];

    public static function Combobox()
    {
        $result = ['0' => trans('actions.no-selection')];
        $records = self::orderBy('id')->get();
        foreach( $records as $i => $record )
        {
            $result[$record->id] = $record->name;
        }
        return $result;

    }
}
