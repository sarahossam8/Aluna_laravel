<?php

namespace App\Models\API;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class note1 extends Model
{
    protected $guarded = []; 

    public function note1()
    {
        return $this->belongsTo(User::class);
    
    }
    protected $fillable = [
        'text', // أضف هذا العمود
        'users_id', // أضف هذا العمود إذا كنت تستخدمه
    ];

}
