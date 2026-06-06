<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'content',
        'post_id',
        'user_id',
        'parent_id',
        'is_approved'
    ];

    // Relation : auteur du commentaire
    public function user() {
        return $this->belongsTo(User::class);
    }

    // Relation : article concerné
    public function post() {
        return $this->belongsTo(Post::class);
    }

    // Relation : réponses à ce commentaire
    public function replies() {
        return $this->hasMany(Comment::class, 'parent_id')
                    ->where('is_approved', true)
                    ->with('user')
                    ->orderBy('created_at', 'asc');
    }

    // Relation : commentaire parent
    public function parent() {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    // Vérifie si c'est une réponse
    public function isReply(): bool {
        return $this->parent_id !== null;
    }
}