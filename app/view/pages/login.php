<div class="container">
        <div class="row">
            <div class="col s12 m6 offset-m3">
                <h3 class="center-align">Login</h3>
                <div class="row">
                    <form action="<?=route('user/login');?>" method="post" class="col s12">
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="username" type="text" name="username" class="validate">
                                <label for="username">Username</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="password" name="password" type="password" class="validate">
                                <label for="password">Password</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12">
                                <p>
                                    Don't have an account?
                                    <a href="<?=route('/register');?>">
                                        Register
                                    </a>
                                </p>
                            </div>
                        </div>
                        <div class="divider"></div>
                        <div id="message">
                        
                            <?php

                                if(session()->has('errors')):

                                    foreach(session()->get('errors') as $i):
                                            echo "<p>{$i}</p>";
                                    endforeach;
                                    session()->forget('errors');

                                endif;

                                if(session()->has('error')):
           
                                    echo session()->get('error');                                   
                                    session()->forget('error');

                                endif;

                            ?>

                        </div>
                        <div class="row">
                            <div class="col m12">
                                <p class="right-align">
                                    <button class="btn btn-large waves-effect waves-light" type="submit" name="login">Login</button>
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>