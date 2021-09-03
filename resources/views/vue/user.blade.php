@extends('layouts.app') @section('content')

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

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
                            <ul>
                                <li class="">
                                    <a href="{{url('software/')}}" class="logiciel"><i class="fa fa-desktop "></i> LOGICIELS <span>1</span></a>
                                </li>

                                <li class="">
                                    <div class="dropD">
                                            <div class="drop-down">
                                              <div id="dropDown" class="drop-down__button">
                                                <a href="#" class="souscription"><i class="fa fa-bookmark-o"></i> Souscription<span class="change"></span></a>
                                            </div>
                                              <div class="drop-down__menu-box">
                                                <ul class="drop-down__menu">
                                                  <li data-name="profile" class="drop-down__item text-black"> <a class="bg-white text-black" href="{{url('prospect')}}"></a> <span class="fa fa-user"></span>  Prospect </li>
                                                  <li data-name="dashboard" class="drop-down__item">  <a href="{{url('souscription')}}" class="bg-white"></a>   <span class="fa fa-user-o"></span>  Client </li>
                                                  <li data-name="dashboard" class="drop-down__item">  <a href="{{url('commercial')}}" class="bg-white"></a>   <span class="fa fa-user-o"></span>  Commercial </li>

                                                </ul>
                                              </div>
                                            </div>
                                          </div> 
                                    </li>


								<li class="">
                                    <a href="{{url('sav/')}}" class="sav"><i class="fa fa-file-archive-o"></i>Service Apres vente<span>3</span></a>
                                </li>
                                <li class="active">
                                    <a href="{{url('user/')}}" class="sav"><i class="fa fa-user-circle"></i>User<span>4</span></a>
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
                            <img src="{{ asset ('images/userimg.png')}}" alt="100" width="150" srcset="">
                        </div>
                        <!-- Dashboard Links -->

                        <!-- delete-account modal -->
                        <!-- delete account popup modal start-->
                        <!-- Modal -->
                       
                        <!-- delete account popup modal end-->
                        <!-- delete-account modal -->

                    </div>
                </div>
                <div class="col-lg-9">
                    <!-- Recently Favorited -->
                    @if (Auth::check() && Auth::user()->is_admin == 1) 
                    
                    <div class="widget dashboard-container my-adslist">
                        <h3 class="widget-header">
                            <div class="row">
                                <div class="col-md-8 mt-4">
                                    <strong>Liste des Users</strong><br>
                                    <div class="p-0">
                                    </div>
                                </div>
                               <!-- <div class="col-md-4 offset-md-10">
                                    <button cl ass="btn btn-primary" type="button" data-toggle="modal" data-target="#staticBackdrop"> Add  User <i class="fa fa-user-circle" aria-hidden="true"></i></button>
                                </div>  !--->
                                
                            </div>
                        </h3>

                        <div>
                            <table id="myTable" class="table table-striped table-hover table-borderless table-responsive-sm">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th scope="col">Numero</th>
                                        <th scope="col">Nom</th>
                                        <th scope="col">email</th>
                                        <th scope="col">Role</th>
                                        <th scope="col text-left">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="jsTableBody">
                                    @foreach ($users as $user)
                                    <tr>
                                        @if ($user->is_admin!=0)
                                        <td id="userid">{{$user->id}}</td> 
                                        <td>{{$user->name}}</td> 
                                        <td>{{$user->email}}</td>
                                        <td>
                                            @if ($user->is_admin==1)
                                             Admin
                                            @elseif($user->is_admin==2)
                                             Utilisateur
                                             @elseif ($user->is_admin==3)
                                             en Attente de droits...
                                            @endif
                                            </td>
                                            <td class="action" data-title="Action">
                                                
                                            <div class="">
                                                <ul class="list-inline justify-content-center">
                                                    @if ($user->is_admin!=1 && $user->is_admin!=2)
                                                    <li class="list-inline-item">
                                                        <a id="edit" data-placement="top" type="button" data-toggle="modal" data-target="#staticBackdropEdit" title="Edit" class="edit">
                                                            <i class="fa fa-refresh"></i>
                                                        </a>
                                                    </li>
                                                    @endif
                                                  
                                                    <li class="list-inline-item">
                                                        <form method="get" action="deleteuser/{{$user->id}}">
                                                            @csrf
                                                            <input name="_method" type="hidden" value="DELETE">
                                                            <a type="submit" data-placement="top" title="Delete show_confirm " class="delete show_confirm" href="">
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                        </form>
                                                    </li>
                                                  
                                                    @if ($user->is_admin==2)
                                                    <li class="list-inline-item">
                                                        <a id="editdenied" data-placement="top" type="button" data-toggle="modal" data-target="#staticBackdropEditUser" title="Enlever les droits a cette utilisateur" class="edit">
                                                            <i class="fa fa-user-times"></i>
                                                        </a>
                                                      </li>
                                               @endif
													
                                                </ul>
                                            </div>
                                        </td>
                                            </td>
                                        @endif
                                    </tr> 
                                    @endforeach
                                   
                                </tbody>
                            </table>
                            <hr>
                          <!--  <div class="text-black ">Souscription realisée <span class=" badge badge-primary"></span> </div>!------>
                        </div>

                    </div>

                    <!-- pagination -->
                    <div class="pagination justify-content-center">
                        <nav aria-label="Page navigation example">
                        </nav>
                    </div>
                    <!-- pagination -->
                    @else
                    
                    <div class="widget dashboard-container my-adslist">

                     <div class="alert text-center alert-danger">
                        <i class="fa fa-exclamation-triangle fa-5x" aria-hidden="true"></i>
