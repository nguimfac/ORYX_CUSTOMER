@extends('layouts.app') @section('content')

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> {{View::make('vue.links')}}
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
    

<div class="container-fluid mb-4">
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
								<li class="active">
                                    <a href="{{url('sav/')}}" class="sav"><i class="fa fa-file-archive-o"></i>Service Apres vente<span>3</span></a>
                                </li>
                                <li class="">
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
                        <div class="row">
                            <div class="col-md-7">
                                <form action="saveintervention" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        @foreach($intervent as $intervents)
                                        <input type="hidden" name="id_reclammation" value="{{$intervents->reclammation_id}}" class="form-control shadow-lg p-3 mb-5 bg-white rounded p-4 " name="reclammation_id" id="reclammation">
                                    </div>
                                    <div class="form-group">
                                        <label for="email" class="text-black"> RECLAMMATION <i class="fa fa-exclamation-circle" aria-hidden="true"></i> <span class="text-primary"> : {{$intervents->titre_rec}} du client <strong style="text-decoration: underline;">{{$intervents->nom}}</strong></span></label>
                                    </div>
                                    @endforeach

                                    <div class="form-group">
                                        <label for="email">Tache effectuée</label>
                                        <textarea name="tache" required class="form-control shadow-lg p-3 mb-5 bg-white rounded" id="tache"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Cout</label>
                                        <input type="number" class="form-control shadow-lg p-3 mb-5 bg-white rounded p-4 " name="cout" id="cout">
                                    </div>

                                    <label for="email" class="text-black">Est-elle effective</label><br>
                                    <div class="row ">
                                        <div class="col-md-2 ">
                                            <span class="ml-3">Oui</span><br><input class="ml-4" required id="method1" type="radio" value="1" name="reponse">
                                        </div>
                                        <div class="col-md-3">
                                            <span class="ml-4">Non<br></span><input type="radio" required id="NPmethod" class="ml-4" value="0" name="reponse"><br>
                                        </div>
                                    </div><br>

                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Choisissez Les agents intervenants</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                                </div>

                                                <script>
                                                    $(document).ready(function() {
                                                        $("#myInput").on("keyup", function() {
                                                            var value = $(this).val().toLowerCase();
                                                            $("#myTable3 tr").filter(function() {
                                                                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                                                            });
                                                        });
                                                    });
                                                </script>

                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text " id="basic-addon1"> <li class="c-white fa fa-search"></li></span>
                                                            </div>
                                                            <input type="text" id="myInput" class="form-control" placeholder="Recherchez un agent" aria-label="Username" aria-describedby="basic-addon1">
                                                        </div>

                                                        <table class="table table-striped table-borderless">
                                                            <thead>
                                                                <tr>
                                                                    <td>Agent</td>
                                                                    <td>Action</td>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="myTable3">
                                                                @foreach ($users as $user)
                                                                <tr>
                                                                   @if ($user->is_admin==0 || $user->is_admin==4 && $user->name!="aucun")
                                                                   <td>{{$user->name}}</td>
                                                                   <td><label><input  type="checkbox" name="agent[]" value="{{$user->name}}"></label><br></td>
                                                               
                                                                   @endif
                                                                </tr>

                                                                @endforeach

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Enregistrer l'intervention</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#exampleModal" class=" btn btn-primary btn-block">Choisissez des agents</button>

                                    </div>
                                </form>

                            </div>
                            <div class="col-md-5">
                                <img class="offset-md-2 offset-md-2 offset-sm-2  mt-4" src="{{asset('images/view2.png')}}" alt=""><br><br>
                                <span class="mr-4 btn btn-dark" id="interventionView">Afficher les interventions pour ce probleme  <i class="fa fa-arrow-circle-down" aria-hidden="true"></i>
                            </span>
                            </div>

                            @if ($interv_info->isNotEmpty())
                            <div id="showIntervention" class="col-md-12 w-100">
                                <hr>
                                <table id="myTable" class=" table table-striped table-borderless table-responsive-sm">
                                    <thead class="bg-dark text-white">
                                        <tr>
                                            <td>id</td>
                                            <td>Tache effectuée</td>
                                            <td>Cout Engendré</td>
                                            <td>Agent intervenue</td>
                                            <td>Date intervention</td>
                                            <td>Action</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($interv_info as $info)
                                        <tr>
                                            <td>{{$info->id}}</td>
                                            <td>{{$info->tache}}</td>
                                            <td>{{$info->cout}}fcfa</td>
                                            <td>
                                                @foreach($info->intervenant as $value) {{$value}}, @endforeach
                                            </td>
                                            <td>{{$info->created_at}}</td>
                                            <td>
                                                <li class="list-inline-item">
                                                    <form method="get" action="/deleteintervention/{{$info->id}}">
                                                        @csrf
                                                        <input name="_method" type="hidden" value="DELETE">
                                                        <a type="submit" data-placement="top" title="Delete show_confirm " class="delete show_confirm btn btn-danger " href="">
                                                            <i class="fa fa-trash"></i>
                                                        </a>
                                                    </form>
                                                </li>
                                            </td>
                                        </tr>
                                        @endforeach

                                    </tbody><br>
                                </table><br><br>
                                <span class="float-right">Total des depenses effectuée pour cette reclammation <strong class="text-primary">{{$depense}} fcfa</strong></span>

                            </div>

                            @else
                            <div class="w-100 offset-md-4"><br><br><br>
                                <span class=" float-left alert-success p-4">Il y'a pas eu d'intervention  pour cette reclammation<strong class="text-primary"></strong></span>

                            </div>
                            @endif
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

<script>
    $(document).ready(function() {

        $('#client_name').keyup(function() {
            var query = $(this).val();
            if (query != '') {
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{ route('sav.fetch') }}",
                    method: "POST",
                    data: {
                        query: query,
                        _token: _token
                    },
                    success: function(data) {
                        $('#clientList').fadeIn();
                        $('#clientList').html(data);
                    }
                });
            } else {
                $('#clientList').fadeOut();

            }
        });

        $(document).on('click', 'li', function() {
            $('#client_name').val($(this).text());
            $('#clientList').fadeOut();
        });
    });
</script>
<!------Modal 1 for save------>




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
        $('#myTable').DataTable();
    });

    $(document).ready(function() {
        $('#showIntervention').hide();
        $('#interventionView').click(function() {
            $('#showIntervention').fadeIn();
        })

    })
</script>
<!--
<script>
    $(document).on('click', '#edit', function() {
        var _this = $(this).parents('tr');
        $('#id_reclammation').val(_this.find('#id_reclam').text());
        $('#contain_reclammation').val(_this.find('#contain_reclam').text());
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
</script>!-->



@endsection