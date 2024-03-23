{{-- Inclusion of the predefined header  --}}
@extends('layouts.admin')
@section('content')

    <div class="card mt-3 mb-4 border-light shadow">
        <div class="card-header d-flex justify-content-between"><span>Look up</span></div>

        <div class="card-body">
            <form action="{{ route('vacation.index') }}" method="GET">
                <div class="row">
                    <div class="col-md-3 col-sm-12">
                        <label class="form-label" for="nome">Title</label>
                        <input type="text" name="title" class="form-control" id="title" placeholder="Plan Title" value="{{ $title }}">
                    </div>

                    <div class="col-md-3 col-sm-12">
                        <label for="local" class="form-label">Local</label>
                        <input type="text" name="local" class="form-control" id="local" placeholder="Vacation spot" value="{{ $local }}">
                    </div>

                    <div class="col-md-3 col-sm-12">
                        <label for="date_plan" class="form-label">Plan Date</label>
                        <input type="date" name="date_plan" class="form-control" id="date_plan" value="{{ $date_plan }}">
                    </div>

                    <div class="col-md-3 col-sm-12 mt-3 pt-4">
                        <button type="submit" class="btn btn-info btn-sm">Look up</button>
                        <a href="{{ route('vacation.index') }}" class="btn btn-warning btn-sm">Clean</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card mt-4 mb-4 border-light shadow">
        <div class="card-header d-flex justify-content-between">
            <span>List of Vacation Plans</span>
            <span>
                <a href="{{ url('gerar-pdf-vacation?' . request()->getQueryString()) }}" class="btn btn-danger btn-sm">Generate PDF</a>
            </span>
        </div>

        {{-- Check if there is a message and print the value --}}
        <x-alert />

        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Local</th>
                        <th scope="col">Plan Date</th>
                        <th scope="col" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i = 0 @endphp
                    @forelse ($vacation as $plan)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $plan->title }}</td>
                            <td>{{ $plan->local }}</td>
                            <td>{{ $plan->date_plan }}</td>

                            {{-- <td>{{ 'R$ ' . number_format($conta->valor, 2, ',', '.') }}</td>
                            <td>{{ \Carbon\Carbon::parse($conta->vencimento)->tz('America/Sao_Paulo')->format('d/m/Y') }}</td> --}}

                            {{-- <td>
                                <a href="{{ route('conta.change-situation', ['conta' => $conta->id]) }}">
                                    {!! '<span class="badge text-bg-' . $conta->situacaoConta->cor . '">' . $conta->situacaoConta->nome . '</span>' !!}
                                </a>
                            </td> --}}

                            <td class="d-md-flex justify-content-center">
                                <a href="{{ route('vacation.show', ['vacation' => $plan->id]) }}" class="btn btn-primary btn-sm me-1">Visualize</a>

                                <a href="{{ route('vacation.edit', ['vacation' => $plan->id]) }}" class="btn btn-warning btn-sm me-1">Edit</a>


                                <form id="formDelete{{ $plan->id }}"
                                    action="{{ route('vacation.destroy', ['vacation' => $plan->id]) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger btn-sm me-1"
                                        onclick="confirmDeletion(event, {{ $plan->id }})">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <span style="color: #f00;">No vacation plans found!</span>
                    @endforelse
                </tbody>
            </table>

            {{ $vacation->onEachSide(0)->links() }}
        </div>
    </div>
@endsection
