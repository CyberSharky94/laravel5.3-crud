<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';

    protected $fillable = ['proj_title', 'proj_start_date', 'proj_end_date', 'user_id'];

    public $incrementing = true;

    public function user($attr = null)
    {
        $user = User::find($this->user_id);

        return $user[$attr];
    }
}
