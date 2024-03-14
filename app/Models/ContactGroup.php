<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ContactGroup extends Model
{
    use HasFactory;

    protected $table = 'contacts_groups';
    protected $fillable = [
        "name"
    ];

    public function contacts(): HasMany
    {
        return $this->hasMany(Contact::class, 'group_id');
    }
}
