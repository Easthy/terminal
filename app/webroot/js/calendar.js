class Calendar
{
    constructor(id)
    {
        this.displayed_date = new Date() //date wich calendar displays now
        this.current_day = this.displayed_date.getDate()
        this.selected_date = this.displayed_date
        this.are_real_date_displayed = true

        this.drawToDom(this.displayed_date, id)

        this.body_node = document.getElementById('calendar-body')
        this.year_node = document.getElementById('calendar-year')
        this.month_node = document.getElementById('calendar-month')

        this.moveLeft = this.moveLeft.bind(this)
        this.moveRight = this.moveRight.bind(this)
        this.selectHandler = this.selectHandler.bind(this)
        this.redrawBody = this.redrawBody.bind(this)

        $(this.body_node).on('tap',this.selectHandler);

        document.getElementById('calendar-left-btn') //adds listeners for buttons
            .addEventListener('click', this.moveLeft)
        document.getElementById('calendar-right-btn')
            .addEventListener('click', this.moveRight)
    }

    drawToDom(date, id)
    {
        var year = date.getFullYear()
        var month = this.getMonthName(date)
        document.getElementById(id)
            .innerHTML =
            `
		<div id='calendar'>
		<header class="calendar-head">
		<div id='calendar-left-btn' class="calendar-arrow">
		<img class="calendar-arrow-left" src="/img/icons/calendar-arrow.png" alt="">
		</div>

		<div class="calender-header-text">
		<span id='calendar-month' class="calender-header-text-month">${month}</span>
		<span id='calendar-year' class="calender-header-text-year">${year}</span>
		</div>

		<div id='calendar-right-btn' class="calendar-arrow">
		<img class='calendar-arrow-right' src="/img/icons/calendar-arrow.png" alt="">
		</div>
		<table class="calendar-days-names">
		<td class='calendar-days-names-item'>П</td>
		<td class='calendar-days-names-item'>В</td>
		<td class='calendar-days-names-item'>С</td>
		<td class='calendar-days-names-item'>Ч</td>
		<td class='calendar-days-names-item'>П</td>
		<td class='calendar-days-names-item'>С</td>
		<td class='calendar-days-names-item'>В</td>
		</table>
		</header>
		<div id='calendar-body'></div>
		</div>`
        var body = this.createCalendarBody(this.displayed_date, this.are_real_date_displayed)
        document.getElementById('calendar-body').appendChild(body)
    }

    createDaysArray(date)
    {
        var prev_month_last_day = new Date( //number of the last day of the previous month
            date.getFullYear(),
            date.getMonth(),
            0).getDate()

        var first_week_day = (new Date( //number of the last day of the current month f.e. monday->1, wednesday->3
            date.getFullYear(),
            date.getMonth(),
            1)).getDay();

        if (first_week_day == 0) first_week_day = 7 //if it was sunday

        var first_array_element = prev_month_last_day - first_week_day + 2

        var current_month_last_day = (new Date(date.getFullYear(), date.getMonth() + 1, 0)).getDate()

        var days_array = new Array(42)
        var i = 0 // iterator for all three parts of array
        for (i = 0; i < first_week_day - 1; ++i) //adds last days of previous month
        {
            days_array[i] = {
                number: first_array_element + i,
                from: 'prev month'
            } //'from' will be used to add different styles
        }
        for (var k = 1; k <= current_month_last_day; ++k) //adds days of current month
        {
            days_array[i] = {
                number: k,
                from: 'currnet month',
                weekend: i % 7 > 4
            }
            i++
        }
        for (var k = 0; i < days_array.length; ++k) //adds days of next month
        {
            days_array[i] = {
                number: k + 1,
                from: 'next month'
            }
            i++
        }
        return days_array
    }

    createCalendarBody(date, are_real_date_displayed) //returns a table fulfilled with days
    {
        var days_array = this.createDaysArray(date)
        var table = document.createElement('table')
        table.classList.add('calendar-body')
        var i = 0 //iterator for days_aray
        for (var j = 0; j < 6; ++j)
        {
            var tr = document.createElement('tr')
            for (var k = 0; k < 7; ++k)
            {
                var td_class = '';

                var td = document.createElement('td')
                td.innerHTML = '<div class="'+td_class+'">'+days_array[i].number+'</div>';
                tr.appendChild(td)

                //add the styles that depend on what month the day belongs to
                td.classList.add('calendar-cell')
                if (days_array[i].from !== 'currnet month')
                {
                    td.classList.add('calendar-cell-gray')
                }
                else
                {
                    if (date.getFullYear() == this.selected_date.getFullYear() && //if this day is selected
                        date.getMonth() == this.selected_date.getMonth() &&
                        this.selected_date.getDate() == days_array[i].number)
                    {
                        td.classList.add('calendar-cell-selected')
                        td.id = 'selected_date'
                    }
                    if (days_array[i].weekend)
                        td.classList.add('calendar-cell-green')
                    if (are_real_date_displayed)
                    {
                        if (this.current_day == days_array[i].number)
                        {
                            td.classList.add('calendar-cell-today')
                        }
                    }
                }
                ++i
            }
            tr.classList.add('calendar-body-row')
            table.appendChild(tr)
        }
        return table
    }

    getMonthName(date)
    {
        const month_names = ["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь",
            "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"
        ]
        return month_names[date.getMonth()]
    }

    //if the received date corresponds to the current month and year returns true
    isThisDayCurrent(date)
    {
        var current = new Date()
        if (current.getFullYear() == date.getFullYear() && current.getMonth() == date.getMonth())
            return true
        else
            return false
    }

    redrawBody(date)
    {
        var are_real_date_displayed = this.isThisDayCurrent(date) //if it is current month, current day will ba highlighted
        var new_body = this.createCalendarBody(date, are_real_date_displayed)
        this.year_node.innerHTML = date.getFullYear()
        this.month_node.innerHTML = this.getMonthName(date)
        this.body_node.innerHTML = ''
        this.body_node.appendChild(new_body)
    }

    moveLeft()
    {
        this.displayed_date = new Date( //set the day to prev month
            this.displayed_date.getFullYear(),
            this.displayed_date.getMonth() - 1, 1)

        this.redrawBody(this.displayed_date)
    }

    moveRight()
    {
        this.displayed_date = new Date( //set the day to next month
            this.displayed_date.getFullYear(),
            this.displayed_date.getMonth() + 1, 1)

        this.redrawBody(this.displayed_date)
        console.log(this.displayed_date)
    }

    selectHandler(e)
    {
    	console.log( e.target.classList );
        if (e.target.classList.contains('calendar-cell-gray')) return //only days of current month can be selected
        // if (!e.target.classList.contains('calendar-cell')) return //if it wawn't a click on a cell

        var prev_selected = document.getElementById('selected_date')
        if (prev_selected)
        {
            prev_selected.classList.remove('calendar-cell-selected')
            prev_selected.id = ''
        }

        this.selected_date = new Date(
            this.displayed_date.getFullYear(),
            this.displayed_date.getMonth(),
            e.target.innerHTML)

        e.target.id = 'selected_date'
        e.target.classList.add('calendar-cell-selected')
    }
}