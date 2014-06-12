/**
 * Date picker for the order date
 */
var OrderDatePicker = Class.create(
    {
        /**
         * Sets up all events of the input fields and
         * the Calender
         */
        initialize: function () {
            // initialize date picker with correct date format
            Calendar.setup({
                inputField: 'delivery_date',
                ifFormat: '%Y-%m-%d',
                align: 'Bl',
                button: 'delivery_date',
                singleClick: true,
                disableFunc : function(date) {
                    var today = new Date();
                    today.setDate(today.getDate() - 1);
                    return (date < today);
                }
            });

            // initialize the input
            var oDateInput = $('delivery_date');
            if (oDateInput.value === '') {
                var oToday = new Date(),
                    sDay = ('0' + oToday.getDate()).slice(-2),
                    sMonth = ('0' + (oToday.getMonth() + 1)).slice(-2),
                    sYear = oToday.getFullYear()
                    ;
                oDateInput.value = sYear + '-' + sMonth + '-' + sDay;
            }

            // date can only be changed via date picker
            oDateInput.on('focus', function () {
                oDateInput.blur();
            });

            this._initializeLoca();
        },

        /**
         * initialize the localization of the calendar, if not already initialized
         *
         * @private
         */
        _initializeLoca: function () {

            if (this._isUndefined('enUS', window)) {
                window.enUS = {
                    "m": {
                        "wide": [
                            "January", "February", "March", "April", "May", "June", "July", "August",
                            "September", "October", "November", "December"
                        ],
                        "abbr": ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"]
                    }
                };
            }

            this._initCalendarLocaField('_DN', new Array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"));
            this._initCalendarLocaField('_SDN', new Array("Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"));
            this._initCalendarLocaField('_FD', 0);
            this._initCalendarLocaField('_MN', window.enUS.m.wide);
            this._initCalendarLocaField('_SMN', window.enUS.m.abbr);
            this._initCalendarLocaField('_TT', {
                INFO: "About",
                ABOUT: "DHTML Date/Time Selector\n" +
                    "(c) dynarch.com 2002-2005 / Author: Mihai Bazon\n" +
                    "For latest version visit: http://www.dynarch.com/projects/calendar/\n" +
                    "Distributed under GNU LGPL.  See http://gnu.org/licenses/lgpl.html for details." +
                    "\n\n" +
                    "Date selection:\n" +
                    "- Use the \xab, \xbb buttons to select year\n" +
                    "- Use the " + String.fromCharCode(0x2039) + ", " + String.fromCharCode(0x203a) + " buttons to select month\n" +
                    "- Hold mouse button on any of the above buttons for faster selection.",
                ABOUT_TIME: "\n\n" +
                    "Time selection:\n" +
                    "- Click on any of the time parts to increase it\n" +
                    "- or Shift-click to decrease it\n" +
                    "- or click and drag for faster selection.",
                PREV_YEAR: "Prev. year (hold for menu)",
                PREV_MONTH: "Prev. month (hold for menu)",
                GO_TODAY: "Go Today",
                NEXT_MONTH: "Next month (hold for menu)",
                NEXT_YEAR: "Next year (hold for menu)",
                SEL_DATE: "Select date",
                DRAG_TO_MOVE: "Drag to move",
                PART_TODAY: "(today)",
                DAY_FIRST: "Display %s first",
                SELECT_COLUMN: "Select all %ss of this month",
                SELECT_ROW: "Select all days of this week",
                WEEKEND: "0,6",
                CLOSE: "Close",
                TODAY: "Today",
                TIME_PART: "(Shift-)Click or drag to change value",
                DEF_DATE_FORMAT: "%Y-%m-%d",
                TT_DATE_FORMAT: "%a, %b %e",
                WK: "wk",
                TIME: "Time:",
                LAM: "am",
                AM: "AM",
                LPM: "pm",
                PM: "PM"
            })
            ;
            this._initCalendarLocaField('_DIR', 'ltr');
            this._initCalendarLocaField('_am', 'am');
            this._initCalendarLocaField('_pm', 'pm');
        },

        /**
         * Inits a localization part of the calendar
         *
         * @param {string} sFieldname name of the part
         * @param {mixed} mValue value of the field (array, string or number)
         * @private
         */
        _initCalendarLocaField: function (sFieldname, mValue) {
            if (this._isUndefined(sFieldname, Calendar)) {
                Calendar[sFieldname] = mValue;
            }
        },

        /**
         * Checks if element is undefined
         *
         * @param {mixed} mElement object or (string) name of property of oParent object
         * @param {object} oParent object to check the property mElement of (not required)
         * @return {Boolean} true if the element is undefined
         * @private
         */
        _isUndefined: function (mElement, oParent) {
            if (typeof oParent == 'undefined') {
                return (typeof  mElement == 'undefined');
            } else {
                return (typeof  oParent[mElement] == 'undefined');
            }
        }
    }
);