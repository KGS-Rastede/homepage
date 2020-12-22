/*!
FullCalendar v5.5.0
Docs & License: https://fullcalendar.io/
(c) 2020 Adam Shaw
*/
var FullCalendarICalendar = (function (exports, common, ICAL) {
    'use strict';

    /*! *****************************************************************************
    Copyright (c) Microsoft Corporation.

    Permission to use, copy, modify, and/or distribute this software for any
    purpose with or without fee is hereby granted.

    THE SOFTWARE IS PROVIDED "AS IS" AND THE AUTHOR DISCLAIMS ALL WARRANTIES WITH
    REGARD TO THIS SOFTWARE INCLUDING ALL IMPLIED WARRANTIES OF MERCHANTABILITY
    AND FITNESS. IN NO EVENT SHALL THE AUTHOR BE LIABLE FOR ANY SPECIAL, DIRECT,
    INDIRECT, OR CONSEQUENTIAL DAMAGES OR ANY DAMAGES WHATSOEVER RESULTING FROM
    LOSS OF USE, DATA OR PROFITS, WHETHER IN AN ACTION OF CONTRACT, NEGLIGENCE OR
    OTHER TORTIOUS ACTION, ARISING OUT OF OR IN CONNECTION WITH THE USE OR
    PERFORMANCE OF THIS SOFTWARE.
    ***************************************************************************** */

    var __assign = function() {
        __assign = Object.assign || function __assign(t) {
            for (var s, i = 1, n = arguments.length; i < n; i++) {
                s = arguments[i];
                for (var p in s) if (Object.prototype.hasOwnProperty.call(s, p)) t[p] = s[p];
            }
            return t;
        };
        return __assign.apply(this, arguments);
    };

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
            var iCalFeed = ICAL.parse(rawFeed);
            var iCalComponent = new ICAL.Component(iCalFeed);
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
            event = new ICAL.Event(vevent);
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
    var plugin = common.createPlugin({
        eventSourceDefs: [eventSourceDef],
    });

    common.globalPlugins.push(plugin);

    exports.default = plugin;
    exports.requestICal = requestICal;

    Object.defineProperty(exports, '__esModule', { value: true });

    return exports;

}({}, FullCalendar, ICAL));
