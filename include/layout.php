<?php
/* $Id$ */


require_once 'site.php';


# spacer()
# print a IMG tag for a sized spacer GIF
#

function spacer($width=1, $height=1, $align=false, $extras=false) {
	printf('<img src="/gifs/spacer.gif" width="%d" height="%d" border="0" alt="" %s%s>',
		$width,
		$height,
		($align ? 'align="'.$align.'" ' : ''),
		($extras ? $extras : '')
	);
}



# resize_image()
# tag the output of make_image() and resize it manually
#

function resize_image($img, $width=1, $height=1) {
	$str = preg_replace('/width=\"([0-9]+?)\"/i', '', $img );
	$str = preg_replace('/height=\"([0-9]+?)\"/i', '', $str );
	$str = substr($str,0,-1) . sprintf(' height="%s" width="%s">', $height, $width );
	return $str;
}



# make_image()
# return an IMG tag for a given file (relative to the images dir)
#

function make_image($file, $alt=false, $align=false, $extras=false, $dir=false, $border=0) {
	global $HTTP_SERVER_VARS;
	if (!$dir) {
		$dir = '/gifs';
	}
	if ($size = @getimagesize($HTTP_SERVER_VARS['DOCUMENT_ROOT'].$dir.'/'.$file)) {
		$image = sprintf('<img src="%s/%s" border="%d" %s ALT="%s" %s%s>',
			$dir,
			$file,
			$border,
			$size[3],
			($alt    ? $alt : ''),
			($align  ? ' align="'.$align.'"'  : ''),
			($extras ? ' '.$extras            : '')
		);
	} else {
		$image = sprintf('<img src="%s/%s" border="%d" ALT="%s" %s%s>',
			$dir,
			$file,
			$border,
			($alt    ? $alt : ''),
			($align  ? ' ALIGN="'.$align.'"'  : ''),
			($extras ? ' '.$extras            : '')
		);
	}
	return $image;
}



# print_image()
# print an IMG tag for a given file
#

function print_image($file, $alt=false, $align=false, $extras=false, $dir=false, $border=0) {
	print make_image($file, $alt, $align, $extras, $dir);
}



# make_submit()
#  - make a submit button image
#
function make_submit($file, $alt=false, $align=false, $extras=false, $dir=false, $border=0) {
	if (!$dir) {
		$dir = '/gifs';
	}
	$return = make_image($file, $alt, $align, $extras, $dir, $border);
	if ($return != "<img>") {
		$return = '<input type="image"'.substr($return,4);
	} else {
		$return = '<input type="submit">';
	}
	return $return;
}



# delim()
# print a pipe delimiter
#

function delim($color=false) {
	if (!$color) {
		return '&nbsp;|&nbsp;';
	}
	return sprintf('<font color="%s">&nbsp;|&nbsp;</font>', $color );
}



# hdelim()
# print a horizontal delimiter (just a wide line);
#

function hdelim($color="#000000") {
	if (!$color) {
		return '<hr noshade size="1">';
	}
	return sprintf('<hr noshade size="1" color="%s">', $color );
}



# make_link()
# return a hyperlink to something, within the site
#

function make_link ($url, $linktext=false, $target=false, $extras=false) {
	return sprintf("<a href=\"%s\"%s%s>%s</a>",
		$url,
		($target ? ' target="'.$target.'"' : ''),
		($extras ? ' '.$extras : ''),
		($linktext ? $linktext : $url)
	);
}



# print_link()
# echo a hyperlink to something, within the site
#

function print_link($url, $linktext=false, $target=false, $extras=false) {
	echo make_link($url, $linktext, $target, $extras);
}



function make_email($email, $linktext=false) {
	return sprintf("<a href=\"mailto:%s\">%s</a>",
		$email,
		($linktext ? $linktext : $email)
	);
}

function print_email($email, $linktext=false) {
	echo make_email($email, $linktext);
}

# commonheader()
#
#

