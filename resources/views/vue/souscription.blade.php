@extends('layouts.app') @section('content')

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<style>
    @media (max-width: 1026px) {
      #notdisplayed { display: none; }

  }    </style>

<script>
$(document).ready(function(){
  $('#dropDown').click(function(event){
    $('.drop-down').toggleClass('drop-down--active');
    event.stopPropagation();
  });
  $(document).click(function(event) {
    	if (!$(event.target).hasClass('drop-down--active')) {
      		$(".drop-down").removeClass("drop-down--active");
    	}
  	});
});


  $(function() {
    $('.change').append('2')
      $('.souscription').click(function() {
       $('.change').text('-')
      })
  })
</script>


<div class="container-fluid">
    <section class="dashboard section">
        <!-- Container Start -->
        <div class="container-fluid">
            <!-- Row Start -->
            <div class="row">
                <div class="col-lg-3">
                    <div class="sidebar">

                        <div class="widget user-dashboard-menu">
                            <ul class="menu-vertical">
                                <li class="">
                                    <a href="{{url('software/')}}" class="logiciel"><i class="fa fa-desktop "></i> LOGICIELS <span>1</span></a></li>
                                <li class="active">
                                <div class="dropD">
                                        <div class="drop-down">
                                          <div id="dropDown" class="drop-down__button">
                                            <a href="#" class="souscription"><i class="fa fa-bookmark-o"></i> Souscription<span class="change"></span></a>
                                        </div>
                                          <div class="drop-down__menu-box">
                                            <ul class="drop-down__menu">
                                              <li data-name="profile" class="drop-down__item text-black"> <a class="bg-white text-black" href="{{url('prospect')}}"></a> <span class="fa fa-user"></span>  Prospect </li>
                                              <li data-name="dashboard" class="drop-down__item">  <a href="{{url('souscription')}}" class="bg-white"></a>   <span class="fa fa-user-o"></span>  Client </li>
                                              <li data-name="dashboard" class="drop-down__item">  <a href="{{url('commercial')}}" class="bg-white"></a>   <span class="fa fa-users"></span>  Commercial </li>

                                            </ul>
                                          </div>
                                        </div>
                                      </div> 
                                </li>
								<li class="">
                                    <a href="{{url('sav/')}}" class="sav"><i class="fa fa-file-archive-o"></i>Service Apres vente<span>3</span></a>
                                </li>
                                <li class="">
                                    <a href="{{url('user/')}}" class="sav"><i class="fa fa-user-circle"></i>User<span>4</span></a>
                                </li>
                            </ul>
                        </div>
                        <!-- User Widget -->
                        <div class="widget user-dashboard-profile" id="notdisplayed">
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
                        <h3 class="widget-header">
                            <div class="row">
                                <div class="col-md-3  mt-4">
                                    <strong>SOUSCRIPTIONS REALISEES</strong><br>
                                    <div class="p-0">
                                    </div>
                                </div>

                                <div class="col-md-3 col-lg-2">
                                    <a class="btn btn-success " type="button" href="/sendmail"> Notifier vos clients <i class="fa fa-bell" aria-hidden="true"></i></a>
                                </div>

                                <div class="col-md-3  col-lg-2">
                                    <a class="btn btn-primary text-white ml-5" type="button" data-toggle="modal" data-target="#staticBackdrop"> Creer un client <i class="fa fa-user" aria-hidden="true"></i></a>
                                </div>
                                
                                <div class="col-md-3 col-lg-2">
                                        <a class="btn btn-secondary ml-5 text-white" type="button" data-toggle="modal" data-target="#staticBackdropexisting"> Souscription <i class="fa fa-plus-square" aria-hidden="true"></i></a>
                                </div>


                        <!--
                                <div class="col-md-2 col-xs-6 col-sm-6">
                                    <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#staticBackdrop"> Souscription <i class="fa fa-plus-square" aria-hidden="true"></i></button>
                                </div>
                                 --->

                                
                            </div>
                        </h3>
          




