<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property string $text
 * @property array<array-key, mixed>|null $analysis
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Node newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Node newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Node query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Node whereAnalysis($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Node whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Node whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Node whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Node whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Node whereUserId($value)
 * @mixin \Eloquent
 */
class Node extends Model
{
  use HasFactory;

  protected $fillable = [
    'user_id',
    'text',
    'analysis',
  ];

  protected $casts = [
    'analysis' => 'array',
  ];

  public function user()
  {
    return $this->belongsTo(User::class);
  }
}
