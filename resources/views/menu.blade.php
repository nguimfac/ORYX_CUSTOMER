@extends('layouts.app') 
@section('content')
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
                  <li data-name="dashboard" class="drop-down__item">  <a href="{{url('commercial')}}" class="bg-white"></a>   <span class="fa fa-user-o"></span>  Commercial </li>

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
@endsection