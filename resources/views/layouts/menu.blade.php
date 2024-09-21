<ul class="navbar-nav">

    {{-- Admin/super admin | admin Menu --}}
    @hasanyrole('super admin|admin')
    <li class="nav-item">
        <a href="{{ route('users.index') }}"
           class="nav-link {{ Request::is('users*') ? 'active' : '' }}">
           <i class="fa fa-user p-1 text-lg" aria-hidden="true"></i>
           <p>المستخدمين</p>
        </a>
    </li>

   
   
    <li class="nav-item">
        <a href="{{ route('categories.index') }}"
           class="nav-link {{ Request::is('categories*') ? 'active' : '' }}">
           <i class="fa fa-folder p-1 text-lg" aria-hidden="true"></i>
           <p>التخصصات</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('cards.index') }}"
           class="nav-link {{ Request::is('cards') ? 'active' : '' }}">
           <i class="fa fa-check-circle p-1 text-lg" aria-hidden="true"></i>
           <p>البطاقات الفعالة</p>
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
            <i class="fa fa-book p-1 text-lg" aria-hidden="true"></i>
            <p>المواد الدراسية</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('examSchedules.index') }}"
           class="nav-link {{ Request::is('examSchedules*') ? 'active' : '' }}">
            <i class="fa fa-calendar p-1 text-lg" aria-hidden="true"></i>
            <p>جداول الامتحانات</p>
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ route('admin.scanQr') }}"
           class="nav-link {{ Request::is('admin/scan-qr*') ? 'active' : '' }}">
           <i class="fa fa-qrcode p-1 text-lg" aria-hidden="true"></i>
           <p>   كود QR   مسح</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('notifications.index') }}" 
           class="nav-link {{ Request::is('notifications*') ? 'active' : '' }}">
           <i class="fa fa-bell p-1 text-lg"></i>
           <p class="ml-1">الإشعارات</p>
        </a>
    </li>  
    @endhasanyrole

    {{-- Student Menu --}}
    @role('student')
    <li class="nav-item">
        <a href="{{ route('my.card') }}"
           class="nav-link {{ Request::is('my-card*') ? 'active' : '' }}">
           <i class="fa fa-id-card p-1 text-lg" aria-hidden="true"></i>
           <p>بطاقتي</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('my.subjects') }}"
           class="nav-link {{ Request::is('my-subjects*') ? 'active' : '' }}">
           <i class="fa fa-book p-1 text-lg" aria-hidden="true"></i>
           <p>موادي</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('my.examSchedule') }}"
           class="nav-link {{ Request::is('my-exam-schedule*') ? 'active' : '' }}">
           <i class="fa fa-calendar-check p-1 text-lg" aria-hidden="true"></i>
           <p>جدول امتحاناتي النهائي</p>
        </a>
    </li>
    <li class="nav-item">
    <a href="{{ route('users.show', auth()->user()->id) }}" class="nav-link">
            <i class="fa fa-user-circle p-1 text-lg"></i>
            <p>حسابي</p>
        </a>
    </li>

    @endrole
</ul>

