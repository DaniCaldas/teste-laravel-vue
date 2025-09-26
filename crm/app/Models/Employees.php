<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    protected $table = 'collaborator';

    protected $fillable = ['name', 'email', 'phone', 'company_id'];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'update_at';

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
