<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Loa extends Model
{
    protected $table = 'loas';
    protected $fillable = ['id', 'controller_id', 'controller_name', 'controller_email', 'start_date', 'end_date', 'reason', 'status', 'notes', 'updated_at', 'created_at'];
}

// status
// -2 -> denied
// -1 -> More Info Needed
// 0 -> pending
// 1-> accepted - not started
// 2 -> accepted -> started
// 3 -> accepted -> ended
// 4 -> accepted -> deleted
// 5 -> accepted -> controlled

