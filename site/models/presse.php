<?php

/**
 * Presse-Übersicht.
 *
 * Die Pressenachrichten liegen auf Unterseiten je Jahr (Template presse-jahr).
 * Eine einzige große Liste lässt sich im Panel nicht mehr speichern: Die
 * IONOS-Firewall blockiert Anfragen mit mehr als 1000 Werten.
 */
class PressePage extends Page
{
    /**
     * Alle Pressenachrichten aller Jahre als eine Structure
     */
    public function allePressenachrichten(): Structure
    {
        $eintraege = [];

        foreach ($this->children()->template('presse-jahr') as $jahr) {
            foreach ($jahr->pressenachrichten()->yaml() as $eintrag) {
                $eintraege[] = $eintrag;
            }
        }

        return Structure::factory($eintraege, ['parent' => $this]);
    }
}
