(function () {
  'use strict';

  const locale = 'de-DE';
  const dateFormatter = new Intl.DateTimeFormat(locale, {
    weekday: 'long',
    day: '2-digit',
    month: 'long',
    year: 'numeric',
  });
  const compactDateFormatter = new Intl.DateTimeFormat(locale, {
    weekday: 'short',
    day: '2-digit',
    month: '2-digit',
  });
  const timeFormatter = new Intl.DateTimeFormat(locale, {
    hour: '2-digit',
    minute: '2-digit',
  });

  function getElement(target) {
    return typeof target === 'string' ? document.querySelector(target) : target;
  }

  function setVisible(target, visible) {
    const element = getElement(target);
    if (!element) return;
    element.hidden = !visible;
  }

  function sameDay(first, second) {
    return (
      first &&
      second &&
      first.getFullYear() === second.getFullYear() &&
      first.getMonth() === second.getMonth() &&
      first.getDate() === second.getDate()
    );
  }

  function sameMinute(first, second) {
    return (
      first &&
      second &&
      first.getFullYear() === second.getFullYear() &&
      first.getMonth() === second.getMonth() &&
      first.getDate() === second.getDate() &&
      first.getHours() === second.getHours() &&
      first.getMinutes() === second.getMinutes()
    );
  }

  function displayEnd(event) {
    if (!event.end) return null;

    const end = new Date(event.end);
    if (event.allDay) {
      end.setDate(end.getDate() - 1);
    }

    return end;
  }

  function formatDateRange(event) {
    if (!event.start) return '';

    const end = displayEnd(event);
    if (!end || sameDay(event.start, end)) {
      return dateFormatter.format(event.start);
    }

    return `${dateFormatter.format(event.start)} bis ${dateFormatter.format(end)}`;
  }

  function formatTimeRange(event) {
    if (event.allDay) return 'ganztägig';
    if (!event.start) return '';
    if (!event.end || sameMinute(event.start, event.end)) {
      return `${timeFormatter.format(event.start)} Uhr`;
    }

    return `${timeFormatter.format(event.start)} - ${timeFormatter.format(event.end)} Uhr`;
  }

  function normaliseEvent(event) {
    const props = event.extendedProps || {};

    return {
      title: event.title || 'Termin',
      start: event.start ? new Date(event.start) : null,
      end: event.end ? new Date(event.end) : null,
      allDay: Boolean(event.allDay),
      location: props.location || event.location || '',
      description: props.description || event.description || '',
      organizer: props.organizer || event.organizer || '',
      url: props.link || '',
    };
  }

  function openEventDetails(rawEvent) {
    const modal = document.getElementById('kgs-calendar-modal');
    if (!modal) return;

    const event = normaliseEvent(rawEvent);
    const title = modal.querySelector('[data-calendar-modal-title]');
    const date = modal.querySelector('[data-calendar-modal-date]');
    const time = modal.querySelector('[data-calendar-modal-time]');
    const location = modal.querySelector('[data-calendar-modal-location]');
    const locationRow = modal.querySelector('[data-calendar-modal-location-row]');
    const description = modal.querySelector('[data-calendar-modal-description]');
    const descriptionRow = modal.querySelector('[data-calendar-modal-description-row]');
    const link = modal.querySelector('[data-calendar-modal-link]');

    title.textContent = event.title;
    date.textContent = formatDateRange(event);
    time.textContent = formatTimeRange(event);

    location.textContent = event.location;
    locationRow.hidden = !event.location;

    description.textContent = event.description;
    descriptionRow.hidden = !event.description;

    if (event.url) {
      link.href = event.url;
      link.hidden = false;
    } else {
      link.hidden = true;
      link.removeAttribute('href');
    }

    modal.hidden = false;
    document.documentElement.classList.add('kgs-calendar-modal-open');
    modal.querySelector('[data-calendar-modal-close]').focus();
  }

  function closeEventDetails() {
    const modal = document.getElementById('kgs-calendar-modal');
    if (!modal || modal.hidden) return;

    modal.hidden = true;
    document.documentElement.classList.remove('kgs-calendar-modal-open');
  }

  function bindModal() {
    const modal = document.getElementById('kgs-calendar-modal');
    if (!modal || modal.dataset.bound === 'true') return;

    modal.dataset.bound = 'true';
    modal.querySelectorAll('[data-calendar-modal-close]').forEach((button) => {
      button.addEventListener('click', closeEventDetails);
    });

    modal.addEventListener('click', (event) => {
      if (event.target.matches('[data-calendar-modal-backdrop]')) {
        closeEventDetails();
      }
    });

    document.addEventListener('keydown', (event) => {
      if (event.key === 'Escape') closeEventDetails();
    });
  }

  // Optionen für FullCalendar: Klick auf einen Termin öffnet das Detailfenster.
  // Verwendung: new FullCalendar.Calendar(el, { ...KgsCalendar.detailsBeiKlick(), ... })
  function detailsBeiKlick() {
    bindModal();

    return {
      eventClassNames() {
        return ['kgs-calendar-clickable'];
      },
      eventClick(info) {
        info.jsEvent.preventDefault();
        openEventDetails(info.event);
      },
    };
  }

  window.KgsCalendar = {
    detailsBeiKlick,
    openEventDetails,
    closeEventDetails,
  };
})();
