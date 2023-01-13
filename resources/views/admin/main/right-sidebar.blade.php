<aside class="control-sidebar control-sidebar-dark">
  <div class="p-3 control-sidebar-content">
    <div class="media">
      <img src="{{URL::to('/')}}/admin/dist/img/avatar5.png" alt="User Avatar" class="img-size-50 img-circle mr-3">
      <div class="media-body">
        <h3 class="dropdown-item-title">
          {{ Auth::user()->name }}
        </h3>
        <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i>  {{Auth::user()->created_at->diffForHumans()}}</p>
      </div>
    </div>
    <hr class="my-1" />
    <ul class="nav nav-sidebar flex-column">
      <li class="nav-item">
        <a href="{{ route('admin.password.index') }}" class="nav-link pl-0 my-auto">
          <i class="nav-icon fas fa-th"></i>
          <span>
            Change Password
          </span>
        </a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link pl-0 my-auto" title="Click for logOut" href="{{ route('logout') }}"
        onclick="event.preventDefault();
        document.getElementById('logout-form').submit();">
        <i class="nav-icon fas fa-sign-out-alt text-danger"></i>
        <span>
          {{ __('Logout') }}
        </span>
      </a>

      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
      </form>
    </li>
  </ul>
</div>
</aside>