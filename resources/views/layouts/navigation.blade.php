<div class="avans-menu" id="avans-menu">
    <a class="avans-menu-logo-container" href="{{ route('dashboard') }}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Druk hier om naar de home pagina te gaan"><img src="{{ URL::to('/') }}/img/logo.png" class="avans-menu-logo"/></a>

    <ul>
        <a href="{{ route('actionpoints.index') }}"><li>Actiepunten Beheren</li></a>
        <a href="{{ route('contact.index') }}"><li>Contacten</li></a>
        <a href="{{ route('company.index') }}"><li>Bedrijven</li></a>
        <a href="{{ route('projectgroup.index') }}"><li>Projectgroepen</li></a>
        <a href="{{ route('project.index') }}"><li>Projecten</li></a>
        <a href="{{ route('classroom.index') }}"><li>Klassen</li></a>
        <a href="#" id="avans-mail-dropdown-button">
          <li class="avans-flex-center">
            Mailen 
            <svg class="fill-current h-4 w-4 avans-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
          </li>
        </a>
        @role('Admin')
          <a href="{{ route('user.index') }}">
            <li>Gebruikers</li>
          </a>
        @endrole
    </ul>

    <a class="avans-menu-user avans-flex-center" id="avans-user-dropdown-button" href="#">
      {{ Auth::user()->name }}
      <svg class="fill-current h-4 w-4 avans-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
      </svg>
    </a>

    <div id="avans-mail-dropdown" class="avans-mail-dropdown">
        <a href="{{ route('mailformat.index') }}">Mail Templates</a>
        <a href="{{ route('mailformat.mailSetup') }}">Mail Versturen</a>
    </div>

    <div id="avans-user-dropdown" class="avans-mail-dropdown">
      <a href="#" onclick="event.preventDefault(); document.getElementById('avans-logout-form').submit();">Uitloggen</a>
      <form method="POST" id="avans-logout-form" action="{{ route('logout') }}">
        @csrf
      </form>
    </div>
</div>

<div style="width: 100vw; height: 140px;"></div>
