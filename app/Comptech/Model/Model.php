<?php namespace App\Comptech\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Model extends \Illuminate\Database\Eloquent\Model
{
    use SoftDeletes;
    public static function getTotal( $where )
    {
        if( ! $where )
        {
            return self::count();
        }
        return self::whereRaw($where)->count();
    }

    public static function getFiltered( $where )
    {
        if( ! $where )
        {
            return self::count();
        }
        return self::whereRaw($where)->count();
    }

    public static function getRows( $start, $length, $where, $order, $input = NULL )
    {
        if( ! $where )
        {
            return self::orderByRaw($order)->skip($start)->take($length)->get();
        }
        return self::whereRaw($where)->orderByRaw($order)->skip($start)->take($length)->get();
    }

    public static function beforeCreate( $data )
    {
        return $data;
    }

    public static function afterCreate( $record, $data )
    {
        return $record;
    }

	public static function insertRecord( $data, $id = NULL)
	{
        $data_for_create = static::beforeCreate($data);
		self::unguard();
		$record = self::create($data_for_create);
        $record = static::afterCreate($record, $data);
        return $record;
	}

    public static function beforeUpdate( $data, $id = NULL)
    {
        return $data;
    }

    public static function afterUpdate( $record, $data, $id = NULL)
    {
        return $record;
    }

    public static function updateRecord( $data, $id )
    {
        $record = static::find($id);
        if( ! $record )
        {
            throw new \Exception("Record not found", 1);
        }
        $data_for_update   = static::beforeUpdate($data, $id);
        self::unguard();
        $record->update($data_for_update);
        $record = static::afterUpdate($record, $data, $id);
        return $record;
    }

    public static function beforeDelete( $data )
    {
        return $data;
    }

    public static function afterDelete( $record, $data, $id = NULL )
    {
        return $record;
    }

    public static function deleteRecord($data, $id)
    {
        $record = static::find($id);
        if( ! $record )
        {
            throw new \Exception("Record not found", 1);
        }
        $data   = static::beforeDelete($data);
        $record->delete();
        $record = static::afterDelete($record, $data, $id);
        return $record;
    }

	public static function removeField($field, $data)
    {
        if( is_string($field) )
        {
            if( array_key_exists($field, $data) )
            {
                $data[$field] = NULL;
                unset($data[$field]);
            }
        }
        else 
        {
            if( is_array($field) )
            {
                foreach($field as $i => $fld)
                {
                    $data = self::removeField($fld, $data);
                }
            }
        }
        return $data;
    }

    public static function toNULL($field, $data, $values)
    {
        if( array_key_exists($field, $data) )
        {
            if( in_array($data[$field], $values) )
            {
                $data[$field] = NULL;
            }
        }
        return $data;
    }
}