@extends('layouts.app')

@section('scoreAnalysisActive')
    active
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
                        <h4 class="card-title">Analisis Nilai</h4>
                        {!!displayAlert()!!}
                        <div class="table-responsive">
                            @livewire('user.analysis.table')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection