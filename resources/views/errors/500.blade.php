@extends('errors.layout')

@section('title', 'Erreur serveur')

@section('content')
    <div class="error-code">500</div>
    <h2>Erreur serveur</h2>
    <p>Désolé, une erreur interne est survenue. Notre équipe technique a été notifiée.</p>
    <a href="{{ route('home') }}" class="btn btn-primary-okami">
        <i class="bi bi-house"></i> Retour à l'accueil
    </a>
@endsection

