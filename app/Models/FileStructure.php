<?php namespace App\Models;
use Baum\Node;

/**
* FileStructure
*/
class FileStructure extends Node {

  protected $table = 'files_structure';
  protected $parentColumn = 'parent_id';
  protected $leftColumn = 'lft';
  protected $rightColumn = 'rgt';
  protected $depthColumn = 'depth';
  protected $guarded = array('id', 'parent_id', 'lft', 'rgt', 'depth');

}
