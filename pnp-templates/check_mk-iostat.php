<?php
#
# Plugin: check_mk-iostat
#
# (c) 2015 Steven <smuth@example.com>
# CC-BY-SA http://smuth.me/posts/check_mk-and-freenas-pt-3.html
$ds_name[1] = "$NAGIOS_AUTH_SERVICEDESC";

$parts = explode("_", $servicedesc);
$disk = $parts[2];

$opt[1] = "--vertical-label 'Throughput (mb/s)' --title \"Disk throughput $hostname - disk $disk\" ";

$INDEX = array_flip($NAME);

$def[1] = rrd::def("readkbps", $RRDFILE[$INDEX['readkbps']], $DS[$INDEX['readkbps']], "AVERAGE");
$def[1] .= rrd::cdef("readmbps", "readkbps,1024,/");
$def[1] .= rrd::cdef("readmbps_neg", "readmbps,-1,*");
$def[1] .= rrd::def("writekbps", $RRDFILE[$INDEX['writekbps']], $DS[$INDEX['writekbps']], "AVERAGE");
$def[1] .= rrd::cdef("writembps", "writekbps,1024,/");
$def[1] .= rrd::cdef("writembps_neg", "writembps,-1,*");

if ($WARN[1] != "") {
  $def[1] .= "HRULE:$WARN[1]#FFFF00 ";
}
if ($CRIT[1] != "") {
  $def[1] .= "HRULE:$CRIT[1]#FF0000 ";
}
$def[1] .= rrd::area("readmbps", "#40c080", "Read  ") ;
$def[1] .= rrd::gprint("readmbps", "LAST", "%6.1lf MB/s last ");
$def[1] .= rrd::gprint("readmbps", "AVERAGE", "%6.1lf MB/s avg ");
$def[1] .= rrd::gprint("readmbps", "MAX", "%6.1lf MB/s max\\n");
$def[1] .= rrd::area("writembps_neg", "#4080c0", "Write ") ;
$def[1] .= rrd::gprint("writembps", "LAST", "%6.1lf MB/s last ");
$def[1] .= rrd::gprint("writembps", "AVERAGE", "%6.1lf MB/s avg ");
$def[1] .= rrd::gprint("writembps", "MAX", "%6.1lf MB/s max\\n");

$opt[2] = "--vertical-label 'Throughput (ops/s)' --title \"Disk throughput $hostname - disk $disk\" ";
$def[2] = rrd::def("readps", $RRDFILE[$INDEX['readps']], $DS[$INDEX['readps']], "AVERAGE");
$def[2] .= rrd::def("writeps", $RRDFILE[$INDEX['writeps']], $DS[$INDEX['writeps']], "AVERAGE");
$def[2] .= rrd::cdef("writeps_neg", "writeps,-1,*");
$def[2] .= rrd::area("readps", "#40c080", "Read  ");
$def[2] .= rrd::gprint("readps", array("LAST", "AVERAGE", "MAX"), "%6.2lf ");
$def[2] .= rrd::area("writeps_neg", "#4080c0", "Write ");
$def[2] .= rrd::gprint("writeps", array("LAST", "AVERAGE", "MAX"), "%6.2lf ");

$ds_name[3] = "$NAGIOS_AUTH_SERVICEDESC";
$opt[3] = "--vertical-label 'Duration (ms)' --title \"Transaction Duration $hostname - disk $disk\" ";
$def[3] = rrd::def("svc_t", $RRDFILE[$INDEX['svc_t']], $DS[$INDEX['svc_t']], "AVERAGE");
$def[3] .= rrd::line1("svc_t", "#FF2211", "Duration") ;
$def[3] .= rrd::gprint("svc_t", array("LAST", "AVERAGE", "MAX"), "%6.2lf ");

$ds_name[4] = "$NAGIOS_AUTH_SERVICEDESC";
$opt[4] = "--vertical-label '% Busy' --title \"% of time transaction were blocked $hostname - disk $disk\" ";
$def[4] = rrd::def("busy", $RRDFILE[$INDEX['busy']], $DS[$INDEX['busy']], "AVERAGE");
$def[4] .= rrd::area("busy", "#3366FF", "Busy") ;
$def[4] .= rrd::gprint("busy", array("LAST", "AVERAGE", "MAX"), "%6.2lf ");

$ds_name[5] = "$NAGIOS_AUTH_SERVICEDESC";
$opt[5] = "--vertical-label 'Length' --title \"Transaction Queue length $hostname - disk $disk\" ";
$def[5] = rrd::def("qlen", $RRDFILE[$INDEX['qlen']], $DS[$INDEX['qlen']], "AVERAGE");
$def[5] .= rrd::line1("qlen", "#FF2211", "Queue") ;
$def[5] .= rrd::gprint("qlen", array("LAST", "AVERAGE", "MAX"), "%6.2lf ");
?>