<div class="modal fade" id="staticBackdropexisting" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Enregistrer subscription existante <img width="80" src="{{  asset('images/subscription.png') }}" alt="" srcset=""></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
            </div>
            <div class="modal-body">
                <form action="/newsouscription" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                      
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nom" class="text-black">Nom du client</label>
                                <input type="text" name="nom_client" class="form-control p-4" required placeholder="Name of the client">
                            </div>

                            <div class="form-group">
                                <label for="civilite" class="text-black">Civilit??</label>
                                <input type="text" name="civilite_client" class="form-control p-4" required placeholder="Civilit??">
                            </div>

                            <div class="form-group">
                                <label for="email" class="text-black">Email</label>
                                <input type="email" name="email_client" class="form-control p-4" required placeholder="email du client">
                            </div>


                            <div class="form-group">
                                <label for="address" class="text-black">Address</label>
                                <input type="text" name="address_client" class="form-control p-4" required placeholder="address du client">
                            </div>

                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="address" class="text-black">Code Postal</label>
                                <input type="text" name="codepostal_client" class="form-control p-4" placeholder="code postal du client">
                            </div>

                            <div class="form-group">
                                <label for="address" class="text-black">Montant du forfait</label>
                                <input type="text" required id="valmontant_p" onkeyup="envoidata(this.value)"  name="montant_p" class="form-control p-4" placeholder="Entrez le montant ?? payer">
                            </div>

                           

                            <div class="form-group">
                                <label for="logiciel" class="text-black">Logiciel</label>
                                <select type="text" name="logiciel" class="form-control  text-black" style="height:46px">
								@foreach ($logiciel as $logiciels)
								<option value="{{$logiciels->id}}">{{$logiciels->titre}}</option>
								@endforeach
							</select>
                            </div>
                            <div class="form-group ">
                                <label for="date_fin" class="text-black">Date fin</label>
                                <input type="date" name="date_fin" class="form-control p-4" required>
                            </div>
                            
                        </div>

                        

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="ville" class="">Ville</label>
                                <input type="text" required list="browsers" class="form-control p-4" name="ville_client">
                                <datalist id="browsers">
									<option value="Douala">
									<option value="Yaound??">
									<option value="Limbe">
									<option value="Edea">
									<option value="Kribi">
									<option value="Dschand">
							</datalist>
                            </div>

                            <div class="form-group">
                                <label for="address" class="text-black">Telephone</label>
                                <input type="number" required name="telephone_client" class="form-control p-4" placeholder="telephone du client">
                            </div>
                            <div class="form-group">
                                <label for="commercial" class="text-black">Commercial encharg??</label>
                                <select name="commercial_id" required id="commercial_id" class="form-control " style="height:46px">
                                    <option value="">Pas de commercial concern??</option>
                                  @foreach ($commercial as $c )
                                     @if ($c->name !="aucun")
                                     <option value="{{$c->id}}">{{$c->name}}</option>
                                     @endif
                                  @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12 ml-3">
                          <div class="row" >
                                <fieldset class="fieldset_color_red">
                                     <legend class="legend_color_red"> Methode</legend>
                                    <div class="col-md-12 col-12">
                                        <div class="row ">
                                            <div class="col-md-2">
                                                <span>Orange money</span><br><input class="ml-4" id="methods1" type="radio" value="OM" name="type_payement">
                                            </div>
                
                                            <div class="col-md-2">
                                                <span>Mtn money<br></span><input type="radio" id="methods2" class="ml-4" value="MM" name="type_payement"><br>
                                            </div>
                                            
                                    
                                            <div class="col-md-2">
                                                <br><span>Cash</span><input type="radio" id="cashs" class="ml-4" value="CASH" name="type_payement"><br>
                                            </div>
                                            <div class="col-md-2">
                                                <br><span>virement</span><input type="radio" id="methods3" value="V" class="ml-4" name="type_payement"><br>
                                            </div>
                                            <div class="col-md-2">
                                                <span>Non pay??<br></span><input type="radio" id="NPmethods" class="ml-4" value="NP" name="type_payement"><br>
                                            </div> 
                                        
                                    </div>
                                </div>
                            </fieldset>

                            </div>
                        </div>

