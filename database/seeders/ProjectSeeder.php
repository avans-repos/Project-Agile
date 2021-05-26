<?php

namespace Database\Seeders;

use App\Models\Project;
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
      'deadline' => new DateTime('10/10/2021'),
      'notes' => 'De rubric staat op BlackBoard.',
    ]);

    project::create([
      'name' => 'Maak een plan van aanpak voor een bedrijf.',
      'description' => 'Plan van aanpak maken voor bedrijf X. Dit moet in tweetallen.',
      'deadline' => new DateTime('10/10/2021'),
      'notes' => 'Tweetallen staan vast.',
    ]);

    project::create([
      'name' => 'Op bezoek bij ASML.',
      'description' => 'Flow chart diagram opstellen van het ontwikkelproces.',
      'deadline' => new DateTime('10/12/2021'),
      'notes' => 'Geen foto\'s maken.',
    ]);

    project::create([
      'name' => 'Interview bij een datacentrum.',
      'description' => 'Een verslag maken voor een mogelijke uitbreiding van het centrum.',
      'deadline' => new DateTime('12/03/2022'),
    ]);

    project::create([
      'name' => 'Kijkje nemen bij een automatisering.',
      'description' => 'Stel de user stories op en de acceptatiecriteria',
      'deadline' => new DateTime('10/7/2021'),
    ]);

    project::create([
      'name' => 'Demo van een simpel netwerk aanleggen.',
      'description' => 'Zelf ook aan de slag met apparatuur.',
      'deadline' => new DateTime('10/11/2021'),
    ]);

    project::create([
      'name' => 'Op bezoek bij Kieboom Mijnbouw BV©.',
      'description' => 'Risico\'s opstellen die het bedrijf mogelijk tegen kan komen.',
      'deadline' => new DateTime('10/27/2021'),
      'notes' => 'Geen foto\s maken.',
    ]);

    project::create([
      'name' => 'Op bezoek bij een stagair.',
      'description' => 'Geef een interview.',
      'deadline' => new DateTime('03/12/2021'),
    ]);

    project::create([
      'name' => 'Throwback naar de 2000\'s.',
      'description' => 'Kijk mee hoe programmeren is veranderd door de jaren heen',
      'deadline' => new DateTime('05/13/2022'),
    ]);

    project::create([
      'name' => 'Game Design Studio tour.',
      'description' => 'Verslag maken van hoe een idee wordt gerealiseerd.',
      'deadline' => new DateTime('06/30/2021'),
    ]);

    project::create([
      'name' => 'Hacken bij de Politie.',
      'description' => 'Hoe bewaakt de politie ons online? Houdt een interview.',
      'deadline' => new DateTime('10/10/2021'),
    ]);

    project::create([
      'name' => 'Werken met Raspberry Pi\'s.',
      'description' => 'Schrijf een simpele protocol die met een andere Raspberri Pi kan communiceren.',
      'deadline' => new DateTime('10/10/2021'),
    ]);

    project::create([
      'name' => 'Hoe kan GameStop zichzelf het best reorganiseren?.',
      'description' => 'Het verouderde bedrijf kent veel onzekerheid, hoe kunnen ze zichzelf moderniseren?.',
      'deadline' => new DateTime('10/10/2021'),
      'notes' => 'In drietallen.',
    ]);

    project::create([
      'name' => 'Workshop met serverhardware.',
      'description' => 'Maak notities van de ingenieuze oplossingen om apparatuur 24/7 te draaien.',
      'deadline' => new DateTime('04/26/2022'),
    ]);

    project::create([
      'name' => 'Front-end Dev opdracht.',
      'description' => 'Ontwikkel een UI voor een al gegeven back-end. Gebruik API\'s.',
      'deadline' => new DateTime('11/20/2022'),
      'notes' => 'tweetallen.',
    ]);
  }
}