<br><br>
                         Desolé Vous avez pas les droits d'access a cette espace  
                     </div>
                     </div>
                    @endif

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
                                <label for="civilite" class="text-black">Civilité</label>
                                <input type="text" name="civilite_client" class="form-control p-4" required placeholder="Civilité">
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
									<option value="Yaoundé">
									<option value="Limbe">
									<option value="Edea">
									<option value="Kribi">
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

                            <div class="form-group">
                                <label for="logiciel" class="text-black">Logiciel</label>
                                <select type="text" name="logiciel" class="form-control  text-black" style="height:46px">
							
							</select>
                            </div>
                            <div class="form-group ">
                                <label for="date_fin" class="text-black">Date fin</label>
                                <input type="date" name="date_fin" class="form-control p-4" required>
                            </div>
                            <div class="row ">
                                <div class="col md-4 mt-4 ">
                                    <span>Orange money</span><br><input class="ml-4" id="method1" type="radio" value="OM" name="type_payement">
                                </div>

                                <div class="col-md-4 mt-4">
                                    <span>Mtn money<br></span><input type="radio" id="method2" class="ml-4" value="MM" name="type_payement"><br>
                                </div>
                                <div class="col-md-4 mt-4">
                                    <span>Non payé<br></span><input type="radio" id="NPmethod" class="ml-4" value="NP" name="type_payement"><br>
                                </div> 
                            </div><br>
							<div class="row">
								<div class="col-md-4 mt-4">
                                    <span>Cash<br></span><input type="radio" id="cash" class="ml-4" value="CASH" name="type_payement"><br>
                                </div>
                                <div class="col-md-4 mt-4">
                                    <span>virement</span><br><input type="radio" id="method3" value="V" class="ml-4" name="type_payement"><br>
                                </div>
							</div>
                            <div class="form-group payeform mt-4">
                                <label for="date_fin" class="text-black">Somme à payer</label>
                                <input type="number" name="paye" class="form-control p-4">
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
                <h5 class="modal-title" id="staticBackdropLabel">Attribution des droits d'access a d'autres utilisateurs<img width="100" src="{{  asset('images/software.jpg') }}" alt="" srcset=""></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		  </button>
            </div>
            <div class="modal-body">

             <form action="accessRight" method="post">
                 @csrf
                <div>
                    <input type="hidden" class="form-control" id="access" type="" name="userid">
                    Voulez-vous Autoriser un autre agent d'Oryx Consulting d'avoir les  droits d'utilisateurs sur cette application ?<br><br>
                        <div class="form-group">
                            <label for="nom"  class="text-black">Selectionnez l'état</label>
                            <select  name="etat"  required id="etat" class="form-control" style="height:46px">
                              <option value="1">Admin</option>
                              <option value="2">utilisateur</option>
                            </select>
                        </div>
                       
                            <br>
                            <hr>
                        <button class="btn btn-primary btn-block" type="submit">Terminer</button>    
                    <br>
                </div>
             </form>
            </div> 
        </div>

    </div>
</div>


<div class="modal fade" id="staticBackdropEditUser" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabelEdit" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Destruction des droits d'access pour cette  utilisateur<img width="100" src="{{  asset('images/software.jpg') }}" alt="" srcset=""></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		  </button>
            </div>
            <div class="modal-body">

             <form action="accessdenied" method="post">
                 @csrf
                <div>
                    <input type="hidden" class="form-control" id="accesdenied" type="" name="userid">
                    Voulez-vous enlever les droits d'utilisateur a cette utilsateur ?
             
                     <div class="row">
                      <div class="col-md-2"> <button type="submit" class="btn btn-primary">
                        Oui
                     </button>
                        
                    </div>
                      <div class="col-md-2">
                        <button type="form" data-dismiss="modal"  class="btn btn-danger">
                          Non
                        </button>
                      </div>
                     </div>
                    <br>
                </div>
             </form>
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
        $('#access').val(_this.find('#userid').text());

    });

    $(document).on('click', '#editdenied', function() {
        var _this = $(this).parents('tr');
        $('#accesdenied').val(_this.find('#userid').text());

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