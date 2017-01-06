<?php
/* <one line to give the program's name and a brief idea of what it does.>
 * Copyright (C) 2015 ATM Consulting <support@atm-consulting.fr>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

/**
 *	\file		lib/grapefruit.lib.php
 *	\ingroup	grapefruit
 *	\brief		This file is an example module library
 *				Put some comments here
 */

function grapefruitAdminPrepareHead()
{
    global $langs, $conf;

    $langs->load("grapefruit@grapefruit");

    $h = 0;
    $head = array();

    $head[$h][0] = dol_buildpath("/grapefruit/admin/grapefruit_setup.php", 1);
    $head[$h][1] = $langs->trans("Parameters");
    $head[$h][2] = 'settings';
    $h++;
    $head[$h][0] = dol_buildpath("/grapefruit/admin/grapefruit_about.php", 1);
    $head[$h][1] = $langs->trans("About");
    $head[$h][2] = 'about';
    $h++;

    // Show more tabs from modules
    // Entries must be declared in modules descriptor with line
    //$this->tabs = array(
    //	'entity:+tabname:Title:@grapefruit:/grapefruit/mypage.php?id=__ID__'
    //); // to add new tab
    //$this->tabs = array(
    //	'entity:-tabname:Title:@grapefruit:/grapefruit/mypage.php?id=__ID__'
    //); // to remove a tab
    complete_head_from_modules($conf, $langs, $object, $head, $h, 'grapefruit');

    return $head;
}

function grapefruitGetTasksForProject($name='fk_task', $socid=-1, $showempty=1, $projectid=0)
{
	global $db;
	
	dol_include_once('/core/class/html.form.class.php');
	
	$form = new Form($db);
	$TTask = getTaskByProjectId($projectid);
	
	$return=array();
	$return['value'] = $form->selectarray('fk_task', $TTask, '', 1, 0, 0, '', 0, 0, 0, '', 'minwidth100 maxwidth300', 1);
	
	echo json_encode($return);
}

function getTaskByProjectId($projectid=0)
{
	global $db,$conf;
	
	$TRes = array();
	
	if (empty($projectid)) return $TRes;
	
	$sql = 'SELECT t.rowid, t.ref as tref, t.label as tlabel, p.ref, p.title, p.fk_soc, p.fk_statut, p.public,';
	$sql.= ' s.nom as name';
	$sql.= ' FROM '.MAIN_DB_PREFIX .'projet as p';
	$sql.= ' LEFT JOIN '.MAIN_DB_PREFIX.'societe as s ON s.rowid = p.fk_soc';
	$sql.= ', '.MAIN_DB_PREFIX.'projet_task as t';
	$sql.= " WHERE p.entity = ".$conf->entity;
	$sql.= " AND t.fk_projet = p.rowid";
	$sql.= " AND p.rowid = ".$projectid;
	//if ($socid == 0) $sql.= " AND (p.fk_soc=0 OR p.fk_soc IS NULL)";
	//if ($socid > 0)  $sql.= " AND (p.fk_soc=".$socid." OR p.fk_soc IS NULL)";
	$sql.= " ORDER BY p.ref, t.ref ASC";
	
	$resql=$db->query($sql);
	if ($resql)
	{
		while ($line = $db->fetch_object($resql)) 
		{
			$TRes[$line->rowid] = $line->tref.' '.$line->tlabel;
		}
	}
	
	return $TRes;
}

function manageDefaultTvaOnDocumentClient($action)
{
	global $db;
	
	dol_include_once('/core/class/extrafields.class.php');
	$extra = new Extrafields($db);
	
	if ($action == 1)
	{
		$extra->fetch_name_optionals_label('propal');
		if (!isset($extra->attribute_list['grapefruit_default_doc_tva'])) _createExtraForDocumentClient($extra, 'propal');
		
		$extra->fetch_name_optionals_label('commande');
		if (!isset($extra->attribute_list['grapefruit_default_doc_tva'])) _createExtraForDocumentClient($extra, 'commande');
		
		$extra->fetch_name_optionals_label('facture');
		if (!isset($extra->attribute_list['grapefruit_default_doc_tva'])) _createExtraForDocumentClient($extra, 'facture');
		
	}
	elseif ($action == 0)
	{
		_deleteExtraForDocumentClient($extra, 'propal');
		_deleteExtraForDocumentClient($extra, 'commande');
		_deleteExtraForDocumentClient($extra, 'facture');
	}
}

function _createExtraForDocumentClient(&$extra, $type)
{
	$extra->addExtraField('grapefruit_default_doc_tva', 'TVA Lignes', 'double', 1, '24,8', $type, 0, 0, '', unserialize('a:1:{s:7:"options";a:1:{s:0:"";N;}}'), 1, '', 0, 0);
}

function _deleteExtraForDocumentClient(&$extra, $type)
{
	$extra->delete('grapefruit_default_doc_tva', $type);
}

function manageDefaultProgressOnSituationInvoice($action)
{
	global $db;
	
	dol_include_once('/core/class/extrafields.class.php');
	$extra = new Extrafields($db);
	
	if ($action == 1)
	{
		$extra->fetch_name_optionals_label('facture');
		if (!isset($extra->attribute_list['grapefruit_default_situation_progress_line'])) $extra->addExtraField('grapefruit_default_situation_progress_line', 'Progression Lignes', 'double', 2, '24,8', 'facture', 0, 0, '', unserialize('a:1:{s:7:"options";a:1:{s:0:"";N;}}'), 1, '', 0, 0);
	}
	else
	{
		$extra->delete('grapefruit_default_situation_progress_line', 'facture');
	}
}