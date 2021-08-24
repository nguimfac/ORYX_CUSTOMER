@extends('layouts.app') @section('content')
<div id="cover"> <span class="glyphicon glyphicon-refresh w3-spin preloader-Icon"></span>Please Wait, Loading... <img width="150" src="{{asset('images/load5.gif')}}" alt=""></div>
<h1>Dom Loaded</h1>
<style>

</style>

<script>
    $('h1').hide();
    $(window).on('load', function() {
        $("#cover").fadeOut(1750);
    })
</script>

<section class="hero-area bg-1 text-center overly" style="background-image: url('{{ asset('images/hero.jpg') }}');">
    <!-- Container Start -->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- Header Contetnt -->
                <div class="content-block">
                    <h1>Suivez & Servez vos clients </h1>
                    <p> <i>Restez plus proche de vos clients <br> Ameliorez la satisfaction de vos clients après le service</i></p>
                    <div class="short-popular-category-list text-center">
                        <h2>CUSTOMER MANAGEMENT</h2>
                    </div>
                </div>

                <!-- Advance Search -->
                <div class="container ">
                    <div class="row ">
                        <div class="col-md-4 containers">
                            <div class="advance-search ad-listing-content ">
                                <div class="">
                                    <div class="row justify-content-center">
                                        <a title="Gerer Vos logiciel" href="{{ url('software/') }}">
                                            <div class="col-lg-12 col-md-12 align-content-center">
                                                <img src="{{ asset ('images/optimus.jpg')}}" width="160" alt=""><br>
                                                <strong class="text-primary">LOGICIELS</strong>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 containers ">
                            <div class="advance-search ad-listing-content ">
                                <div class="container">
                                    <div class="row justify-content-center">
                                        <a href="{{url ('souscription')}}" title="Gerer vos Souscription">
                                            <div class="col-lg-12 col-md-12 align-content-center">
                                                <img src="{{ asset ('images/subscription.png')}}" width="160" alt=""><br>
                                                <strong class="text-primary">SUBCRIPTION</strong>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 containers ">
                            <div class="advance-search ad-listing-content ">
                                <div class="container">
                                    <div class="row justify-content-center">
                                        <a href="{{url('sav')}}">
                                            <div class="col-lg-12 col-md-12 align-content-center">
                                                <img src="{{ asset ('images/sav.jpg')}}" width="120" alt=""><br>
                                                <strong class="text-primary">SERVICE APRES VENTE</strong>

                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container End -->
</section>

</div>
<br><br><br><br><br><br><br> @endsection