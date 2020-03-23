<?php

$links = [];
if(isset($loginLink)){
    $links[] = '<a href="'.$loginLink.'">Login</a>';
}
if(isset($privacyLink)){
    $links[] = '<a href="'.$privacyLink.'">Privacy Policy</a>';
}
if(isset($unsubscribeLink)){
    $links[] = '<a href="'.$unsubscribeLink.'"><unsubscribe>Unsubscribe</unsubscribe></a>';
}

$links = implode(' | ',$links);

$html = <<<HTML
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
 
<meta name="viewport" content="width=device-width"/>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<title>{$this->fetch('title')}</title>
<link rel="stylesheet" type="text/css" href="stylesheets/email.css"/>
</head>
<body bgcolor="#FFFFFF">
<table class="body-wrap">
<tr>
<td></td>
<td class="container" bgcolor="#FFFFFF">
<div class="content">
{$this->fetch('content')}
</div> 
</td>
<td></td>
</tr>
</table> 
 
<table class="footer-wrap">
<tr>
<td></td>
<td class="container">
 
<div class="content">
<table>
<tr>
<td align="center">
<p>
{$links}
</p>
</td>
</tr>
</table>
</div> 
</td>
<td></td>
</tr>
</table> 
</body>
</html>        
HTML;

$css = <<<CSS
/* ------------------------------------- 
		GLOBAL 
------------------------------------- */
* { 
	margin:0;
	padding:0;
}
* { font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; }

img { 
	max-width: 100%; 
}
.collapse {
	margin:0;
	padding:0;
}
body {
	-webkit-font-smoothing:antialiased; 
	-webkit-text-size-adjust:none; 
	width: 100%!important; 
	height: 100%;
}

