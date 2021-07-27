@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<?php use Carbon\Carbon;
$current_date = date('y-m-d');
?>



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
							<li class="active">
								<a href="{{url('software/')}}" class=""><i class="fa fa-user "></i> LOGICIELS <span>1</span></a></li>
							<li>
								<a href="{{url('souscription/')}}"><i class="fa fa-bookmark-o"></i> Souscription<span>2</span></a>
							</li>
							<li>
								<a href="dashboard-archived-ads.html"><i class="fa fa-file-archive-o"></i>Service Apres vente<span>3</span></a>
							</li>
							<li>
								<a href="dashboard-pending-ads.html"><i class="fa fa-bolt"></i>User<span>4</span></a>
							</li>
							<li>
								<a href="index.html"><i class="fa fa-cog"></i> Logout</a>
							</li>
							<li>
								<a href="#!" data-toggle="modal" data-target="#deleteaccount"><i class="fa fa-power-off"></i>Delete Account</a>
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
<div class="modal fade" id="deleteaccount" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
  aria-hidden="true">
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
                               <strong>SUBSCRIPTION REALISE</strong><br>
							   <div  class="p-0" >
							</div>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-primary" type="button"  data-toggle="modal" data-target="#staticBackdrop"  > Souscription <i class="fa fa-plus-square" aria-hidden="true"></i></button>
                            </div>
							<div class="col-md-2">
                                <button class="btn btn-success" type="button"  data-toggle="modal" data-target="#staticBackdrop"  > Notification <i class="fa fa-bullhorn" aria-hidden="true"></i></button>
                            </div>
                        </div>
                    </h3>
					
					<div>
						<table id="myTable" class="table-responsive table table-striped table-hover table-borderless">
							<thead  class="bg-primary text-white">
								<tr>
								<th scope="col" >Numero</th>
								<th scope="col">Client</th>
								<th scope="col">Logiciel</th>
								<th scope="col">Frais </th>
								<th scope="col"> Payés</th>
								<th scope="col"> Debut</th>
								<th scope="col">D Fin</th>
								<th scope="col">Payement</th>
								<th >Reste</th>
								<th scope="col text-left">Action</th>
								</tr>
							</thead>
							<tbody class="jsTableBody">
								@foreach ($subscription as $subscriptions)
									<tr>
										<td class="font p-3" id="id_subs" >{{$subscriptions->subscription_id}}</td>
										<td class="font p-3">{{$subscriptions->client_name}}</td>
										<td class="font p-3 ">{{$subscriptions->logiciel_name}}</td>
										<td class="font p-3 col1" id="montant">{{$subscriptions->prix_logiciel}}</td>
										<td class="font p-3 col2" >{{$subscriptions->payement}}</td>
										<td class="font w" >{{$subscriptions->date_debut}}</td>
										<td class="font" >
											<?php $origin = new Datetime($subscriptions->date_fin);
												$target = new Datetime(date('y-m-d'));
												$difference = $target->diff($origin);
												$val=$difference->d;
												if($val<=5){
													echo '<div class="text-danger text-center">'.$subscriptions->date_fin.'<br>(expiration)</div>';
												}else{
												echo $subscriptions->date_fin;
												}
											?>
										</td>
											<td class="font p-3">{{$subscriptions->type_payement}}</td>
											<td><span class="subtract font"></span> </td>

											<td class="action" data-title="Action">
											<div class="">
												<ul class="list-inline justify-content-center">
													<li class="list-inline-item">
														<a data-toggle="tooltip" data-placement="top" title="View" class="view" href="category.html">
															<i class="fa fa-print"></i>
														</a>
													</li>
													<li class="list-inline-item">
														<a id="edit" data-placement="top" type="button"  data-toggle="modal" data-target="#staticBackdropEdit" title="Edit"  class="edit">
															<i class="fa fa-pencil"></i>
														</a>
													</li>
													<li class="list-inline-item">
														<form method="get" action="DeleteLogiciel/{{$subscriptions->subscription_id}}">
															@csrf
															<input name="_method" type="hidden" value="DELETE">
															<a type="submit"  data-placement="top" title="Delete show_confirm "  class="delete show_confirm" href="">
																<i class="fa fa-trash"></i>
															</a>
														</form>
													</li>
												</ul>
											</div>
										</td>
									</tr>
								@endforeach
							</tbody>
							</table>
							<hr>
							<div class="text-black " style="">Souscription realisée <span class=" badge badge-primary">{{$number_subs}}</span> </div>
                            
					
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
							<label for="civilite" class="text-black" >Civilité</label>
							<input type="text" name="civilite_client" class="form-control p-4"required  placeholder="Civilité">
						</div>
	
						<div class="form-group">   
							<label for="email" class="text-black" >Email</label>
							<input type="email" name="email_client" class="form-control p-4"required  placeholder="email du client">
						</div>
			   
						
						<div class="form-group">   
							<label for="address" class="text-black" >Address</label>
							<input type="text" name="address_client" class="form-control p-4" required  placeholder="address du client">
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
							<label for="address" class="text-black" >Telephone</label>
							<input type="number" name="telephone_client" class="form-control p-4"   placeholder="telephone du client">
						</div>
					   </div>
					   <div class="col-md-6">
						<div class="form-group">   
							<label for="address" class="text-black" >Code Postal</label>
							<input type="text" name="codepostal_client" class="form-control p-4"   placeholder="code postal du client">
						</div>
						
						<div class="form-group">   
							<label for="logiciel" class="text-black">Logiciel</label>
							<select type="text"  name="logiciel" class="form-control  text-black" style="height:46px" >
								@foreach ($logiciel as $logiciels)
								<option value="{{$logiciels->id}}">{{$logiciels->titre}}</option>
								@endforeach
							</select>
						</div>
						

						<div class="form-group ">   
							<label for="date_fin" class="text-black" >Date fin</label>
							<input type="date" name="date_fin" class="form-control p-4" required>
						</div>
								<div class="row " >
									<div class="col md-3 mt-4 ">
										<span>Orange money</span><br><input class="ml-4" id="method1" type="radio" value="OM"   name="type_payement" >
									</div>

									<div class="col-md-3 mt-4">
										<span>Mtn money<br></span><input type="radio"  id="method2" class="ml-4" value="MM"  name="type_payement"><br>
									</div>
									<div class="col-md-3 mt-4">
										<span>Non payé<br></span><input type="radio" id="NPmethod"  class="ml-4" value="NP"  name="type_payement" ><br>
									</div>

									<div class="col-md-3 mt-4">
									<span>virement</span><br><input type="radio"  id="method3" value="V" class="ml-4" name="type_payement" ><br>
									</div>
								</div>
								<div class="form-group payeform mt-4">   
									<label for="date_fin" class="text-black" >Somme à payer</label>
									<input type="number" name="paye" class="form-control p-4" required>
								</div>
								
							</div>

						<script>
							$(document).ready(function(){
                               $(".payeform").hide()
                               $("#method1").click(function(){
								   $(".payeform").fadeIn(250);
							   })
							   $("#method2").click(function(){
								$(".payeform").fadeIn(250);
							})
							$("#method3").click(function(){
								$(".payeform").fadeIn(250);
							})
							   $("#NPmethod").click(function(){
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
									<button class="tablinks" onclick="openSubscription(event, 'renewSubs')">Renouveller</button>
									<button class="tablinks" onclick="openSubscription(event, 'payement')">Payement</button>
								</div>
							</div>
							<div id="renewSubs" class="tabcontent">
								<form class="text-left" action="/updatesubscription" method="POST" enctype="multipart/form-data">
									@csrf
									<div class="form-group">   
										<input type="hidden"  id="id_subscription" name="id_subscription" class="form-control p-4" required  placeholder="date of the software">
									</div>
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">   
														<label for="date_exp"class="text-black" >Date debut</label>
														<input type="date"  id="date_debut" name="date_debut" class="form-control p-4" required  placeholder="date of the software">
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">   
														<label for="date_exp"class="text-black" >Date expiration</label>
														<input type="date"  id="date_expiration" name="date_fin" class="form-control p-4" required  placeholder="date of the software">
													</div>
												</div>
											</div>
											<div class="modal-footer">
												<button type="button"  class="btn btn-danger" data-dismiss="modal">Close</button>
												<button type="submit" class="btn btn-primary">Nouveau</button>
										</div>
										</div>	 
												
							   </form>
							   <div id="payement" class="tabcontent">
								<form class="text-left" action="/updatepayement" method="POST" enctype="multipart/form-data">
									@csrf
												<div class="form-group">   
													<input type="hidden"  id="id_montant" name="id_subscription" class="form-control p-4" required  placeholder="date of the software">
												</div>
												<div class="form-group">   
													<input type="hidden"  id="a_payer" name="a_payer" class="form-control p-4" required  placeholder="date of the software">
												</div>
												<div class="">
													<div class="form-group">   
														<label for="Montant" class="text-black" >Nouveau Montant</label>
														<input type="text"  id="montant_paye" name="montant" class="form-control p-4" required  placeholder="entrez le nouveu montant">
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
	margin:0.5em;
}

.box-2 {
	padding: 0.5em;
	width: calc(100%/2 - 1em);
}

.options label,
.options input{
	width:4em;
	padding:0.5em 1em;
}
.btn{
	
	padding: 0.5em 1em;
	text-decoration:none;
	margin:0.8em 0.3em;
	display:inline-block;
	cursor:pointer;
}

.hide {
	display: none;
}

img {
	max-width: 100%;
}

</style>


<script>
	$(document).ready(function(){
        $(".jsTableBody tr").each(function(){
			col1=$(this).find('.col1').text();
			col2=$(this).find('.col2').text();
			subtract= parseInt(col1)-parseInt(col2);
			$(this).find(".subtract").html(subtract);
	})
	})
</script>

<script>
	$(document).ready( function () {
		$('#myTable').DataTable();
	} );
</script>

<script>
    $(document).on('click', '#edit', function() {
        var _this = $(this).parents('tr');
		$('#id_subscription').val(_this.find('#id_subs').text());
		$('#id_montant').val(_this.find('#id_subs').text());
        $('#a_payer').val(_this.find('#montant').text());
    });
/*a revoir */
	$(document).ready(function(){
		var a_payer = parseInt($("#a_payer").val());
		var payer = parseInt($('#montant_paye'))
		$('#montant_paye').keyup(function(){
            if(payer>a_payer)
			{
				alert('sdsdsdsdssd');
			}
		});
	})

	$(document).ready(function(){
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
	  $('.tablinks').click(function(){
           $('.tablinks').css('color','white');
	  });
	}




</script>


@endsection