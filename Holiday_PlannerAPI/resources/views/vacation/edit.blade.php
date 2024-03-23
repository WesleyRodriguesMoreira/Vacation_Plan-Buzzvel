{{-- Inclusion of the predefined header  --}}
@extends('layouts.admin')
@section('content')

    <div class="card mt-4 mb-4 border-light shadow">
        <div class="card-header d-flex justify-content-between">
            <span>Edit Vacation Plan</span>
        </div>

        {{-- Check if there is a message and print the value --}}
        <x-alert />

        <div class="card-body">

            <form action="{{ route('vacation.update', ['vacation' => $vacation->id]) }}" method="POST" class="row g-3">
                @csrf
                @method('PUT')

                <div class="col-md-12 col-sm-12">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" name="title" class="form-control" id="title" placeholder="Plan Title" value="{{ old('title' , $vacation->title )  }}">
                </div>

                <div class="col-md-12 col-sm-12">
                    <label for="local" class="form-label">Local</label>
                    <input type="text" name="local" class="form-control" id="local" placeholder="Vacation spot" value="{{ old('local' , $vacation->local) }}">
                </div>

                <div class="col-md-4 col-sm-12">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description" cols="30" rows="10" class="form-control" placeholder="Plan Description" value="{{ old('description' , $vacation->description) }}"></textarea>
                </div>

                <div class="col-md-4 col-sm-12">
                    <label for="date_plan" class="form-label">Plan Date</label>
                    <input type="date" name="date_plan" class="form-control" id="date_plan" value="{{ old('date_plan' , $vacation->date_plan) }}">
                </div>

                 {{-- <div class="col-md-4 col-sm-12">
                    <label for="valor" class="form-label">Valor</label>
                    <input type="text" name="valor" class="form-control" id="valor" placeholder="Valor da conta"
                        value="{{ old('valor', isset($conta->valor) ? number_format($conta->valor, '2', ',', '.') : '') }}">
                </div> --}}

                {{-- <div class="col-md-4 col-sm-12">
                    <label for="situacao_conta_id" class="form-label">Situação da Conta</label>
                    <select name="situacao_conta_id" id="situacao_conta_id" class="form-select select2">
                        <option value="">Selecione</option>
                        @forelse ($situacoesContas as $situacaoConta)
                            <option value="{{ $situacaoConta->id }}"
                                {{ old('situacao_conta_id', $conta->situacao_conta_id) == $situacaoConta->id ? 'selected' : '' }}>
                                {{ $situacaoConta->nome }}</option>
                        @empty
                            <option value="">Nenhuma situação da conta encontrada</option>
                        @endforelse
                    </select>
                </div> --}}

                <div class="col-12">
                    <button type="submit" class="btn btn-warning btn-sm">Save</button>
                </div>

            </form>
        </div>
    </div>
@endsection
