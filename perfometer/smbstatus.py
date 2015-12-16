#!/usr/bin/python

def perfometer_check_mk_smbstatus_users(row, check_command, perfdata):
    users = int(perfdata[0][1])
    warn = int(perfdata[0][3])
    crit = int(perfdata[0][4])
    if users >= crit:
        color = "#ff0000"
    elif users >= warn:
        color = "#ffff00"
    else:
        color = "#00ff00"
    return "%d users"%users, perfometer_logarithmic(users, warn, 2, color) 

def perfometer_check_mk_smbstatus_shares(row, check_command, perfdata):
    shares = int(perfdata[0][1])
    warn = int(perfdata[0][3])
    crit = int(perfdata[0][4])
    if shares >= crit:
        color = "#ff0000"
    elif shares >= warn:
        color = "#ffff00"
    else:
        color = "#00ff00"
    return "%d shares"%shares, perfometer_logarithmic(shares, warn, 2, color)

def perfometer_check_mk_smbstatus_locks(row, check_command, perfdata):
    locks = int(perfdata[0][1])
    warn = int(perfdata[0][3])
    crit = int(perfdata[0][4])
    if locks >= crit:
        color = "#ff0000"
    elif locks >= warn:
        color = "#ffff00"
    else:
        color = "#00ff00"
    return "%d locks"%locks, perfometer_logarithmic(locks, warn, 2, color) 

perfometers["check_mk-smbstatus.users"]        = perfometer_check_mk_smbstatus_users
perfometers["check_mk-smbstatus.shares"]        = perfometer_check_mk_smbstatus_shares
perfometers["check_mk-smbstatus.locks"]        = perfometer_check_mk_smbstatus_locks
