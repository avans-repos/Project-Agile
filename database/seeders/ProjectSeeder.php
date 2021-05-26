<?php

namespace Database\Seeders;

use App\Models\Project;
use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    project::create([
      'name' => 'Interview met Vizova',
      'description' => 'Leg een interview af met Vizova en verwerk deze in een verslag.',
      'deadline' =>     Carbon::now()->addWeeks(random_int(3,12)),
      'notes' => 'De rubric staat op BlackBoard.',
    ]);

    project::create([
      'name' => 'Maak een plan van aanpak voor een bedrijf.',
      'description' => 'Plan van aanpak maken voor bedrijf X. Dit moet in tweetallen.',
      'deadline' =>     Carbon::now()->addWeeks(random_int(3,12)),
      'notes' => 'Tweetallen staan vast.',
    ]);

    project::create([
      'name' => 'Op bezoek bij ASML.',
      'description' => 'Flow chart diagram opstellen van het ontwikkelproces.',
      'deadline' =>     Carbon::now()->addWeeks(random_int(3,12)),
      'notes' => 'Geen foto\'s maken.',
    ]);

    project::create([
      'name' => 'Interview bij een datacentrum.',
      'description' => 'Een verslag maken voor een mogelijke uitbreiding van het centrum.',
      'deadline' =>     Carbon::now()->addWeeks(random_int(3,12)),
    ]);

    project::create([
      'name' => 'Kijkje nemen bij een automatisering.',
      'description' => 'Stel de user stories op en de acceptatiecriteria',
      'deadline' =>     Carbon::now()->addWeeks(random_int(3,12)),
    ]);

    project::create([
      'name' => 'Demo van een simpel netwerk aanleggen.',
      'description' => 'Zelf ook aan de slag met apparatuur.',
      'deadline' =>     Carbon::now()->addWeeks(random_int(3,12)),
    ]);

    project::create([
      'name' => 'Op bezoek bij Kieboom Mijnbouw BV©.',
      'description' => 'Risico\'s opstellen die het bedrijf mogelijk tegen kan komen.',
      'deadline' =>     Carbon::now()->addWeeks(random_int(3,12)),
      'notes' => 'Geen foto\s maken.',
    ]);

    project::create([
      'name' => 'Op bezoek bij een stagair.',
      'description' => 'Geef een interview.',
      'deadline' =>     Carbon::now()->addWeeks(random_int(3,12)),
    ]);

    project::create([
      'name' => 'Throwback naar de 2000\'s.',
      'description' => 'Kijk mee hoe programmeren is veranderd door de jaren heen',
      'deadline' =>     Carbon::now()->addWeeks(random_int(3,12)),
    ]);

    project::create([
      'name' => 'Game Design Studio tour.',
      'description' => 'Verslag maken van hoe een idee wordt gerealiseerd.',
      'deadline' =>     Carbon::now()->addWeeks(random_int(3,12)),
    ]);

    project::create([
      'name' => 'Hacken bij de Politie.',
      'description' => 'Hoe bewaakt de politie ons online? Houdt een interview.',
      'deadline' =>     Carbon::now()->addWeeks(random_int(3,12)),
    ]);

    project::create([
      'name' => 'Werken met Raspberry Pi\'s.',
      'description' => 'Schrijf een simpele protocol die met een andere Raspberri Pi kan communiceren.',
      'deadline' =>     Carbon::now()->addWeeks(random_int(3,12)),
    ]);

    project::create([
      'name' => 'Hoe kan GameStop zichzelf het best reorganiseren?.',
      'description' => 'Het verouderde bedrijf kent veel onzekerheid, hoe kunnen ze zichzelf moderniseren?.',
      'deadline' =>     Carbon::now()->addWeeks(random_int(3,12)),
      'notes' => 'In drietallen.',
    ]);

    project::create([
      'name' => 'Workshop met serverhardware.',
      'description' => 'Maak notities van de ingenieuze oplossingen om apparatuur 24/7 te draaien.',
      'deadline' => Carbon::now()->addWeeks(random_int(3,12)),
    ]);

    project::create([
      'name' => 'Front-end Dev opdracht.',
      'description' => 'Ontwikkel een UI voor een al gegeven back-end. Gebruik API\'s.',
      'deadline' => Carbon::now()->addWeeks(random_int(3,12)),
      'notes' => 'tweetallen.',
    ]);
  }
}
