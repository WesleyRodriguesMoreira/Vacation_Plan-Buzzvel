{{-- Inclusion of the predefined header  --}}
@extends('layouts.admin')
@section('content')

    <div class="card mt-4 mb-4 border-light shadow">
        <div class="card-header d-flex justify-content-between">
            <span>View the Vacation Plan</span>
            <span>
                {{-- <a href="{{ route('vacation.index') }}" class="btn btn-info btn-sm ">List</a> --}}
                <a href="{{ route('vacation.edit', ['vacation' => $vacation->id]) }}" class="btn btn-warning btn-sm">Edit</a>
            </span>
        </div>

        {{-- Check if there is a message and print the value --}}
        <x-alert />

        <div class="card-body">
            <dl class="row">

                <dt class="col-sm-3">Title</dt>
                <dd class="col-sm-9">{{ $vacation->title }}</dd>

                <dt class="col-sm-3">Local</dt>
                <dd class="col-sm-9">{{ $vacation->local }}</dd>
                {{-- <dd class="col-sm-9">{{ 'R$ ' . number_format($conta->local, 2, ',', '.') }}</dd> --}}

                <dt class="col-sm-3">Description</dt>
                <dd class="col-sm-9">{{ $vacation->description }}</dd>
                {{-- <dd class="col-sm-9">{{ \Carbon\Carbon::parse($conta->vencimento)->tz('America/Sao_Paulo')->format('d/m/Y') }}</dd> --}}

                <dt class="col-sm-3">Plan Date</dt>
                <dd class="col-sm-9">{{ $vacation->date_plan }}</dd>
                {{-- <dd class="col-sm-9">
                    <a href="{{ route('conta.change-situation', [ 'conta' => $conta->id])}}">
                        {!! '<span class="badge text-bg-'. $conta->situacaoConta->cor .'">' . $conta->situacaoConta->nome . '</span>' !!}
                    </a>
                </dd> --}}

                <dt class="col-sm-3">Registered</dt>
                <dd class="col-sm-9">{{ \Carbon\Carbon::parse($vacation->created_at)->tz('America/Sao_Paulo')->format('d/m/Y H:i:s') }}</dd>

                <dt class="col-sm-3">Edited</dt>
                <dd class="col-sm-9">{{ \Carbon\Carbon::parse($vacation->updated_at)->tz('America/Sao_Paulo')->format('d/m/Y H:i:s') }}</dd>

            </dl>
            
        </div>
    </div>
@endsection
