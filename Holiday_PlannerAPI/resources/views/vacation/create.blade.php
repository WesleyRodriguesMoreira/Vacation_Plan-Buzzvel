@extends('layouts.admin')

@section('content')
    <div class="card mt-4 mb-4 border-light shadow">
        <div class="card-header d-flex justify-content-between">
            <span>Vacation Plan Registration</span>
            <span>
                <a href="{{ route('vacation.index') }}" class="btn btn-info btn-sm ">Listar</a>
            </span>
        </div>

        {{-- Verificar se existe a sessão success e imprimir o valor --}}
        <x-alert />

        <div class="card-body">
            <form action="{{ route('vacation.store') }}" method="POST" class="row g-3">
                @csrf

                <div class="col-md-12 col-sm-12">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" name="title" class="form-control" id="title" placeholder="Plan Title" value="{{ old('title') }}">
                </div>

                <div class="col-md-12 col-sm-12">
                    <label for="local" class="form-label">Local</label>
                    <input type="text" name="local" class="form-control" id="local" placeholder="Vacation spot" value="{{ old('local') }}">
                </div>

                <div class="col-md-4 col-sm-12">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description" cols="30" rows="10" class="form-control" placeholder="Plan Description" value="{{ old('description') }}"></textarea>
                </div>

                <div class="col-md-4 col-sm-12">
                    <label for="date_plan" class="form-label">Plan Date</label>
                    <input type="date" name="date_plan" class="form-control" id="date_plan" value="{{ old('date_plan') }}">
                </div>

                {{-- <div class="col-md-4 col-sm-12">
                    <label for="situacao_conta_id" class="form-label">Situação da Conta</label>
                    <select name="situacao_conta_id" id="situacao_conta_id" class="form-select select2">
                        <option value="">Selecione</option>
                        @forelse ($situacoesContas as $situacaoConta)
                            <option value="{{ $situacaoConta->id }}"
                                {{ old('situacao_conta_id') == $situacaoConta->id ? 'selected' : '' }}>
                                {{ $situacaoConta->nome }}</option>
                        @empty
                            <option value="">Nenhuma situação da conta encontrada</option>
                        @endforelse
                    </select>
                </div> --}}

                <div class="col-12">
                    <button type="submit" class="btn btn-success btn-sm">Register</button>
                </div>

            </form>

        </div>
    </div>
@endsection