table {
  max-width: 100%;
  background-color: transparent;
  border-collapse: collapse;
  border-spacing: 0;
}
.table {
  width: 100%;
  margin-bottom: 20px;
}
.table th,
.table td {
  padding: 8px;
  line-height: 20px;
  text-align: left;
  vertical-align: top;
  border-top: 1px solid #dddddd;
}
.table th {
  font-weight: bold;
}
.table thead th {
  vertical-align: bottom;
}
.table caption + thead tr:first-child th,
.table caption + thead tr:first-child td,
.table colgroup + thead tr:first-child th,
.table colgroup + thead tr:first-child td,
.table thead:first-child tr:first-child th,
.table thead:first-child tr:first-child td {
  border-top: 0;
}
.table tbody + tbody {
  border-top: 2px solid #dddddd;
}
.table-condensed th,
.table-condensed td {
  padding: 4px 5px;
}
.table-bordered {
  border: 1px solid #dddddd;
  border-collapse: separate;
  *border-collapse: collapse;
  border-left: 0;
  -webkit-border-radius: 4px;
  -moz-border-radius: 4px;
  border-radius: 4px;
}
.table-bordered th,
.table-bordered td {
  border-left: 1px solid #dddddd;
}
.table-bordered caption + thead tr:first-child th,
.table-bordered caption + tbody tr:first-child th,
.table-bordered caption + tbody tr:first-child td,
.table-bordered colgroup + thead tr:first-child th,
.table-bordered colgroup + tbody tr:first-child th,
.table-bordered colgroup + tbody tr:first-child td,
.table-bordered thead:first-child tr:first-child th,
.table-bordered tbody:first-child tr:first-child th,
.table-bordered tbody:first-child tr:first-child td {
  border-top: 0;
}
.table-bordered thead:first-child tr:first-child th:first-child,
.table-bordered tbody:first-child tr:first-child td:first-child {
  -webkit-border-top-left-radius: 4px;
  border-top-left-radius: 4px;
  -moz-border-radius-topleft: 4px;
}
.table-bordered thead:first-child tr:first-child th:last-child,
.table-bordered tbody:first-child tr:first-child td:last-child {
  -webkit-border-top-right-radius: 4px;
  border-top-right-radius: 4px;
  -moz-border-radius-topright: 4px;
}
.table-bordered thead:last-child tr:last-child th:first-child,
.table-bordered tbody:last-child tr:last-child td:first-child,
.table-bordered tfoot:last-child tr:last-child td:first-child {
  -webkit-border-radius: 0 0 0 4px;
  -moz-border-radius: 0 0 0 4px;
  border-radius: 0 0 0 4px;
  -webkit-border-bottom-left-radius: 4px;
  border-bottom-left-radius: 4px;
  -moz-border-radius-bottomleft: 4px;
}
.table-bordered thead:last-child tr:last-child th:last-child,
.table-bordered tbody:last-child tr:last-child td:last-child,
.table-bordered tfoot:last-child tr:last-child td:last-child {
  -webkit-border-bottom-right-radius: 4px;
  border-bottom-right-radius: 4px;
  -moz-border-radius-bottomright: 4px;
}
.table-bordered caption + thead tr:first-child th:first-child,
.table-bordered caption + tbody tr:first-child td:first-child,
.table-bordered colgroup + thead tr:first-child th:first-child,
.table-bordered colgroup + tbody tr:first-child td:first-child {
  -webkit-border-top-left-radius: 4px;
  border-top-left-radius: 4px;
  -moz-border-radius-topleft: 4px;
}
.table-bordered caption + thead tr:first-child th:last-child,
.table-bordered caption + tbody tr:first-child td:last-child,
.table-bordered colgroup + thead tr:first-child th:last-child,
.table-bordered colgroup + tbody tr:first-child td:last-child {
  -webkit-border-top-right-radius: 4px;
  border-top-right-radius: 4px;
  -moz-border-radius-topleft: 4px;
}
.table-striped tbody tr:nth-child(odd) td,
.table-striped tbody tr:nth-child(odd) th {
  background-color: #f9f9f9;
}
.table-hover tbody tr:hover td,
.table-hover tbody tr:hover th {
  background-color: #f5f5f5;
}
table [class*=span],
.row-fluid table [class*=span] {
  display: table-cell;
  float: none;
  margin-left: 0;
}
.table .span1 {
  float: none;
  width: 44px;
  margin-left: 0;
}
.table .span2 {
  float: none;
  width: 124px;
  margin-left: 0;
}
.table .span3 {
  float: none;
  width: 204px;
  margin-left: 0;
}
.table .span4 {
  float: none;
  width: 284px;
  margin-left: 0;
}
.table .span5 {
  float: none;
  width: 364px;
  margin-left: 0;
}
.table .span6 {
  float: none;
  width: 444px;
  margin-left: 0;
}
.table .span7 {
  float: none;
  width: 524px;
  margin-left: 0;
}
.table .span8 {
  float: none;
  width: 604px;
  margin-left: 0;
}
.table .span9 {
  float: none;
  width: 684px;
  margin-left: 0;
}
.table .span10 {
  float: none;
  width: 764px;
  margin-left: 0;
}
.table .span11 {
  float: none;
  width: 844px;
  margin-left: 0;
}
.table .span12 {
  float: none;
  width: 924px;
  margin-left: 0;
}
.table .span13 {
  float: none;
  width: 1004px;
  margin-left: 0;
}
.table .span14 {
  float: none;
  width: 1084px;
  margin-left: 0;
}
.table .span15 {
  float: none;
  width: 1164px;
  margin-left: 0;
}
.table .span16 {
  float: none;
  width: 1244px;
  margin-left: 0;
}
.table .span17 {
  float: none;
  width: 1324px;
  margin-left: 0;
}
.table .span18 {
  float: none;
  width: 1404px;
  margin-left: 0;
}
.table .span19 {
  float: none;
  width: 1484px;
  margin-left: 0;
}
.table .span20 {
  float: none;
  width: 1564px;
  margin-left: 0;
}
.table .span21 {
  float: none;
  width: 1644px;
  margin-left: 0;
}
.table .span22 {
  float: none;
  width: 1724px;
  margin-left: 0;
}
.table .span23 {
  float: none;
  width: 1804px;
  margin-left: 0;
}
.table .span24 {
  float: none;
  width: 1884px;
  margin-left: 0;
}
.table tbody tr.success td {
  background-color: #dff0d8;
}
.table tbody tr.error td {
  background-color: #f2dede;
}
.table tbody tr.warning td {
  background-color: #fcf8e3;
}
.table tbody tr.info td {
  background-color: #d9edf7;
}
.table-hover tbody tr.success:hover td {
  background-color: #d0e9c6;
}
.table-hover tbody tr.error:hover td {
  background-color: #ebcccc;
}
.table-hover tbody tr.warning:hover td {
  background-color: #faf2cc;
}
.table-hover tbody tr.info:hover td {
  background-color: #c4e3f3;
}
/* ------------------------------------- 
		ELEMENTS 
------------------------------------- */
a { color: #2BA6CB;}

.btn {
	text-decoration:none;
	color: #FFF;
	background-color: #666;
	padding:10px 16px;
	font-weight:bold;
	margin-right:10px;
	text-align:center;
	cursor:pointer;
	display: inline-block;
}

p.callout {
	padding:15px;
	background-color:#ECF8FF;
	margin-bottom: 15px;
}
.callout a {
	font-weight:bold;
	color: #2BA6CB;
}

table.social {
/* 	padding:15px; */
	background-color: #ebebeb;
	
}
.social .soc-btn {
	padding: 3px 7px;
	font-size:12px;
	margin-bottom:10px;
	text-decoration:none;
	color: #FFF;font-weight:bold;
	display:block;
	text-align:center;
}
a.fb { background-color: #3B5998!important; }
a.tw { background-color: #1daced!important; }
a.gp { background-color: #DB4A39!important; }
a.ms { background-color: #000!important; }

.sidebar .soc-btn { 
	display:block;
	width:100%;
}

/* ------------------------------------- 
		HEADER 
------------------------------------- */
table.head-wrap { width: 100%;}

.header.container table td.logo { padding: 15px; }
.header.container table td.label { padding: 15px; padding-left:0px;}


/* ------------------------------------- 
		BODY 
------------------------------------- */
table.body-wrap { width: 100%;}


/* ------------------------------------- 
		FOOTER 
------------------------------------- */
table.footer-wrap { width: 100%;	clear:both!important;
}
.footer-wrap .container td.content  p { border-top: 1px solid rgb(215,215,215); padding-top:15px;}
.footer-wrap .container td.content p {
	font-size:10px;
	font-weight: bold;
	
}


/* ------------------------------------- 
		TYPOGRAPHY 
------------------------------------- */
h1,h2,h3,h4,h5,h6 {
font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif; line-height: 1.1; margin-bottom:15px; color:#000;
}
h1 small, h2 small, h3 small, h4 small, h5 small, h6 small { font-size: 60%; color: #6f6f6f; line-height: 0; text-transform: none; }

h1 { font-weight:200; font-size: 44px;}
h2 { font-weight:200; font-size: 37px;}
h3 { font-weight:500; font-size: 27px;}
h4 { font-weight:500; font-size: 23px;}
h5 { font-weight:900; font-size: 17px;}
h6 { font-weight:900; font-size: 14px; text-transform: uppercase; color:#444;}

.collapse { margin:0!important;}

p, ul { 
	margin-bottom: 10px; 
	font-weight: normal; 
	font-size:14px; 
	line-height:1.6;
}
p.lead { font-size:17px; }
p.last { margin-bottom:0px;}

ul li {
	margin-left:5px;
	list-style-position: inside;
}

/* ------------------------------------- 
		SIDEBAR 
------------------------------------- */
ul.sidebar {
	background:#ebebeb;
	display:block;
	list-style-type: none;
}
ul.sidebar li { display: block; margin:0;}
ul.sidebar li a {
	text-decoration:none;
	color: #666;
	padding:10px 16px;
/* 	font-weight:bold; */
	margin-right:10px;
/* 	text-align:center; */
	cursor:pointer;
	border-bottom: 1px solid #777777;
	border-top: 1px solid #FFFFFF;
	display:block;
	margin:0;
}
ul.sidebar li a.last { border-bottom-width:0px;}
ul.sidebar li a h1,ul.sidebar li a h2,ul.sidebar li a h3,ul.sidebar li a h4,ul.sidebar li a h5,ul.sidebar li a h6,ul.sidebar li a p { margin-bottom:0!important;}



/* --------------------------------------------------- 
		RESPONSIVENESS
		Nuke it from orbit. It's the only way to be sure. 
------------------------------------------------------ */

/* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */
.container {
	display:block!important;
	max-width:600px!important;
	margin:0 auto!important; /* makes it centered */
	clear:both!important;
}

/* This should also be a block element, so that it will fill 100% of the .container */
.content {
	padding:15px;
	max-width:600px;
	margin:0 auto;
	display:block; 
}

/* Let's make sure tables in the content area are 100% wide */
.content table { width: 100%; }


/* Odds and ends */
.column {
	width: 300px;
	float:left;
}
.column tr td { padding: 15px; }
.column-wrap { 
	padding:0!important; 
	margin:0 auto; 
	max-width:600px!important;
}
.column table { width:100%;}
.social .column {
	width: 280px;
	min-width: 279px;
	float:left;
}

/* Be sure to place a .clear element after each set of columns, just to be safe */
.clear { display: block; clear: both; }


/* ------------------------------------------- 
		PHONE
		For clients that support media queries.
		Nothing fancy. 
-------------------------------------------- */
@media only screen and (max-width: 600px) {
	
	a[class="btn"] { display:block!important; margin-bottom:10px!important; background-image:none!important; margin-right:0!important;}

	div[class="column"] { width: auto!important; float:none!important;}
	
	table.social div[class="column"] {
		width:auto!important;
	}

}
CSS;
?>

<?= $this->Dak->inlineCss($html, $css) ?>
