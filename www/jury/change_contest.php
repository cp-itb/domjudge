<?php
/**
 * Change current contest
 *
 * Part of the DOMjudge Programming Contest Jury System and licenced
 * under the GNU GPL. See README and COPYING for details.
 */

$REQUIRED_ROLES = array('jury','balloon');
require('init.php');

if ( !is_numeric($_REQUEST['cid']) ) die("Invalid value for cid parameter");

if ( empty($_SERVER['HTTP_REFERER']) ) die("Missing referrer header.");

// Do not blatantly trust the full Referer header. Use only the path component
// so at least we remain inside our own domain.
$url = parse_url($_SERVER['HTTP_REFERER']);
if ( $url === false ) die("Invalid referrer header.");

$redir = $url['path'] . (empty($url['query']) ? '' : '?' . $url['query']) .
	 (empty($url['fragment']) ? '' : '#' . $url['fragment']);

dj_setcookie('domjudge_cid', $_REQUEST['cid']);

header('Location: ' . $redir);
