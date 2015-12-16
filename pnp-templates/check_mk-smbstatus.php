<?php

$opt[1] = "--title \"$servicedesc\"";
$def[1] = "DEF:var1=$RRDFILE[1]:$DS[1]:ACT";
$def[1] .= "LINE1:var1#000000 ";
$def[1] .= "AREA:var1#00FF00:\" $servicedesc "\" ";
$def[1] .= "GPRINT:var1:LAST:\"%3.4lg %s$UNIT[1] LAST \" ";
$def[1] .= "GPRINT:var1:MAX:\"%3.4lg %s$UNIT[1] MAX \" ";
$def[1] .= "GPRINT:var1:AVERAGE:\"%3.4lg %s$UNIT[1] AVERAGE \" ";

?>
