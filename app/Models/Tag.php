<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Tag
 *
 * @property int $id
 * @property string $name
 * @property string $style
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Hobby[] $filteredHobbies
 * @property-read int|null $filtered_hobbies_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Hobby[] $hobbies
 * @property-read int|null $hobbies_count
 * @method static \Illuminate\Database\Eloquent\Builder|Tag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tag query()
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereStyle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Tag extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'style'
    ];

    public function hobbies()
    {
        return $this->belongsToMany(Hobby::class);
    }

    public function filteredHobbies()
    {
        return $this->belongsToMany(Hobby::class)
                    ->wherePivot('tag_id', $this->id)
                    ->orderBy('updated_at', 'DESC');
    }
}
