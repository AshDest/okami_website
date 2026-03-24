<div>
    <div class="simulator-card" data-aos="fade-up">
        <div class="simulator-header">
            <h3><i class="bi bi-calculator"></i> Simulateur de revenus</h3>
            <p class="mb-0 opacity-75">Estimez vos gains en tant que propriétaire partenaire OKAMI</p>
        </div>
        <div class="simulator-body">
            {{-- Nombre de motos --}}
            <div class="mb-4">
                <label class="form-label fw-bold">Nombre de motos</label>
                <div class="d-flex align-items-center gap-3">
                    <input type="range" class="form-range flex-grow-1" min="1" max="50" wire:model.live="nombreMotos">
                    <span class="badge bg-primary rounded-pill fs-6 px-3">{{ $nombreMotos }}</span>
                </div>
            </div>

            {{-- Montant journalier --}}
            <div class="mb-4">
                <label class="form-label fw-bold">Montant journalier par moto (FC)</label>
                <input type="number" class="form-control" wire:model.live.debounce.300ms="montantJournalier" min="1000" max="100000" step="500">
                <small class="text-muted">Montant standard : 10 000 FC / jour</small>
            </div>

            <hr class="my-4">

            {{-- Résultats --}}
            <div class="simulator-result">
                <span class="result-label"><i class="bi bi-calendar-week me-2"></i>Recettes hebdomadaires (6 jours)</span>
                <span class="result-value">{{ number_format($this->recettesHebdomadaires, 0, ',', ' ') }} FC</span>
            </div>

            <div class="simulator-result">
                <span class="result-label"><i class="bi bi-person-check me-2"></i>Votre part (5/6)</span>
                <span class="result-value">{{ number_format($this->partProprietaireHebdo, 0, ',', ' ') }} FC</span>
            </div>

            <div class="simulator-result">
                <span class="result-label"><i class="bi bi-building me-2"></i>Part OKAMI (1/6)</span>
                <span class="result-value">{{ number_format($this->partOkamiHebdo, 0, ',', ' ') }} FC</span>
            </div>

            <div class="simulator-result highlight">
                <span class="result-label"><i class="bi bi-calendar-month me-2"></i>Estimation mensuelle</span>
                <span class="result-value">{{ number_format($this->estimationMensuelle, 0, ',', ' ') }} FC</span>
            </div>

            <div class="simulator-result highlight">
                <span class="result-label"><i class="bi bi-calendar3 me-2"></i>Estimation annuelle</span>
                <span class="result-value">{{ number_format($this->estimationAnnuelle, 0, ',', ' ') }} FC</span>
            </div>

            <div class="mt-3 text-center">
                <small class="text-muted"><i class="bi bi-info-circle"></i> Ces estimations sont basées sur un taux de collecte de 100%. Les montants réels peuvent varier.</small>
            </div>
        </div>
    </div>
</div>

