<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Case_Study extends Model
{
    use HasFactory;
    protected $fillable = [
        'category',
        'logo',
        'path',
        'company_name',
        'order',
        'admin_id', // Add admin_id to the fillable array
        'user_id', // Add user_id to the fillable array
    ];

    //Case studies belongs to only one admin
    public function admin(){
        return $this->belongsTo(Admin::class , 'admin_id');
    }

    //case study belongs to one user
    public function user(){
        return $this->belongsTo(User::class , 'user_id');
    }

}
