/*!
FullCalendar v5.5.0
Docs & License: https://fullcalendar.io/
(c) 2020 Adam Shaw
*/
import { __assign } from 'tslib';
import { Event, parse, Component } from 'ical.js';
import { createPlugin } from '@fullcalendar/common';

function requestICal(url, successCallback, failureCallback) {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', url, true);
    xhr.onload = function () {
        if (xhr.status >= 200 && xhr.status < 400) {
            successCallback(xhr.responseText, xhr);
        }
        else {
            failureCallback('Request failed', xhr);
        }
    };
    xhr.onerror = function () { return failureCallback('Request failed', xhr); };
    xhr.send(null);
}
var buildIcalEvents = function (rawFeed) {
    try {
        var iCalFeed = parse(rawFeed);
        var iCalComponent = new Component(iCalFeed);
        return iCalComponent.getAllSubcomponents('vevent');
    }
    catch (err) {
        console.warn("Error parsing feed: " + err);
        return [];
    }
};
var buildEvents = function (vevents) { return vevents.map(function (vevent) {
    var event = null;
    try {
        event = new Event(vevent);
        if (!event.startDate) { // is an accessor method. might throw an error
            return null;
        }
    }
    catch (error) {
        console.warn("Unable to process item in calendar: " + error + ".");
        return null;
    }
    var fcEvent = {
        title: event.summary,
        start: event.startDate.toString(),
        end: (event.endDate ? event.endDate.toString() : null),
    };
    if (event.startDate.isDate) {
        return __assign(__assign({}, fcEvent), { allDay: true });
    }
    return fcEvent;
}).filter(function (item) { return item !== null; }); };
var eventSourceDef = {
    ignoreRange: true,
    parseMeta: function (refined) {
        if (refined.url && refined.format === 'ics') {
            return {
                url: refined.url,
                format: 'ics',
            };
        }
        return null;
    },
    fetch: function (arg, success, failure) {
        var meta = arg.eventSource.meta;
        return new Promise(function (resolve, reject) {
            requestICal(meta.url, function (rawFeed, xhr) {
                var icalEvents = buildIcalEvents(rawFeed);
                var events = buildEvents(icalEvents);
                success({ rawEvents: events, xhr: xhr });
                resolve();
            }, function (errorMessage, xhr) {
                failure({ message: errorMessage, xhr: xhr });
                reject();
            });
        });
    },
};
var main = createPlugin({
    eventSourceDefs: [eventSourceDef],
});

export default main;
export { requestICal };
//# sourceMappingURL=main.js.map
