<template>
    <div class="footer-area">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-6">
                <div class="single-footer-widget">
                    <a href="index.php" class="footer-logo">
                        <img :src="'images/footer-logo.png'" alt="logo"/>
                    </a>
                    <p>Spájame IT komunity</p>
                    <ul class="footer-social">
                        <li><a target="_blank" href="https://www.facebook.com/nconnectsk/"><i
                            class="fa fa-facebook"></i></a></li>
                        <li><a target="_blank" href="https://www.instagram.com/nconnect_sk/"><i
                            class="fa fa-instagram"></i></a></li>
                        <li><a target="_blank" href="https://www.linkedin.com/company/nconnectsk/"><i
                            class="fa fa-linkedin"></i></a></li>
                    </ul>
                </div>
            </div><!-- /.col -->
            <div class="col-md-4 col-sm-6">
                <div class="single-footer-widget">
                    <h4 style="text-transform: none;">Študentské centrum UKF Dražovská 2, Nitra</h4>
                </div>
            </div><!-- /.col -->
            <div class="col-md-4 col-sm-6">
                <div class="single-footer-widget">
                    <a href="https://www.fpvai.ukf.sk/sk/" target="_blank">
                        <h4 style="text-transform: none;">Fakulta prírodných vied a informatiky UKF v Nitre</h4>
                    </a>
                </div>
            </div><!-- /.col -->
            <div class="col-md-4 col-sm-12">
                <div class="single-footer-widget">
                    <h4 style="text-transform: none;">info@nconnect.sk</h4>
                </div>
            </div><!-- /.col -->
            <div class="col-md-4 col-sm-12">
                <div class="single-footer-widget">
                    <a href="gdpr.php"><h4 style="text-transform: none;">Ochrana osobných údajov</h4></a>
                </div>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container -->
    </div><!-- /.footer-area -->

    <div class="footer-bar-area">
        <div class="container">
            <div class="row">
                <div class="col-md-10">
                    <span>Copyright 2024 . Designed By <a href="#">BestPixels</a></span>
                </div>
                <div class="col-md-2">
                    <span><router-link to="/login">Admin login</router-link></span>
                </div>
            </div>
        </div>
    </div><!-- /.footer-bar-area -->

</template>
<script setup>
</script>
