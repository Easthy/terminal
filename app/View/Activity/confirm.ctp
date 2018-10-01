<div class="white-content">
    <div class="content-header-green">
        Запись на мероприятие
    </div>
    <div>
        <div class="text-centered full-width">
            <div style="display: inline-block; margin-top:30px;">
                <img src="/img/icons/sport.png" style="width: 63px; height: 63px;">
            </div>
            <p class="text-blue-small-thick">Вы успешно записались на мероприятие!</p>
            <span class="text-black-big-thick"><?= $model['name'] ?></span>
        </div>
    </div>
	<div class="tab-container" style="max-height: 1000px; margin-top: 80px;">
		<div class="tab-item no-margin">
            <table style="padding: 30px;">
                <tr>
                    <td style="width: 30%"><span class="text-blue-small-thin">Посещение</span></td>
                    <td style="padding-left: 40px;"><span class="text-blue-small-thick"><?= $model['schedule'] ?></span></td>
                </tr>
                <tr>
                    <td style="width: 30%"><span class="text-blue-small-thin">Адрес</span></td>
                    <td style="padding-left: 40px;"><span class="text-blue-small-thick"><?= $model['address'] ?></span></td>
                </tr>
                <tr>
                    <td style="width: 30%"><span class="text-blue-small-thin">Баллы</span></td>
                    <td style="padding-left: 40px;"><span class="text-blue-small-thick"><?= $model['points'] ?></span></td>
                </tr>
            </table>
        </div>
	</div>

    <div class="btn-container">
        <a href="/activity/bycompany" class="btn btn-white btn-small text-black-small">
            Закрыть
        </a>
    </div>
    <div class="btn-container">
        <div class="btn btn-green btn-small text-black-small">Открыть мое расписание</div>
    </div>
</div>