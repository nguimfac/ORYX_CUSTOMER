@extends('layouts.app')

@section('content')

<div class="">
	
		<div class="container col-md-10">
			<div class="bg-white mb-4 shadow p-3 mb-5 bg-white rounded">
                <div class="container">
                </div>
				<div class="row">
                    <div class="col-md-6 mt-4"><br><br><br><br>
                    <img     src="{{asset ('images/my_back.png')}}" alt="">
                    </div>
                    <div class="col-md-6">
                    <img height="100" class="offset-md-5 offset-xs-5 offset-md-5" width="100" src="{{asset ('images/optimusclient.jpg')}}" alt=""><br><br>
                    <span class="login100-form-title p-b-43">
						Login to continue
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

				<div class="login100-more" style="background-image: url('images/bg-01.jpg');">
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
