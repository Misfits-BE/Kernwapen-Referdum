@extends('layouts.backend')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-offset-2 col-md-8">
				@include('flash::message') {{-- Flash session include --}}

				<div class="panel panel-default">
					<div class="panel-heading">
						<i class="fa fa-fw fa-bug"></i> Meld een probleem
					</div>

					<div class="panel-body">
						<form class="form-horizontal" method="POST" action="{{ route('bug.store') }}">
							{{ csrf_field() }}

							<div class="form-group"> {{-- Waarchuwing alert box om deg beruiker te laten weten dat alles publiek word geregistreerd --}}
								<div class="col-md-12">
									<div class="alert alert-important alert-warning" role="alert">
										<strong><i class="fa fa-warning"></i> Info:</strong>
										Alle data van die formulier zal geplaatst worden in een publieke issue tracker. 
									</div>
								</div>
							</div>

							<div class="form-group @error('titel', 'has-error')">
								<label class="control-label col-md-3">Titel: <span class="text-danger">*</span></label>

								<div class="col-md-9">
									<input type="text" class="form-control" @input('titel') placeholder="Titel van het probleem">
									@error('titel')
								</div>
							</div>

							<div class="form-group @error('label', 'has-error')">
								<label class="control-label col-md-3">Categorie: <span class="text-danger">*</span></label>

								<div class="col-md-9">
									<select class="form-control" name="label">
										<option value=""> -- Selecteer een categorie -- </option>

										@foreach ($labels as $category)
											<option value="{{ $category['name'] }}" @if (old('label') == $category['name']) selected @endif>
												{{ $category['name'] }}
											</option> 
										@endforeach
									</select>

									@error('label')
								</div>
							</div>

							<div class="form-group @error('beschrijving', 'has-error')">
								<label class="control-label col-md-3">Beschrijving: <span class="text-danger">*</span></label>

								<div class="col-md-9">
									<textarea class="form-control" placeholder="Beschrijf kort het probleem dat je ondervind." @input('beschrijving') rows="7"></textarea>
									@error('beschrijving')
								</div>
							</div>

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