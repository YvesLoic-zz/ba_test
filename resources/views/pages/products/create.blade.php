@extends('home')

@section('title', config('app.name') . ' - Nouveau produit')

@section('center')
    <div class="card">
        <div class="card-header">
            Informations d'un produit
            @if (!empty($product) && !empty($product->deleted_at))
                <span class="badge bg-warning float-end">
                    Produit Supprimé
                </span>
            @endif
        </div>
        <div class="card-body">
            {!! form($form) !!}
        </div>
    </div>
@endsection
