@extends('layouts.main')

@section('content')

<div class="card">
    <div class="card-hearder">
        <h2 class="text-title">
            <a class="btn btn-secondary btn-pill float-start" href="{{ route('espacoCafes.index') }}">Voltar</a>
            Edição do espaço de café <strong>{{ $espaco->nome }}</strong>
        </h2>
    </div>
    <div class="card-body">
        <form action="{{ route('espacoCafes.update', $espaco->id) }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <h4>Edição</h4>
                    <hr class="mt-0">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label" for="nome">Nome</label>
                    <input class="form-control @error('nome') is-invalid @enderror" type="text"
                        name="nome" value="{{ $espaco->nome }}">
                    @error('nome')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label" for="lotacao">Lotacao</label>
                    <input class="form-control @error('lotacao') is-invalid @enderror" type="number"
                        name="lotacao" value="{{ $espaco->lotacao }}">
                    @error('lotacao')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-12">
                    <button class="btn btn-primary" type="submit">Salvar</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
