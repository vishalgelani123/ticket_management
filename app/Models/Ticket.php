<?php

namespace App\Models;

use App\Traits\ModelActionTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory, ModelActionTrait;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'description',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function getActionButtonsAttribute()
    {

        return '<ul class="d-flex" style="list-style-type: none;">'
//            . $this->editModel(route("tickets.edit", $this))
            . $this->deleteModel(route("tickets.delete", $this), csrf_token(), "tickets-table")
            . '</ul>';
    }
}
