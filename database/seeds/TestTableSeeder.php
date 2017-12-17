<?php

use Illuminate\Database\Seeder;

use App\User as UserEloquent;
use App\Post as PostEloquent;
use App\PostType as PostTypeEloquent;

class TestTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $defaultPostType = ['tutu', 'yoyo', 'haha'];
        // foreach ($defaultPostType as $idx => $postType) {
        //     echo $idx;  
        //     try {
        //         PostTypeEloquent::create([
        //             'name' => $postType,
        //             'id' => $idx + 1,
        //         ]);
        //     } catch (Exception $e) {
        //         echo 'Caught exception: ',  $e->getMessage(), "\n";
        //     }
        // }
        $postTypes = factory(PostTypeEloquent::class, 6)->create();
        $users = factory(UserEloquent::class, 20)->create()->each(function ($user) {
            // $user->posts()->save(factory(PostEloquent::class)->make());
            // collect(range(1, 3))->each(function () use ($user) {
            //     $user->posts()->save(factory(PostEloquent::class)->make());
            // });
        });
        $posts = factory(PostEloquent::class, 20)->create()->each(function ($post) use ($postTypes, $users) {
            $post->user_id = $users[mt_rand(0, count($users) - 1)]->id;
            $post->type = $postTypes[mt_rand(0, count($postTypes) - 1)]->id;
            $post->save();
        });
    }
}
