@section('soalActive')
active
@endsection
{{-- <div> --}}
<div class="content">
    <div class="container-fluid">
        <div class="row">
			<div class="col-md-12">
				<div class="card">
					<form class="form-horizontal">
						<div class="card-header card-header-text" data-background-color="rose">
							<h4 class="card-title">Ubah Soal</h4>
						</div>
						@if ($type == 'uraian')
							<div class="card-content">
								<div class="add-input">
									<div class="row">
										<label class="col-sm-2 label-on-left">No 1</label>
										<div class="col-sm-10">
											<div class="form-group label-floating is-empty">
												<label class="control-label"></label>
												<textarea wire:model="soal.0" type="text" class="form-control"></textarea>
												@error('soal.0') <span class="text-danger error">{{ $message }}</span>@enderror
											</div>
										</div>

										<label class="col-sm-2 label-on-left">Kunci Jawaban No 1</label>
										<div class="col-sm-10">
											<div class="form-group label-floating is-empty">
												<label class="control-label"></label>
												<input wire:model="jawaban.0" type="text" class="form-control">
												@error('jawaban.0') <span class="text-danger error">{{ $message }}</span>@enderror
											</div>
										</div>
										<div class="col-md-2">
											<button class="btn text-white btn-info btn-sm" wire:click.prevent="add({{$i}})">Add</button>
										</div>
									</div>
								</div>

								@foreach($inputs as $key => $value)
									<div class="add-input">
										<div class="row">
											<label class="col-sm-2 label-on-left">No {{$value}}</label>
											<div class="col-sm-10">
												<div class="form-group label-floating is-empty">
													<label class="control-label"></label>
													<textarea wire:model="soal.{{ $value }}" type="text" class="form-control"></textarea>
												</div>
											</div>

											<label class="col-sm-2 label-on-left">Kunci Jawaban No {{$value}}</label>
											<div class="col-sm-10">
												<div class="form-group label-floating is-empty">
													<label class="control-label"></label>
													<input wire:model="jawaban.{{ $value }}" type="text" class="form-control">
												</div>
											</div>
											<div class="col-md-2">
												<button class="btn btn-danger btn-sm" wire:click.prevent="remove({{$key}})">remove</button>
											</div>
										</div>
									</div>
						        @endforeach

								<div class="row" style="padding: 20px">
									<div class="col-md-12">
										<div class="col-md-2">
											<div class="form-group form-button">
												<button type="submit" class="btn btn-fill btn-rose" wire:click.prevent="store()">Simpan</button>
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
						@else
							<div class="card-content">
								<div class="add-input">
									@foreach($soals as $key => $value)
										<div class="row">
											<label class="col-sm-2 label-on-left">No {{$loop->iteration}}</label>
											<div class="col-sm-10">
												<div class="form-group label-floating is-empty">
													<label class="control-label"></label>
													<textarea wire:model="soal.{{$key}}" type="text" class="form-control">{{$value->soal}}</textarea>
													@error('soal.{{$key}}') <span class="text-danger error">{{ $message }}</span>@enderror
												</div>
											</div>
											
											<label class="col-sm-2 label-on-left"></label>
											<div class="col-sm-10">
												<div class="form-group label-floating is-empty">
													<label class="control-label">Pilihan A</label>
													<input type="text" wire:model="pilihan_a.{{$key}}" name="" class="form-control" value="{{$value->pilihan->pilihan_a}}">
												</div>
											</div>

											<label class="col-sm-2 label-on-left"></label>
											<div class="col-sm-10">
												<div class="form-group label-floating is-empty">
													<label class="control-label">Pilihan B</label>
													<input type="text" wire:model="pilihan_b.{{$key}}" name="" class="form-control" value="{{$value->pilihan->pilihan_b}}">
												</div>
											</div>

											<label class="col-sm-2 label-on-left"></label>
											<div class="col-sm-10">
												<div class="form-group label-floating is-empty">
													<label class="control-label">Pilihan C</label>
													<input type="text" wire:model="pilihan_c.{{$key}}" name="" class="form-control" value="{{$value->pilihan->pilihan_c}}">
												</div>
											</div>

											<label class="col-sm-2 label-on-left"></label>
											<div class="col-sm-10">
												<div class="form-group label-floating is-empty">
													<label class="control-label">Pilihan D</label>
													<input type="text" wire:model="pilihan_d.{{$key}}" name="" class="form-control" value="{{$value->pilihan->pilihan_d}}">
												</div>
											</div>

											<label class="col-sm-2 label-on-left">Kunci Jawaban No {{$loop->iteration}}</label>
											<div class="col-sm-10">
												<div class="form-group label-floating is-empty">
													<label class="control-label"></label>
													<select class="form-control" wire:model="jawaban.{{$key}}">
														<option value="A" {{strtolower($value->kunci_jawaban) == 'a' ? "selected" : ""}}>A</option>
														<option value="B" {{strtolower($value->kunci_jawaban) == 'b' ? "selected" : ""}}>B</option>
														<option value="C" {{strtolower($value->kunci_jawaban) == 'c' ? "selected" : ""}}>C</option>
														<option value="D" {{strtolower($value->kunci_jawaban) == 'd' ? "selected" : ""}}>D</option>
													</select>
													@error('jawaban.{{$key}}') <span class="text-danger error">{{ $message }}</span>@enderror
												</div>
											</div>
											@if ($loop->iteration == 1)
												<div class="col-md-2">
													<button class="btn text-white btn-info btn-sm" wire:click.prevent="add({{$i}})">Add</button>
												</div>	
											@else
												<div class="col-md-2">
													<button class="btn btn-danger btn-sm" wire:click.prevent="remove({{$key}})">remove</button>
												</div>
											@endif
											
										</div>
									@endforeach
								</div>

								@foreach($inputs as $key => $value)
									<div class="add-input">
										<div class="row">
										<label class="col-sm-2 label-on-left">No {{$value}}</label>
										<div class="col-sm-10">
											<div class="form-group label-floating is-empty">
												<label class="control-label"></label>
												<textarea wire:model="soal.{{$value}}" type="text" class="form-control"></textarea>
												@error('soal.{{$value}}') <span class="text-danger error">{{ $message }}</span>@enderror
											</div>
										</div>
										
										<label class="col-sm-2 label-on-left"></label>
										<div class="col-sm-10">
											<div class="form-group label-floating is-empty">
												<label class="control-label">Pilihan A</label>
												<input type="text" name="" class="form-control" wire:model="pilihan_a.{{$value}}">
											</div>
										</div>

										<label class="col-sm-2 label-on-left"></label>
										<div class="col-sm-10">
											<div class="form-group label-floating is-empty">
												<label class="control-label">Pilihan B</label>
												<input type="text" name="" class="form-control" wire:model="pilihan_b.{{$value}}">
											</div>
										</div>

										<label class="col-sm-2 label-on-left"></label>
										<div class="col-sm-10">
											<div class="form-group label-floating is-empty">
												<label class="control-label">Pilihan C</label>
												<input type="text" name="" class="form-control" wire:model="pilihan_c.{{$value}}">
											</div>
										</div>

										<label class="col-sm-2 label-on-left"></label>
										<div class="col-sm-10">
											<div class="form-group label-floating is-empty">
												<label class="control-label">Pilihan D</label>
												<input type="text" name="" class="form-control" wire:model="pilihan_d.{{$value}}">
											</div>
										</div>

										<label class="col-sm-2 label-on-left">Kunci Jawaban No {{$value}}</label>
										<div class="col-sm-10">
											<div class="form-group label-floating is-empty">
												<label class="control-label"></label>
												<select class="form-control" wire:model="jawaban.{{$value}}">
													<option value="A">A</option>
													<option value="B">B</option>
													<option value="C">C</option>
													<option value="D">D</option>
													<option value="E">E</option>
												</select>
												@error('jawaban.{{$value}}') <span class="text-danger error">{{ $message }}</span>@enderror
											</div>
										</div>
										<div class="col-md-2">
											<button class="btn btn-danger btn-sm" wire:click.prevent="remove({{$key}})">remove</button>
										</div>
									</div>
									</div>
						        @endforeach

								<div class="row" style="padding: 20px">
									<div class="col-md-12">
										<div class="col-md-2">
											<div class="form-group form-button">
												<button type="submit" class="btn btn-fill btn-rose" wire:click.prevent="update()">Simpan</button>
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
						@endif
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
{{-- </div> --}}