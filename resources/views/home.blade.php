@extends('layouts.app')

@section('content')


<section class="hero-area bg-1 text-center overly"  style="background-image: url('{{ asset('images/hero.jpg') }}');">
	<!-- Container Start -->
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<!-- Header Contetnt -->
				<div class="content-block">
					<h1>Suivez  & Servez vos  clients </h1>
					<p>Restez plus proche de vos clients <br> Ameliorez la satisaction de vos clients après le service</p>
					<div class="short-popular-category-list text-center">
						<h2>CUSTOMER MANAGEMENT</h2>
					</div>
				</div>
			
				<!-- Advance Search -->
			   <div class="container">
			   <div class="row ">
					<div class="col-md-4 containers">
							<div class="advance-search ad-listing-content ">
							<div class="">
								<div class="row justify-content-center">
									<a href="{{ url('software/') }}">
								<div class="col-lg-12 col-md-12 align-content-center">
									<img src="{{ asset ('images/software.jpg')}}" width="200"  alt=""><br>
										 <strong class="text-primary">LOGICIEL
										
										 </strong>
									</div>
									</a>
								</div>
							</div>
						</div>
					</div>

					<div class="col-md-4 containers" >
							<div class="advance-search ad-listing-content ">
							<div class="container">
								<div class="row justify-content-center">
									<div class="col-lg-12 col-md-12 align-content-center">
									<img src="{{ asset ('images/subscription.png')}}" width="160"  alt=""><br>
									<strong class="text-primary">SUBCRIPTION</strong>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="col-md-4 containers">
							<div class="advance-search ad-listing-content ">
							<div class="container">
								<div class="row justify-content-center">
									<div class="col-lg-12 col-md-12 align-content-center">
									<img src="{{ asset ('images/sav.jpg')}}" width="120"  alt=""><br>
									<strong class="text-primary">SERVICE APRES VENTE</strong>

									</div>
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
@endsection