<style>
  legend {
    float: none;
    position: absolute;
    display: block;
    margin: 0 100% 10px 13px;
    padding: 3px 9px;
    width: auto !important;
    /* background: #f5f5f5; */
    /* border-right: 1px solid #ddd; */
    border-bottom: 1px solid #ddd;
    border-radius: 5px 5px 0px 0;
    font-size: 12px;
    color: #999;
    top: 3px;
  }

  .fieldset_color_red {
    border-color: rgb(64, 110, 196) !important;
  }

  .legend_color_red {
    background-color: rgb(64, 110, 196);
    color: white;
    border-color: rgb(64, 110, 196);
  }

  fieldset {
    border: 1px solid #ddd;
    border-radius: 5px;
    padding: 0;
    background-color: transparent;
    margin-top: 28px;
  }
</style>
                    </div>

                    <div i class="form-group payeform mt-4">
                        <label for="date_fin" class="text-black">Somme  pay??</label>
                        <input type="number"  id="valpaye" name="paye" class="form-control p-4">
                    </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
            </form>
        </div>

    </div>
</div>
















                        
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-md  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Nouveau Client <img width="80" src="{{  asset('images/userimg.png') }}" alt="" srcset=""></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
            </div>
            <div class="modal-body">
                <form action="newclient" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="nom" class="text-black">Nom du client</label>
                                <input type="text" value="{{old('nom_client')}}"  name="nom_client" class="form-control p-4" required placeholder="Name of the client">
                            </div>

                            
                            <div class="form-group">
                                <label for="ville" class="">Ville</label>
                                <input type="text" value="{{old('ville_client')}}" list="city" class="form-control p-4" name="ville_client">
                                <datalist id="city">
                                    <option value="Douala">
                                    <option value="Yaound??">
                                    <option value="Bafousssam">
                                    <option value="Dschang">
                                    <option value="Edea">
                                    <option value="Limbe">
                                    <option value="Kribi"> 
                                    <option value="Bamenda">
                                    <option value="Kumba">
                            </datalist>
                            </div>
 
                            <div class="form-group">
                                <label for="address" class="text-black">Telephone</label>
                                <input type="number" required    name="telephone_client" class="form-control p-4" placeholder="telephone du client">
                            </div>

                            <div class="form-group">
                                <label for="logiciel" class="text-black">Logiciel</label>
                                <select type="text" name="logiciel_id" class="form-control  text-black" style="height:46px">
								 @foreach ($logiciel as $log)
                                     <option value="{{$log->id}}">{{$log->titre}}</option>
                                 @endforeach
							</select>
                            </div>

                      
                        
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address" class="text-black">Code Postal</label>
                                <input type="text" required value="{{old('codepostal_client')}}" name="codepostal_client" class="form-control p-4" placeholder="code postal du client">
                            </div>

                            
                           
                            <div class="form-group">
                                <label for="civilite" class="text-black">Civilit??</label>
                                <input type="text" value="{{old('civilite_client')}}" name="civilite_client" class="form-control p-4" required placeholder="Civilit??">
                            </div>

                            <div class="form-group">
                                <label for="email" class="text-black">Email</label>
                                <input type="email"value="{{old('email_client')}}"  name="email_client" class="form-control p-4" required placeholder="email du client">
                            </div>


                            <div class="form-group">
                                <label for="address" class="text-black">Address</label>
                                <input type="text" value="{{old('address_client')}}" name="address_client" class="form-control p-4" required placeholder="address du client">
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
                                    $('#paye').val(0)
                                    $(".payeform").hide();
                                })
                            })
                        </script>


                    </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                <button type="submit" class="btn btn-primary">Nouveau</button>
            </div>
            </form>
        </div>

    </div>
