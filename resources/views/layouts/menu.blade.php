

@role('admin|system admin')
<li class="nav-item">
    <a href="{{ route('users.index') }}"
       class="nav-link {{ Request::is('users*') ? 'active' : '' }}">
       <i class="fa fa-user p-1 text-lg" aria-hidden="true"></i>

       <p>Users</p>
    </a>
</li>
@endrole

<li class="nav-item">
    <a href="{{ route('categories.index') }}"
       class="nav-link {{ Request::is('categories*') ? 'active' : '' }}">
       <i class="fa fa-folder p-1 text-lg" aria-hidden="true"></i>
       <p>Categories</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('cards.requests') }}"
       class="nav-link {{ Request::is('requests') ? 'active' : '' }}">
       <i class="fa fa-bell p-1 text-lg" aria-hidden="true"></i>
 <p>Requests</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('cards.exp') }}"
       class="nav-link {{ Request::is('exp') ? 'active' : '' }}">
       <i class="fa fa-clock-o p-1 text-lg" aria-hidden="true"></i>
 <p> Expired members</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('cards.index') }}"
       class="nav-link {{ (Request::is('cards') )? 'active' : '' }}">
       <i class="fa fa-check-circle p-1 text-lg" aria-hidden="true"></i>
       <p> Active Members</p>
    </a>
</li>

