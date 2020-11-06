<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Hobby
 *
 * @property int $id
 * @property int|null $user_id
 * @property string $name
 * @property string $beschreibung
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Tag[] $tags
 * @property-read int|null $tags_count
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Hobby newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Hobby newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Hobby query()
 * @method static \Illuminate\Database\Eloquent\Builder|Hobby whereBeschreibung($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hobby whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hobby whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hobby whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hobby whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hobby whereUserId($value)
 * @mixin \Eloquent
 */
class Hobby extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'beschreibung',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
