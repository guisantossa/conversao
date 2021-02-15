<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coin extends Model
{
    use HasFactory;
    protected $guarded = ["user_id", "moeda_original", "moeda_convertida", "valor_original", "valor_convertido"];
    protected $fillable = ["id", "created_at", "updated_at"];
}
