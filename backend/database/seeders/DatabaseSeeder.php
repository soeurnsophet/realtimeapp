<?php

namespace Database\Seeders;

use App\Models\ChatMessage;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // $users = [
        //     [
        //         'name' => 'Test User 1',
        //         'email' => 'test1@example.com',
        //     ],
        //     [
        //         'name' => 'Test User 2',
        //         'email' => 'test2@example.com',
        //     ],
        //     [
        //         'name' => 'Test User 3',
        //         'email' => 'test3@example.com',
        //     ],
        //     [
        //         'name' => 'Test User 4',
        //         'email' => 'test4@example.com',
        //     ],
        //     [
        //         'name' => 'Test User 5',
        //         'email' => 'test5@example.com',
        //     ],
        //     [
        //         'name' => 'Test User 6',
        //         'email' => 'test6@example.com',
        //     ],
        //     [
        //         'name' => 'Test User 7',
        //         'email' => 'test7@example.com',
        //     ],
        //     [
        //         'name' => 'Test User 8',
        //         'email' => 'test8@example.com',
        //     ],
        //     [
        //         'name' => 'Test User 9',
        //         'email' => 'test9@example.com',
        //     ],
        //     [
        //         'name' => 'Test User 10',
        //         'email' => 'test10@example.com',
        //     ],
        // ];

        // foreach ($users as $user) {
        //     User::factory()->create($user);
        // }


        $test = User::where('email', 'test@example.com')->first();
        $test1 = User::where('email', 'test1@example.com')->first();

        ChatMessage::create([
            'sender_id' => $test->id,
            'receiver_id' => $test1->id,
            'message' => 'Hello test1 👋',
        ]);

        ChatMessage::create([
            'sender_id' => $test1->id,
            'receiver_id' => $test->id,
            'message' => 'Hello test! How are you?',
        ]);

        ChatMessage::create([
            'sender_id' => $test->id,
            'receiver_id' => $test1->id,
            'message' => 'I am good. What are you doing?',
        ]);

        ChatMessage::create([
            'sender_id' => $test1->id,
            'receiver_id' => $test->id,
            'message' => 'I am working on our chat application.',
        ]);
    }
}
