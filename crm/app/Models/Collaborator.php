<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Collaborator extends Model
{
    protected $table = 'collaborator';

    protected $fillable = ['name', 'email', 'password', 'number', 'company_id'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
