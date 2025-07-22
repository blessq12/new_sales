<?php

namespace App\Console\Commands;

use App\Models\Article;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class PublishScheduledArticles extends Command
{
    protected $signature = 'articles:publish-scheduled';
    protected $description = 'Публикует запланированные статьи';

    public function handle()
    {
        $articles = Article::where('is_scheduled', true)
            ->where('scheduled_at', '<=', Carbon::now())
            ->where('published', false)
            ->get();

        if ($articles->isEmpty()) {
            $this->info('Нет статей для публикации');
            return;
        }

        foreach ($articles as $article) {
            $article->update([
                'published' => true,
                'is_active' => true,
                'published_at' => now()->setTimezone('Asia/Tomsk'),
            ]);
            $article->save();
            $this->info("Опубликована статья: {$article->title}");
            Log::info("Опубликована запланированная статья: {$article->title}");
        }
    }
}
