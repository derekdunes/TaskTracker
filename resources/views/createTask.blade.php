@extends('layouts.app')
@section('content0')
    

    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <script type="text/javascript">

        $(document).ready(function(){

            //when category option is selcted do this
            $("select[name='client']").change(function(){
                
                //let the user select an option first
                //get the value of the selection
                var selectedClient = $(this).children("option:selected").val();
                
                //setup ajax token for fetching data 
                $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
                });

                //fetch the admin assigned to the client or overall agent

                $.ajax({
                    url: '/get/client/agents'+selectedCategory,//route to fetch the data
                    type: 'GET',
                    datatype: 'json',
                    success: function(result){
                        var newResult = JSON.parse(result);

                        //create the radio options from the data
                        createRadioOptions(newResult);
                    }
                });

                
                //hide every class not bearing the gotten id
                //enable the speciality select options if it is disabled
                if($("select[name='speciality']").is('[disabled=disabled]')){

                    $("select[name='speciality']").attr('disabled',false);

                }else{

                    $("select[name='speciality']").attr('disabled',false);

                }

                
            });

            $("#button").click(function(){

                //get all the selected options
                 var selectedCategory = $("select[name='category']").children("option:selected").val();

                var selectedSpeciality = $("select[name='speciality']").children("option:selected").val();

                var selectedLocation = $("select[name='location']").children("option:selected").val();

                $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
                });

                $.ajax({
                    url: '/get/specialist/' + selectedCategory + '/' + selectedSpeciality + '/' + selectedLocation,
                    type: 'GET',
                    datatype: 'json',
                    success: function(result){
                        var newResult = JSON.parse(result);

                        createSpecialistList(newResult);
                    }
                });

            })

            function createSpecialistList(result){

                //empty the parent div before adding new data
                $("div[class='w3-about-grids']").empty();

                //create left grid and right grid
                var $leftGrid = $("<di>", {"class": "col-md-6 w3-about-right-grid"});
                var $rightGrid = $("<div>", {"class": "col-md-6 w3-about-right-grid"});

                for (var i = 0; i < result.length; i++) {

                    // console.log(result[i].username);
                    // console.log(result[i].qualification);
                    // console.log(result[i].firstname);
                    // console.log(result[i].lastname);
                    // console.log(result[i].speciality);
                    // console.log(result[i].location);
                    // console.log(result[i].bio);
                    // console.log(result[i].Fees);

                    var $doctorName = 'Dr ' + result[i].lastname + ' ' + result[i].firstname;

                    var $url = '/register/book/' + result[i].doctor_id;

                    //doctor deatails parent div
                    var $doctorDetailsParentDiv = $("<div>", {"class": "col-md-8 w3-about-right-text1"});

                    var $qualifications = $("<h5>", {"text": result[i].qualification});
                    var $name = $("<h4>", {"text": $doctorName});
                    var $bio = $("<h3>", {"text": result[i].bio});
                    var $paragraph = $("<p>");
                    var $button = $("<button>", {"text": "Book Doctor", "class": "btn btn-primary"});
                    
                    $button.click(function(){
                        //save doctors details in session and tell the user to signup/signin
                        window.location.href = $url;

                    });
                    
                    $paragraph.append($button);

                    var $break = $("<br>");

                    $doctorDetailsParentDiv.append($qualifications);
                    $doctorDetailsParentDiv.append($name);
                    $doctorDetailsParentDiv.append($bio);
                    $doctorDetailsParentDiv.append($paragraph);
                    $doctorDetailsParentDiv.append($break);
                    
                    //create image div parent
                    var $imageParentDiv = $("<div>", {"class": "col-md-4 w3-about-right-img1"});

                    var $image = $("<img>", {"src": "images/a11.jpg", "alt": "img" });
                    $imageParentDiv.append($image);

                    var $clearfix = $("<div>", {"class": "clearfix"});

                    //if the value is even put on the right if odd then left
                    if( i % 2 == 0){

                        $leftGrid.append($doctorDetailsParentDiv);
                        $leftGrid.append($imageParentDiv);
                        $leftGrid.append($clearfix);

                    }else{

                        $rightGrid.append($doctorDetailsParentDiv);
                        $rightGrid.append($imageParentDiv);
                        $rightGrid.append($clearfix);

                    }
                    
                }

                $("div[class='w3-about-grids']").append($rightGrid);
                $("div[class='w3-about-grids']").append($leftGrid);

            }

            function createRadioOption(result){
                //clear the original options and start new options
                $("select[name='agents']").empty();

                var $option = $("<option>", {"text": "Choose a Speciality"});

                $("select[name='speciality']").append($option);

                //loop through the array
                for (var i = result.length - 1; i >= 0; i--) {
                        
                    // console.log(result[i].id);
                    // console.log(result[i].cat_id);
                    // console.log(result[i].name);
                    // console.log(result[i].description);
                    // console.log("\n");
                    
                      <input type="radio" name="gender" value="male"> Male<br>
                      <input type="radio" name="gender" value="female"> Female<br>
                      <input type="radio" name="gender" value="other"> Other

                    var $option = $("<option>", { value: result[i].name, "text": result[i].name});
                    
                    // $option.click(function(){
                    //  //enable the location dropdown
                    //  $("select[name='location']").attr('disabled',false);

                    // });

                    $("select[name='speciality']").append($option);
                                        

                }

            }

            
        });

    </script>

@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create New Task</div>

                <div class="panel-body">

                    <form class="form-horizontal" method="POST" action="/updateTask">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Client</label>

                            <div class="col-md-6">
                                <select id="name" type="text" class="form-control" name="client" value="{{ $value->client }}" required autofocus>
                                    <option value="" disabled>Choose a Client</option>
                                    
                                    @foreach($clients as $client)     
                                        <option value="{{ $client->client_code }}">{{ $client->client_code }}</option>
                                    @endforeach
                              </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Mail to</label>

                            <div class="col-md-6">
                                <select id="name" type="text" class="form-control" name="name" value="{{ $value->client }}" required autofocus>
                                <option value="">Choose a Client</option>
                                 
                              @foreach($clients as $client)     
                                   <option value="{{ $client->client_code }}">{{ $client->client_code }}</option>
                              @endforeach
                              
                              </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description" class="col-md-4 control-label">Description/Error Message</label>

                            <div class="col-md-6">
                                <input id="description" type="text" class="form-control" name="description" value="" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="details" class="col-md-4 control-label">Reg/App/RRR/Confirmation No</label>

                            <div class="col-md-6">
                                <input id="details" type="details" class="form-control" name="details" required>
                            </div>
                        </div>

                       <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Client</label>

                            <div class="col-md-6">
                                <select id="name" type="text" class="form-control" name="name" value="" required autofocus>
                                    <option value="">Choose Problem Status</option>
                                    <option value="green">Resolved</option>
                                    <option value="yellow">In Progress</option>
                                    <option value="red">Pending</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    Delete
                                </button>
                            </div>
                        </div>
                    </form>
                  @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
