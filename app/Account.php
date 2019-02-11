<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

/**
 * App\Account
 *
 * @property int $id
 * @property int $user_id
 * @property string $avatar
 * @property string $name
 * @property string|null $address
 * @property string|null $phone
 * @property string|null $memo
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\MediaLibrary\Models\Media[] $media
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Account newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Account newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Account query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Account whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Account whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Account whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Account whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Account whereMemo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Account whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Account wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Account whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Account whereUserId($value)
 * @mixin \Eloquent
 */
class Account extends Model implements HasMedia
{
    use HasMediaTrait;
    protected $fillable=["user_id",'name','address','phone','memo'];

    public function registerMediaCollections()
    {
        $this
            ->addMediaCollection('userAvatars')
            ->singleFile();
    }

    public function user()
    {
        return $this->belongsTo('App\User')->withDefault();
    }

}
