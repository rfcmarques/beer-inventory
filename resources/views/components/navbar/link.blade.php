@props(['active' => false])

<li class="nav-item">
    <a class="nav-link {{ $active ? 'active' : '' }}" {{ $attributes }}>{{ $slot }}</a>
</li>
