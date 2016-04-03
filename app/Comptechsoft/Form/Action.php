<?php namespace App\Comptechsoft\Form;

use Illuminate\Support\Facades\Log;

class Action
{
    protected $id       = NULL;
    protected $action   = NULL;
    protected $data     = NULL;
    protected $record   = NULL;

    protected $rules    = [];
    protected $messages = [];


    public function __construct($action, $id)
    {
        $this->id     = $id;
        $this->action = $action;
    }

    public function addData($key, $value)
    {
        $this->data[$key] = $value;
        return $this;
    }

    public function addRule($actions, $field, $rule, $message)
    {
        foreach($actions as $i => $action)
        {
            $this->rules[$action][$field][] = $rule;
            $pos = strpos($rule,':');
            if( $pos === false )
            {
                $key = $rule;
            }
            else
            {
                $key = substr( $rule, 0, $pos );
            }
            $this->messages[$action][$field][$key] = $message;
        }
        return $this;
    }

    protected function fillRecord($data)
    {
        foreach($data as $field => $value)
        {
            $this->record->{$field} = $value;
        }
    }

    protected function prepareinsertdata( $data, $record )
    {
        return $data;
    }

    protected function prepareupdatedata( $data, $record )
    {
        return $data;
    }

    protected function doInsert()
    {
        $this->record->save();
    }

    protected function doUpdate()
    {
        $this->record->save();
    }

    protected function doDelete()
    {
        $this->record->delete();
    }

    public function commit()
    {

        if( $this->action != 'delete' )
        {
            $validator = \Validator::make( $this->data, $this->rules(), $this->messages() );
            if ($validator->fails() )
            {
                return [
                    'success'     => false,
                    'record'      => NULL,
                    'error-type'  => 'rules',
                    'errors'      => $validator->messages(),
                    'messges'     => [],
                ];
            }
            $this->fillRecord( $this->{'prepare' . $this->action . 'data'}($this->data, $this->record) );
        }
        try
        {
            $this->log($this->record, $this->action);
            $this->{'do' . $this->action}();
            return [
                'success'     => true,
                'record'      => $this->record,
                'error-type'  => '',
                'errors'      => [],
                'messages'    => [],
            ];
        }
        catch(\Exception $e)
        {
            return [
                'success'     => false,
                'record'      => NULL,
                'error-type'  => 'exception',
                'errors'      => [ $e->getMessage() ],
                'messages'    => [],
            ];
        }
    }

    public function log($record, $action)
    {
        $table = $record->getTable();
        $user = access()->user();
        $message = 'Utilizatorul: '.$user->name . ' a facut actiunea de: '. $action . ', pe tabelul: '.$table;
        if($action == 'update' || $action == 'delete'){
            $message .= ', la id-ul:'.$record->id;
        }
        switch($action){
            case 'insert':
                Log::info($message);
                break;
            case 'update':
                Log::warning($message);
                break;
            case 'delete':
                Log::warning($message);
                break;
        }
    }

    protected function rules()
    {
        if( array_key_exists($this->action, $this->rules) )
        {
            return $this->rules[$this->action];
        }
        return [];
    }

    protected function messages()
    {
        if( ! array_key_exists($this->action, $this->messages) )
        {
            return [];
        }
        $result = [];
        foreach($this->messages[$this->action] as $field => $messages)
        {
            foreach($messages as $rule => $message)
            {
                $result[$field . '.' . $rule] = $message;
            }
        }
        return $result;
    }

    public function __call( $method, $arguments)
    {
        if( property_exists( $this, $method = strtolower($method)) )
        {
            if( is_array($arguments) )
            {
                if( array_key_exists(0, $arguments) )
                {
                    $this->{$method} = $arguments[0];
                    return $this;
                }
            }
            return $this->{$method};
        }
        throw new \Exception('Call invalid method ' . $method . ' on class  ' . __CLASS__ . '.', 1);
    }

}