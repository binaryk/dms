<?php

namespace App\Models\PS;

use App\Comptech\Model\Model;
use App\Models\Access\User\Traits\UserAccess;
use App\Models\FileStructure;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Access\User\Traits\Attribute\UserAttribute;
use App\Models\Access\User\Traits\Relationship\UserRelationship;

/**
 * Class UseAccounts
 * @package App\Models\Access\User
 */
class UserAccounts extends Model
{

    use SoftDeletes;
    protected $table = 'ps_user_account';






}