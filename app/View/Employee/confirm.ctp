<div class="white-content">
    <div class="content-header-green">
        Запись на прием
    </div>
    <div>
        <div class="text-centered full-width">
            <p class="text-blue-small-thick">Вы успешно записались на прием к специалисту!</p>
            <div style="display: inline-block;" class="full-width">
                <img src="<?= $model['photo'] ?>" style="width: 164px;">
            </div>
            <span class="text-black-big-thick"><?= mb_strtoupper($model['last_name']) ?></span>
                <br> 
            <span class="text-black-big-thick"><?= $model['first_name'] . ' ' . $model['parent_name'] ?></span>
            <p class="text-blue-small-thin"><?= $model['position'] ?></p>
        </div>
    </div>
	<div class="tab-container" style="max-height: 1000px;">
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
            </table>
        </div>
	</div>

    <div class="btn-container">
        <div class="btn btn-white btn-small text-black-small">Закрыть</div>
    </div>
    <div class="btn-container">
        <div class="btn btn-green btn-small text-black-small">Открыть мое расписание</div>
    </div>
</div>