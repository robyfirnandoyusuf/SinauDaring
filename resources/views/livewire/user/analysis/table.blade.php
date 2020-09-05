<div>
    {{-- <div class="row"> --}}
        <div class="col-md-8 form-inline">
            Entries: &nbsp;
            <select wire:model="perPage" class="form-control">
                <option>10</option>
                <option>15</option>
                <option>25</option>
            </select>
        </div>

        <div class="col-md-4">
            <input wire:model="search" class="form-control" type="text" placeholder="Pencarian soal...">
        </div>
    {{-- </div> --}}

    {{-- <div class="row"> --}}
        <table class="table">
            <thead class="text-primary">
                <th>
                    <a wire:click.prevent="sortBy('kode')" role="button" href="#">
                        Kode soal
                    </a>
                </th>
                <th>
                    <a wire:click.prevent="sortBy('matpel_id')" role="button" href="#">
                        Matpel
                    </a>
                </th>
                <th>
                    <a wire:click.prevent="sortBy('jenis_soal')" role="button" href="#">
                        Jenis Soal
                    </a>
                </th>
                <th>
                    Aksi
                </th>
            </thead>
            <tbody>
                @forelse ($soals as $soal)
                    <tr>
                        <td>{!! $soal->kode !!}</td>
                        <td>{!! $soal->matpel->matpel !!}</td>
                        <td>{!! ucfirst($soal->jenis_soal) !!}</td>
                        <td class="td-actions">
                            <a href="{{route('user.create_soal',['kode'=>$soal->kode])}}" type="button" rel="tooltip" class="btn btn-info" data-original-title="" title="">
                                <i class="material-icons">book</i>
                            </a>
                            <a href="{{route('user.edit',$soal->kode)}}" rel="tooltip" class="btn btn-success" data-original-title="" title="">
                                <i class="material-icons">edit</i>
                            </a>
                            <button onclick="return confirm('Are you sure you want to delete this item?');" wire:click=delete("{{ $soal->kode }}") type="button" rel="tooltip" class="btn btn-danger" data-original-title="" title="">
                                <i class="material-icons">close</i>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3"><center>Kosong !</center></td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    {{-- </div> --}}

    {{-- <div class="row"> --}}
    	<div class="col-md-12">
	        <div class="col-md-6">
	          {{--   {!! $soals->links('vendor.pagination.default') !!} --}}
	        </div>
	        <div class="col-md-6 text-right text-muted">
	            {{-- Showing {{ $soals->firstItem() }} to {{ $soals->lastItem() }} out of {{ $soals->total() }} results --}}
	        </div>
        </div>
    {{-- </div> --}}
</div>