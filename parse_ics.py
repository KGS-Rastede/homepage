# inspiriert von https://github.com/erikcox/ical2csv/blob/master/ical2csv.py
import sys
import os.path
from icalendar import Calendar
import csv

filename = "kgs.ics"

headers = ('Summary', 'Description', 'Location', 'Start Time', 'End Time')

class CalendarEvent:
    """Calendar event class"""
    summary = ''
    description = ''
    location = ''
    start = ''
    end = ''

    def __init__(self, name):
        self.name = name

events = []

def open_cal():
    if os.path.isfile(filename):
        if 'ics' == 'ics':
            print("Extracting events from file:", filename, "\n")
            f = open('kgs.ics', 'rb')
            gcal = Calendar.from_ical(f.read())

            for component in gcal.walk():
                event = CalendarEvent("event")
                if component.get('SUMMARY') == None: continue #skip blank items
                event.summary = component.get('SUMMARY')
                event.description = component.get('DESCRIPTION')
                event.location = component.get('LOCATION')
                if hasattr(component.get('dtstart'), 'dt'):
                    event.start = component.get('dtstart').dt
                if hasattr(component.get('dtend'), 'dt'):
                    event.end = component.get('dtend').dt

                events.append(event)
            f.close()
    else:
        print("I can't find the file ", filename, ".")
        print("Please enter an ics file located in the same folder as this script.")
        exit(0)


def debug_event(class_name):
    print("\nContents of ", class_name.name, ":")
    print(class_name.summary)
    print(class_name.description)
    print(class_name.location)
    print(class_name.start)
    print(class_name.end)

def create_json(class_name):
    print("{", sep="")
    print("title: '", class_name.summary, "',", sep="")
    print("start: '", class_name.start, "',", sep="")
    print("end: '", class_name.end, "'", sep="")
    print("},\n")

print("moin")
open_cal()



for event in events:
    #debug_event(event)
    create_json(event)


#csv_write(filename)
#debug_event(event)