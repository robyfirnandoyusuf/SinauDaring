@extends('layouts.app')
@section('soalActive')
    active
@endsection
@section('js')
    @livewireScripts
@endsection
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-icon" data-background-color="rose">
                        <i class="material-icons">assignment</i>
                    </div>
                    <div class="card-content">
                        <h4 class="card-title">Data Soal</h4>
                        <a href="{{ route('soal.create') }}" class="btn btn-primary">Buat Soal</a>
                        <div class="table-responsive">
                            {{-- @livewire('user.table') --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection