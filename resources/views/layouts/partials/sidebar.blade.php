<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{url('/')}}">KAVA</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">KAVA</a>
        </div>
        @if (request()->is('cs*'))
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="{{ (request()->is('cs')) ? 'active' : '' }}">
                <a href="{{url('/cs')}}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            <li class="menu-header">Menu</li>

            <!-- CUSTOMER SERVICE -->
            <li class="dropdown {{ (request()->is('cs/master*')) ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-headset"></i>
                    <span>Master Data</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ (request()->is('cs/master/customer-list*')) ? 'active' : '' }}"><a class="nav-link"
                            href="{{url('/cs/master/customer-list')}}">Customer</a>
                    </li>
                    <li class="{{ (request()->is('cs/master/vehicle-list*')) ? 'active' : '' }}"><a class="nav-link"
                            href="{{url('/cs/master/vehicle-list')}}">Vehicle</a>
                    </li>
                    <li class="{{ (request()->is('cs/master/service*')) ? 'active' : '' }}"><a class="nav-link"
                            href="{{url('/cs/master/service')}}">Service</a>
                    </li>
                    <li class="{{ (request()->is('cs/master/membership*')) ? 'active' : '' }}"><a class="nav-link"
                            href="{{url('/cs/master/membership')}}">Membership</a>
                    </li>
                    <li class="{{ (request()->is('cs/master/feedback*')) ? 'active' : '' }}"><a class="nav-link"
                            href="{{url('/cs/master/feedback')}}">Feedback</a>
                    </li>
                </ul>
            </li>
            <li class="dropdown {{ (request()->is('cs/transaction*')) ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-headset"></i>
                    <span>Transaction</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ (request()->is('cs/transaction/booking*')) ? 'active' : '' }}"><a class="nav-link"
                            href="{{url('/cs/transaction/booking')}}">Booking</a>
                    </li>
                    <li class="{{ (request()->is('cs/transaction/membership*')) ? 'active' : '' }}"><a class="nav-link"
                            href="{{url('/cs/transaction/membership')}}">Membership</a>
                    </li>
                    <li class="{{ (request()->is('cs/transaction/feedback*')) ? 'active' : '' }}"><a class="nav-link"
                            href="{{url('/cs/transaction/feedback')}}">Feedback</a>
                    </li>
                </ul>
            </li>
            <li class="dropdown {{ (request()->is('cs/report*')) ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-headset"></i>
                    <span>Report</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ (request()->is('cs/report/customer-report*')) ? 'active' : '' }}"><a class="nav-link"
                            href="{{url('/cs/report/customer-report')}}">Customer Report</a>
                    </li>
                    <li class="{{ (request()->is('cs/report/check-in-out*')) ? 'active' : '' }}"><a class="nav-link"
                            href="{{url('/cs/report/check-in-out')}}">Check In Out</a>
                    </li>
                    <li class="{{ (request()->is('cs/report/membership*')) ? 'active' : '' }}"><a class="nav-link"
                            href="{{url('/cs/report/membership')}}">Membership</a>
                    </li>
                    <li class="{{ (request()->is('cs/report/booking*')) ? 'active' : '' }}"><a class="nav-link"
                            href="{{url('/cs/report/booking')}}">Booking</a>
                    </li>
                    <li class="{{ (request()->is('cs/report/feedback*')) ? 'active' : '' }}"><a class="nav-link"
                            href="{{url('/cs/report/feedback')}}">Feedback</a>
                    </li>
                </ul>
            </li>
        </ul>
        @endif
        @if (request()->is('pos*'))
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="{{ (request()->is('cs')) ? 'active' : '' }}">
                <a href="{{url('/cs')}}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            <li class="menu-header">Menu</li>

            <!-- POS -->
            <li class="dropdown {{ (request()->is('pos/master*')) ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-headset"></i>
                    <span>Master Data</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ (request()->is('pos/master/bank-account*')) ? 'active' : '' }}"><a class="nav-link"
                            href="{{url('/pos/master/bank-account')}}">Bank Account</a>
                    </li>
                    <li class="{{ (request()->is('pos/master/cashier*')) ? 'active' : '' }}"><a class="nav-link"
                            href="{{url('/pos/master/cashier')}}">Cashier</a>
                    </li>
                </ul>
            </li>
            <li class="dropdown {{ (request()->is('pos/transaction*')) ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-headset"></i>
                    <span>Transaction</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ (request()->is('pos/transaction/booking*')) ? 'active' : '' }}"><a class="nav-link"
                            href="{{url('/pos/transaction/booking')}}">Check In</a>
                    </li>
                    <li class="{{ (request()->is('pos/transaction/membership*')) ? 'active' : '' }}"><a class="nav-link"
                            href="{{url('/pos/transaction/membership')}}">Check Out</a>
                    </li>
                    <li class="{{ (request()->is('pos/transaction/feedback*')) ? 'active' : '' }}"><a class="nav-link"
                            href="{{url('/pos/transaction/feedback')}}">Cash Register</a>
                    </li>
                    <li class="{{ (request()->is('pos/transaction/feedback*')) ? 'active' : '' }}"><a class="nav-link"
                            href="{{url('/pos/transaction/feedback')}}">Shift</a>
                    </li>
                </ul>
            </li>
            <li class="dropdown {{ (request()->is('pos/report*')) ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-headset"></i>
                    <span>Report</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ (request()->is('pos/report/customer-report*')) ? 'active' : '' }}"><a class="nav-link"
                            href="{{url('/pos/report/customer-report')}}">Sales Report</a>
                    </li>
                    <li class="{{ (request()->is('pos/report/check-in-out*')) ? 'active' : '' }}"><a class="nav-link"
                            href="{{url('/pos/report/check-in-out')}}">Check In Out</a>
                    </li>
                    <li class="{{ (request()->is('pos/report/membership*')) ? 'active' : '' }}"><a class="nav-link"
                            href="{{url('/pos/report/membership')}}">Cash Report</a>
                    </li>
                </ul>
            </li>
        </ul>
        @endif
        @if (request()->is('service*'))
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="{{ (request()->is('service')) ? 'active' : '' }}">
                <a href="{{url('/service')}}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            <li class="menu-header">Menu</li>

            <!-- POS -->
            <li class="dropdown {{ (request()->is('service/master*')) ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-headset"></i>
                    <span>Master Data</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ (request()->is('service/master/maintenance*')) ? 'active' : '' }}"><a class="nav-link"
                            href="{{url('/service/master/maintenance')}}">Maintenance</a>
                    </li>
                    <li class="{{ (request()->is('service/master/tools*')) ? 'active' : '' }}"><a class="nav-link"
                            href="{{url('/service/master/tools')}}">Tools</a>
                    </li>
                    <li class="{{ (request()->is('service/master/materials*')) ? 'active' : '' }}"><a class="nav-link"
                            href="{{url('/service/master/materials')}}">Materials</a>
                    </li>
                </ul>
            </li>
            <li class="dropdown {{ (request()->is('service/transaction*')) ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-headset"></i>
                    <span>Transaction</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ (request()->is('service/transaction/booking*')) ? 'active' : '' }}"><a
                            class="nav-link" href="{{url('/service/transaction/booking')}}">Check In</a>
                    </li>
                    <li class="{{ (request()->is('service/transaction/membership*')) ? 'active' : '' }}"><a
                            class="nav-link" href="{{url('/service/transaction/membership')}}">Check Out</a>
                    </li>
                    <li class="{{ (request()->is('service/transaction/feedback*')) ? 'active' : '' }}"><a
                            class="nav-link" href="{{url('/service/transaction/feedback')}}">Cash Register</a>
                    </li>
                    <li class="{{ (request()->is('service/transaction/feedback*')) ? 'active' : '' }}"><a
                            class="nav-link" href="{{url('/service/transaction/feedback')}}">Shift</a>
                    </li>
                </ul>
            </li>
            <li class="dropdown {{ (request()->is('service/report*')) ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-headset"></i>
                    <span>Report</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ (request()->is('service/report/customer-report*')) ? 'active' : '' }}"><a
                            class="nav-link" href="{{url('/service/report/customer-report')}}">Sales Report</a>
                    </li>
                    <li class="{{ (request()->is('service/report/check-in-out*')) ? 'active' : '' }}"><a
                            class="nav-link" href="{{url('/service/report/check-in-out')}}">Check In Out</a>
                    </li>
                    <li class="{{ (request()->is('service/report/membership*')) ? 'active' : '' }}"><a class="nav-link"
                            href="{{url('/service/report/membership')}}">Cash Report</a>
                    </li>
                </ul>
            </li>
        </ul>
        @endif
        @if (request()->is('purchasing*'))
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="{{ (request()->is('purchasing')) ? 'active' : '' }}">
                <a href="{{url('/purchasing')}}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            <li class="menu-header">Menu</li>

            <!-- PURCHASING -->
            <li class="dropdown {{ (request()->is('purchasing/master*')) ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-headset"></i>
                    <span>Master Data</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ (request()->is('purchasing/master/vendor-list*')) ? 'active' : '' }}"><a
                            class="nav-link" href="{{url('/purchasing/master/vendor-list')}}">Vendor List</a>
                    </li>
                    <li class="{{ (request()->is('purchasing/master/items*')) ? 'active' : '' }}"><a class="nav-link"
                            href="{{url('/purchasing/master/items')}}">Items</a>
                    </li>
                </ul>
            </li>
        </ul>
        @endif
        @if (request()->is('employee*'))
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="{{ (request()->is('employee')) ? 'active' : '' }}">
                <a href="{{url('/employee')}}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            <li class="menu-header">Menu</li>

            <!-- employee -->
            <li class="dropdown {{ (request()->is('employee/master*')) ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-headset"></i>
                    <span>Master Data</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ (request()->is('employee/master/department-list*')) ? 'active' : '' }}"><a
                            class="nav-link" href="{{url('/employee/master/department-list')}}">Department List</a>
                    </li>
                    <li class="{{ (request()->is('employee/master/employee-list*')) ? 'active' : '' }}"><a
                            class="nav-link" href="{{url('/employee/master/employee-list')}}">Employee List</a>
                    </li>
                </ul>
            </li>
            <li class="dropdown {{ (request()->is('employee/transaction*')) ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-headset"></i>
                    <span>Transaction</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ (request()->is('employee/transaction/insentive*')) ? 'active' : '' }}"><a
                            class="nav-link" href="{{url('/employee/transaction/insentive')}}">Insentive</a>
                    </li>
                    <li class="{{ (request()->is('employee/transaction/salary*')) ? 'active' : '' }}"><a
                            class="nav-link" href="{{url('/employee/transaction/salary')}}">Salary</a>
                    </li>
                    <li class="{{ (request()->is('employee/transaction/attendance*')) ? 'active' : '' }}"><a
                            class="nav-link" href="{{url('/employee/transaction/attendance')}}">Attendance</a>
                    </li>
                </ul>
            </li>
            <li class="dropdown {{ (request()->is('employee/report*')) ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-headset"></i>
                    <span>Report</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ (request()->is('employee/report/attendance*')) ? 'active' : '' }}"><a class="nav-link"
                            href="{{url('/employee/report/attendance')}}">Attendance</a>
                    </li>
                </ul>
            </li>
        </ul>
        @endif
    </aside>
</div>
