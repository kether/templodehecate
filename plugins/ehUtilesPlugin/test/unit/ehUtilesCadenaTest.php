<?php

require_once dirname(__FILE__).'/../../../../test/bootstrap/unit.php';
 
$t = new lime_test(10, new lime_output_color());
 
$t->comment('::cadenaParaURL()');
$t->is(ehUtilesCadena::cadenaParaURL('Estudio'), 'estudio', '::cadenaParaURL() pone todos los caracteres en minusculas');
$t->is(ehUtilesCadena::cadenaParaURL('estudio hecate'), 'estudio-hecate', '::cadenaParaURL() reemplaza los espacios por guiones -');
$t->is(ehUtilesCadena::cadenaParaURL('estudio   hecate'), 'estudio-hecate', '::cadenaParaURL() reemplaza varios espacios por un guion');
$t->is(ehUtilesCadena::cadenaParaURL('  hecate'), 'hecate', '::cadenaParaURL() elimina los espacios al principio de la frase');
$t->is(ehUtilesCadena::cadenaParaURL('estudio  '), 'estudio', '::cadenaParaURL() elimina todos los espacios al final de la frase');
$t->is(ehUtilesCadena::cadenaParaURL('estudio,hecate'), 'estudio-hecate', '::cadenaParaURL() reemplaza los caracteres no ASCII por -');
$t->is(ehUtilesCadena::cadenaParaURL('hécate'), 'hecate', '::cadenaParaURL() suprime los acentos');

$t->comment('::codigoPlataformaVideo()');
$t->is(ehUtilesCadena::codigoPlataformaVideo('http://www.youtube.com/watch?v=fDEFPam9U0M'), 'fDEFPam9U0M', 'recupera el codigo de la url');
$t->is(ehUtilesCadena::codigoPlataformaVideo('http://es.youtube.com/watch?v=fDEFPam9U0M'), 'fDEFPam9U0M', 'recupera el codigo de la url cambiando el www');
$t->is(ehUtilesCadena::codigoPlataformaVideo('http://www.youtube.com/watch?v=vpgvmHTBFt8&feature=related'), 'vpgvmHTBFt8', 'extra el codigo surpimiendo parametros');