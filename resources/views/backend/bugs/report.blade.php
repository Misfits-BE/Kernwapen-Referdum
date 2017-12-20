@extends('layouts.backend')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-offset-1 col-md-10">
				@include('flash::message') {{-- Flash session include --}}

				<div class="panel panel-default">
					<div class="panel-heading">
						<i class="fa fa-fw fa-bug"></i> Meld een probleem
					</div>

					<div class="panel-body">
						<form class="form-horizontal" method="POST" action="">
							{{ csrf_field() }}

							<div class="form-group">
								<div class="col-md-offset-3 col-md-9">
									<button type="submit" class="btn btn-primary btn-sm">
										<i class="fa fa-check"></i> Opslaan
									</button>

									<button type="reset" class="btn btn-link btn-sm">
										<i class="fa fa-undo"></i> Annuleren
									</button>
								</div>
							</div>

						</form>
					</div>
				</div> {{-- /END panel --}}
			</div>
		</div>
	</div>
@endsection