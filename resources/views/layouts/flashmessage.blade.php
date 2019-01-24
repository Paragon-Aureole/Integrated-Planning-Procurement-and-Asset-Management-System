
		@if ($message = Session::get('success'))
		<div class="alert alert-success alert-dismissible fade show w-25" role="alert">
		  {{ $message }}
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    <span aria-hidden="true">&times;</span>
		  </button>
		</div>
		@endif


		@if ($message = Session::get('error'))
		<div class="alert alert-danger alert-dismissible fade show w-25" role="alert">
		  {{ $message }}
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    <span aria-hidden="true">&times;</span>
		  </button>
		</div>
		@endif


		@if ($message = Session::get('warning'))
		<div class="alert alert-warning alert-dismissible fade show w-25" role="alert">
		  {{ $message }}
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    <span aria-hidden="true">&times;</span>
		  </button>
		</div>
		@endif


		@if ($message = Session::get('info'))
		<div class="alert alert-info alert-dismissible fade show w-25" role="alert">
		  {{ $message }}
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    <span aria-hidden="true">&times;</span>
		  </button>
		</div>
		@endif


		@guest
		@else
			@if ($errors->any())
			<div class="alert alert-warning alert-dismissible fade show w-25" role="alert">
			  <strong>Warning!</strong> You should check in on some of those fields below.
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			  </button>
			</div>
			@endif
		@endguest