</div>



                        <div>
                            <table id="myTable" id="tableOne"  class=" table-responsive  table table-striped table-hover table-borderless">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th  scope="col">Commercial Concern??</th>
                                        <th hidden scope="col">Numero</th>
                                        <th hidden scope="col">id_client</th>
                                        <th scope="col">Client</th>
                                        <th scope="col">Logiciel</th>
                                        <th scope="col">Montant </th>
                                        <th scope="col">Tel Client </th>
                                        <th scope="col"> Pay??s</th>
                                        <th scope="col"> Date payement</th>
                                        <th scope="col">Date deFin</th>
                                        <th scope="col">Mode Payement</th>
                                        <th scope="col">Solde</th>
                                        <th scope="col">status</th>
                                        <th scope="col text-left">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="jsTableBody">
                                    @foreach ($subscription as $subscriptions)
                                    <tr>
                                        <td class="font p-3">{{$subscriptions->name}}</td>
                                        <td hidden class="font p-3" id="id_subs">{{$subscriptions->subscription_id}}</td>
                                        <td hidden id="facture_id">{{$subscriptions->client_id}}</td>
                                        <td class="font p-3"  id="client_name">{{$subscriptions->client_name}}</td>
                                        <td class="font p-3 ">{{$subscriptions->logiciel_name}}</td>
                                        <td class="font p-3 col1" id="montant">{{$subscriptions->a_payer}}</td>
                                        <td class="font p-3 ">{{$subscriptions->telephone}}</td>                                       
                                         <td class="font p-3 col2">{{$subscriptions->payement}}</td>

                                        <td class="font w">
                                            @if ($subscriptions->date_debut==NULL)
                                                attente de payement... 
                                            @else
                                            {{$subscriptions->date_debut}}
                                            @endif
                                        </td>
                                        <td class="font">
                                            <?php 
												$datetime1 = date_create(date('y-m-d'));
												$datetime2 = date_create($subscriptions->date_fin);
												$interval = date_diff($datetime1, $datetime2);
												$val=$interval->format('%R%a');
												if($val<=5 && $subscriptions->date_fin!=null){
													echo '<div class="text-danger text-center">'.$subscriptions->date_fin.'<br>(expiration)</div>';
												 }elseif ($subscriptions->date_fin==null) {
                                                    echo 'attente de payement...';
                                                 }
                                                else{
												echo $subscriptions->date_fin;
												}
												//$val=$difference->d;
											?>
                                        </td>
                                        <td class="font p-3">@if($subscriptions->type_payement==NULL)
                                             attente de payement...
                                             @else
                                             {{$subscriptions->type_payement}}
                                        @endif
                                       
                                    </td>
                                        <td><span class="col4 font">{{$subscriptions->a_payer-$subscriptions->payement}}</span></td> </span></td>
                                        <td><span class="col3 font"></span></td>
                                        <td class="action" data-title="Action">
                                            <div class="">
                                                <ul class="list-inline justify-content-center">
                                                    @if ($subscriptions->date_debut!=Null)
                                                    <li class="list-inline-item">
                                                        <a data-toggle="tooltip" data-placement="top" title="Recu de payement" class="view" href="printinvoice/{{$subscriptions->subscription_id}}">
                                                            <i class="fa fa-print"></i>
                                                        </a>
                                                    </li>
                                                    @endif
                                                    <li class="list-inline-item">
                                                        <a id="edit" data-placement="top" type="button" data-toggle="modal" data-target="#staticBackdropEdit" title="Renouveller une souscrription/nouveau payement/continuer" class="edit">
                                                            <i class="fa fa-refresh"></i>
                                                        </a>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <form method="get" action="deletesouscription/{{$subscriptions->subscription_id}}">
                                                            @csrf
                                                            <input name="_method" type="hidden" value="DELETE">
                                                            <a type="submit" data-placement="top" title="Delete show_confirm " class="delete show_confirm" href="">
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                        </form>
                                                    </li>
													<li class="list-inline-item">
                                                        <a id="notify" data-placement="top" href="send_toclient/{{$subscriptions->client_id}}"  type="button"  title="Notifier le client pour son payement" class="view">
                                                            <i class="fa fa-bell"></i>
                                                        </a>
                                                    </li>

                                                   @if ($subscriptions->a_payer==NULL)
                                                   <li class="list-inline-item">
                                                    <a id="edit_facture" data-placement="top" type="button" data-toggle="modal" data-target="#staticBackdropEditFacture" title="Creer une facture" class="view">
                                                        <i class="fa fa-file-text-o"></i>
                                                    </a>
                                                </li>
                                                   @endif

                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <hr>
                          <!--  <div class="text-black ">Souscription realis??e <span class=" badge badge-primary">{{$number_subs}}</span> </div>!------>


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
                <h5 class="modal-title" id="staticBackdropLabel">Nouvelle subscription <img width="80" src="{{  asset('images/subscription.png') }}" alt="" srcset=""></h5>
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
                                <label for="nom" class="text-black">Nom du client</label>
                                <input type="text" name="nom_client" class="form-control p-4" required placeholder="Name of the client">
                            </div>

                            <div class="form-group">
                                <label for="civilite" class="text-black">Civilit??</label>
                                <input type="text" name="civilite_client" class="form-control p-4" required placeholder="Civilit??">
                            </div>

                            <div class="form-group">
                                <label for="email" class="text-black">Email</label>
                                <input type="email" name="email_client" class="form-control p-4" required placeholder="email du client">
                            </div>


                            <div class="form-group">
                                <label for="address" class="text-black">Address</label>
                                <input type="text" name="address_client" class="form-control p-4" required placeholder="address du client">
                            </div>

                            <div class="form-group">
                                <label for="ville" class="">Ville</label>
                                <input type="text" list="browsers" class="form-control p-4" name="ville_client">
                                <datalist id="browsers">
									<option value="Douala">
									<option value="Yaound??">
									<option value="Limbe">
		                            <option value="Kribi">										
                                    <option value="Edea">
							<option value="Dschand">
							</datalist>
                            </div>

                            <div class="form-group">
                                <label for="address" class="text-black">Telephone</label>
                                <input type="number" name="telephone_client" class="form-control p-4" placeholder="telephone du client">
                            </div>



                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address" class="text-black">Code Postal</label>
                                <input type="text" name="codepostal_client" class="form-control p-4" placeholder="code postal du client">
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
                                    $('#paye').val(0)
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


