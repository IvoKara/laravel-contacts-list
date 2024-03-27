<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Laravel\Scout\Searchable;

class ContactGroup extends Model
{
    use HasFactory;
    use Searchable;

    protected $table = 'contacts_groups';

    protected $fillable = ["name"];

    public function contacts(): BelongsToMany
    {
        return $this->belongsToMany(
            Contact::class,
            'contacts_contact_groups',
            'contact_group_id',
            'contact_id'
        );
    }
}
