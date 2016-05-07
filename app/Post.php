<?php

namespace App;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Post
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $title
 * @property string $slug
 * @property string $summary
 * @property string $body_one
 * @property string $body_two
 * @property string $body_three
 * @property string $body_four
 * @property string $thumbnails
 * @property \Carbon\Carbon $publish_date
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\User $user
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Tag[] $tags
 * @method static \Illuminate\Database\Query\Builder|\App\Post whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Post whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Post whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Post whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Post whereSummary($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Post whereBodyOne($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Post whereBodyTwo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Post whereBodyThree($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Post whereBodyFour($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Post whereThumbnails($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Post wherePublishDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Post whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Post extends Model implements SluggableInterface
{

    use SluggableTrait;

    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'summary',
        'body_one',
        'body_two',
        'body_three',
        'body_four',
        'thumbnails',
        'publish_date',
    ];

    /**
     * @var array
     */
    protected $dates = ['publish_date'];

    /**
     * @var array
     */
    protected $sluggable = [
        'build_from' => 'title',
        'save_to'    => 'slug',
    ];

    protected $hidden = [
        'user_id',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'thumbnails' => 'array',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo|\Illuminate\Database\Query\Builder
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany|\Illuminate\Database\Query\Builder
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
