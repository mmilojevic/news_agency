<section>
    <div class="container">

        <div class="row">

            <div class="col-md-6 col-md-offset-3">

                

                <div class="box-static box-border-top padding-30">

                    <!-- ALERT -->
                <div id="login-error" class="alert alert-mini alert-danger margin-bottom-30 hide">
                </div><!-- /ALERT -->
                
                    <form id="loginForm" class="margin-bottom-20">
                        <div class="clearfix">

                            <!-- Email -->
                            <div class="form-group">
                                <input type="text" required="" placeholder="Email" class="form-control" name="email">
                            </div>

                            <!-- Password -->
                            <div class="form-group">
                                <input type="password" required="" placeholder="Password" class="form-control" name="password">
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12 text-center">

                                <button id="loginButton" class="btn btn-primary">Log in</button>

                            </div>
                        </div>

                    </form>
                </div>

                <div class="margin-top-30 text-center">
                   If you don't have account please register <a href="<?= WWW_PATH ?>access/register"><strong>here</strong></a>
                </div>

            </div>
        </div>

    </div>
</section>
