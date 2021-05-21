<?php

namespace Database\Seeders;

use App\Models\Mail_format;
use Illuminate\Database\Seeder;

class MailFormatSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    Mail_format::create([
      'name' => 'Eerste contact',
      'body' => 'Beste {voornaam} {achternaam},

Ik zou graag met u in contact komen voor onze opleiding

Groet,
Avans AD',
    ]);
  }
}
