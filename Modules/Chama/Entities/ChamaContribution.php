<?php

namespace Modules\Chama\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\User\Entities\User;

class ChamaContribution extends Model
{
    protected $table = 'chama_contributions';
    protected $fillable = ['chama_group_id', 'chama_member_id', 'amount', 'date', 'notes', 'created_by_id'];

    public function group()
    {
        return $this->belongsTo(ChamaGroup::class, 'chama_group_id');
    }

    public function member()
    {
        return $this->belongsTo(ChamaMember::class, 'chama_member_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
}
