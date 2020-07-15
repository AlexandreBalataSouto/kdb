window._ = require('lodash');

try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');
    window.toastr = require('toastr');

    require('bootstrap');
    require('materialize-css');

    require('datatables.net');
    require('datatables.net-dt');
    require('datatables.net-responsive');
    require('datatables.net-responsive-dt');

    require('@fullcalendar/core');
    require('@fullcalendar/daygrid');
    require('@fullcalendar/interaction');
} catch (e) { }


window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import * as Calendar from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction';

window.FullCalendar = Calendar;
window.dayGridPlugin = dayGridPlugin;
window.interactionPlugin = interactionPlugin;





