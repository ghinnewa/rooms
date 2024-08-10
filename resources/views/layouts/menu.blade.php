

@role('admin|system admin')
<li class="nav-item">
    <a href="{{ route('users.index') }}"
       class="nav-link {{ Request::is('users*') ? 'active' : '' }}">
       <i class="fa fa-user p-1 text-lg" aria-hidden="true"></i>

       <p>المستخدمين</p>
    </a>
</li>
@endrole

<li class="nav-item">
    <a href="{{ route('categories.index') }}"
       class="nav-link {{ Request::is('categories*') ? 'active' : '' }}">
       <i class="fa fa-folder p-1 text-lg" aria-hidden="true"></i>
       <p>التخصصات</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('cards.index') }}"
       class="nav-link {{ (Request::is('cards') )? 'active' : '' }}">
       <i class="fa fa-check-circle p-1 text-lg" aria-hidden="true"></i>
       <p> البطاقات الفعالة</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('cards.requests') }}"
       class="nav-link {{ Request::is('requests') ? 'active' : '' }}">
       <i class="fa fa-bell p-1 text-lg" aria-hidden="true"></i>
 <p>طلبات البطاقات</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('cards.exp') }}"
       class="nav-link {{ Request::is('exp') ? 'active' : '' }}">
       <i class="fa fa-clock-o p-1 text-lg" aria-hidden="true"></i>
 <p>بطاقات منتهية الصلاحية</p>
    </a>
</li>



<li class="nav-item">
    <a href="{{ route('subjects.index') }}"
       class="nav-link {{ Request::is('subjects*') ? 'active' : '' }}">
        <p>@lang('models/subjects.plural')</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('examSchedules.index') }}"
       class="nav-link {{ Request::is('examSchedules*') ? 'active' : '' }}">
        <p>@lang('models/examSchedules.plural')</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('examScheduleItems.index') }}"
       class="nav-link {{ Request::is('examScheduleItems*') ? 'active' : '' }}">
        <p>@lang('models/examScheduleItems.plural')</p>
    </a>
</li>

