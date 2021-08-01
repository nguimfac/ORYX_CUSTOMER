@extends('layouts.app') @section('content')

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
{{View::make('vue.links')}}
<div class="container-fluid mb-4">
    <section class="dashboard section">
        <!-- Container Start -->
        <div class="container-fluid">
            <!-- Row Start -->
            <div class="row">
                <div class="col-lg-3">
                    <div class="sidebar">
                        <div class="widget user-dashboard-menu">
                            <ul>
                                <li class="">
                                    <a href="{{url('software/')}}" class="logiciel"><i class="fa fa-user "></i> LOGICIELS <span>1</span></a></li>
                                <li class="">
                                    <a href="{{url('souscription/')}}" class="souscription"><i class="fa fa-bookmark-o"></i> SOUSCRIPTION<span>2</span></a>
                                </li>
                                <li class="active">
                                    <a href="{{url('sav/')}}" class="sav"><i class="fa fa-file-archive-o"></i>SERVICE APRES VENTES<span>3</span></a>
                                </li>

                            </ul>
                        </div>
                        <!-- User Widget -->
                        <div class="widget user-dashboard-profile">
                            <!-- User Image -->
                            <div class="profile-thumb">
                                <img src="images/user/user-thumb.jpg" alt="" class="rounded-circle">
                            </div>
                            <!-- User Name -->
                            <img src="{{ asset ('images/subscription.png')}}" alt="100" width="200" srcset="">
                        </div>
                        <!-- Dashboard Links -->

                        <!-- delete-account modal -->
                        <!-- delete account popup modal start-->
                        <!-- Modal -->
                        <div class="modal fade" id="deleteaccount" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header border-bottom-0">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
                                    </div>
                                    <div class="modal-body text-center">
                                        <img src="images/account/Account1.png" class="img-fluid mb-2" alt="">
                                        <h6 class="py-2">Are you sure you want to delete your account?</h6>
                                        <p>Do you really want to delete these records? This process cannot be undone.</p>
                                        <textarea class="form-control" name="message" id="" cols="40" rows="4" class="w-100 rounded"></textarea>
                                    </div>
                                    <div class="modal-footer border-top-0 mb-3 mx-5 justify-content-center">
                                        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                                        <button type="button" class="btn btn-danger">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- delete account popup modal end-->
                        <!-- delete-account modal -->

                    </div>
                </div>
                <div class="col-lg-9">
                    <!-- Recently Favorited -->
                    <div class="widget dashboard-container my-adslist">                
                        <div id="tsum-tabs">
                          <main>   
                            <input id="tab1" type="radio" name="tabs" checked>
                            <label for="tab1"><strong>RECLAMMATION</strong></label>
                              
                            <input id="tab2" type="radio" name="tabs">
                            <label for="tab2"><strong>SUGGESTION</strong></label>
                              
                            <input id="tab3" type="radio" name="tabs">
                            <label for="tab3"><strong>SOLUTION</strong></label>
                              
                            <input id="tab4" type="radio" name="tabs">
                            <label for="tab4">Drupal</label>
                              
                            <section id="content1">
                                <div class="row">
                                    <div class="col-md-3">
                                        <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#staticBackdrop"> Add Reclammation <i class="fa fa-plus-circle" aria-hidden="true"></i></button>
                                    </div>
                                    <div class="col-md-3">
                                        <a class="btn btn-success" type="button" href="/sendmail"> Notifier clients <i class="fa fa-bell" aria-hidden="true"></i></a>
                                    </div>
                                </div>
            <br>
                                <div>
                                    <table id="myTable" class=" table table-striped table-hover table-borderless">
                                        <thead class="bg-primary text-white">
                                            <tr>
                                                <th scope="col">Numero</th>
                                                <th scope="col">Client</th>
                                                <th scope="col">Logiciel</th>
                                                <th scope="col">Frais </th>
                                                <th scope="col"> Payés</th>
                                                <th scope="col"> Debut</th>
                                                <th scope="col">D Fin</th>
                                                <th scope="col">Payement</th>
                                                <th>Reste</th>
                                                <th scope="col text-left">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="jsTableBody">
                                          
                                        </tbody>
                                    </table>
                                    <hr>
        
        
                                </div>
                            </section>
                              
                            <section id="content2">
                              <p>
                                 CONTENT FIR TAB 2
                              </p>
                            </section>
                              
                            <section id="content3">
                              <p>
                                 CONTENT FIR TAB 3
                              </p>
                            </section>
                              
                            <section id="content4">
                              <p>
                                 CONTENT FIR TAB 4
                              </p>
                            </section>
                              
                          </main>
                          </div>
                    </div>

                    </div>

                    <!-- pagination -->
                    <div class="pagination justify-content-center">
                        <nav aria-label="Page navigation example">
                        </nav>
                    </div>
                    <!-- pagination -->

                </div>
            </div>
            <!-- Row End -->
        </div>
        <!-- Container End -->
    </section>
</div>

<!------Modal 1 for save------>

