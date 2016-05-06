<?php

use App\Tag;
use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{

    private $tags = [
        ['name' => 'Ingeniería'],
        ['name' => 'Informática'],
        ['name' => 'Redes'],
        ['name' => 'Desarrollo'],
        ['name' => 'Desarrollo Web'],
        ['name' => 'PHP 5'],
        ['name' => 'PHP 7'],
        ['name' => 'Starcraft 2'],
        ['name' => 'Trululus'],
        ['name' => 'Shoutcasting'],
        ['name' => 'Narraciones'],
        ['name' => 'Videos'],
        ['name' => 'Youtube'],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tag::insert($this->tags);
    }
}
