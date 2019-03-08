<!-- A grey horizontal navbar that becomes vertical on small screens -->
<nav class="navbar navbar-expand-md bg-dark navbar-dark sticky-top">
  <a class="navbar-brand" href="{{route('home')}}">
  	<img src="{{asset('img/sfclogo.png')}}" width="30" height="30" class="d-inline-block align-top" alt="">
	<span class="mb-0 h5">IPPAMS</span>
  </a>
  <!-- Toggler/collapsibe Button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <!-- Links -->
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="{{route('view.ppmp')}}">PPMP</a>
      </li>
      <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="prDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Purchase Request
          </a>
          <ul class="dropdown-menu" aria-labelledby="prDropdownMenuLink">
            <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#"><i class="fas fa-plus"></i> New</a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{route('view.pr')}}">Purchase Request</a></li>
                <li><a class="dropdown-item" href="#">Supplemental Purchase Request</a></li>
              </ul>
            </li>
            @hasanyrole('Admin|Secretariat')
            <li><a class="dropdown-item" href="{{route('viewall.pr')}}">Close Purchase Request</a></li>
            @endrole
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
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="irDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Assets
        </a>
        <ul class="dropdown-menu" aria-labelledby="irDropdownMenuLink">
          <li><a class="dropdown-item" href="#">Migrate Current Assets</a></li>
          <li><a class="dropdown-item" href="/assets">Procured Assets</a></li>
        </ul>
      </li>
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
