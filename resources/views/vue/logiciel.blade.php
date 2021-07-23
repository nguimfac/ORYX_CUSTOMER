@extends('layouts.app')

@section('content')
<div class="container">
<section class="dashboard section">
	<!-- Container Start -->
	<div class="container">
		<!-- Row Start -->
		<div class="row">
			<div class="col-lg-4">
				<div class="sidebar">
					<!-- User Widget -->
					<div class="widget user-dashboard-profile">
						<!-- User Image -->
						<div class="profile-thumb">
							<img src="images/user/user-thumb.jpg" alt="" class="rounded-circle">
						</div>
						<!-- User Name -->

						<h5 class="text-center"> @auth 
  {{Auth::user()->name}}
@else

@endauth </h5>
						<p>Joined February 06, 2017</p>
						<a href="user-profile.html" class="btn btn-main-sm">Edit Profile</a>


					</div>
					<!-- Dashboard Links -->
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
					<table class="table table-responsive product-dashboard-table">
						<thead>
							<tr>
								<th>IMAGE</th>
								<th> TITRE</th>
								<th class="text-center">PRIX</th>
								<th class="text-center">Action</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="product-thumb">
									<img width="80px" height="auto" src="images/products/products-1.jpg" alt="image description"></td>
								<td class="product-details">
									<h3 class="title">Macbook Pro 15inch</h3>
									<span class="add-id"><strong>Ad ID:</strong> ng3D5hAMHPajQrM</span>
									<span><strong>Posted on: </strong><time>Jun 27, 2017</time> </span>
									<span class="status active"><strong>Status</strong>Active</span>
									<span class="location"><strong>Location</strong>Dhaka,Bangladesh</span>
								</td>
								<td class="product-category"><span class="categories">Laptops</span></td>
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
												<a data-toggle="tooltip" data-placement="top" title="Delete" class="delete" href="dashboard-my-ads.html">
													<i class="fa fa-trash"></i>
												</a>
											</li>
										</ul>
									</div>
								</td>
							</tr>
							<tr>

								<td class="product-thumb">
									<img width="80px" height="auto" src="images/products/products-2.jpg" alt="image description"></td>
								<td class="product-details">
									<h3 class="title">Study Table Combo</h3>
									<span class="add-id"><strong>Ad ID:</strong> ng3D5hAMHPajQrM</span>
									<span><strong>Posted on: </strong><time>Feb 12, 2017</time> </span>
									<span class="status active"><strong>Status</strong>Active</span>
									<span class="location"><strong>Location</strong>USA</span>
								</td>
								<td class="product-category"><span class="categories">Laptops</span></td>
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
												<a data-toggle="tooltip" data-placement="top" title="Delete" class="delete" href="dashboard-my-ads.html">
													<i class="fa fa-trash"></i>
												</a>
											</li>
										</ul>
									</div>
								</td>
							</tr>
							<tr>

								<td class="product-thumb">
									<img width="80px" height="auto" src="images/products/products-3.jpg" alt="image description"></td>
								<td class="product-details">
									<h3 class="title">Macbook Pro 15inch</h3>
									<span class="add-id"><strong>Ad ID:</strong> ng3D5hAMHPajQrM</span>
									<span><strong>Posted on: </strong><time>Jun 27, 2017</time> </span>
									<span class="status active"><strong>Status</strong>Active</span>
									<span class="location"><strong>Location</strong>Dhaka,Bangladesh</span>
								</td>
								<td class="product-category"><span class="categories">Laptops</span></td>
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
												<a data-toggle="tooltip" data-placement="top" title="Delete" class="delete" href="dashboard-my-ads.html">
													<i class="fa fa-trash"></i>
												</a>
											</li>
										</ul>
									</div>
								</td>
							</tr>
							<tr>

								<td class="product-thumb">
									<img width="80px" height="auto" src="images/products/products-4.jpg" alt="image description"></td>
								<td class="product-details">
									<h3 class="title">Macbook Pro 15inch</h3>
									<span class="add-id"><strong>Ad ID:</strong> ng3D5hAMHPajQrM</span>
									<span><strong>Posted on: </strong><time>Jun 27, 2017</time> </span>
									<span class="status active"><strong>Status</strong>Active</span>
									<span class="location"><strong>Location</strong>Dhaka,Bangladesh</span>
								</td>
								<td class="product-category"><span class="categories">Laptops</span></td>
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
												<a data-toggle="tooltip" data-placement="top" title="Delete" class="delete" href="dashboard-my-ads.html">
													<i class="fa fa-trash"></i>
												</a>
											</li>
										</ul>
									</div>
								</td>
							</tr>
							<tr>

								<td class="product-thumb">
									<img width="80px" height="auto" src="images/products/products-1.jpg" alt="image description"></td>
								<td class="product-details">
									<h3 class="title">Macbook Pro 15inch</h3>
									<span class="add-id"><strong>Ad ID:</strong> ng3D5hAMHPajQrM</span>
									<span><strong>Posted on: </strong><time>Jun 27, 2017</time> </span>
									<span class="status active"><strong>Status</strong>Active</span>
									<span class="location"><strong>Location</strong>Dhaka,Bangladesh</span>
								</td>
								<td class="product-category"><span class="categories">Laptops</span></td>
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
												<a data-toggle="tooltip" data-placement="top" title="Delete" class="delete" href="dashboard-my-ads.html">
													<i class="fa fa-trash"></i>
												</a>
											</li>
										</ul>
									</div>
								</td>
							</tr>
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
         <form action="/newsoftware" method="POST">
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
                                <div class="input-group input-file" name="Fichier1">
                                    <span class="input-group-btn">
                                        <button class="btn btn-primary btn-choose" type="button">Choose <i class="fa fa-arrow-circle-up" aria-hidden="true"></i>
                        </button>
                                    </span>
                                    <input type="text" name="image_name" class="form-control" placeholder='Choose a file...' />
                                    <span class="input-group-btn">
                                        <button class="btn btn-secondary btn-reset" type="button">Reset <i class="fa fa-trash" aria-hidden="true"></i>
                        </button>
                                    </span>
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


  

 <script>
     @if(Session::has('success'))
      <script>
          toastr.success("{!! Session::get('success') !!}");
      </script>
      @endif
 </script>

<script>
     @if(Session::has('success'))
      <script>
          swal("great job","{!! Session::get('success') !!}","success",{
            button:"OK",
          });
      </script>
      @endif
 </script>
@endsection