<?php

namespace Modules\Chama\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Client\Entities\Client;

class ChamaMember extends Model
{
    protected $table = 'chama_members';
    protected $fillable = ['chama_group_id', 'client_id', 'payout_order', 'status'];

    public function group()
    {
        return $this->belongsTo(ChamaGroup::class, 'chama_group_id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function contributions()
    {
        return $this->hasMany(ChamaContribution::class, 'chama_member_id', 'id');
    }

    public function payouts()
    {
        return $this->hasMany(ChamaPayout::class, 'chama_member_id', 'id');
    }
}
