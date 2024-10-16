<template>
  <nav data-bs-theme="dark" class="navbar navbar-expand-lg p-4 bg-body-tertiary ">
    <div class="container-fluid">
      <b>
        <img src="/public/fav.jpg" class="mb-1" alt="Bootstrap" width="30" height="24">
        <a class="navbar-brand" href="#"> SMS</a></b>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li><router-link class="nav-link" to="/">Dashboard</router-link></li>

          <!-- <li><a class="nav-link d-flex align-items-center"   href="#"><i class="fa fa-home p-1"></i> Dashboard</a></li> -->

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Message Management
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#"><i class="fas fa-sms"></i> Quick SMS</a></li>
              <li><router-link class="nav-link" to="/templates"><i
                    class="fa fa-file-alt me-1"></i>Templates</router-link></li>
            </ul>
          </li>
          <li class="nav-item">
            <router-link class="nav-link" to="/contacts">Contacts</router-link>
            <!-- <a class="nav-link active" aria-current="page" href="#"> Contacts</a> -->
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Company Management
            </a>
            <ul class="dropdown-menu">
              <li><router-link class="nav-link" to="/organisations"><i
                    class="fa fa-sitemap me-1 "></i>Organisations</router-link></li>
              <li><router-link class="nav-link" to="/departments"><i
                    class="fa fa-layer-group me-1"></i>Departments</router-link></li>

              <li><a class="dropdown-item" href="#"><i class="fas fa-user-tag"></i> Roles</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              User Management
            </a>
            <ul class="dropdown-menu">
              <li><router-link class="nav-link" to="/groups"><i class="fa fa-users-cog me-1"></i>Groups</router-link>
              </li>
              <li><a class="dropdown-item" href="#"><i class="fas fa-user"></i> Users</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Jobs
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#"><i class="fas fa-briefcase"></i> Contact Jobs</a></li>
              <li><a class="dropdown-item" href="#"><i class="fas fa-envelope"></i> Message Jobs</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Reports
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#"><i class="fas fa-briefcase"></i> Contact Reports</a></li>
              <li><a class="dropdown-item" href="#"><i class="fas fa-envelope"></i> Message Reports</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Settings
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#"><i class="fas fa-id-badge"></i> Sender ID</a></li>
              <li><a class="dropdown-item" href="#"><i class="fas fa-user-cog"></i> My Profile</a></li>
            </ul>
          </li>
        </ul>

        <!-- account button -->
        <div style="margin-right: auto;" class="btn-group ">
          <button type="button" class="btn btn-success"><i class="fa fa-user p-2"></i>Account</button>
          <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown"
            aria-expanded="false">
            <span class="visually-hidden">Toggle Dropdown</span>
          </button>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">My Profile</a></li>
            <!-- <li><a class="dropdown-item" href="#">Another action</a></li>
    <li><a class="dropdown-item" href="#">Something else here</a></li> -->
            <li>
              <hr class="dropdown-divider">
            </li>
            <li> <a class="dropdown-item" href="#"> Logout<i class="fa fa-power-off p-2" aria-hidden="true"></i></a>
            </li>
          </ul>
        </div>

      </div>
    </div>
  </nav>
</template>
