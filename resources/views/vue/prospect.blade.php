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
                                              <li data-name="activity" class="drop-down__item"><a href="{{url('peyement')}}" class="bg-white"></a> <span class="fa fa-money"></span>  Payement</li>
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

                        <style>
              @media (max-width: 1026px) {
                #notdisplayed { display: none; }

            }    </style>
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

                                <div class="col-md-8 mt-4">
                                    <strong>LISTE DE PROSPECT </strong><br>
                                    <div class="p-0">
                                    </div>
                                </div>
                                <div class="col-md-2 offset-md-12 mr-4 col-xs-6 col-sm-6">
                                    <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#staticBackdrop"> New Prospect <i class="fa fa-plus-square" aria-hidden="true"></i></button>
                                </div>
                            </div>
                        </h3>

                        <div>
                            <table id="myTable" class="table-responsive table table-striped table-hover table-borderless">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th scope="col">Numero</th>
                                        <th scope="col">Nom</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Adress </th>
                                        <th scope="col"> Telephone</th>
                                        <th scope="col"> ville</th>
                                        <th scope="col">Logiciel</th>
                                        <th scope="col">Code postal</th>
                                        <th scope="col text-left">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="jsTableBody">
                                    @foreach ($prospects as $propection)
                                    <tr>
                                        <td class="font p-3" id="id_pros">{{$propection->client_id}}</td>
                                        <td class="font p-3" id="nom_client">{{$propection->nom}}</td>
                                        <td class="font p-3 ">{{$propection->email}}</td>
                                        <td class="font p-3 col1" id="montant">{{$propection->address}}</td>
                                        <td class="font p-3 col2">{{$propection->telephone}}</td>
                                        <td class="font w">{{$propection->ville}}</td>
                                        <td class="font p-3"  id="id_logiciel">{{$propection->titre}}</td>
                                        <td class="font w">{{$propection->code_postal}}</td>
                                            <td class="action" data-title="Action">
                                                <div class="">
                                                    <ul class="list-inline justify-content-center">
                                                       
                                                        <li class="list-inline-item">
                                                            <a id="edit" data-placement="top" type="button" data-toggle="modal" data-target="#staticBackdropEdit" title="Edit" class="edit">
                                                                <i class="fa fa-refresh"></i>
                                                            </a>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <form method="get" action="deleteprospect/{{$propection->client_id}}">
                                                                @csrf
                                                                <input name="_method" type="hidden" value="DELETE">
                                                                <a type="submit" data-placement="top" title="Delete show_confirm " class="delete show_confirm" href="">
                                                                    <i class="fa fa-trash"></i>
                                                                </a>
                                                            </form>
                                                        </li>

                                                        
                                                        <li class="list-inline-item">
                                                            <a id="souscrire" data-placement="top" type="button" data-toggle="modal" data-target="#staticBackdropLabelSubs" title="creer une souscrition" class="view">
                                                                <i class="fa fa-plus-circle"></i>
                                                            </a>
                                                        </li> 
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
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

                </div>
            </div>
            <!-- Row End -->
        </div>
        <!-- Container End -->
    </section>
</div>

<!------Modal 1 for save------>

<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-md  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Nouveau Prospect <img width="80" src="{{  asset('images/userimg.png') }}" alt="" srcset=""></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
            </div>
            <div class="modal-body">
                <form action="/newprospect" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="nom" class="text-black">Nom du client</label>
                                <input type="text" name="nom_client" class="form-control p-4" required placeholder="Name of the client">
                            </div>

                            
                            <div class="form-group">
                                <label for="ville" class="">Ville</label>
                                <input type="text" list="city" class="form-control p-4" name="ville_client">
                                <datalist id="city">
                                    <option value="Douala">
                                    <option value="Yaoundé">
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
                                <input type="number" name="telephone_client" class="form-control p-4" placeholder="telephone du client">
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
                                <input type="text" name="codepostal_client" class="form-control p-4" placeholder="code postal du client">
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


<div class="modal fade" id="staticBackdropLabelSubs" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabelSubs" aria-hidden="true">
    <div class="modal-dialog modal-md  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"> Creez une souscription pour le client <label class="text-black text-uppercase" style="font-size:20px" for="client_name" id="client"></label> <img width="80" src="{{  asset('images/userimg.png') }}" alt="" srcset=""></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
            </div>
            <div class="modal-body">
                <form action="/prospect_to_client_subscrip" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <input type="hidden" id="id_prospects"  name="id_prospects" class="form-control p-4" placeholder="">
                            <div class="form-group">
                                <label for="nom" class="text-black">Nom du client</label>
                                <input type="text" id="client_nom" readonly name="nom_client" class="form-control p-4" required placeholder="Name of the client">
                            </div>                          

                            <div class="form-group">
                                <div class="form-group">
                                    <label for="nom" class="text-black">Logiciel choisi</label>
                                    <input type="text" id="logiciel_id"  readonly   name="logiciel_id" class="form-control p-4" required placeholder="Nom du logiciel">
                                </div>
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
                <button type="submit" class="btn btn-primary">ajouter</button>
            </div>
            </form>
        </div>

    </div>
</div>

<!-----Modal 2 for edti-->
<div class="modal fade" id="staticBackdropEdit" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabelEdit" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Creez un autre montant pour proforma<img width="100" src="{{  asset('images/software.jpg') }}" alt="" srcset=""></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		  </button>
            </div>
            <form action="printproformainvoice" method="post">
                @csrf  
                <div class="modal-body">

                    <div class="form-group">
                     <div class="row">
                         <div class="col-md-6"> 
                             <input type="text" list="browsers" name="nombre" class="form-control p-4" placeholder="periode">
                            <datalist id="browsers">
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
                      <input type="hidden"  class="form-control" placeholder="" name="id_prospect" id="id_propect">
                    </div>
    
                 <div class="form-group">
                     <label for="montant">Montant de la proforma</label>
                     <input type="text" required class="form-control p-4" id="montant" placeholder="entrez le montant" name="montant">
                 </div>
                 <button type="submit" id="prof" class="btn btn-primary btn-block"  > <li class="fa fa-print"></li> imprimez</button>
<script>
  $(document).ready(function() {
    $('#prof').click(function(){
            ('#staticBackdropEdit').hide();
        })
  })
</script>

                </div> 
            </form>
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
        $('#id_propect').val(_this.find('#id_pros').text());
       // $('#id_montant').val(_this.find('#id_subs').text());
        //$('#a_payer').val(_this.find('#montant').text());
    });

    $(document).on('click', '#souscrire', function() {
        var _this = $(this).parents('tr');
        $('#id_prospects').val(_this.find('#id_pros').text());
        $('#client_nom').val(_this.find('#nom_client').text());
        $('#logiciel_id').val(_this.find('#id_logiciel').text());
        $value = _this.find('#nom_client').text()
        $('#client').text($value);
       // $('#id_montant').val(_this.find('#id_subs').text());
        //$('#a_payer').val(_this.find('#montant').text());
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

<script>
                               
    function envoi(value) 
    {
  
        if($("#NPmethod").is(':checked')){
           $('#paye').val(0)
        } else {
            var p = parseInt(document.getElementById('montant_p').value);
            document.getElementById('paye').value =p        }
    }
</script>


@endsection