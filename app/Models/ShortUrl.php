<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShortUrl extends Model
{
    public $with = ['company', 'user'];
    protected $fillable = ['user_id', 'company_id', 'original_url', 'short_code', 'clicks', 'expires_at'];

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
