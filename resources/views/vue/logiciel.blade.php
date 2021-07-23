@extends('layouts.app')

@section('content')
<div class="container-fluid">
<section class="dashboard section">
	<!-- Container Start -->
	<div class="container-fluid">
		<!-- Row Start -->
		<div class="row">
			<div class="col-lg-4">
				<div class="sidebar">

					<div class="widget user-dashboard-menu">
						<ul>
							<li class="active">
								<a href="dashboard-my-ads.html" class="link-unstyled"><i class="fa fa-user "></i> My Ads</a></li>
							<li>
								<a href="dashboard-favourite-ads.html"><i class="fa fa-bookmark-o"></i> Favourite Ads <span>5</span></a>
							</li>
							<li>
								<a href="dashboard-archived-ads.html"><i class="fa fa-file-archive-o"></i>Archeved Ads <span>12</span></a>
							</li>
							<li>
								<a href="dashboard-pending-ads.html"><i class="fa fa-bolt"></i> Pending Approval<span>23</span></a>
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
				<img src="{{ asset ('images/software.jpg')}}" alt="100" srcset="">
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
			<div class="col-lg-8">
				<!-- Recently Favorited -->
				<div class="widget dashboard-container my-adslist">
					<h3 class="widget-header">
                        <div class="row">
                            <div class="col-md-9">
                               <strong>NOS LOGICIELS</strong>
                            </div>
                            <div class="col-md-3">
                                <button class="btn btn-primary" type="button"  data-toggle="modal" data-target="#staticBackdrop"  >Add logiciel <i class="fa fa-plus-square" aria-hidden="true"></i></button>
                            </div>
                        </div>
                    </h3>
					<table class="table table-responsive product-dashboard-table" id="myTable">
						<thead>
							<tr>
								<th>IMAGE</th>
								<th> TITRE</th>
								<th class="text-center">PRIX</th>
								<th class="text-center">Added</th>
								<th class="text-center">Action</th>
							</tr>
						</thead>
						<tbody>
						@foreach ($logiciel as $logiciel)
							<tr>
								<td class="product-thumb">
                					<img class="slider-img img-responsive rounded" width="100" src="{{asset ('storage/images/'.$logiciel->image_name)}}" alt="Chania">
								<td class="product-category">
									<span class="categories">{{$logiciel->titre}}</span>
								</td>
								<td class="product-category"><span class="categories">{{$logiciel->prix}} fcfa</span></td>
								<td class="product-category"><span class="categories">{{$logiciel->created_at}} </span></td>

								<td class="action" data-title="Action">
									<div class="">
										<ul class="list-inline justify-content-center">
											<li class="list-inline-item">
												<a data-toggle="tooltip" data-placement="top" title="View" class="view" href="category.html">
													<i class="fa fa-eye"></i>
												</a>
											</li>
											<li class="list-inline-item">
												<a data-toggle="tooltip" data-placement="top" title="Edit" class="edit" href="dashboard-my-ads.html">
													<i class="fa fa-pencil"></i>
												</a>
											</li>
											<li class="list-inline-item">
											
												<form method="get" action="DeleteLogiciel/{{$logiciel->id}}">
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

				</div>

				<!-- pagination -->
				<div class="pagination justify-content-center">
					<nav aria-label="Page navigation example">
						<ul class="pagination">
							<li class="page-item">
								<a class="page-link" href="dashboard-my-ads.html" aria-label="Previous">
									<span aria-hidden="true">&laquo;</span>
									<span class="sr-only">Previous</span>
								</a>
							</li>
							<li class="page-item"><a class="page-link" href="dashboard-my-ads.html">1</a></li>
							<li class="page-item active"><a class="page-link" href="dashboard-my-ads.html">2</a></li>
							<li class="page-item"><a class="page-link" href="dashboard-my-ads.html">3</a></li>
							<li class="page-item">
								<a class="page-link" href="dashboard-my-ads.html" aria-label="Next">
									<span aria-hidden="true">&raquo;</span>
									<span class="sr-only">Next</span>
								</a>
							</li>
						</ul>
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

<!------Modal 1------>

<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Modal title <img width="100" src="{{  asset('images/software.jpg') }}" alt="" srcset=""></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <form action="/newsoftware" method="POST" enctype="multipart/form-data">
         @csrf
                    <div class="form-group">   
                        <label for="Titre" class="text-black">Titre</label>
                        <input type="text" name="titre" class="form-control p-4" required placeholder="Name of the software">
                    </div>

                    <div class="form-group">   
                        <label for="Titre"class="text-black" >Prix</label>
                        <input type="number" name="prix" class="form-control p-4"required  placeholder="Price of the software">
                    </div>

                    
            <div class="form-group">
                     	<div class="box">
			<input type="file" name="image_name" id="file-input">
				</div>
				<!-- leftbox -->
				<div class="box-2">
					<div class="result"></div>
				</div>
				<!--rightbox-->
				<div class="box-2 img-result hide">
					<!-- result of crop -->
					<img class="cropped" src="" alt="">
				</div>
				<!-- input file -->
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

<!-----Modal 2-->
<main class="page">
	<h2>Upload ,Crop and save.</h2>
	<!-- input file -->
	<div class="box">
		<input type="file" id="file-input">
	</div>
	<!-- leftbox -->
	<div class="box-2">
		<div class="result"></div>
	</div>
	<!--rightbox-->
	<div class="box-2 img-result hide">
		<!-- result of crop -->
		<img class="cropped" src="" alt="">
	</div>
	<!-- input file -->
	<div class="box">
		<div class="options hide">
			<label> Width</label>
			<input type="number" class="img-w" value="300" min="100" max="1200" />
		</div>
		<!-- save btn -->
		<button class="btn save hide">Save</button>
		<!-- download btn -->
		<a href="" class="btn download hide">Download</a>
	</div>
</main>
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
	$(document).ready( function () {
		$('#myTable').DataTable();
	} );
</script>




@endsection