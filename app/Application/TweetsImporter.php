<?php
/**
 * (c) Israel Martín García <israel.martin.g@gmail.com>
 * See LICENSE.txt for license details.
 */

namespace App\Application;

use App\Infrastructure\TwitterRepository;

class TweetsImporter
{
    private const FILTERED_HASTAG = 'jajaja';

    /**
     * @var TwitterRepository
     */
    private $tweeterRepository;

    /**
     * @var TelegramVideoCreate
     */
    private $telegramVideoCreate;

    public function __construct(
        TwitterRepository $tweeterRepository,
        TelegramVideoCreate $telegramVideoCreate
    ) {
        $this->tweeterRepository = $tweeterRepository;
        $this->telegramVideoCreate = $telegramVideoCreate;
    }

    public function handle(): void
    {
        $tweets = $this->tweeterRepository->getFilteredByHastagList(self::FILTERED_HASTAG);
        foreach ($tweets as $tweet) {
            ($this->telegramVideoCreate)($tweet);
        }
    }
}
