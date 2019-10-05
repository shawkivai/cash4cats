<div class="single-widget-container">
            <section class="widget login-widget">
                <header class="text-align-center">
                    <h4>Login to your account</h4>
                    <div><?php if ($this->session->flashdata('notice')) {
                        echo ('<span class="label label-important">' . $this->session->flashdata('notice') .'</span>');
                         } ?></div>
                </header>
                <div class="body">
                    <form class="no-margin"
                          action="<?php echo site_url(); ?>/login/validate" method="post">
                        <fieldset>
                            <div class="form-group">
                                <label for="user" >Username</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                    </span>
                                    <input id="user" name="user" type="text" class="form-control input-lg"
                                           placeholder="Your Username">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password" >Password</label>

                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon">
                                        <i class="fa fa-lock"></i>
                                    </span>
                                    <input id="password" name="password" type="password" class="form-control input-lg"
                                           placeholder="Your Password">
                                </div>
                            </div>
                        </fieldset>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-block btn-lg btn-danger">
                                <span class="small-circle"><i class="fa fa-caret-right"></i></span>
                                <small>Sign In</small>
                            </button>
                            <a class="forgot">For any issues contact the System Administrator</a>
                        </div>
                    </form>
                </div>
            </section>
        </div>
