<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
        ]);

        Product::create([
            'title' => 'Sentenced - The Cold White Light',
            'description' => 'The Cold White Light is an album by the Finnish metal band Sentenced, released in May 2002 on Century Media. Limited copies contain the video for the song "Killing Me Killing You" from the band\'s previous album Crimson plus a free Sentenced sticker. Konevitsan kirkonkellot ("The Church Bells of Konevets") was originally recorded by Piirpauke in 1974',
            'price' => 30,
            'img' => 'thumbnails/sentenced.jpg'
        ]);

        Product::create([
            'title' => 'Amorphis - Elegy',
            'description' => 'Elegy is the third studio album by Finnish metal band Amorphis. It is their first to feature a majority of clean vocals, sung by new vocalist Pasi Koskinen. The music and lyrics are inspired by the traditional Finnish ballads and poems compiled in the Kanteletar by Elias Lönnrot in 1840.',
            'price' => 35,
            'img' => 'thumbnails/elegy.jpg'
        ]);

        Product::create([
            'title' => 'Children of Bodom - Something Wild',
            'description' => 'Something Wild is the debut full-length album by Finnish melodic death metal band Children of Bodom, released in 1997 in Finland, and in 1998 worldwide. Upon release, the album was met with universal acclaim by music critics. In 2020, it was named one of the 20 best metal albums of 1997 by Metal Hammer magazine.',
            'price' => 40,
            'img' => 'thumbnails/cob.jpg'
        ]);

        Product::create([
            'title' => 'Theatre of Tragedy - Aegis',
            'description' => 'Aégis is the third studio album by Norwegian gothic metal band Theatre of Tragedy, and the last album of their musical period defined by gothic stylings and Early Modern English lyrics.',
            'price' => 35,
            'img' => 'thumbnails/aegis.jpg'
        ]);
    }
}
