<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = ['team_name', 'team_leader_id', 'team_member_ids'];

    protected $casts = [
        'team_member_ids' => 'array', // Automatically cast team_member_ids to an array
    ];

    // Relationship with the team leader (User model)
    public function teamLeader()
    {
        return $this->belongsTo(User::class, 'team_leader_id');
    }

    // Relationship with the team members (User model)
    public function teamMembers()
    {
        return $this->hasMany(User::class, 'id', 'team_member_ids');
    }
}