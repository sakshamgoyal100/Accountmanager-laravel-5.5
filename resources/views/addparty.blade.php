@extends('layout.main')

@section('main-section')


<div class="main-container mt-5 ml-4">
  <div class="row">
    <div class="col-md-6 mx-auto">
    <h1>Create Party</h1>
    <form class="mt-5" action="{{url('/addparty')}}" method="post" enctype="multipart/form-data">
        
        <!-- CSRF Token -->
        {{ csrf_field() }}  

        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Name</label>
            <div class="col-sm-12 col-md-10">
                <input type="text" name="name" required class="form-control" id="name" placeholder="Enter your name">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Mobile</label>
            <div class="col-sm-12 col-md-10">
                <input type="integer" name="mobile" required class="form-control" id="mobile" placeholder="Enter your mobile" >
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Address</label>
            <div class="col-sm-12 col-md-10">
                <input type="text" name="address" required class="form-control" id="address" placeholder="Enter your address" >
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">GSTIN</label>
            <div class="col-sm-12 col-md-10">
                <input type="text" name="GSTIN" required class="form-control" placeholder="Enter party GST number">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Description</label>
            <div class="col-sm-12 col-md-10">
                <input type="text" name="description" required class="form-control" placeholder="Enter Details">
            </div>
        </div>

        <button type="submit" class="btn btn-danger">Submit</button>
    </form>
   </div> 
  </div>  

</div>
                            
@endsection