<template>
    <div class="navigation-area primary-shadow">
        <div class="top-info-bar">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="contact-info-bar">
                            <ul>
                                <li><i class="fa fa-map-marker"></i>Študentské centrum UKF, Dražovská 2, Nitra</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6 text-right mobile-left">
                        <div class="contact-info-bar">
                            <ul>
                                <li><i class="fa fa-phone"></i> +421 902 170 744</li>
                                <li><i class="fa fa-envelope"></i> info@nconnect.sk</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div><!-- /.container -->
        </div><!-- /.top-info-bar -->

        <nav class="navbar navbar-default">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Prepnúť navigáciu</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href=""><router-link to="/" exact><img :src="'images/nconnect-logo.png'" alt="nConnect Logo" /></router-link></a>
                </div>

                <!-- Collect the nav links and other content for toggling -->
                <div class="collapse navbar-collapse" id="navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li :class="{ 'current': $route.path === '/' }"><router-link to="/" exact>DOMOV</router-link></li>
                        <li :class="{ 'current': $route.path === '/speakers' }"><router-link to="/speakers" exact>SPEAKERS</router-link></li>
                        <li :class="{ 'current': $route.path === '/schedule' }"><router-link to="/schedule" exact>PROGRAM</router-link></li>
                        <li :class="{ 'current': $route.path === '/sponsors' }"><router-link to="/sponsors" exact>PARTNERI</router-link></li>
                        <li :class="{ 'current': $route.path === '/contact' }"><router-link to="/contact" exact>KONTAKT</router-link></li>
                        <li :class="{ 'current': $route.path === '/student-registration' }"><router-link to="/student-registration" exact>REGISTRÁCIA</router-link></li>
                    </ul>
                </div><!-- /.navbar-collapse -->

            </div><!-- /.container -->
        </nav>
    </div><!-- /.navigation-area -->
</template>

<script>
import { RouterLink } from 'vue-router'

</script>
