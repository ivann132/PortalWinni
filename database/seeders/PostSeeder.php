<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use App\Models\Article;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $title = [
            'Judul Pertama',
            'Judul Kedua',
            'Judul Ketiga',
            'Judul Keempat',
            'Judul Kelima',
            'Judul Keenam',
            'Judul Ketujuh',
            'Judul Kedelapan',
            'Judul Kesembilan',
            'Judul Kesepuluh',
        ];

        foreach ($title as $j) {
            $slug = Str::slug($j);
            $slugOri = $slug;
            $count = 1;
            while (Article::where('slug', $slug)->exists()) {
                $slug = $slugOri . '-' . $count;
                $count++;
            }
            Article::create([
                'title' => $j,
                'slug' => $slug,
                'description' => 'Deskripsi untuk ' . $j,
                'content' => 'konten untuk ' . $j,
                'status' => 'publish',
                'user_id' => '1',
            ]);
        }
    }
}
