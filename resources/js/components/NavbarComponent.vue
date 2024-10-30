
<template>
 <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <div class="wrapper">
        <aside id="sidebar"   :class="{ expand: isExpanded} ">
            <div class="d-flex">
                <button class="toggle-btn" type="button" @click="toggleSidebar">
                    <i class="lni lni-grid-alt"></i>
                </button>
                <div class="sidebar-logo">
                    <a style="text-decoration: none;" href="">SMS</a>
                </div>
            </div>
            <ul class="sidebar-nav">
              <!-- dashboard -->
              <li class="sidebar-item">
        <router-link class="sidebar-link" to="/">
          <i class="lni lni-home"></i>
          <span>Dashboard</span>
        </router-link>
      </li>

      <!-- user management -->
                <li class="sidebar-item">
    <!-- The main dropdown link -->
    <router-link
      to="#"
      class="sidebar-link collapsed has-dropdown"
      data-bs-toggle="collapse"
      data-bs-target="#auth"
      aria-expanded="false"
      aria-controls="auth"
    >
    <i class="lni lni-envelope"></i>
      <span>Message Management</span>
    </router-link>

    <!-- The dropdown list with Vue Router links -->
    <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
      <li class="sidebar-item">
        <!-- Using router-link for Vue routing -->
        <router-link to="/sms" class="sidebar-link">Quick SMS</router-link>
      </li>
      <li class="sidebar-item">
        <router-link to="/templates" class="sidebar-link">Templates</router-link>
      </li>
    </ul>
  </li>
  

  <!-- contacts -->
  <li class="sidebar-item">
        <router-link class="sidebar-link" to="/contacts">
          <i class="lni lni-user"></i>
          <span>Contacts</span>
        </router-link>
      </li>



         <!-- company management -->
         <li class="sidebar-item">
    <!-- The main dropdown link -->
    <router-link
      to="#"
      class="sidebar-link collapsed has-dropdown"
      data-bs-toggle="collapse"
      data-bs-target="#auth1"
      aria-expanded="false"
      aria-controls="auth1"
    >
    <i class="lni lni-rocket"></i>
      <span>Company Management</span>
    </router-link>

    <!-- The dropdown list with Vue Router links -->
    <ul id="auth1" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar1">
      <li class="sidebar-item">
        <!-- Using router-link for Vue routing -->
        <router-link to="/organisations" class="sidebar-link">Organisations</router-link>
      </li>
      <li class="sidebar-item">
        <router-link to="/departments" class="sidebar-link">Departments</router-link>
      </li>
      <li class="sidebar-item">
        <router-link to="/roles" class="sidebar-link">Roles</router-link>
      </li>
    </ul>
  </li>



     <!-- user management -->
     <li class="sidebar-item">
    <!-- The main dropdown link -->
    <router-link
      to="#"
      class="sidebar-link collapsed has-dropdown"
      data-bs-toggle="collapse"
      data-bs-target="#auth2"
      aria-expanded="false"
      aria-controls="auth2"
    >
      <i class="lni lni-users"></i>
      <span>User Management</span>
    </router-link>

    <!-- The dropdown list with Vue Router links -->
    <ul id="auth2" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar2">
      <li class="sidebar-item">
        <!-- Using router-link for Vue routing -->
        <router-link to="/groups" class="sidebar-link">Groups</router-link>
      </li>
      <li class="sidebar-item">
        <router-link to="/users" class="sidebar-link">Users</router-link>
      </li>
    </ul>
  </li>




     <!-- JOB management -->
     <li class="sidebar-item">
    <!-- The main dropdown link -->
    <router-link
      to="#"
      class="sidebar-link collapsed has-dropdown"
      data-bs-toggle="collapse"
      data-bs-target="#auth3"
      aria-expanded="false"
      aria-controls="auth3"
    >
    <i class="lni lni-briefcase"></i>
      <span>Job Management</span>
    </router-link>

    <!-- The dropdown list with Vue Router links -->
    <ul id="auth3" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar3">
      <li class="sidebar-item">
        <!-- Using router-link for Vue routing -->
        <router-link to="/contact_jobs" class="sidebar-link">Contact Jobs</router-link>
      </li>
      <li class="sidebar-item">
        <router-link to="/message_jobs" class="sidebar-link">Message Jobs</router-link>
      </li>
    </ul>
  </li>



     <!-- Reports management -->
     <li class="sidebar-item">
    <!-- The main dropdown link -->
    <router-link
      to="#"
      class="sidebar-link collapsed has-dropdown"
      data-bs-toggle="collapse"
      data-bs-target="#auth4"
      aria-expanded="false"
      aria-controls="auth4"
    >
    <i class="lni lni-bar-chart"></i>
      <span>Reports Management</span>
    </router-link>

    <!-- The dropdown list with Vue Router links -->
    <ul id="auth4" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar4">
      <li class="sidebar-item">
        <!-- Using router-link for Vue routing -->
        <router-link to="/message_reports" class="sidebar-link">Message Reports</router-link>
      </li>
      <li class="sidebar-item">
        <router-link to="/templates" class="sidebar-link">Contact Reports</router-link>
      </li>
    </ul>
  </li>




     <!-- user management -->
     <li class="sidebar-item">
    <!-- The main dropdown link -->
    <router-link
      to="#"
      class="sidebar-link collapsed has-dropdown"
      data-bs-toggle="collapse"
      data-bs-target="#auth5"
      aria-expanded="false"
      aria-controls="auth5"
    >
      <i class="lni lni-cog"></i>
      <span>Settings</span>
    </router-link>

    <!-- The dropdown list with Vue Router links -->
    <ul id="auth5" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar5">
      <li class="sidebar-item">
        <!-- Using router-link for Vue routing -->
        <router-link to="/" class="sidebar-link">Sender ID</router-link>
      </li>
      <li class="sidebar-item">
        <router-link to="/" class="sidebar-link">My Profile</router-link>
      </li>
    </ul>
  </li>
