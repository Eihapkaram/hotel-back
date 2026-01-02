<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectInterest extends Model
{
    use HasFactory;

    protected $fillable = ['project_id', 'name', 'phone', 'email', 'purchase_type', 'purpose'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
