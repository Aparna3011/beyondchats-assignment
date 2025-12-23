<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Symfony\Component\DomCrawler\Crawler;
use App\Models\Article;
use Illuminate\Support\Str;


class ScrapeBeyondChatsBlogs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:scrape-beyond-chats-blogs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
  public function handle()
{
    $this->info('Starting BeyondChats blog scraping...');

    $blogUrls = [
         'https://beyondchats.com/blogs/chatbots-for-small-business-growth/',
         'https://beyondchats.com/blogs/lead-generation-chatbots/',
         'https://beyondchats.com/blogs/virtual-assistant/',
         'https://beyondchats.com/blogs/live-chatbot/',
         'https://beyondchats.com/blogs/introduction-to-chatbots/',
        // add 4 more URLs from page 15
    ];

    foreach ($blogUrls as $url) {
        $this->info("Scraping: {$url}");

        $response = Http::timeout(60)
    ->withHeaders([
        'User-Agent' => 'Mozilla/5.0 (compatible; BeyondChatsBot/1.0)',
    ])
    ->get($url);


        if (!$response->successful()) {
            $this->error("Failed to fetch {$url}");
            continue;
        }

        $crawler = new Crawler($response->body());

        // ✅ FINAL TITLE SELECTOR
        $title = trim(
            $crawler->filter('.elementor-heading-title')->first()->text()
        );

        // ✅ FINAL CONTENT SELECTOR
        $contentHtml = $crawler
            ->filter('.elementor-widget-theme-post-content')
            ->first()
            ->html();

        Article::updateOrCreate(
            [
                'slug' => Str::slug($title),
                'version' => 'original',
            ],
            [
                'title' => $title,
                'content' => $contentHtml,
                'source_url' => $url,
                'published_at' => now(),
            ]
        );

        $this->info("Saved: {$title}");
    }

    $this->info('Scraping process completed.');
}

}
