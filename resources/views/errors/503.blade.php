@extends('errors.layout')

@section('title', 'Maintenance en cours')

@section('content')
    <div class="error-code">503</div>
    <h2>Maintenance en cours</h2>
    <p>Notre site est actuellement en maintenance. Nous serons de retour très bientôt.</p>
    <div class="mt-4">
        <i class="bi bi-gear-wide-connected fs-1 text-primary-okami" style="animation: spin 2s linear infinite;"></i>
    </div>
    <p class="mt-3 text-muted">Merci de votre patience.</p>
@endsection

