<nav>
        <div class="nav-wrapper">
        <a href="<?=route('/');?>" class="brand-logo">Project 3</a>
        <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
        <ul class="right hide-on-med-and-down">

            <li><a href="<?=route('/');?>">Comments</a></li>
            <?php
                if(!session()->has('user')):?>
                    <li><a href="<?=route('login');?>">Login | Register</a></li>
                <?php else: ?>
                    <li><a href="<?=route('logout');?>">Logout</a></li>
                <?php endif;
            ?>

        </ul>
        </div>
    </nav>

    <ul class="sidenav" id="mobile-demo">

        <li><a href="<?=route('/');?>">Comments</a></li>
        <?php
                if(!session()->has('user')):?>
                    <li><a href="<?=route('login');?>">Login | Register</a></li>
                <?php else: ?>
                    <li><a href="<?=route('logout');?>">Logout</a></li>
                <?php endif;
        ?>

    </ul>