<nav class="navbar navbar-expand-lg bg-dark" data-bs-theme="dark">
    <div class="container">
        <a class="navbar-brand" href="/" aria-current="page">
            <img src="/imgs/logo-site.png" style="max-width: 2.75rem;">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <x-navbar.link href="/items" :active="request()->is('items')">Inventory</x-navbar.link>
                <x-navbar.link href="/beers" :active="request()->is('beers')">Beers</x-navbar.link>
                <x-navbar.link href="/breweries" :active="request()->is('breweries')">Breweries</x-navbar.link>
                <x-navbar.link href="/styles" :active="request()->is('styles')">Styles</x-navbar.link>
            </ul>
            @auth
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <form method="POST" action="/login">
                            @csrf
                            @method('delete')
                            <button class="btn btn-link nav-link">Log Out</button>
                        </form>
                    </li>
                </ul>
            @endauth
        </div>
    </div>
</nav>
