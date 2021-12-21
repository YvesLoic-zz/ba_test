@extends('home')

@section('title', config('app.name') . ' - Nouvel utilisateur')

@section('center')
    <div class="card">
        <div class="card-header">
            Informations de l'utilisateur
            @if (!empty($user) && !empty($user->deleted_at))
                <span class="badge bg-warning float-end">
                    Utilisateur Supprimé
                </span>
            @endif
        </div>
        <div class="card-body">
            {!! form($form) !!}
        </div>
    </div>
@endsection
