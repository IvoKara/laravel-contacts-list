<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Contact extends Model
{
    use HasFactory;

    protected $table = 'contacts';

    protected $fillable = [
        "name",
        "nickname",
        "email",
        "phone",
        "group_id"
    ];

    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(
            ContactGroup::class,
            'contacts_contact_groups',
            'contact_id',
            'contact_group_id'
        );
    }
}