function commonHeader($title=false) {
	global $SIDEBAR_DATA;

?><html>
<head>
 <title>PHP-GTK<?php if ($title) { echo ':'.$title; } ?></title>
 <link rel="stylesheet" href="/style.css">
</head>

<body
	topmargin="0" leftmargin="0"
	marginheight="0" marginwidth="0"
        bgcolor="#ffffff"
        text="#000000"
        link="#000033"
        alink="#0099ff"
        vlink="#000033"
><a name="TOP"></a>
<table border="0" cellspacing="0" cellpadding="0" height="48" width="100%">
  <tr bgcolor="#0099cc">
    <td align="left" rowspan="2" width="120">
<?php print_link('/', make_image('php-gtk.gif', 'PHP-GTK', false, 'vspace="2" hspace="2"') ); ?><br>
    </td>
    <td align="right" valign="top">
      <font color="#ffffff"><b>
        <?php echo strftime("%A, %B %d, %Y"); ?>
      </b>&nbsp;<br>
      </font>
    </td>
  </tr>

  <tr bgcolor="#0099cc">
    <td align="right" valign="bottom">
      <?php
	print_link('/download.php', 'download', false, 'class="menuBlack"');
	echo delim();
	print_link('/manual.php', 'documentation', false, 'class="menuBlack"');
	echo delim();
	print_link('/faq.php', 'faq', false, 'class="menuBlack"');
	echo delim();
	print_link('/resources.php', 'resources', false, 'class="menuBlack"');
      ?>&nbsp;<br>
      <?php spacer(2,2); ?><br>
    </td>
  </tr>

  <tr bgcolor="#000033"><td colspan="2"><?php spacer(1,1);?><br></td></tr>

  <tr bgcolor="#006699">
    <form method="POST" action="/search.php">
      <td align="right" valign="top" colspan="2"><font color="#ffffff">
        <small>search for</small>
<INPUT CLASS="small" TYPE="text" NAME="pattern" VALUE="<? echo htmlspecialchars($prevsearch) ?>" SIZE="30">
<small>in the</small>
<SELECT NAME="show" CLASS="small">
<OPTION VALUE="nosource">whole site
<OPTION VALUE="manual">online documentation
<OPTION VALUE="bugdb">bug database
<OPTION VALUE="maillist">general mailing list
<OPTION VALUE="devlist">developer mailing list
<OPTION VALUE="source">website source code    
</SELECT>
<?	echo make_submit('small_submit_white.gif', 'search', 'bottom');
      ?>&nbsp;<br>
     </font></td>
    </form>
  </tr>

  <tr bgcolor="#000033"><td colspan="2"><?php spacer(1,1);?><br></td></tr>
</table>


<table cellpadding="0" cellspacing="0">
 <tr valign="top">
<?php if (isset($SIDEBAR_DATA)):?>
  <td bgcolor="#f0f0f0">
   <table width="149" cellpadding="4" cellspacing="0">
    <tr valign="top">
     <td class="sidebar"><?php echo $SIDEBAR_DATA?></td>
    </tr>
   </table>
  </td>
  <td bgcolor="#cccccc" background="/gifs/checkerboard.gif"><?php spacer(1,1);?><br></td>
<?php endif; ?>
  <td>
   <table width="625" cellpadding="10" cellspacing="0">
    <tr>
     <td valign="top">
<?php
}




# commonfooter()
#
#

function commonFooter() {
	global $LAST_UPDATED, $MIRRORS, $MYSITE, $COUNTRIES;
?>
      <br>
     </td>
    </tr>
   </table>
  </td>
 </tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" width="100%">
  <tr bgcolor="#000033"><td><?php spacer(1,1);?><br></td></tr>
  <tr bgcolor="#006699">
    <form method="GET" action="/mirrors.php" onsubmit="return gotomirror(this);">
      <td align="right" valign="bottom">
      <script language="javascript">
      <!--
        function gotomirror(form) {
          url = form.country.options[form.country.selectedIndex].value;
          if (url != '<? echo $MYSITE; ?>') {
            window.location.href = url;
          }
	  return false;
        }
      //-->
      </script>
      <input type="hidden" name="REDIRECT" value="1">
      <?php
	# TODO: should send current url above, so we can redirect to
	# the same page on the mirror, and do the same in our javascript.
	print_link('/source.php?url='.$SCRIPT_NAME, 'show source', false, 'class="menuWhite"');
	echo delim();
	print_link('/credits.php', 'credits', false, 'class="menuWhite"');
	echo delim();
	print_link('/mirrors.php', 'mirror sites:', false, 'class="menuWhite"');
	echo "&nbsp;<select class=\"small\" name=\"country\" onchange=\"gotomirror(this.form)\">\n";

	foreach($MIRRORS as $url=>$mirror) {
          if ($mirror[4] == 1) { /* only list full mirrors here */
	    if ($url==$MYSITE) {
              echo '<option value="' . $url . '" SELECTED>' . $COUNTRIES[$mirror[0]] . 
		' (' . $mirror[1] . ") *\n";
	    } else {
              echo '<option value="' . $url . '">' . $COUNTRIES[$mirror[0]] . 
		' (' . $mirror[1] . ")\n";
	    }
          }
	}
	echo "</select> ";
	echo make_submit('small_submit_white.gif', 'go', 'bottom' );
      ?>&nbsp;<br>
      </td>
    </form>
  </tr>
  <tr bgcolor="#000033"><td><?php spacer(1,1); ?><br></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="6" width="100%">
  <tr valign="top" bgcolor="#cccccc">
    <td><small>
      <?php print_link('http://www.php.net/', make_image('php-logo.gif', 'PHP', 'left') ); ?>
      <?php print_link('/copyright.php', 'Copyright &copy; 2001 The PHP Group'); ?><BR>
      All rights reserved.<BR>
      </small>
    </td>
    <td align="right"><small>
      This mirror generously provided by:
      <?php print_link($MIRRORS[$MYSITE][3], $MIRRORS[$MYSITE][1] ); ?><BR>
      Last updated: <?php echo strftime("%c %Z", $LAST_UPDATED); ?><BR>
      </small>
    </td>
  </tr>
</table>

</body>
</html>
<?php
}

