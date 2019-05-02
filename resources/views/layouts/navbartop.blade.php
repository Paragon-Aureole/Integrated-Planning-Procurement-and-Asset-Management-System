<!-- A grey horizontal navbar that becomes vertical on small screens -->

{{-- hidden Message --}}
<div style="background-color:#343a40; color:white" id="demo" class="collapse">
  <div class="container-fluid">
    <span class="navbar-brand mb-0 h5" style="font-size:20px;">Integrated Planning Procurement and Asset Management System</span>
  </div>
</div>

<nav class="navbar navbar-expand-md bg-dark navbar-dark sticky-top">
  {{-- button that shows the System Name and Home Dropdown  --}}
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item dropdown">
        <a class="navbar-brand" href="#" id="ppmpDropdownMenuLink" aria-haspopup="true" aria-expanded="false" data-toggle="collapse" data-target="#demo">
          <img src="{{asset('img/sfclogo.png')}}" width="40" height="40" class="d-inline-block align-top" alt="">
        </a>
        <ul class="dropdown-menu" aria-labelledby="ppmpDropdownMenuLink">
          <li><a class="dropdown-item" href="{{route('home')}}">HOME</a></li>
        </ul>
      </li>
    </ul>

    <!-- Links -->
    <ul class="navbar-nav mr-auto">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="ppmpDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          PPMP
        </a>
        <ul class="dropdown-menu" aria-labelledby="ppmpDropdownMenuLink">
          <li><a class="dropdown-item" href="{{route('view.ppmp')}}">PPMP</a></li>
          <li><a class="dropdown-item" href="{{route('supplemental.ppmp')}}">Supplemental PPMP</a></li>
        </ul>
      </li>
      <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="prDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Purchase Request
          </a>
          <ul class="dropdown-menu" aria-labelledby="prDropdownMenuLink">
            <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#"><i class="fas fa-plus"></i> New</a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{route('pr.index')}}">Purchase Request</a></li>
                <li><a class="dropdown-item" href="{{route('pr.supplemental')}}">Supplemental Purchase Request</a></li>
              </ul>
            </li>
            @can('close')
            <li><a class="dropdown-item" href="{{ url('/pr/view') }}">Close Purchase Request</a></li>
            @endcan
            <li><a class="dropdown-item" href="{{route('archive.pr')}}">Previous Purchase Requests</a></li>
          </ul>
       </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="rfqDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          RFQ
        </a>
        <ul class="dropdown-menu" aria-labelledby="rfqDropdownMenuLink">
          <li><a class="dropdown-item" href="{{route('rfq.index')}}">New Request for Quotation</a></li>
          <li><a class="dropdown-item" href="#">Previous Requests for Quotation</a></li>
        </ul>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="abstractDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Abstract
        </a>
        <ul class="dropdown-menu" aria-labelledby="abstractDropdownMenuLink">
          <li><a class="dropdown-item" href="/abstract">New Abstract of Quotation</a></li>
          <li><a class="dropdown-item" href="#">Previous Abstracts of Quotation</a></li>
        </ul>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="poDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Purchase Order
        </a>
        <ul class="dropdown-menu" aria-labelledby="poDropdownMenuLink">
          <li><a class="dropdown-item" href="/po">New Purchase Order</a></li>
          <li><a class="dropdown-item" href="#">Previous Purchase Orders</a></li>
        </ul>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="irDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Inspection Report
        </a>
        <ul class="dropdown-menu" aria-labelledby="irDropdownMenuLink">
          <li><a class="dropdown-item" href="/ir">New Inspection Report</a></li>
          <li><a class="dropdown-item" href="#">Previous Inspection Reports</a></li>
        </ul>
      </li>
      @can('asset mgt', 'gso supervisor')
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="irDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Assets
        </a>
        <ul class="dropdown-menu" aria-labelledby="irDropdownMenuLink">
          <li><a class="dropdown-item" href="/assets">Asset Procurement and Distribution</a></li>
          <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">Print Reports</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="/printOfficeAssets">REPORT OF THE PHYSICAL COUNT OF PROPERTY, PLANT AND EQUIPMENT</a></li>
              <li><a class="dropdown-item" href="/printVehicle">UPDATED INVENTORY/ACCOUNTING OF ALL EXISTING MOTOR VEHICLES</a></li>
            </ul>
          </li>
          <li><a class="dropdown-item" href="/migrateAssets">Migrate Current Assets</a></li>
        </ul>
      </li>
      @endcan
      @can('full control')
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="settingsDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Settings
        </a>
        <ul class="dropdown-menu" aria-labelledby="settingsDropdownMenuLink">
          <li><a class="dropdown-item" href="{{route('register')}}">User Management</a></li>
          <!-- <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">User Management</a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Users</a></li>
                <li><a class="dropdown-item" href="#">Roles and Permisions</a></li>
              </ul>
          </li> -->
          <li><a class="dropdown-item" href="{{route('view.office')}}">Offices</a></li>
          <li><a class="dropdown-item" href="{{route('view.signatories')}}">Signatories</a></li>
          <li><a class="dropdown-item" href="{{route('view.modes')}}">Modes of Procurement</a></li>
          <li><a class="dropdown-item" href="{{route('view.units')}}">Units of Measurement</a></li>
          <li><a class="dropdown-item" href="{{route('view.dist')}}">Distributors</a></li>
        </ul>
      </li>
      @endcan
    </ul>

    <!-- logout -->
    <ul class="navbar-nav ml-auto">
    	<li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="logoutDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-user-tie"></i> {{Auth::user()->username}}
        </a>
        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="logoutDropdownMenuLink">
          <li><a class="dropdown-item" href="#">Profile</a></li>
          <li><a class="dropdown-item" href="#">Change Password</a></li>
          <div class="dropdown-divider"></div>
          <li>
          	<a class="dropdown-item" href="#"
          		onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                  Logout
          	</a>
          	<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  {{ csrf_field() }}
              </form>
      	</li>
        </ul>
      </li>
    </ul>
  </div>
</nav>
