<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Post
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $body
 * @property \Illuminate\Support\Carbon $published_at
 * @property string $excerpt
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Post newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Post newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Post query()
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereExcerpt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post wherePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $category_id
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereCategoryId($value)
 * @property-read \App\Models\Category $category
 * @property int $user_id
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUserId($value)
 * @method static \Database\Factories\PostFactory factory(...$parameters)
 * @property-read \App\Models\User $author
 * @method static \Illuminate\Database\Eloquent\Builder|Post filter()
 */
class Post extends Model
{

    protected $dates = [
        'published_at'
    ];

    /*protected $fillable = [
        'title',
        'body',
        'slug',
        'excerpt',
        'published_at',
        'category_id'
    ];*/
    //protected $guarded = [];

    public function category()
    {
        // retourne une relation de type BelongsTo sur l'instance de la classe Category
        return $this->belongsTo(Category::class);
    }

    public function author() //user
    {
        return $this->belongsTo(User::class, 'user_id'); // si le nom de la fonction ≠ -> author_id => foreignKey : user_id
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, fn($query, $search) =>
            $query->where(fn($query) =>
                $query  ->where('title', 'like', '%' . $search . '%')
                        ->orWhere('excerpt', 'like', '%' . $search . '%')
                        ->orWhere('body', 'like', '%' . $search . '%'))
        );

        $query->when($filters['category'] ?? false, fn($query, $category) =>
            $query->whereHas('category', fn($query) => // posts whereHas (relation category)
                    $query->where('slug', $category)) // où le slug = category que l'user a mis
        );

        $query->when($filters['author'] ?? false, fn($query, $author) =>
            $query->whereHas('author', fn($query) => // posts whereHas (relation category)
                $query->where('username', $author)) // où le slug = category que l'user a mis
        );

    }

    use HasFactory;
}
