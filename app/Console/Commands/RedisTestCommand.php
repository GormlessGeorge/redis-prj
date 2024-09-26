<?php

namespace App\Console\Commands;

use App\Models\Post;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class RedisTestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'redis:go';

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
        $data = [
            'title'=>'some title',
            'content' => 'some content',
            'likes'=>20
        ];
        $post = Post::create($data);
        Cache::put('posts:' . $post->id, $post);
        $post = Post::find(1);

        Redis::set('posts:'. $post->id, $post);
    }
}