<!-- MULTI DROPDOWN -->
<!--   
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#multi" aria-expanded="false" aria-controls="multi">
                        <i class="lni lni-layout"></i>
                        <span>Multi Level</span>
                    </a>
                    <ul id="multi" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link collapsed" data-bs-toggle="collapse"
                                data-bs-target="#multi-two" aria-expanded="false" aria-controls="multi-two">
                                Two Links
                            </a>
                            <ul id="multi-two" class="sidebar-dropdown list-unstyled collapse">
                                <li class="sidebar-item">
                                    <a href="#" class="sidebar-link">Link 1</a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="#" class="sidebar-link">Link 2</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li> -->
             
            </ul>
            <div class="sidebar-footer">
                <a href="#" class="sidebar-link">
                    <i class="lni lni-exit"></i>
                    <span>Logout</span>
                </a>
            </div>
        </aside>
      
    </div>
 


</template>

<script>
export default {
  data() {
    return {
      isExpanded: false, // Tracks whether the sidebar is expanded or not
    };
  },
  methods: {
    toggleSidebar() {
      this.isExpanded = !this.isExpanded; // Toggle sidebar expansion
    },

  },
};
</script>


<style >
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

::after,
::before {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}
.sidebar-link{
  text-decoration: none;
}
a {
    text-decoration: none;
}

li {
    list-style: none;
    margin-top:10px;
}

h1 {
    font-weight: 600;
    font-size: 1.5rem;
}

body {
    font-family: 'Poppins', sans-serif;
}

.wrapper {
    display: flex;
}

.main {
    min-height: 100vh;
    width: 100%;
    overflow: hidden;
    transition: all 0.35s ease-in-out;
    background-color: #fafbfe;
}

#sidebar {
    width: 70px;
    min-width: 70px;
    z-index: 1000;
    transition: all .25s ease-in-out;
    background-color: #0e2238;
    display: flex;
    flex-direction: column;
    overflow-y:auto;
    overflow-x: hidden;
    scrollbar-width:thin;
    scrollbar-gutter: stable;
    scroll-behavior: smooth;
 

}
.sidebar-dropdown .sidebar-link{
margin-left: 30px;
}
#sidebar.expand {
    width: 260px;
    min-width: 260px;
}


.toggle-btn {
    background-color: transparent;
    cursor: pointer;
    border: 0;
    padding: 1rem 1.5rem;
}

.toggle-btn i {
    font-size: 1.5rem;
    color: #FFF;
}

.sidebar-logo {
    margin: auto 0;
}

.sidebar-logo a {
    color: #FFF;
    font-size: 1.15rem;
    font-weight: 600;
}

#sidebar:not(.expand) .sidebar-logo,
#sidebar:not(.expand) a.sidebar-link span {
    display: none;
}

.sidebar-nav {
    padding: 2rem 0;
    flex: 1 1 auto;
}

a.sidebar-link {
    padding: .625rem 1.625rem;
    color: #FFF;
    display: block;
    font-size: 0.9rem;
    white-space: nowrap;
    border-left: 3px solid transparent;
}

.sidebar-link i {
    font-size: 1.1rem;
    margin-right: .75rem;
}

a.sidebar-link:hover {
    background-color: rgba(255, 255, 255, .075);
    border-left: 3px solid #3b7ddd;
}

.sidebar-item {
    position: relative;
}

#sidebar:not(.expand) .sidebar-item .sidebar-dropdown {
    position: absolute;
    top: 0;
    left: 70px;
    background-color: #0e2238;
    padding: 0;
    min-width: 15rem;
    display: none;
}

#sidebar:not(.expand) .sidebar-item:hover .has-dropdown+.sidebar-dropdown {
    display: block;
    max-height: 15em;
    width: 100%;
    opacity: 1;
}

#sidebar.expand .sidebar-link[data-bs-toggle="collapse"]::after {
    border: solid;
    border-width: 0 .075rem .075rem 0;
    content: "";
    display: inline-block;
    padding: 2px;
    position: absolute;
    right: 1.5rem;
    top: 1.4rem;
    transform: rotate(-135deg);
    transition: all .2s ease-out;
}

#sidebar.expand .sidebar-link[data-bs-toggle="collapse"].collapsed::after {
    transform: rotate(45deg);
    transition: all .2s ease-out;
}

</style>



































