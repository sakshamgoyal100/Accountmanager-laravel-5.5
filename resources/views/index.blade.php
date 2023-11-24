@extends('layout.main')

@section('main-section')

<div class="main-container">
		<div class="w-25  mx-auto mt-5 pt-5">
			<div class="text-center">
				<a href="{{url('/adduser')}}">
				<i class="fa-solid fa-user-plus fa-2xl "></i>
				<h4 class="mt-2">Add User</h4>
				</a>
			</div>
			<div class="mt-5 text-center">
				<a href="{{url('/selectuser')}}">
				<i class="fa-regular fa-folder-open fa-2xl"></i>
				<h4 class="mt-2">My Transaction</h4>
			    </a>
			</div>
		</div>
</div>
	
	
@endsection

