<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate sitemap and save it in a file in the public folder';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        SitemapGenerator::create(config('app.crawler_url'))
            ->hasCrawled(function (Url $url) {
                switch ($url->segment(1)) {
                    case 'courses':
                        $url->setPriority(0.9);
                        return $url;
                        break;
                    case 'code.co.ua':
                        $url->setPriority(0.9);
                        return $url;
                        break;
                    case 'lessons':
                        $url->setPriority(0.8);
                        return $url;
                        break;
                    case 'questions':
                        $url->setPriority(0.7);
                        return $url;
                        break;
                    case 'exercises':
                        $url->setPriority(0.7);
                        return $url;
                        break;
                    case 'articles':
                        $url->setPriority(0.6);
                        return $url;
                        break;
                    case 'users':
                        $url->setPriority(0.5);
                        return $url;
                        break;
                    case 'complete':
                        return;
                        break;
                    case 'profile':
                        return;
                        break;
                    case 'media':
                        return;
                        break;
                    case 'admin':
                        return;
                        break;
                }

                $url->setPriority(0.5);
                return $url;
            })
            ->writeToFile(public_path('sitemap.xml'));
    }
}