<div class="modal fade" id="staticBackdropEditFacture" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropEditFacture" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Creez un  montant pour la Facture<img width="100" src="{{  asset('images/software.jpg') }}" alt="" srcset=""></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		  </button>
            </div>
            <form action="printinvoice" method="post">
                @csrf  
                <div class="modal-body">
                    <label for="" class="offset-md-3 text-black text-uppercase"> Facture client <strong id="client_fact"> </strong></label>
                    <input type="" class="form-control" name="id_fact" id="fact_id">
                    <div class="form-group">
                     <div class="row">
                         <div class="col-md-6"> 
                             <input type="text" list="periode" name="nombre" required class="form-control p-4" placeholder="periode">
                             <datalist id="periode">
                                <option value="1">
                                <option value="2">
                                <option value="3">
                                <option value="4">
                                <option value="5">
                                <option value="6">
                                <option value="7"> 
                                <option value="8">
                                <option value="9">
                        </datalist>
                        </div>
                         <div class="col-md-6"><select name="date_fin" id="" class="form-control " style="height:46px"  placeholder="periode">
                            <option value="mois">Mensuel</option>   
                            <option value="ans">Annuel</option>  
                        </select> </div>
                     </div>
                    </div>

                    <div class="form-group" >
                      <input type="hidden"  class="form-control" placeholder="" name="id_prospect" id="id_facture">
                    </div>
    
                 <div class="form-group">
                     <label for="montant">Montant de la facture</label>
                     <input type="text" required class="form-control p-4" id="montant" placeholder="entrez le montant" name="montant">
                 </div>
                 <button type="submit" id="prof" class="btn btn-primary btn-block"  > <li class="fa fa-print"></li> imprimez</button>

                </div> 
            </form>
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
                            <button id="tab1" class="tablinks" onclick="openSubscription(event, 'renewSubs')">Renouveller Souscription <i class="fa fa-refresh" aria-hidden="true"></i>
                            </button>
                            <button id="tab2" class="tablinks" onclick="openSubscription(event, 'creerpayement')">Creer un Payement <i class="fa fa-money" aria-hidden="true"></i>
                            </button>
                            <button id="tab3" class="tablinks" onclick="openSubscription(event, 'payement')">Continuer Payement <i class="fa fa-wheelchair" aria-hidden="true"></i>
                            </button>

                        </div>
                    </div>
                    <div id="renewSubs" class="tabcontent">
                        <form class="text-left" action="/updatesubscription" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <input type="hidden" id="id_subscription" name="id_subscription" class="form-control p-4" required placeholder="">
                            </div>

                            <div class="form-group">
                                <input type="hidden" id="id_client_for_fac" name="id_client_for_fac" class="form-control p-4" required placeholder="">
                            </div>

                            <div class="form-group">
                                <label for="text-black" class="text-black text-center offset-md-3 text-uppercase">Actualiser la souscription Du client <strong class="renewsubs_client_name"></strong> </label>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="date_fin " class="text-black">Periode</label>
                                    <input type="number" list="number" id="nombrerenew" required name="nombre" class="form-control p-4" placeholder="periode">
                                    <datalist id="number">
                                        <option value="1">
                                        <option value="2">
                                        <option value="3">
                                        <option value="4">
                                        <option value="5">
                                        <option value="6">
                                        <option value="7"> 
                                        <option value="8">
                                        <option value="9">
                                </datalist>                                    
                            </div>
                                <div class="col-md-6">
                                    <label for="date_fin"  class="text-black">Mois/ans</label>
                                    <select name="date_fin" id="perioderenew" class="form-control " style="height:46px" id="">
                                        <option value="1">mensuelle</option>
                                        <option value="2">annuelle</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="">
                                <div class="form-group">
                                    <label for="date_exp" class="text-black">Renouveller le montant</label>
                                    <input type="number" id="newmont" name="newmont" class="form-control p-4" required placeholder="Entrez le montant pay??">
                                </div>
                            </div>
                               
