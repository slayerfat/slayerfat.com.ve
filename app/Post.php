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
 * @property string $desc
 * @property string $body
 * @property string $publish_date
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $thumbnail_url
 * @property-read \App\User $user
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Tag[] $tags
 * @method static \Illuminate\Database\Query\Builder|\App\Post whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Post whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Post whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Post whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Post whereDesc($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Post whereBody($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Post whereThumbnailUrl($value)
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
        'desc',
        'body',
        'thumbnail_url',
        'publish_date',
    ];

    /**
     * @var array
     */
    protected $dates = ['published_at'];

    /**
     * @var array
     */
    protected $sluggable = [
        'build_from' => 'title',
        'save_to'    => 'slug',
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
