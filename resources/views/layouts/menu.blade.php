
<li class="nav-item">
    <a href="{{ route('cards.index') }}"
       class="nav-link {{ (Request::is('cards') )? 'active' : '' }}">
        <p>Cards</p>
    </a>
</li>

@role('admin|system admin')
<li class="nav-item">
    <a href="{{ route('users.index') }}"
       class="nav-link {{ Request::is('users*') ? 'active' : '' }}">
        <p>Users</p>
    </a>
</li>
@endrole

<li class="nav-item">
    <a href="{{ route('categories.index') }}"
       class="nav-link {{ Request::is('categories*') ? 'active' : '' }}">
        <p>Categories</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('cards.requests') }}"
       class="nav-link {{ Request::is('requests') ? 'active' : '' }}">
        <p>Requests</p>
    </a>
</li>


