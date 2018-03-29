<?php

use Illuminate\Database\Seeder;

class PlayerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = public_path().'/csv/players.csv';
        if (($handle = fopen($file, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $player = new \App\Player([
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                    'name' => $data[0],
                    'rating' => $data[1],
                    'position' => $data[2],
                    'cardtype' => $data[3]
                ]);
                $player->save();
            }
            fclose($handle);
        }
    }
}
