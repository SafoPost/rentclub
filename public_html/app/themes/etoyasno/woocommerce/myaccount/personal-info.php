<?php
if (isset($target_user)):
    $personal_data = get_field('personal_data', 'user_' . $target_user->ID);
    ?>
    <div class="main-data">
        <div class="information-block">
            <div class="avatar" <?php echo ($personal_data['avatar']) ? 'style="background-image: url(' . $personal_data['avatar'] . ')"' : ''; ?>></div>
            <div class="name-block">
                <div class="type">
                    <?php
                    switch ($personal_data['type']) {
                        case 'individual':
                            echo "Физическое лицо";
                            break;
                        case 'ip':
                            echo "Индивидуальный предприниматель";
                            break;
                        case 'company':
                            echo "Компания";
                            break;
                    }
                    ?>
                </div>
                <div class="name"><?php echo (strlen($personal_data['full_name']) > 0) ? $personal_data['full_name'] : '-' ?></div>
            </div>
        </div>
        <div class="status-block">
            <div class="status <?php echo $personal_data['verification']; ?>"></div>
            <?php if ($show_private): ?>
                <div class="address"><?php echo (strlen($personal_data['address']) > 0) ? $personal_data['address'] : '-' ?></div>
            <?php endif; ?>
        </div>
        <?php if ($show_private): ?>
            <div class="money-block">
                <div class="money-block-title"><span>Вы заработали:</span></div>
                <div class="count">1990 р.</div>
                <a class="more" href="/profile/cashout/">Подробнее</a>
            </div>
        <?php endif; ?>
    </div>
    <?php if ($show_private): ?>
    <div class="personal-data-wrap">
        <div class="personal-data">
            <div class="personal-data-block <?php echo $personal_data['type']; ?>">
                <?php
                switch ($personal_data['type']) {
                    case 'individual': ?>
                        <div class="personal-data-item passport">
                            <span class="title">Паспорт:</span>
                            <span class="value"><?php echo (strlen($personal_data['individual_data']['passport']) > 0) ? $personal_data['individual_data']['passport'] : '-' ?></span>
                        </div>
                        <div class="personal-data-item date-issue">
                            <span class="title">Дата выдачи:</span>
                            <span class="value"><?php echo (strlen($personal_data['individual_data']['date_issue']) > 0) ? $personal_data['individual_data']['date_issue'] : '-' ?></span>
                        </div>
                        <div class="personal-data-item phone">
                            <span class="title">Телефон:</span>
                            <span class="value"><?php echo (strlen($personal_data['individual_data']['phone']) > 0) ? $personal_data['individual_data']['phone'] : '-' ?></span>
                        </div>
                        <div class="personal-data-item date-birth">
                            <span class="title">Дата рождения:</span>
                            <span class="value"><?php echo (strlen($personal_data['individual_data']['date_birth']) > 0) ? $personal_data['individual_data']['date_birth'] : '-' ?></span>
                        </div>
                        <?php break;
                    case 'ip':
                        echo "Индивидуальный предприниматель";
                        break;
                    case 'company':
                        echo "Компания";
                        break;
                }
                ?>
            </div>
            <div class="personal-edit">
                <button class="edit-btn" onclick="openModal('edit-profile')">Редактировать</button>
            </div>
        </div>
        <div class="public-title">Данные не являются публичными и видны только вам и администратору</div>
    </div>
<?php endif; ?>
<div class="personal-stats">
    <div class="stats-block">
        <div class="stat-item ads">
            <div class="count">13</div>
            <div class="title">опубликованных объявлений</div>
        </div>
        <div class="stat-item rents">
            <div class="count">25</div>
            <div class="title">раз брал вещи в аренду</div>
        </div>
        <div class="stat-item reviews">
            <div class="count">5</div>
            <div class="title">отзывов</div>
        </div>
        <div class="stat-item register">
            <div class="title">Зарегистрирован</div>
            <div class="count">
                <?php
                    echo date( 'd.m.Y', strtotime($target_user->user_registered));
                ?>
            </div>
        </div>
    </div>
</div>

    <?php if ($show_private): ?>
    <div class="modal" id="edit-profile">
        <div class="modal-block">
            <button class="close" onclick="closeModal()"></button>
            <div class="modal-header">
                <div class="modal-title">Паспортные данные</div>
                <div class="modal-description">Помните, что брать в аренду вещи могут только физические лица</div>
            </div>
            <div class="modal-content">
                <form action="">
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="1" name="flexRadioDefault" id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault1">
                                Физическое лицо
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="2" name="flexRadioDefault" id="flexRadioDefault2">
                            <label class="form-check-label" for="flexRadioDefault2">
                                ИП
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="3" name="flexRadioDefault" id="flexRadioDefault3">
                            <label class="form-check-label" for="flexRadioDefault3">
                                ООО
                            </label>
                        </div>
                    </div>
                    <div class="form-floating">
                        <input type="text" class="form-control" id="surname" placeholder="Фамилия">
                        <label for="surname">Фамилия</label>
                    </div>
                    <div class="form-floating">
                        <input type="text" class="form-control" id="name" placeholder="Имя">
                        <label for="name">Имя</label>
                    </div>
                    <div class="form-floating">
                        <input type="text" class="form-control" id="midname" placeholder="Отчество">
                        <label for="midname">Отчество</label>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php endif; ?>