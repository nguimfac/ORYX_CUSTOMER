@extends('layouts.app') @section('content')

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<div class="container-fluid ">
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
                                    <a href="{{url('software/')}}" class="logiciel"><i class="fa fa-user "></i> LOGICIELS <span>1</span></a></li>
                                <li>
                                    <a href="{{url('souscription/')}}" class="souscription"><i class="fa fa-bookmark-o"></i> Souscription<span>2</span></a>
                                </li>
                                <li>
                                    <a href="dashboard-archived-ads.html" class="sav"><i class="fa fa-file-archive-o"></i>Service Apres vente<span>3</span></a>
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
                                <div class="col-md-9 mt-4">
                                    <strong>NOS LOGICIELS</strong><br>
                                    <div class="p-0">

                                    </div>

                                </div>
                                <div class="col-md-3">
                                    <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#staticBackdrop">Add logiciel <i class="fa fa-plus-square" aria-hidden="true"></i></button>
                                </div>
                            </div>
                        </h3>
                        <table class="table table-hover table-responsive table-striped product-dashboard-table" id="myTable">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th>NUMERO</th>
                                    <th>IMAGE</th>
                                    <th> TITRE</th>
                                    <th class="text-center">PRIX</th>
                                    <th class="text-center">Added</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($logiciel as $logiciels)
                                <tr>

                                    <td class="product-category" id="id_logiciel"><span class="categories">{{$logiciels->id}} </span></td>
                                    <td class="product-thumb font">
                                        <input type="hidden" value="{{$logiciels->image_name}}" name="image_name" id="image_name">
                                        <img class="slider-img img-responsive rounded" width="50" src="{{asset ('storage/images/'.$logiciels->image_name)}}" alt="Chania">
                                        <td class="product-category text-left" id="titre_logiciel"><span class="categories font">{{$logiciels->titre}}</span></span>
                                        </td>
                                        <td class="product-category" id="prix_logiciel"><span class="categories font">{{$logiciels->prix}} fcfa</span></td>
                                        <td class="product-category" id="date_creation"><span class="categories font">{{$logiciels->created_at}} </span></td>

                                        <td class="action" data-title="Action">
                                            <div class="">
                                                <ul class="list-inline justify-content-center">
                                                    <li class="list-inline-item">
                                                        <a data-toggle="tooltip" data-placement="top" title="View" class="view" href="category.html">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <a id="edit" data-placement="top" type="button" data-toggle="modal" data-target="#staticBackdropEdit" title="Edit" class="edit">
                                                            <i class="fa fa-pencil"></i>
                                                        </a>
                                                    </li>
                                                    <li class="list-inline-item">

                                                        <form method="get" action="DeleteLogiciel/{{$logiciels->id}}">
                                                            @csrf
                                                            <input name="_method" type="hidden" value="DELETE">
                                                            <a type="submit" data-placement="top" title="Delete show_confirm " class="delete show_confirm" href="">
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
                        <div class="float-right"> {!!$logiciel->links()!!}</div>

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
                        <label for="Titre" class="text-black">Prix</label>
                        <input type="number" name="prix" class="form-control p-4" required placeholder="Price of the software">
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

<!-----Modal 2 for edti-->
<div class="modal fade" id="staticBackdropEdit" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabelEdit" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Modifier un Logiciel <img width="100" src="{{  asset('images/software.jpg') }}" alt="" srcset=""></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		  </button>
            </div>
            <div class="modal-body">
                <form class="text-left" action="/updatesoftware" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <input type="hidden" id="id" name="id" class="form-control p-4" required placeholder="titre of the software">
                    </div>
                    <div class="form-group">
                        <label for="Titre" class="text-black">Titre</label>
                        <input type="text" id="titre" name="titre" class="form-control p-4" required placeholder="titre of the software">
                    </div>
                    <div class="form-group">
                        <label for="Titre" class="text-black">Prix</label>
                        <input type="text" id="prix" name="prix" class="form-control p-4" required placeholder="Price of the software">
                    </div>
                    <div class="form-group">
                        <label for="created_at" class="text-black">created_at</label>
                        <input type="text" id="created_at" name="created_at" class="form-control p-4" required placeholder="date of the software">
                    </div>

                    <div class="form-group">
                        <div class="box">
                            <input type="file" name="image_name" value="optimus cash" id="file-input">
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
</script>

<script>
    $(document).on('click', '#edit', function() {
        var _this = $(this).parents('tr');
        $('#id').val(_this.find('#id_logiciel').text());
        $('#titre').val(_this.find('#titre_logiciel').text());
        $('#prix').val(_this.find('#prix_logiciel').text());
        $('#created_at').val(_this.find('#date_creation').text());
    });
</script>




@endsection