<style>
    #fa{
        color: white;
    }
</style>

<script>
/ All buttons where id contains 'rbutton_'
const $buttons = $("button[id*='p']");

//Selected button onclick
$buttons.click(function() {
    $(this).prop('disabled', true); //disable clicked button
});
</script>
                             
                                
                                
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" id="renew" name="Print" value="Print"> <li class="fa fa-print" id="fa"></li>  Enregistrer</button>
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

                            <div class="form-group">
                                    <label for="Montant" class="text-black">Client Concern??</label>
                                    <input type="text" disabled id="client" name="client" class="form-control p-4">
                            </div>

                            <div class="">
                                <div class="form-group">
                                    <label for="Montant" class="text-black">Nouveau Montant</label>
                                    <input type="number" id="montant_paye" name="montant" class="form-control p-4" required placeholder="entrez le nouveau montant">
                                </div>
                            </div>

                            <div class="col-md-12 ml-3">
                                <div class="row" >
                                      <fieldset class="fieldset_color_red">
                                           <legend class="legend_color_red"> payement</legend>
                                          <div class="col-md-12 col-12">
                                            <div class="row ">
                                                <div class="col-md-2">
                                                    <span>Orange money</span><br><input required class="ml-4" id="" type="radio" value="OM" name="type_payement">
                                                </div>
                
                                                <div class="col-md-2">
                                                    <span>Mtn money<br></span><input required type="radio" id="" class="ml-4" value="MM" name="type_payement"><br>
                                                </div>
                                              
                                           
                                                <div class="col-md-2">
                                                   <br> <span>Cash<br></span><input required  type="radio" id="" class="ml-4" value="CASH" name="type_payement"><br>
                                                </div>
                                                <div class="col-md-2">
                                                    <br><span>virement</span><br><input required type="radio" id="" value="V" class="ml-4" name="type_payement"><br>
                                                </div>
                                            </div>
                                            
                                      </div>
                                  </fieldset>
            
                                  </div>
                              </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-block btn-primary">Enregistrer</button>
                            </div>
                        </form>
                    </div>

                    <div id="creerpayement" class="tabcontent">
                        <form class="text-left" id="form" action="{{url('makepayement')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <input type="hidden" id="id_payement" name="id_payement" class="form-control p-4" required placeholder="date of the software">
                            </div>
                            <label for="text-black" class="text-black text-center offset-md-4 text-uppercase"> Payement  du client <strong class="payement_client_name"></strong> </label>
                            
                                <script>
                                    $(document).ready(function() {
                                        $('#info').hide();
                                        $('#paye').keyup(function() {
                                           if(parseInt($(this).val())>parseInt($('#montant_p').val())){
                                                    $('#info').show();
                                                    $('#bout').attr("disabled",true);

                                        }else{
                                            $('#info').hide();
                                            $('#bout').attr("disabled",false);

                                        }
                                        })
                                    })
                                </script>

                            <div class="form-group">
                                <label for="address" class="text-black">Montant du forfait</label>
                                <input type="text" required id="montant_p" onkeyup="envoi(this.value)"  name="montant_paye" class="form-control p-4" placeholder="Entrez le montant ?? payer">
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="date_fin " class="text-black">Periode</label>
                                        <input type="number" id="nombremake" list="number" name="nombre" class="form-control p-4" placeholder="periode">
                                        <datalist id="number">
                                            <option value="1">
                                            <option value="2">
                                            <option value="3">
                                            <option value="4">
                                            <option value="5">
                                            <option value="6">
                                            <option value="7"> 
                                            <option value="8">
                                            <option value="9">
                                    </datalist>                                    
                                </div>
                                    <div class="col-md-6">
                                        <label for="date_fin"  class="text-black">Mois/ans</label>
                                        <select name="date_fin" id="periodemake" class="form-control " style="height:46px" id="">
                                            <option value="1">mensuelle</option>
                                            <option value="2">annuelle</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                                   
                   <div class="col-md-12 ml-3">
                    <div class="row" >
                          <fieldset class="fieldset_color_red">
                               <legend class="legend_color_red"> Methode</legend>
                              <div class="col-md-12 col-12">
                                <div class="row ">
                                    <div class="col-md-2">
                                        <span>Orange money</span><br><input required class="ml-4" id="method1" type="radio" value="OM" name="type_payement">
                                    </div>
    
                                    <div class="col-md-2">
                                        <span>Mtn money<br></span><input required type="radio" id="method2" class="ml-4" value="MM" name="type_payement"><br>
                                    </div>
                                    <div class="col-md-2">
                                        <span>Non pay??<br></span><input  type="radio" id="NPmethod" class="ml-4" value="NP" name="type_payement"><br>
                                    </div> 
                               
                                    <div class="col-md-2">
                                       <br> <span>Cash<br></span><input required  type="radio" id="cash" class="ml-4" value="CASH" name="type_payement"><br>
                                    </div>
                                    <div class="col-md-2">
                                        <br><span>virement</span><br><input required type="radio" id="method3" value="V" class="ml-4" name="type_payement"><br>
                                    </div>
                                </div>
                                
                          </div>
                      </fieldset>

                      </div>
                  </div>


                            <div i class="form-group payeform mt-4">
                                <label for="date_fin" class="text-black">Somme  pay??</label><br>
                                <label for="error" class="text-danger" id="info" style="font-size:12px">Vous etes en train d'entrer un montant superieure au montant ?? payer par ce client</label>

                                <input type="number" id="paye" required name="paye" class="form-control p-4">
                            </div>
                            <div class="modal-footer">
                                <button type="submit" id="bout" class="btn btn-block btn-primary">Enregistrer</button>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
