<?php
/**
 * (c) Israel Martín García <israel.martin.g@gmail.com>
 * See LICENSE.txt for license details.
 */

namespace App\Infrastructure;

use App\Domain\TweetFactory;
use Illuminate\Support\Facades\Http;

class TwitterRepository
{
    private const TWITTER_USERNAME = 'Trublux';

    private $tweetFactory;

    public function __construct(TweetFactory $tweetFactory)
    {
        $this->tweetFactory = $tweetFactory;
    }

    public function getList(): array
    {
        $res = Http::withToken(env('TWITTER_BEARER_TOKEN'))->get('https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=' . self::TWITTER_USERNAME . '&tweet_mode=extended&limit=1');

        $tweets = $res->json();

        return $res->json();
    }

    public function getFilteredByHastagList(string $hastag): array
    {
        $tweetsList = $this->getList();
        $tweets = [];
        foreach ($tweetsList as $tweet) {
            if (!isset($tweet['quoted_status_id_str'])) {
                continue;
            }

            if (false === $this->hasHastag($tweet, $hastag)) {
                continue;
            }

            $currentTweet = $this->tweetFactory->create($tweet);
            if (null !== $currentTweet) {
                $tweets[] = $currentTweet;
            }
            $currentTweet = null;
        }

        return $tweets;
    }

    private function hasHastag(array $tweet, string $hastag): bool
    {
        if (!isset($tweet['entities']['hashtags'])) {
            return false;
        }

        $tags = $tweet['entities']['hashtags'];
        foreach ($tags as $tag) {
            if ($hastag === $tag['text']) {
                return true;
            }
        }

        return false;
    }
}
