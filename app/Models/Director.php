<?php namespace App\Models;
use Baum\Node;

/**
* FileStructure
*/
class Director extends Node {

  protected $table = 'directors';
  protected $parentColumn = 'parent_id';
  protected $leftColumn = 'lft';
  protected $rightColumn = 'rgt';
  protected $depthColumn = 'depth';
  protected $guarded = array('id', 'parent_id', 'lft', 'rgt', 'depth');

  public static function owners(){
    if(! auth()->user()){
      return [];
    }
    return self::where('user_id', access()->user()->id)->get();
  }

}
