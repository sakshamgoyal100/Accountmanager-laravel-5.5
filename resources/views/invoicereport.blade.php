@extends('layout.main')

@section('main-section')


<div class="main-container mt-5 ml-4">
   
	<div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Start Date :</label>
            <div class="col-sm-12 col-md-10">
                <input type="text" class="form-control date-picker" id="date" placeholder="Enter Date">
            </div>
            
            <label class="col-sm-12 col-md-2 col-form-label">End Date :</label>
            <div class="col-sm-12 col-md-10">
                <input type="text" class="form-control date-picker" id="date" placeholder="Enter Date">
            </div>

		    <button class="text-center btn btn-secondary w-100 mt-5" id="showdata">Show Data</button>

	</div>

</div>

@endsection
