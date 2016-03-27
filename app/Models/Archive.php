<?php namespace App\Models;

class Archive extends \App\Comptech\Model\Model
{


    protected $table = 'archives';
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

    public static function storage(){
        $files = self::all();
        $storage = 0;
        foreach($files as $k => $file){
            $storage += $file->storage;
        }

        return $storage;
    }
}
