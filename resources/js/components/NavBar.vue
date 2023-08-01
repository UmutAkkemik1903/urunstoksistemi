<template>
    <div>
        <div id="wrapper">

            <!-- Sidebar -->
            <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

                <router-link :to="{ name:'dashboard'}" class="sidebar-brand d-flex align-items-center justify-content-center" >
                    <div class="sidebar-brand-icon rotate-n-15">
                        <i class="fas fa-laugh-wink"></i>
                    </div>
                    <div class="sidebar-brand-text mx-3">WAKYAZILIM <sup></sup></div>
                </router-link>
                <hr class="sidebar-divider my-0">
                <!-- Nav Item - Dashboard -->
                <li class="nav-item">
                    <router-link :to="{name:'dashboard'}" class="nav-link" >
                        <i class="fas fa-fw fa-home"></i>
                        <span>Anasayfa</span></router-link>
                </li>

                <hr class="sidebar-divider my-0">

                <li class="nav-item">
                    <router-link :to="{name:'product'}" class="nav-link" >
                        <i class="fas fa-fw fa-shopping-basket"></i>
                        <span>Ürünler</span></router-link>
                </li>


                <li class="nav-item">
                    <router-link :to="{name:'productDef'}" class="nav-link" >
                        <i class="fas fa-fw fa-shopping-basket"></i>
                        <span>Tanımlı Ürünler</span></router-link>

                </li>


                <hr class="sidebar-divider d-none d-md-block">
                <!-- Sidebar Toggler (Sidebar) -->
                <div class="text-center d-none d-md-inline">
                    <button class="rounded-circle border-0" id="sidebarToggle"></button>
                </div>

            </ul>
            <!-- End of Sidebar -->

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">

                    <!-- Topbar -->
                    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                        <!-- Sidebar Toggle (Topbar) -->
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>

                        <!-- Topbar Search -->



                        <!-- Topbar Navbar -->
                        <ul class="navbar-nav ml-auto">

                            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                            <li class="nav-item dropdown no-arrow d-sm-none">
                                <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-search fa-fw"></i>
                                </a>
                                <!-- Dropdown - Messages -->
                                <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                    <form class="form-inline mr-auto w-100 navbar-search">
                                        <div class="input-group">
                                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="button">
                                                    <i class="fas fa-search fa-sm"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle"   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <button id="logout" class="btn btn-primary btn-circle float-right" @click="logOut()" >
                                        <i class="fas fa-sign-out-alt"></i>
                                    </button>
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <!-- End of Topbar -->

                    <!-- Begin Page Content -->
                    <div class="container-fluid">
                        <div class="row">
                            <router-view></router-view>
                        </div>
                    </div>

                </div>


                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Akkemik &copy; Website 2020</span>
                        </div>
                    </div>
                </footer>

            </div>
        </div>


        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>


        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" href="">Logout</a>
                    </div>
                </div>
            </div>
        </div>


    </div>
</template>

<script>
export default{
    methods:{
        logOut(){
            axios.get('logout').then( response => {
                location.reload();
            });
        }
    }
}
</script>
<style type="text/css">
#logout{
    border-radius: 20px;
}
</style>
