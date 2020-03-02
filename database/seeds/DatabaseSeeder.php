<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(NewsTableSeeder::class);
        $this->call(NewsCommentsTableSeeder::class);
    }
}


class NewsTableSeeder extends Seeder
{

    public function run()
    {
        // Uncomment the below to wipe the table clean before populating
        DB::table('news')->delete();

        $news = array(
            [
                'id' => 1,
                'slug' => 'news-1',
                'news_title' => 'AMD Reveals Threadripper 2 : Up to 32 Cores, 250W, X399 Refresh',
                'news_link' => 'https://www.anandtech.com/show/12906/amd-reveals-threadripper-2-up-to-32-cores-250w-x399-refresh',
                'news_description' => 'Try to desc',
                'num_upvotes' => 10,
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ],
            [
                'id' => 2,
                'slug' => 'news-2',
                'news_title' => "GitHub acquired by Microsoft for $7.5b",
                'news_link' => 'https://news.microsoft.com/2018/06/04/microsoft-to-acquire-github-for-7-5-billion/',
                'news_description' => 'Acquisition will empower developers, accelerate GitHub’s growth and advance Microsoft services with new audiences',
                'num_upvotes' => 3,
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ],
            [
                'id' => 3,
                'slug' => 'news-3',
                'news_title' => "Intel's 28-Core 5GHz Processor And Test System Breaks Cover",
                'news_link' => 'https://www.tomshardware.com/news/intel-28-core-processor-5ghz-motherboard,37213.html',
                'news_description' => '',
                'num_upvotes' => 5,
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ],
            [
                'id' => 4,
                'slug' => 'news-4',
                'news_title' => "ARM promises laptop-level performance in 2019",
                'news_link' => 'https://arstechnica.com/gadgets/2018/06/arm-promises-laptop-level-performance-in-2019/',
                'news_description' => '',
                'num_upvotes' => 5,
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ],

        );

        // Uncomment the below to run the seeder
        DB::table('news')->insert($news);
    }

}


class NewsCommentsTableSeeder extends Seeder
{

    public function run()
    {
        // Uncomment the below to wipe the table clean before populating
        DB::table('news_comment')->delete();

        $app = array(
            [
                'id' => 1,
                'slug' => 'comment-1',
                'news_id' => 1,
                'username' => 'AyyMD',
                'comment_text' => 'Really good',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ],
            [
                'id' => 2,
                'slug' => 'comment-2',
                'news_id' => 1,
                'username' => 'Intel Shill',
                'comment_text' => 'Intel was better @ 5GHz!',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ],
            [
                'id' => 3,
                'slug' => 'comment-3',
                'news_id' => 2,
                'user' => 'Anonymus',
                'comment_text' => 'Noooo, M$ is the worst!',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ],
            [
                'id' => 4,
                'slug' => 'comment-4',
                'news_id' => 3,
                'user' => 'Darkus Prodigy',
                'comment_text' => 'Total Ripoff, cooling was not disclosed',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ],
            [
                'id' => 5,
                'slug' => 'comment-5',
                'news_id' => 2,
                'user' => 'MS',
                'comment_text' => 'Better Microsoft than Oracle...',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ],

        );

        // Uncomment the below to run the seeder
        DB::table('news_comment')->insert($app);
    }

}
