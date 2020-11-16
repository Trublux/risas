<?php
/**
 * (c) Israel Martín García <israel.martin.g@gmail.com>
 * See LICENSE.txt for license details.
 */

namespace App\Commands;

use App\Application\TweetsImporter;
use LaravelZero\Framework\Commands\Command;

class ImportarVideos extends Command
{
    /**
     * @var TweetsImporter
     */
    private $tweetsImporter;

    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'importar:videos';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Importa vídeos de Twitter a Telegram';

    public function __construct(TweetsImporter $tweetsImporter)
    {
        $this->tweetsImporter = $tweetsImporter;

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        $this->tweetsImporter->handle();
        $this->info('Fin del script');
    }
}
