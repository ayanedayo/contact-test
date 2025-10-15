<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'first_name',
        'last_name',
        'gender',
        'email',
        'tel',
        'address',
        'building',
        'detail',
    ];
    protected $casts =[
        'gender' => 'integer',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function getFullNameAttribute(): string
    {
        return "{$this->last_name} {$this->first_name}";
    }
}