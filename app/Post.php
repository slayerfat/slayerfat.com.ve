<?php

namespace App;

use Carbon\Carbon;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Date;
use Illuminate\Database\Eloquent\Builder;
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
 * @method static \Illuminate\Database\Query\Builder|\App\Post published()
 * @method static \Illuminate\Database\Query\Builder|\App\Post unpublished()
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

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
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
     * Creates various date elements for the views.
     *
     * @return \App\Post
     */
    public function withDates()
    {
        // we need to parse the date.
        $date = Date::parse($this->publish_date);

        $this->attributes['dates']              = [];
        $this->attributes['dates']['formatted'] = $date->diffForHumans();
        $this->attributes['dates']['formal']    = 'Caracas, ' . $date->format('l j F \d\e Y');

        return $this;
    }

    /**
     * Forces Capitalization of title first letter.
     *
     * @param string $value
     * @return string
     */
    public function setTitleAttribute($value)
    {
        return $this->attributes['title'] = ucfirst($value);
    }

    /**
     * @param string $value
     * @return string
     */
    public function setSummaryAttribute($value)
    {
        return $this->attributes['summary'] = $this->addPeriodAndCapitalize($value);
    }

    /**
     * Check if last char is dot and returns it with first letter capitalized.
     *
     * @param string $value
     * @return string
     */
    private function addPeriodAndCapitalize($value)
    {
        if (substr($value, -1) !== '.') {
            $value .= '.';
        }

        return ucfirst($value);
    }

    /**
     * @param string $value
     * @return string
     */
    public function setBodyOneAttribute($value)
    {
        return $this->attributes['body_one'] = $this->addPeriodAndCapitalize($value);
    }

    /**
     * @param string $value
     * @return string
     */
    public function setBodyTwoAttribute($value)
    {
        return $this->attributes['body_two'] = $this->addPeriodAndCapitalize($value);
    }

    /**
     * @param string $value
     * @return string
     */
    public function setBodyThreeAttribute($value)
    {
        return $this->attributes['body_three'] = $this->addPeriodAndCapitalize($value);
    }

    /**
     * @param string $value
     * @return string
     */
    public function setBodyFourAttribute($value)
    {
        return $this->attributes['body_four'] = $this->addPeriodAndCapitalize($value);
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return $this
     */
    public function scopePublished(Builder $query)
    {
        return $query->where('publish_date', '<=', Carbon::now());
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return $this
     */
    public function scopeUnpublished(Builder $query)
    {
        return $query->where('publish_date', '>=', Carbon::now());
    }

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
