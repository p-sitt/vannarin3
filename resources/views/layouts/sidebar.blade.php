<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/home" class="brand-link">
      <img src="{{ asset('/img/Logo_New.png') }}" alt="Vannarin Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Vannarin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('/img/profile/'.Auth::user()->photo) }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <router-link to="/profile" class="d-block"> {{ Auth::user()->name }} </router-link>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <router-link to="/dashboard" class="nav-link">
              <i class="fas fa-home blue fa-2x"></i>
              <p>
                 &nbsp หน้าหลัก
              </p>
            </router-link>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-bell fa-2x orange"></i>
              <p>
                 &nbsp การแจ้งเตือน
                <span class="right badge badge-danger">ใหม่</span>
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="fas fa-seedling fa-2x green"></i>
              <p>
                 &nbsp ข้อมูลพืช 
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <router-link to="/planttype" class="nav-link ">
                  <i class="fas fa-file-alt nav-icon green"></i>
                  <p>&nbsp รายการชนิดพืช</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/plants" class="nav-link">
                  <i class="fas fa-file-alt nav-icon green"></i>
                  <p>&nbsp รายการพืชทั้งหมด</p>
                </router-link>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fa-2x fas fa-stream cyan"></i>
              <p>
                &nbsp แผนการปฏิบัติ
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fa-2x fas fa-edit teal"></i>
              <p>
                &nbsp แบบบันทึก
              </p>
            </a>
          </li>
          
           <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="fa-2x fas fa-tint blue"></i>
              <p>
                &nbsp ระบบให้น้ำอัตโนมัติ
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fas fa-tools nav-icon cyan"></i>
                  <p>&nbsp ติดตั้งระบบ</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fas fa-file-alt nav-icon green"></i>
                  <p>&nbsp หน้าแสดงผล</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <router-link to="/profile" class="nav-link">
              <i class="fa-2x fas fa-user yellow"></i>
              <p>
                &nbsp ข้อมูลส่วนตัว
              </p>
            </router-link>
          </li>
           @can('isAdmin')
          <li class="nav-item">
            <router-link to="/users" class="nav-link">
            <i class="fa-2x fas fa-users orange"></i>
              <p>
                &nbsp ผู้ใช้งาน
              </p>
            </router-link>
          </li>
           <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="fa-2x fas fa-cog"></i>
              <p>
               &nbsp  ตั้งค่า
              </p>
              <i class="right fas fa-angle-left"></i>
            </a>
             <ul class="nav nav-treeview">
              <li class="nav-item">
                <router-link to="developer" class="nav-link">
                  <i class="fas fa-cog"></i>
                  <p>
                    &nbsp Developer
                  </p>
                </router-link>
              </li>
            </ul>
          </li>
          @endcan
          <li class="nav-item">
            <a class="dropdown-item nav-link" href="{{ route('logout') }}"
              onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
              <i class="fa-2x  fas fa-power-off red"></i> 
               <p>&nbsp ออกจากระบบ</p>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
             </form>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>