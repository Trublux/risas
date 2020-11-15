<?php
/**
 * (c) Israel Martín García <israel.martin.g@gmail.com>
 * See LICENSE.txt for license details.
 */

namespace App\Infrastructure;

use App\Domain\Tweet;
use App\Models\Tweet as TweetModel;

class TweetRepository
{
    public function save(Tweet $tweet): void
    {
        $tweetId = $tweet->getParentId();

        TweetModel::create([
            'tweet_id' => $tweetId,
        ]);
    }

    public function isNewTweet(Tweet $tweet): bool
    {
        $tweetId = $tweet->getParentId();

        $existe = TweetModel::where('tweet_id', $tweetId)->first();

        if (null === $existe) {
            return true;
        }

        return false;
    }
}
