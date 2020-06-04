@extends('layouts.app')

@section('content')
    <div id="loading"></div>
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="card-title">{{ __('Utilizando arquivo EPE') }}</h4>

                            <form name="plotsTorre" method="POST" action="{{ route('reports.torreepe') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <input type="file" name="arquivoEpe">
                                </div>
                            </form>
                        </div>
                        <div class="col-6">
                            <h4 class="card-title">{{ __('Ou o código estação da torre') }}</h4>
                            <div class="form-group">
                                <label for="primeiraTorre" class="col-md-4 control-label">{{ __('Código estação da torre') }}</label>
                                <div class="col-md-6">
                                    <input id="primeiraTorre" type="text" class="form-control" name="primeiraTorre" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="dateFilter" class="col-md-4 control-label">{{ __('Data') }}</label>
                                <div class="col-md-6">
                                    <input id="dateFilter" type="text" class="form-control" name="datefilter" autocomplete="off" required>
                                </div>
                            </div>                           
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <button id="generatePlots" name="generatePlots">
                                <i class="mdi mdi-upload">{{ __('Gerar Plots') }}</i>
                            </button>
                        </div>            
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('report.sites')
@endsection