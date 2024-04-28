<template>
    <div class="header-area" id="home-header">
        <MainHeader></MainHeader>
    </div>

    <div class="about-area gray-bg" id="about">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mb30">
                    <div class="video-intro primary-shadow">
                        <img :src="'images/about/about-logo.jpg'" alt="video-intro" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="about-text">
                        <h4>Pár slov o konferencii nConnect</h4>
                        <p>Po mnohých rokoch premýšľania a plánovania sme vytvorili nConnect, jedinečnú udalosť v Nitre, ktorá spája študentov IT a popredné firmy z tohto dynamického odvetvia. Konferencia nConnect nadväzuje na dlhoročnú tradíciu formátu "IT v praxi" Fakulty prírodných vied a informatiky UKF v Nitre. Táto iniciatíva je mostom medzi novou generáciou talentov a skúsenými profesionálmi, ktorý poskytuje fórum pre vzájomnú výmenu myšlienok a inšpirácií. Naše poslanie bolo jasné: vyplniť medzeru v regionálnej komunikácii a spolupráci v IT a nConnect je hrdým výsledkom tejto vízie.</p>
                    </div>
                    <div class="row">
                        <div>
                            <div v-for="(item, index) in sekcia" :key="index" class="col-sm-6">
                                <div class="single-about primary-shadow white-bg">
                                    <h5>{{ item.question }}</h5>
                                    <p>{{ item.answer }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container -->
    </div><!-- /.about-area -->

    <Speakers></Speakers>
    <Program></Program>

    <!--
    PARTS: (podstranky vlastne tieto iste obsahuju, takze urcite COMPONENTS!!!!!!!!!!!)
    -PROGRAM
    -POVEDALI O NAS
    -NASI PARTNERI
    -MAPA ||| KONTAKT
    -->

</template>

<script>
import MainHeader from "../components/MainHeader.vue";
import Speakers from "../components/Speakers.vue";
import Program from "../components/Program.vue";
export default {
    components: {
        Program,
        Speakers,
        MainHeader
    },
    data(){
        return{
            sekcia: [
                {
                    question: 'Kto sme ?',
                    answer: 'Sme skupina nadšencov pre IT z akademického a súkromného sektora.'
                },
                {
                    question: 'Čo chceme dosiahnuť ?',
                    answer: 'Vytvoriť udalosť, ktorá bude na pravidelnej báze spájať IT komunitu v Nitre.'
                }
            ]
        }
    }
}
</script>
