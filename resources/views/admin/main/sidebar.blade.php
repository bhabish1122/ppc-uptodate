<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="{{ route('admin.home') }}" class="brand-link">
    {{-- <img src="{{URL::to('/')}}/admin/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> --}}
    <span class="brand-text font-weight-light">Admin</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image pt-1">
        @php 
        $auth_name = Auth::user()->name; 
        preg_match_all('/(?<=\s|^)[a-z]/i', $auth_name, $matches); 
        @endphp
        <span class="border border-light rounded-circle py-1 {{count($matches[0]) == 1 ? 'px-2' : 'px-'.(3-count($matches[0]))}} bg-success text-light text-capitalize elevation-3">{{strtoupper(implode('', $matches[0]))}}</span>
      </div>
      <div class="info">
        <a href="#" class="d-block">{{Auth::user()->name}}</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="{{route('admin.config.index')}}" class="nav-link {{ (request()->is('home/config*')) ? 'active' : '' }}">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Config
            </p>
          </a>
        </li>
        <li class="nav-item has-treeview {{ (request()->is('home/welcome/*')) ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ (request()->is('home/welcome/*')) ? 'active' : '' }}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Start Page
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('admin.slider.index')}}" class="nav-link {{ (request()->is('home/welcome/slider*')) ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Slider</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('admin.about.index')}}" class="nav-link {{ (request()->is('home/welcome/about*')) ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>About</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('admin.core_person.index')}}" class="nav-link {{ (request()->is('home/welcome/core_person*')) ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Core Person</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('admin.useful_link.index')}}" class="nav-link {{ (request()->is('home/welcome/useful_link*')) ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Useful Link</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('admin.quick_menu.index')}}" class="nav-link {{ (request()->is('home/welcome/quick_menu*')) ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Quick Menu</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('admin.contact.index')}}" class="nav-link {{ (request()->is('home/welcome/contact*')) ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Contact</p>
              </a>
            </li>
            
          </ul>
        </li>
        <li class="nav-item has-treeview {{ (request()->is('home/about/*')) ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ (request()->is('home/about/*')) ? 'active' : '' }}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              About Us
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('admin.background.index')}}" class="nav-link {{ (request()->is('home/about/background*')) ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Background</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('admin.bg_slider.index')}}" class="nav-link {{ (request()->is('home/about/bg_slider*')) ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Background Slider</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('admin.vision.index')}}" class="nav-link {{ (request()->is('home/about/vision*')) ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Vision</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('admin.mission.index')}}" class="nav-link {{ (request()->is('home/about/mission*')) ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Mission</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('admin.objective.index')}}" class="nav-link {{ (request()->is('home/about/objective*')) ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Our Objective</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('admin.organizational_structure.index')}}" class="nav-link {{ (request()->is('home/about/organizational_structure*')) ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Organizational Structure</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('admin.bill_sarwajanikaran.index')}}" class="nav-link {{ (request()->is('home/about/bill_sarwajanikaran*')) ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>BillSarwajanikaran</p>
              </a>
            </li>
            
          </ul>
        </li>
        <li class="nav-item">
          <a href="{{ route('admin.division_section.index') }}" class="nav-link {{ (request()->is('home/division_section*')) ? 'active' : '' }}">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Division / Section
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('admin.notice.index') }}" class="nav-link {{ (request()->is('home/notice*')) ? 'active' : '' }}">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Notice
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('admin.document.index') }}" class="{{ (request()->is('home/document*')) ? 'active' : '' }} nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Document
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('admin.report.index') }}" class="nav-link {{ (request()->is('home/report*')) ? 'active' : '' }}">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Report
            </p>
          </a>
        </li>
        
        <li class="nav-item">
          <a href="{{ route('admin.gallery.index') }}" class="{{ (request()->is('home/gallery*')) ? 'active' : '' }} nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Gallery
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('admin.video-gallery.index') }}" class="{{ (request()->is('home/video-gallery*')) ? 'active' : '' }} nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Video Gallery
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('admin.citizen_charter.index') }}" class="{{ (request()->is('home/citizen_charter*')) ? 'active' : '' }} nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Citizen charter
            </p>
          </a>
        </li>
        <li class="nav-item has-treeview {{ (request()->is('home/form/*')) ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ (request()->is('home/form/*')) ? 'active' : '' }}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Form
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('admin.form.suggestion')}}" class="nav-link {{ (request()->is('home/form/suggestion*')) ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Suggestion</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('admin.form.complain')}}" class="nav-link {{ (request()->is('home/form/complain*')) ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Complain</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('admin.form.report')}}" class="nav-link {{ (request()->is('home/form/report*')) ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Report</p>
              </a>
            </li>
          </ul>
        </li>


        <li class="nav-item">
          <a href="{{route('admin.important.form')}}" class="nav-link {{ (request()->is('home/report*')) ? 'active' : '' }}">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Important Form
            </p>
          </a>
        </li>

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>