<?php

// Dieses Plugin erzeugt ein automatisches Inhaltsverzeichnis am Kopf des Contents.
// Das Plugin wird daher im Theme manuell aufgerufen statt über einen HOOK.
// In der aktuellen Version ist das Inhaltsverzeichnis noch ohne Link-Funktion.
// Die SVG-Grafik 'icon_check_circle' wird verwendet und sollte daher in der 
// de_DE.json existieren.
//
// Autor: 	Oliver Lohse
// Datum: 	11.03.2022
// Version: 1.0

class pluginInhaltsverzeichnis extends Plugin {

	function getInhalt() {
        global $content, $pages, $items, $L;

		foreach ($content as $key=>$page) {
            $pageContent = $page->content(); 												// normaler Content mit HTML
			//$pageContent = $page->contentRaw(); 											// RAW Content ohne HTML

			$html = '<div class="bg-wp-dark text-light rounded p-3 mb-3">';
			$html .= '<strong>Inhaltsverzeichnis</strong>';
			$html .= '<ul class="mt-3" style="list-style: none; padding-left: 5px;">';
			while (stristr($pageContent, '<h2>')) {											// so lange ein HTag vorhanden ist
				$token = explode('<h2>', $pageContent);										// Start des HTags finden
				$token = explode('</h2>', $token[1]);										// Ende des HTags finden
				$pageContent = str_replace('<h2>'.$token[0].'</h2>', '', $pageContent);		// komplette Überschrift löschen
				$html .= '<li>'.$L->get('icon_check_circle').' &ensp; '.$token[0].'</li>';
			}
			$html .= '</ul>';
			$html .= '</div>';

			echo $html;
        }
    }
}