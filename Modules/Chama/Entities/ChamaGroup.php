<?php

namespace Modules\Chama\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\User\Entities\User;

class ChamaGroup extends Model
{
    protected $table = 'chama_groups';
    protected $fillable = ['name', 'description', 'contribution_amount', 'frequency', 'start_date', 'status', 'created_by_id'];

    public function members()
    {
        return $this->hasMany(ChamaMember::class, 'chama_group_id', 'id')->orderBy('payout_order', 'asc');
    }

    public function contributions()
    {
        return $this->hasMany(ChamaContribution::class, 'chama_group_id', 'id');
    }

    public function payouts()
    {
        return $this->hasMany(ChamaPayout::class, 'chama_group_id', 'id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
}
