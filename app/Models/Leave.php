<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Leave extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'enhancer',
        'date',
        'end_date',
        'status',
        'reason',
        'reason_verification',
        'about',
    ];

    // Relasi ke model User
    public function user()
    {
        return $this->belongsTo(User::class, 'enhancer');
    }

    // // Relasi ke tabel categories
    // public function category()
    // {
    //     return $this->belongsTo(Category::class, 'category_id');
    // }

    // // Relasi ke tabel subcategories
    // public function subcategory()
    // {
    //     return $this->belongsTo(Subcategory::class, 'subcategory_id');
    // }
}
