<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Comment extends Model
{
    protected $fillable = [
        'parent_comment_id',
        'level',
        'user_name',
        'user_email',
        'content',
        'status'
    ];

    /**
     * @return BelongsTo
     */
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    /**
     * @return HasMany|BelongsTo|null
     */
    public function replies(): HasMany
    {
        return $this->hasMany(__CLASS__,
            'parent_comment_id')->orderBy('created_at', 'DESC');
    }

    public function getCreatedAtAttribute($date)
    {
        return Carbon::parse($date)->isoFormat('MMM Do YY');
    }
}
