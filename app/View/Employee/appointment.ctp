<div class="white-content">
    <div class="content-header-green">
        Запись на прием
    </div>

    <div class="tab">
        <div class="tab-item no-margin">
            <div class="profile-inner valign" style="width: 164px;">
                <img src="<?= $model['profile']['photo'] ?>">
            </div>
            <div class="profile-inner valign" style="width: 650px; height:198px; position:relative;">
                <span class="name"><?= mb_strtoupper($model['profile']['last_name']) ?></span>
                <br>
                <span class="name"><?= $model['profile']['first_name'] . ' ' . $model['profile']['parent_name'] ?></span>
                <br>
                <span class="position"><?= $model['profile']['position'] ?></span>
                <br>
                <span class="phone">Тел.: <?= $model['profile']['phone'] ?></span>
            </div>
        </div>
    </div>

	<div id="calendar-wrap"></div>
    <div class="tab">
        <div class="tab-item no-margin">
            <table>
                <?php 
                    $i = 0;
                    do {
                        $posted = false;
                        echo '<tr>';
                        foreach ($model['schedule'] as $schedule_day) {
                            echo '<td class="calendar-cell ' . (isset($schedule_day[$i]) ? 'employee-schedule-item' : '') . '"><div class="text-centered">';
                            if(isset($schedule_day[$i])) {
                                echo $schedule_day[$i];
                                $posted = true;
                            }
                            echo '</div></td>';
                        }
                        echo '</tr>';
                        $i++;  
                    } while ($posted);
                ?>
            </table>
        </div>
    </div>

    <div class="btn-container">
        <div class="btn btn-white btn-small text-black-small">Отменить</div>
    </div>
    <div class="btn-container">
        <div class="btn btn-green btn-small text-black-small">Подтвердить</div>
    </div>
</div>

<style type="text/css">
    #calendar-wrap {
        padding: 16px;
    }

	#calendar-year {
		display: none;
	}

	#calendar-left-btn {
		display: inline-block;
	}
	#calendar-month {
        width: 100%;
		display: inline-block;
		font-weight: 700;
		font-size: 24px;
		text-align: center;
	}
	#calendar-right-btn {
		display: inline-block;	
	}

	.calendar-days-names-item {
		width: 150px;
		height: 50px;
		text-align: center;
		font-weight: 700;
		font-size: 24px;
		color: #5B76D0;
	}

	.calendar-cell {
		width: 150px;
		height: 70px;
		text-align: center;
        vertical-align: middle;
		font-weight: 700;
		font-size: 24px;
	}

	.calendar-cell-gray {
		visibility: hidden;
	}

	.calendar-arrow-left {
		transform: rotate(90deg);
	}
	.calendar-arrow-right {
		transform: rotate(270deg);
	}

    .calendar-head {
        padding: 15px 0 15px 0;
    }

    .calender-header-text {
        width: 876px;
        margin-bottom: 30px;
        display: inline-block;
    }
</style>
<script type="text/javascript">
class Calendar
{
    constructor(id, moment)
    {
        this.moment = moment;
        this.id = id;

        this.moveLeft = this.moveLeft.bind(this)
        this.moveRight = this.moveRight.bind(this)

        this.drawToDom = this.drawToDom.bind(this)

        this.drawToDom()

        this.drawToDom = this.drawToDom.bind(this)
    }

    drawToDom()
    {
        var startOfWeek = moment(this.moment).startOf('isoWeek');
        var endOfWeek =  moment(this.moment).endOf('isoWeek');
        var month_start = this.getMonthName(startOfWeek);
        var month_end = this.getMonthName(endOfWeek);
        
        if(month_start != month_end) {
            var month_text = startOfWeek.format('D') + ' ' + month_start + ' - ' + endOfWeek.format('D') + ' ' + month_end;
        } else {
            var month_text = startOfWeek.format('D') + ' - ' + endOfWeek.format('D') + ' ' + month_end;
        }

        var days = [];
        var day = startOfWeek;

        while (day <= endOfWeek) {
            days.push({'day': day.format('D'), 'month': this.getMonthName(day)});
            day = day.clone().add(1, 'd');
        }


        document.getElementById(this.id)
            .innerHTML =
            `
		<div id='calendar'>
		<header class="calendar-head">
		<div id='calendar-left-btn' class="calendar-arrow">
		<img class="calendar-arrow-left" src="/img/icons/calendar-arrow.png" alt="">
		</div>

		<div class="calender-header-text">
		<span id='calendar-month' class="calender-header-text-month">${month_text}</span>
		</div>

		<div id='calendar-right-btn' class="calendar-arrow">
		<img class='calendar-arrow-right' src="/img/icons/calendar-arrow.png" alt="">
		</div>
		<table class="calendar-days-names">
		<td class='calendar-days-names-item'><span class='text-blue-small-thin'>П</span><br>${days[0].day + ' ' + days[0].month}</td>
		<td class='calendar-days-names-item'><span class='text-blue-small-thin'>В</span><br>${days[1].day + ' ' + days[1].month}</td>
		<td class='calendar-days-names-item'><span class='text-blue-small-thin'>С</span><br>${days[2].day + ' ' + days[2].month}</td>
		<td class='calendar-days-names-item'><span class='text-blue-small-thin'>Ч</span><br>${days[3].day + ' ' + days[3].month}</td>
		<td class='calendar-days-names-item'><span class='text-blue-small-thin'>П</span><br>${days[4].day + ' ' + days[4].month}</td>
        <td class='calendar-days-names-item'><span class='text-blue-small-thin'>С</span><br>${days[5].day + ' ' + days[5].month}</td>
		</table>
		</header>`

        document.getElementById('calendar-left-btn') //adds listeners for buttons
            .addEventListener('click', this.moveLeft)
        document.getElementById('calendar-right-btn')
            .addEventListener('click', this.moveRight)
    }

    getMonthName(day)
    {
        const month_names = ["Января", "Февраля", "Марта", "Апреля", "Мая", "Июня",
            "Июля", "Августа", "Сентября", "Октября", "Ноября", "Декабря"
        ]
        return month_names[moment(day, 'day').month()]
    }

    moveLeft()
    {
        this.moment.add(-7, 'd');
        this.drawToDom()
    }

    moveRight()
    {
        this.moment.add(7, 'd');
        this.drawToDom()
    }
}

var calendar = new Calendar('calendar-wrap', moment());


$(function() {
    $('.employee-schedule-item').click(function() {
        if($(this).hasClass('active')) {
            $(this).removeClass('active');
        } else {
            $('.employee-schedule-item').removeClass('active');
            $(this).addClass('active');
        }
    });
});
</script>