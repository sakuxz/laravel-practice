<?php

use Illuminate\Database\Seeder;

use App\User as UserEloquent;
use App\Post as PostEloquent;
use App\PostType as PostTypeEloquent;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $defaultPostType = ['tutu', 'yoyo', 'haha'];
        foreach ($defaultPostType as $idx => $postType) {
            echo $idx;  
            try {
                PostTypeEloquent::create([
                    'name' => $postType,
                    'id' => $idx + 1,
                ]);
            } catch (Exception $e) {
                echo 'Caught exception: ',  $e->getMessage(), "\n";
            }
        }

        $posts = factory(PostEloquent::class, 20)->create();
    }
}
