<?php
/**
 * (c) Israel Martín García <israel.martin.g@gmail.com>
 * See LICENSE.txt for license details.
 */

namespace App\Application;

use App\Domain\Tweet;
use App\Infrastructure\TelegramVideoRepository;
use App\Infrastructure\TweetRepository;

class TelegramVideoCreate
{
    private $telegramVideoRepository;

    private $tweetRepository;

    public function __construct(
        TelegramVideoRepository $telegramVideoRepository,
        TweetRepository $tweetRepository
    ) {
        $this->telegramVideoRepository = $telegramVideoRepository;
        $this->tweetRepository = $tweetRepository;
    }

    public function __invoke(Tweet $tweet): void
    {
        if (false === $this->mustByProcessed($tweet)) {
            return;
        }

        /*
         * @TODO: Comprobar que Telegram a recibido el vídeo antes de guardarlo como enviado
         */
        $this->tweetRepository->save($tweet);
        $this->telegramVideoRepository->save($tweet);
    }

    private function mustByProcessed(Tweet $tweet): bool
    {
        /*
         * @TODO: Los datos pueden pedirse ya filtrados
         */
        if (!$this->tweetRepository->isNewTweet($tweet)) {
            return false;
        }

        if (Tweet::MEDIA_TYPE_VIDEO !== $tweet->getMediaType()) {
            return false;
        }

        return true;
    }
}
