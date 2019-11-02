<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{url('/')}}">KAVA</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">KAVA</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="{{ (request()->is('cs')) ? 'active' : '' }}">
                <a href="{{url('/cs')}}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            <li class="menu-header">Menu</li>

            <!-- CUSTOMER SERVICE -->
            {{-- @foreach ($menu as $item)

            <li class="dropdown {{ (request()->is('cs/master*')) ? 'active' : '' }}">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-headset"></i>
                <span>{{$item->menu_name}}</span></a>
            <ul class="dropdown-menu">
                <li class="{{ (request()->is('cs/master/customer-list*')) ? 'active' : '' }}"><a class="nav-link"
                        href="{{url('/cs/master/customer-list')}}">{{$item->menu_detail_name}}</a>
                </li>
            </ul>
            </li>
            @endforeach --}}
    </aside>
</div>
