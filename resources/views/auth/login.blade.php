@extends('layouts.app')

@section('content')
<div id="cover"> <span class="glyphicon glyphicon-refresh w3-spin preloader-Icon"></span>Veillez patienter, chargement... <img width="150" src="{{asset('images/load5.gif')}}" alt=""></div>
<h1>Dom Loaded</h1>
<style>

</style>

<script>
    $('h1').hide();
    $(window).on('load', function() {
        $("#cover").fadeOut(1750);
    })
</script>

<div class="">
		<div class="container col-md-10 col-sm-10 col-xs-10">
			<div class="bg-white mb-4 shadow p-3 mb-5 bg-white rounded">
                <div class="container">
                </div>
				<style>/*
					#hidesmall{ 
						max-width: 100%; 
						 height: auto;
					} 
					.top{ 
						margin-bottom: 50em;
					}
					@media (max-width: 1050px) {
						#hidesmall { display: none; }
												} 
												*/
			   </style>

				<div class="row">
                    <div class="col-md-6 mb-5" id="hidesmall"><br><br>
                    <img src="{{asset ('images/login_img.jpg')}}" width="600" height="600" class="top rounded img-fluid mb-5" alt="">
                    </div>
                    <div class="col-md-6">
					<img width="200" class="offset-xs-4 col-xs-offset-4 img-fluid img-responsive offset-sm-4 offset-md-4"  src="{{asset ('images/op.png')}}" alt=""><br><br>
                   
					<span class="login100-form-title p-b-43">
						Veillez vous connecter
					</span>
                    <form class="container " method="POST" action="{{ route('login') }}">
                    @csrf
					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input id="email"  readonly onfocus="this.removeAttribute('readonly');" class="input100 @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
						<span class="focus-input100"></span>
						<span class="label-input100" id="Labemail">Email</span>
                        @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
					</div>
					
					
					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<input class="input100   @error('password') is-invalid @enderror"  id="password" type="password"  name="password" required autocomplete="current-password">
						<span class="focus-input100"></span>
						<span class="label-input100" id="Labpassword">Password</span>
					</div>
                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

					<div class="flex-sb-m w-full p-t-3 p-b-32">
						<div class="contact100-form-checkbox">
							<input class="input-checkbox100" id="ckb1" {{ old('remember') ? 'checked' : '' }} type="checkbox" name="remember">
							<label class="label-checkbox100" for="ckb1">
								Remember me
							</label>
						</div>


                        <script>
                         
                        </script>

						<div>
                        @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
						</div>
					</div>
			

					<div class="container-login100-form-btn">
						<button type="submit" class="login100-form-btn">
							Login
						</button>
					</div>
					
					<div class="text-center p-t-46 p-b-20">
						<span class="txt2">
							or sign up using
						</span>
					</div>

					<div class="login100-form-social flex-c-m">
						<a href="#" class="login100-form-social-item flex-c-m bg1 m-r-5">
							<i class="fa fa-facebook-f" aria-hidden="true"></i>
						</a>

						<a href="#" class="login100-form-social-item flex-c-m bg2 m-r-5">
							<i class="fa fa-twitter" aria-hidden="true"></i>
						</a>
					</div>
				</form>
                    </div>
                </div>

			</div>
		</div>
	</div>
	
<script>
   
   $(document).ready(function(){
      $('#email').keyup(function(){
		$("#Labemail").hide();
	  })
	  $('#password').keyup(function(){
		$("#Labpassword").hide();
	  })
   })
</script>


@endsection
