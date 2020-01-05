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
          <img src="{{ asset('/img/user.png') }}" class="img-circle elevation-2" alt="User Image">
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
              <i class="nav-icon fas fa-home blue"></i>
              <p>
                หน้าหลัก
              </p>
            </router-link>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-bell orange"></i>
              <p>
                การแจ้งเตือน
                <span class="right badge badge-danger">ใหม่</span>
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-seedling green"></i>
              <p>
                ข้อมูลพืช 
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/plant-type/create" class="nav-link">
                  <i class="fas fa-plus-square nav-icon cyan"></i>
                  <p>เพิ่มชนิดพืช</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/plant-type" class="nav-link ">
                  <i class="fas fa-file-alt nav-icon green"></i>
                  <p>รายการชนิดพืช</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/plant/create" class="nav-link">
                  <i class="fas fa-plus-square nav-icon cyan"></i>
                  <p>เพิ่มข้อมูลพืช</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/plant" class="nav-link">
                  <i class="fas fa-file-alt nav-icon green"></i>
                  <p>แสดงข้อมูลพืชทั้งหมด</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-stream cyan"></i>
              <p>
                แผนการปฏิบัติ
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit teal"></i>
              <p>
                แบบบันทึก
              </p>
            </a>
          </li>
          
           <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tint blue"></i>
              <p>
                ระบบให้น้ำอัตโนมัติ
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/water" class="nav-link">
                  <i class="fas fa-tools nav-icon cyan"></i>
                  <p>ติดตั้งระบบ</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/waterstatus" class="nav-link">
                  <i class="fas fa-file-alt nav-icon green"></i>
                  <p>หน้าแสดงผล</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <router-link to="/profile" class="nav-link">
              <i class="nav-icon fas fa-user yellow"></i>
              <p>
                ข้อมูลส่วนตัว
              </p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link to="/users" class="nav-link">
            <i class="nav-icon fas fa-users orange"></i>
              <p>
                ผู้ใช้งาน
              </p>
            </router-link>
          </li>
           <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                ตั้งค่า
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a class="dropdown-item nav-link" href="{{ route('logout') }}"
              onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
              <i class="nav-icon fas fa-power-off red"></i> 
               ออกจากระบบ
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