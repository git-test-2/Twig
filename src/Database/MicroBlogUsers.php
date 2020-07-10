<?php
namespace App\Database;

require PROJECT_PATH . '/config.php';

use Illuminate\Database\Eloquent\Model as Eloquent;

class MicroBlogUsers extends Eloquent
{
    protected $table = 'users';
}
