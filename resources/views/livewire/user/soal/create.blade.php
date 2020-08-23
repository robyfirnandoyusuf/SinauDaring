{{-- <div> --}}
@section('soalActive')
active
@endsection
<div class="content">
    <div class="container-fluid">
        <div class="row">
			<div class="col-md-12">
				<div class="card">
					<form wire:submit.prevent="store" class="form-horizontal">
						<div class="card-header card-header-text" data-background-color="rose">
							<h4 class="card-title">Buat Soal</h4>
						</div>
						<div class="card-content">
							<div class="row">
								<label class="col-sm-2 label-on-left">Kode Soal</label>
								<div class="col-sm-10">
									<div class="form-group label-floating is-empty @error('kode') has-error @enderror">
										<label class="control-label"></label>
										<input wire:model="kode" type="text" class="form-control" name="kode">
									</div>
								</div>
							</div>
							<div class="row">
								<label class="col-sm-2 label-on-left">Jenis Soal</label>
								<div class="col-sm-10">
									<div class="form-group label-floating is-empty @error('jenis_soal') has-error @enderror">
										<label class="control-label"></label>
										<div class="col-lg-5 col-md-6 col-sm-3">
											<div wire:ignore>
												<select class="form-control" data-style="btn btn-primary btn-round" title="Pilih Jenis Soal" data-size="7" wire:model="jenis_soal">
													{{-- <option disabled selected>Jenis Soal</option> --}}
													<option value="" selected="">- Jenis Soal -</option>
													<option value="pilihan">Pilihan Ganda</option>
													<option value="uraian">Uraian</option>
												</select>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<label class="col-sm-2 label-on-left">Mata Pelajaran</label>
								<div class="col-sm-10">
									<div class="form-group label-floating is-empty @error('matpel_id') has-error @enderror">
										<label class="control-label"></label>
										<div class="col-lg-5 col-md-6 col-sm-3">
											<div wire:ignore>
												<select class="form-control" data-style="btn btn-primary btn-round" title="Pilih Matpel" data-size="7" wire:model="matpel_id">
													<option selected="">- Pilih Matpel- </option>
													@forelse ($matpels as $matpel)
														<option value="{{$matpel->id}}">{{$matpel->matpel}}</option>
													@empty
														{{-- empty expr --}}
													@endforelse
												</select>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row" style="padding: 20px">
								<div class="col-md-12">
									<div class="col-md-2">
										<div class="form-group form-button">
											<button type="submit" class="btn btn-fill btn-rose">Simpan</button>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group form-button">
											<a href="{{ route('user.soal.index') }}" class="btn btn-fill btn-danger">Cancel</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
{{-- </div> --}}
@section('js')
	<script type="text/javascript">
		// $(window).trigger('load.bs.select.data-api');
		/*var remove = $('.bootstrap-select');
		$(remove).replaceWith($(remove).contents('.selectpicker'));
		;*/
		/*$(document).on("turbolinks:load", function() { 
			$('.selectpicker').selectpicker(); 
			if (($("select.selectpicker").length > 0) && ($('.bs-caret').length == 0)) {
				$(".selectpicker").selectpicker();
			}
		});

		$(document).on("turbolinks:before-cache", function() {
		  var remove = $('.bootstrap-select');
		  $(remove).replaceWith($(remove).contents('.selectpicker'));
		});*/
	</script>
@endsection