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

    Mail_format::create([
      'name' => 'Bedankt voor alles',
      'body' => 'Hallo {voornaam} {achternaam},

Namens mijn team zijn we allemaal verdrietig om u te zien vertrekken. We zijn blij dat we al die tijd met u hebben samengewerkt.

Ik hoop dat we in contact blijven en in de toekomst weer samenwerken. Aarzel niet om feedback en suggesties te geven om ons te helpen verbeteren, zelfs van veraf.

Veel succes!

Avans AD',
    ]);
    Mail_format::create([
      'name' => 'Vervolg afspraak',
      'body' => 'Hallo {voornaam} {achternaam},

Ik hoop dat het goed met je gaat. Ik wilde met je een vervolgafspraak maken om te praten over het project waar wij het vandaag over gehad hebben ({datum}). Wanneer kunnen we even bellen?.

Een fijne dag verder,

Avans AD',
    ]);
  }
}
