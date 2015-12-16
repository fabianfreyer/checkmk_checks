#!/usr/bin/python

def perfometer_check_mk_users(row, check_command, perfdata):
    locks = int(perfdata[0][1])
    warn = int(perfdata[0][3])
    crit = int(perfdata[0][4])
    if locks >= crit:
        color = "#ff0000"
    elif locks >= warn:
        color = "#ffff00"
    else:
        color = "#00ff00"
    return ("%d users"%locks, perfometer_logarithmic(locks, warn, 2, color))

perfometers["check_mk-users"] = perfometer_check_mk_users
