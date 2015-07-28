<?php
/*
 * Copyright Olegs Capligins, 2013
 *
 * This file is fork of BMPM (Beider-Morse Phonetic Matching System)
 * Copyright: Stephen P. Morse, 2005.
 * Website:   http://stevemorse.org/phoneticinfo.htm
 *
 * This is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * It is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY
 * or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public
 * License for more details.
 *
 * You should have received a copy of the GNU General Public License.
 * If not, see <http://www.gnu.org/licenses/>.
 */

/* require(__DIR__.'/../Phonetic/BeiderMorse/gen/french/approx.php');*/
/* require('/Phonetic/BeiderMorse/gen/french/approx.php');*/

$search_file_name = "";
$root = $_SERVER['DOCUMENT_ROOT'];
if (substr($root, 1, 5) === 'home') {
	$search_file_name = "" . $_SERVER['DOCUMENT_ROOT'] . "/";
	}
$search_file_name .= 'Phonetic/BeiderMorse/gen/french/approx.php';
	
require($search_file_name);

// this file uses the same rules as french/approx.php
$this->approx[ $this->getLanguageIndexByName('czech') ] = $this->approx[ $this->getLanguageIndexByName('french') ];