</div>



<script>
    $(document).ready(function() {
        $(".jsTableBody tr").each(function() {
            col1 = $(this).find('.col1').text();
            col2 = $(this).find('.col2').text();
            col4 = $(this).find('.col4').text();
            subtract = parseInt(col1) - parseInt(col2);
			if(subtract <0){
			    subtract =0;
			}
          
           if(col4==0 && parseInt(col1)!=0  ){
            col3 = $(this).find('.col3').html('Fini');
           }else
           {
            col3 = $(this).find('.col3').html('Non Fini');
 
           }


            $(this).find(".subtract").html(subtract);
        })
    })
</script>

<script>
    $(document).ready(function() {

        $('#myTable').DataTable({
            "language": {
                "sEmptyTable":     "Aucune donn??e disponible dans le tableau",
                "sInfo":           "Affichage de l'??l??ment _START_ ?? _END_ sur _TOTAL_ ??l??ments",
                "sInfoEmpty":      "Affichage de l'??l??ment 0 ?? 0 sur 0 ??l??ment",
                "sInfoFiltered":   "(filtr?? ?? partir de _MAX_ ??l??ments au total)",
                "sInfoPostFix":    "",
                "sInfoThousands":  ",",
                "sLengthMenu":     "Afficher _MENU_ ??l??ments",
                "sLoadingRecords": "Chargement...",
                "sProcessing":     "Traitement...",
                "sSearch":         "Rechercher :",
                "sZeroRecords":    "Aucun ??l??ment correspondant trouv??",
                "oPaginate": {
                    "sFirst":    "Premier",
                    "sLast":     "Dernier",
                    "sNext":     "Suivant",
                    "sPrevious": "Pr??c??dent"
                },
                "oAria": {
                    "sSortAscending":  ": activer pour trier la colonne par ordre croissant",
                    "sSortDescending": ": activer pour trier la colonne par ordre d??croissant"
                },
                "select": {
                    "rows": {
                        "_": "%d lignes s??lectionn??es",
                        "0": "Aucune ligne s??lectionn??e",
                        "1": "1 ligne s??lectionn??e"
                    }
                }
            },
    } );    });
