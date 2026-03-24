<?php

namespace App\Livewire;

use Livewire\Component;

class RevenueSimulator extends Component
{
    public int $nombreMotos = 1;
    public int $montantJournalier = 10000;

    public function updatedNombreMotos($value): void
    {
        $this->nombreMotos = max(1, min(50, (int) $value));
    }

    public function updatedMontantJournalier($value): void
    {
        $this->montantJournalier = max(1000, min(100000, (int) $value));
    }

    public function getRecettesHebdomadairesProperty(): int
    {
        return $this->montantJournalier * 6 * $this->nombreMotos;
    }

    public function getPartProprietaireHebdoProperty(): int
    {
        return (int) round($this->recettesHebdomadaires * 5 / 6);
    }

    public function getPartOkamiHebdoProperty(): int
    {
        return (int) round($this->recettesHebdomadaires * 1 / 6);
    }

    public function getEstimationMensuelleProperty(): int
    {
        return $this->partProprietaireHebdo * 4;
    }

    public function getEstimationAnnuelleProperty(): int
    {
        return (int) round($this->partProprietaireHebdo * 52);
    }

    public function render()
    {
        return view('livewire.revenue-simulator');
    }
}

