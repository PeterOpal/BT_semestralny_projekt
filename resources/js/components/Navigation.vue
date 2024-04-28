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
                    <a class="navbar-brand" href=""><img :src="'images/nconnect-logo.png'" alt="nConnect Logo" /></a>
                </div>

                <!-- Collect the nav links and other content for toggling -->
                <div class="collapse navbar-collapse" id="navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="current"><a href="index.php">DOMOV</a></li>
                        <li ><a href="speakers.php">SPEAKERS</a></li>
                        <li ><a href="schedule.php">PROGRAM</a></li>
                        <li ><a href="sponsors.php">PARTNERI</a></li>
                        <li ><a href="contact.php">KONTAKT</a></li>
                        <li ><a target="_blank" href="https://jhbq6cjtw5n.formlets.com/forms/udzi7MdglP32QjfE/">REGISTRÁCIA</a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container -->
        </nav>
    </div><!-- /.navigation-area -->
</template>