</script>


<script>

    $(document).ready(function() {
        $(".payeform").hide()
        $("#methods1").click(function() {
            $(".payeform").fadeIn(250);
        })
        $("#methods2").click(function() {
            $(".payeform").fadeIn(250);
        })
        $("#methods3").click(function() {
            $(".payeform").fadeIn(250);
        })
        $("#cashs").click(function() {
            $(".payeform").fadeIn(250);
        })
        $("#NPmethods").click(function() {
            $('#paye').val(0)
            $(".payeform").hide();
        })
    })
</script>


<script>
     $(document).on('click', '#edit_facture', function() {
        var _this = $(this).parents('tr');
        $('#id_facture').val(_this.find('#facture_id').text())
        $('#fact_id').val(_this.find('#id_subs').text())

        $('#client_fact').text(_this.find('#client_name').text())
    });
</script>

<script>
    $(document).on('click', '#edit', function() {
        var _this = $(this).parents('tr');
        $('#id_subscription').val(_this.find('#id_subs').text());
        $('#id_payement').val(_this.find('#id_subs').text());
        $('#id_montant').val(_this.find('#id_subs').text());
        $('#a_payer').val(_this.find('#montant').text());
        $('#montant_p').val(_this.find('#montant').text());
        $('#client').val(_this.find('#client_name').text());
        $('.payement_client_name').text(_this.find('#client_name').text())
        $('.renewsubs_client_name').text(_this.find('#client_name').text())
        $('#id_client_for_fac').val(_this.find('#facture_id').text())
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


    $(document).ready(function() {
        $('#renew').click(function() {
        $('#montant_p').val($('#newmont').val());
        $('#nombremake').val($('#nombrerenew').val());
        $('#periodemake ').val($('#perioderenew').val());
      })
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
        $('#payement').hide();creerpayement
        $('#creerpayement').hide();
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
       
    }
</script>


<script>

$(document).ready(function() {
    $('#tab1').click(function() {
     $('#tab2').css('color','black')
     $('#tab3').css('color','black')
     $(this).css('color','white')


    })
    $('#tab2').click(function() {
        $('#tab1').css('color','black')
     $('#tab3').css('color','black')
     $(this).css('color','white')
    })
    $('#tab3').click(function() {
        $('#tab2').css('color','black')
     $('#tab1').css('color','black')
     $(this).css('color','white')
    })

})

</script>

<script>
                               
    function envoi(value) 
    {
  
        if($("#NPmethod").is(':checked')){
           $('#paye').val(0)
        } else {
            var p = parseInt(document.getElementById('montant_p').value);
            document.getElementById('paye').value =p        }
    }

    function envoidata(value) 
    {
  
        if($("#NPmethod").is(':checked')){
           $('#valpaye').val(0)
        } else {
            var p = parseInt(document.getElementById('valmontant_p').value);
            document.getElementById('valpaye').value =p        }
    }
</script>

<script>
    $(document).ready(function() {


// inspired by http://jsfiddle.net/arunpjohny/564Lxosz/1/
$('.table-responsive-stack').each(function (i) {
var id = $(this).attr('id');
//alert(id);
$(this).find("th").each(function(i) {
$('#'+id + ' td:nth-child(' + (i + 1) + ')').prepend('<span class="table-responsive-stack-thead">'+             $(this).text() + ':</span> ');
$('.table-responsive-stack-thead').hide();

});



});





$( '.table-responsive-stack' ).each(function() {
var thCount = $(this).find("th").length; 
var rowGrow = 100 / thCount + '%';
//console.log(rowGrow);
$(this).find("th, td").css('flex-basis', rowGrow);   
});




function flexTable(){
if ($(window).width() < 768) {

$(".table-responsive-stack").each(function (i) {
$(this).find(".table-responsive-stack-thead").show();
$(this).find('thead').hide();
});


// window is less than 768px   
} else {


$(".table-responsive-stack").each(function (i) {
$(this).find(".table-responsive-stack-thead").hide();
$(this).find('thead').show();
});



}
// flextable   
}      

flexTable();

window.onresize = function(event) {
flexTable();
};






// document ready  
});

</script>




@endsection