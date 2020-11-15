<?php
/**
 * (c) Israel Martín García <israel.martin.g@gmail.com>
 * See LICENSE.txt for license details.
 */

namespace App\Infrastructure;

use App\Domain\Tweet;
use Illuminate\Support\Facades\Http;

class TelegramVideoRepository
{
    public function save(Tweet $tweet): void
    {
        /*
        $botMesssage = sprintf('https://api.telegram.org/bot%s/sendMessage?chat_id=%s&text=%s',
            $botToken,
            $channelName,
            $message
        );
        */

        $botEndPoint = 'https://api.telegram.org/bot%s/sendVideo';

        $caption = <<<EOF
😂🤣
EOF;
        $data = [
            'chat_id' => env('TELEGRAM_CHANNEL_NAME'),
            'video' => $tweet->getMedia(),
            'caption' => $caption,
            'parse_mode' => 'MarkdownV2',
        ];

        echo 'Se va a importar el vídeo: ' . $tweet->getMedia() . PHP_EOL;

        $botMesssage = \sprintf($botEndPoint, env('TELEGRAM_BOT_TOKEN'));

        $botMesssage .= '?' . \http_build_query($data);

        echo 'Enviar: ' . $botMesssage . PHP_EOL;

        $res = Http::get($botMesssage);
        //$res = Http::timeout(2)->get($botMesssage);
    }
}
