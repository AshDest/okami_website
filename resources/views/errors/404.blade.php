@extends('errors.layout')

@section('title', 'Page non trouvée')

@section('content')
    <div class="error-code">404</div>
    <h2>Page non trouvée</h2>
    <p>Désolé, la page que vous recherchez n'existe pas ou a été déplacée.</p>
    <a href="{{ route('home') }}" class="btn btn-primary-okami">
        <i class="bi bi-house"></i> Retour à l'accueil
    </a>
@endsection

