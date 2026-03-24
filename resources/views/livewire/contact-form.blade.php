<div>
    @if($sent)
        <div class="alert alert-success d-flex align-items-center" role="alert" data-aos="fade-up">
            <i class="bi bi-check-circle-fill me-2 fs-4"></i>
            <div>
                <strong>Message envoyé avec succès !</strong><br>
                Merci de nous avoir contacté. Notre équipe vous répondra dans les plus brefs délais.
            </div>
        </div>
    @else
        <form wire:submit="submit">
            <div class="row g-3">
                {{-- Nom --}}
                <div class="col-md-6">
                    <label for="nom" class="form-label">Nom complet <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('nom') is-invalid @enderror" id="nom" wire:model.blur="nom" placeholder="Votre nom complet">
                    @error('nom') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{-- Email --}}
                <div class="col-md-6">
                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" wire:model.blur="email" placeholder="votre@email.com">
                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{-- Téléphone --}}
                <div class="col-md-6">
                    <label for="telephone" class="form-label">Téléphone <span class="text-danger">*</span></label>
                    <input type="tel" class="form-control @error('telephone') is-invalid @enderror" id="telephone" wire:model.blur="telephone" placeholder="+243 XXX XXX XXX">
                    @error('telephone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{-- Sujet --}}
                <div class="col-md-6">
                    <label for="sujet" class="form-label">Sujet <span class="text-danger">*</span></label>
                    <select class="form-select @error('sujet') is-invalid @enderror" id="sujet" wire:model.blur="sujet">
                        <option value="">-- Sélectionnez un sujet --</option>
                        <option value="Propriétaire">Propriétaire</option>
                        <option value="Motard">Motard</option>
                        <option value="Partenariat">Partenariat</option>
                        <option value="Réclamation">Réclamation</option>
                        <option value="Autre">Autre</option>
                    </select>
                    @error('sujet') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{-- Message --}}
                <div class="col-12">
                    <label for="message" class="form-label">Message <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('message') is-invalid @enderror" id="message" wire:model.blur="message" rows="5" placeholder="Votre message..."></textarea>
                    @error('message') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{-- Bouton --}}
                <div class="col-12">
                    <button type="submit" class="btn btn-primary-okami w-100" wire:loading.attr="disabled">
                        <span wire:loading.remove>
                            <i class="bi bi-send"></i> Envoyer le message
                        </span>
                        <span wire:loading>
                            <span class="spinner-okami"></span> Envoi en cours...
                        </span>
                    </button>
                </div>
            </div>
        </form>
    @endif
</div>

