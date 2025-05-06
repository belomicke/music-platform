<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserFollowingSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::query()->pluck('id')->toArray();
        $data = [];

        foreach ($users as $follower) {
            foreach ($users as $following) {
                if ($follower === $following) {
                    continue;
                }

                $data[] = [
                    "followed_user_id" => $follower,
                    "following_user_id" => $following
                ];

                if (count($data) === 5000) {
                    DB::table('user_user')->insert($data);
                    $data = [];
                }
            }
        }

        DB::table('user_user')->insert($data);
    }
}
