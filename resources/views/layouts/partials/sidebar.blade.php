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
            <li class="{{ (request()->is('*/local-setting')) ? 'active' : '' }}">
                <a href="{{url(request()->segment(1). '/local-setting')}}" class="nav-link"><i
                        class="fas fa-cog"></i><span>Local Setting</span></a>
            </li>
            <li class="menu-header">Menu</li>

            <li class="dropdown {{ (request()->is('*/master*')) ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-database"></i>
                    <span>Master Data</span></a>
                <ul class="dropdown-menu">
                    @foreach ($menu_master as $item)
                    <li class="{{ (request()->is($item->menu_detail_url.'*')) ? 'active' : '' }}">
                        <a class="nav-link" href="{{url($item->menu_detail_url)}}">{{$item->menu_detail_name}}</a>
                    </li>
                    @endforeach
                </ul>
            </li>

            <li class="dropdown {{ (request()->is('*/transaction*')) ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-exchange-alt"></i>
                    <span>Transaction</span></a>
                <ul class="dropdown-menu">
                    @foreach ($menu_transaction as $item)
                    <li class="{{ (request()->is($item->menu_detail_url)) ? 'active' : '' }}">
                        <a class="nav-link" href="{{url($item->menu_detail_url)}}">{{$item->menu_detail_name}}</a>
                    </li>
                    @endforeach
                </ul>
            </li>

            <li class="dropdown {{ (request()->is('*/report*')) ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-clipboard"></i>
                    <span>Report</span></a>
                <ul class="dropdown-menu">
                    @foreach ($menu_report as $item)
                    <li class="{{ (request()->is($item->menu_detail_url)) ? 'active' : '' }}">
                        <a class="nav-link" href="{{url($item->menu_detail_url)}}">{{$item->menu_detail_name}}</a>
                    </li>
                    @endforeach
                </ul>
            </li>
    </aside>
</div>
