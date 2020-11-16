<?php
/**
 * (c) Israel Martín García <israel.martin.g@gmail.com>
 * See LICENSE.txt for license details.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * @method static void create(array $data)
 * @method static Collection|null where(string $field, string $value)
 */
class Tweet extends Model
{
    protected $table = 'tweets';

    protected $fillable = ['tweet_id'];

    /**
     * @var string
     */
    protected $tweetId;
}