<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Creez une Reclammation <img width="80" src="{{  asset('images/sav.jpg') }}" alt="" srcset=""></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
            </div>
            <div class="modal-body">
                <form action="/newsouscription" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="nom" class="text-black">Client Concerné</label>
                                <select name="client_name" class="form-control p-4" id="client_name">
                                    <option value=""></option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="probleme" class="text-black">Titre du Probleme</label>
                                <input type="text" name="titrepb" class="form-control p-4" required placeholder="titre ce probleme">
                            </div>

                            <div class="form-group">
                                <label for="email" class="text-black">Description du probleme</label>
                                <textarea name="descpd" id="descpb"  class="form-control " placeholder="Decrivez le probleme de votre client"></textarea>
                            </div>
                            <label for="email" class="text-black">Avez vous une solution a proposé</label><br>
                            <div class="row ">
                                <div class="col-md-2 ">
                                    <span class="ml-3">Oui</span><br><input class="ml-4" id="method1" type="radio" value="OM" name="type_payement">
                                </div>
                                <div class="col-md-3">
                                    <span class="ml-4">Non<br></span><input type="radio" id="NPmethod" class="ml-4" value="NP" name="type_payement"><br>
                                </div> 
                            </div><br>

                            <div class="form-group payeform">
                                <label for="date_fin" class="text-black">Entrez votre solution</label>
                                 <textarea name=""  class="form-control "></textarea>
                            </div>    
                        </div>

                        <script>

                            $(document).ready(function() {
                                $(".payeform").hide()
                                $("#method1").click(function() {
                                    $(".payeform").fadeIn(250);
                                })
                                $("#method2").click(function() {
                                    $(".payeform").fadeIn(250);
                                })
                                $("#method3").click(function() {
                                    $(".payeform").fadeIn(250);
                                })
								$("#cash").click(function() {
                                    $(".payeform").fadeIn(250);
                                })
                                $("#NPmethod").click(function() {
                                    $(".payeform").hide();
                                })
                            })
                        </script>


                    </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Nouveau</button>
            </div>
            </form>
        </div>

    </div>
</div>
</div>

<!-----Modal 2 for edti-->
<div class="modal fade" id="staticBackdropEdit" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabelEdit" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Renouvelle la souscription<img width="100" src="{{  asset('images/software.jpg') }}" alt="" srcset=""></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		  </button>
            </div>
            <div class="modal-body">
                <div class="modal-body">
                    <div>
                        <div class="tab">
                            <button class="tablinks" onclick="openSubscription(event, 'renewSubs')">Renouveller Souscription</button>
                            <button class="tablinks" onclick="openSubscription(event, 'payement')">Continuer Payement</button>
                        </div>
                    </div>
                    <div id="renewSubs" class="tabcontent">
                        <form class="text-left" action="/updatesubscription" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <input type="hidden" id="id_subscription" name="id_subscription" class="form-control p-4" required placeholder="date of the software">
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="date_exp" class="text-black">Date expiration</label>
                                        <input type="date" id="date_expiration" name="date_fin" class="form-control p-4" required placeholder="date of the software">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="date_exp" class="text-black">Montant payé</label>
                                        <input type="number" id="Mpaye" name="Mpaye" class="form-control p-4" required placeholder="Entrez le montant payé">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Nouveau</button>
                            </div>
                    </div>

                    </form>
                    <div id="payement" class="tabcontent">
                        <form class="text-left" action="/updatepayement" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <input type="hidden" id="id_montant" name="id_subscription" class="form-control p-4" required placeholder="date of the software">
                            </div>
                            <div class="form-group">
                                <input type="hidden" id="a_payer" name="a_payer" class="form-control p-4" required placeholder="date of the software">
                            </div>
                            <div class="">
                                <div class="form-group">
                                    <label for="Montant" class="text-black">Nouveau Montant</label>
                                    <input type="text" id="montant_paye" name="montant" class="form-control p-4" required placeholder="entrez le nouveu montant">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-block btn-primary">Enregistrer</button>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
</div>

<style>
    .page {
        margin: 1em auto;
        max-width: 768px;
        display: flex;
        align-items: flex-start;
        flex-wrap: wrap;
        height: 100%;
    }
    
    .box {
        padding: 0.5em;
        width: 100%;
        margin: 0.5em;
    }
    
    .box-2 {
        padding: 0.5em;
        width: calc(100%/2 - 1em);
    }
    
    .options label,
    .options input {
        width: 4em;
        padding: 0.5em 1em;
    }
    
    .btn {
        padding: 0.5em 1em;
        text-decoration: none;
        margin: 0.8em 0.3em;
        display: inline-block;
        cursor: pointer;
    }
    
    .hide {
        display: none;
    }
    
    img {
        max-width: 100%;
    }
</style>


<script>
    $(document).ready(function() {
        $(".jsTableBody tr").each(function() {
            col1 = $(this).find('.col1').text();
            col2 = $(this).find('.col2').text();
            subtract = parseInt(col1) - parseInt(col2);
			if(subtract <0){
			    subtract =0;
			}
            $(this).find(".subtract").html(subtract);
        })
    })
</script>

<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
</script>

<script>
    $(document).on('click', '#edit', function() {
        var _this = $(this).parents('tr');
        $('#id_subscription').val(_this.find('#id_subs').text());
        $('#id_montant').val(_this.find('#id_subs').text());
        $('#a_payer').val(_this.find('#montant').text());
    });
    /*a revoir */
    $(document).ready(function() {
        var a_payer = parseInt($("#a_payer").val());
        var payer = parseInt($('#montant_paye'))
        $('#montant_paye').keyup(function() {
            if (payer > a_payer) {
                alert('sdsdsdsdssd');
            }
        });
    })
/*
	$(document).ready(function(){
	 $("td").hover(function(){
		 $('.notify').css('background-color', 'blue')
	 })
	 $("td").mouseout(function(){
		 $('.notify').css('background-color', '')
	 })	
	
	})
*/
    $(document).ready(function() {
        $('#payement').hide();
    })

    function openSubscription(evt, subscriptionvalue) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(subscriptionvalue).style.display = "block";
        evt.currentTarget.className += " active";
        $('.tablinks').click(function() {
            $('.tablinks').css('color', 'white');
        });
    }
</script>



@endsection