<header class="app-header"><a class="app-header__logo" href="<?php echo e(url('/')); ?>">IDLe Admin</a>
    <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar"
                                    aria-label="Hide Sidebar"></a>
    <!-- Navbar Right Menu-->
    <ul class="app-nav">

        <!-- User Menu-->
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown"
                                aria-label="Open Profile Menu"><i class="fa fa-user-circle-o fa-lg"></i> &nbsp; <?php echo e(Auth::user()->name); ?> <i class="fa fa-caret-down"></i></a>
            <ul class="dropdown-menu settings-menu dropdown-menu-right">
                <li>
                    <a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out fa-lg"></i> Logout
                    </a>
                </li>
            </ul>
        </li>

        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
            <?php echo csrf_field(); ?>
        </form>
    </ul>
</header>
<?php /**PATH D:\WEB IDLE 2026\idle_2026\resources\views/admin/includes/header.blade.php ENDPATH**/ ?>