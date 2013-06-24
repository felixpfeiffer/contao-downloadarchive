<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * TYPOlight webCMS
 * Copyright (C) 2005 Leo Feyer
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 2.1 of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at http://www.gnu.org/licenses/.
 *
 * PHP version 5
 * @copyright  Felix Pfeiffer 2008 
 * @author     Felix Pfeiffer :: Neue Medien 
 * @package    downloadarchiv 
 * @license    LGPL 
 * @filesource
 */


/**
 * Fields
 */
$GLOBALS['TL_LANG']['tl_downloadarchiv']['title'] = array('Name', 'Geben Sie einen Namen für das Download-Archiv an. Dieser wird lediglich für die Anzeige im Backend verwendet.');
$GLOBALS['TL_LANG']['tl_downloadarchiv']['showMeta']     = array('Metadaten Anzeigen?', 'Sollen Upload-Datum und Größe der Dateien angezeigt werden?');
$GLOBALS['TL_LANG']['tl_downloadarchiv']['hideDate']     = array('Datum ausblenden', 'Die Anzeige des Upload-Datums ausblenden.');
$GLOBALS['TL_LANG']['tl_downloadarchiv']['loadDirectory'] = array('Verzeichnis einlesen?', 'Sie können alle Dateien eines Verzeichnisses automatisch in das Downloadarchiv einlesen lassen. Dies geht nur, solange noch keine Dateien in dem Downloadarchiv gespeichert sind.');
$GLOBALS['TL_LANG']['tl_downloadarchiv']['loadSubdir'] = array('Unterverzeichnisse durchsuchen', 'Sollen auch alle Untervezeichnisse nach Dateien durchsucht werden?');
$GLOBALS['TL_LANG']['tl_downloadarchiv']['dirSRC'] = array('Verzeichnis auswählen', 'Wählen Sie das Verzeichnis aus, welches Sie durchsuchen möchten.');
$GLOBALS['TL_LANG']['tl_downloadarchiv']['prefix'] = array('Namens-Prefix verwenden', 'Sie können die Titel der Dateien automatisch generieren lassen. Der Name setzt sich dann aus dem Prefix und einer steigenden Zahl zusammen. (Beispiel: "Unsere Produkte 0001")<br />Der Dateiname wird dabei NICHT geändert.');
$GLOBALS['TL_LANG']['tl_downloadarchiv']['extension'] = array('Erweiterungen', 'Sie können die Suche auf bestimmte Dateiendungen beschränken. Also z.B. nur PDF-Dokumente in das Archiv aufnehmen. Geben Sie die Dateiendungen mit Komma getrennt ein.');
$GLOBALS['TL_LANG']['tl_downloadarchiv']['publishAll'] = array('Alle Dateien veröffentlichen', 'Wählen Sie diese Checkbox, werden beim Import alle Dateien automatisch veröffentlicht.<br />Ansonsten müssen Sie jede Datei einzlen oder über die Funktion "Mehrere bearbeiten" veröffentlichen.');
$GLOBALS['TL_LANG']['tl_downloadarchiv']['class'] = array('CSS-Klasse', 'Sie können diesem Archiv eine CSS-Klasse zuweisen. Diese wird jeder Datei übergeben.');
$GLOBALS['TL_LANG']['tl_downloadarchiv']['published']     = array('Veröffentlicht', 'Solange Sie diese Option nicht wählen, ist das Archiv für die Besucher Ihrer Webseite nicht sichtbar.');
$GLOBALS['TL_LANG']['tl_downloadarchiv']['start']        = array('Anzeigen ab', 'Das Archiv erst ab diesem Tag auf der Webseite anzeigen.');
$GLOBALS['TL_LANG']['tl_downloadarchiv']['stop']         = array('Anzeigen bis', 'Das Archiv nur bis zu diesem Tag auf der Webseite anzeigen.');

/**
 * Reference
 */
$GLOBALS['TL_LANG']['tl_downloadarchiv']['deleteConfirm'] = 'Wollen Sie das Download-Archiv ID %s wirklich entfernen?\n(Die Dateien werden dabei NICHT vom Server gelöscht.)';

/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_downloadarchiv']['new']    = array('Neues Archiv', 'Legen Sie ein neues Download-Archiv an.');
$GLOBALS['TL_LANG']['tl_downloadarchiv']['edit']   = array('Archiv bearbeiten', 'Download-Archiv mit der ID %s bearbeiten');
$GLOBALS['TL_LANG']['tl_downloadarchiv']['copy']   = array('Archiv kopieren', 'Download-Archiv mit der ID %s kopieren');
$GLOBALS['TL_LANG']['tl_downloadarchiv']['delete'] = array('Archiv löschen', 'Download-Archiv mit der ID %s löschen');
$GLOBALS['TL_LANG']['tl_downloadarchiv']['show']   =array('Details anzeigen', 'Die Details des Download-Archivs mit der ID %s anzeigen');

/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_downloadarchiv']['title_legend']      = 'Titel';
$GLOBALS['TL_LANG']['tl_downloadarchiv']['directory_legend']  = 'Verzeichnis einlesen';
$GLOBALS['TL_LANG']['tl_downloadarchiv']['publish_legend']    = 'Veröffentlichung';
?>