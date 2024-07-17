<?php

namespace App\Models;

use App\Classes\Reps\SocialsLinksRepository;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    use HasFactory;
    protected $guarded = [];

    public const CHUNK_LIMIT = 50;
}
