<?php
global $wp;
$tax = 'product_cat';

$ads_link = explode("/", $wp->query_vars['ads']);

$current_term = get_term_by('slug', $ads_link[1], $tax);
$current_tree = get_taxonomy_hierarchy($current_term->term_id);
?>
<h1 class="quadrate green size-h2">Новое объявление</h1>

<form action="" class="new-ad-form">

    <div class="new-ad-form-group horizontal">
        <div class="form-title">
            Категория:
        </div>
        <a class="to-category" href="<?php echo get_permalink(9) . 'ads/add/?prev=' . $current_term->term_id; ?>">
            <?php
            $count = count($current_tree);
            foreach ($current_tree as $i => $tree):
                echo $tree;
                if ($i+1 !== $count){
                    echo ' / ';
                }
            endforeach;
            ?>
        </a>
    </div>

    <div class="new-ad-form-group">
        <div class="form-title">
            Параметры:
        </div>
        <div class="form-line">
            <div class="form-line-name">
                <div class="form-line-title">
                    Название объявления:*
                </div>
            </div>
            <div class="input-group">
                <input type="text" class="form-control" id="ad-name" placeholder="Жумар Black Diamond">
                <div class="input-group-description">
                    Например: “Жумар Black Diamond” или “Жумар Правый Petzl”
                </div>
            </div>
        </div>
        <div class="form-line">
            <div class="form-line-name">
                <div class="form-line-title">
                    Описание объявления:*
                </div>
                <div class="form-line-description">
                    Запрещается давать ссылки, указывать адреса эл. почты, адрес, телефоны, цену, предлагать услуги.
                </div>
            </div>
            <div class="input-group">
                <textarea class="form-control" rows="3" placeholder="Детская обувь на зимний сезон"></textarea>
                <div class="input-group-description">
                    Опишите достоинства этой вещи, почему ее нужно взять в аренду?
                    Чем она хороша?
                </div>
            </div>
        </div>
        <div class="form-line">
            <div class="form-line-name">
                <div class="form-line-title">
                    Количество:
                </div>
            </div>
            <div class="input-group">
                <input type="number" class="form-control" id="ad-count" placeholder="шт.">
                <div class="input-group-description">
                    Укажите количество товара, имеющееся в наличии
                </div>
            </div>
        </div>
        <div class="form-line">
            <div class="form-line-name">
                <div class="form-line-title">
                    Фотографии:
                </div>
                <div class="form-line-description">
                    Не более 10
                </div>
            </div>
            <div class="input-group">
                <div class="form-file-group">
                    <div class="form-file">
                        <div class="form-file-title">
                            Основное фото:*
                        </div>
                        <input type="file" name="main-photo" id="main-photo" class="input-file">
                        <div class="photo-preview">
                            <button class="add-photo"></button>
                        </div>
                    </div>
                    <div class="form-file">
                        <div class="form-file-title">
                            Дополнительные фото:
                        </div>
                        <input type="file" name="additional-photo" id="additional-photo" multiple class="input-file">
                        <div class="photo-preview">
                            <button class="add-photo"></button>
                        </div>
                    </div>
                </div>
                <div class="input-group-description">
                    Больше красивых фото - больше внимания к объявлению.
                </div>
            </div>
        </div>
    </div>

    <div class="new-ad-form-group">
        <div class="form-title">
            Характеристики вещи:
        </div>

        <div class="form-line">
            <div class="form-line-name">
                <div class="form-line-title">
                    Бренд:
                </div>
            </div>
            <div class="input-group">
                <textarea class="form-control" rows="3" placeholder=""></textarea>
                <div class="input-group-description">
                    Опишите достоинства этой вещи, почему ее нужно взять в аренду?
                    Чем она хороша?
                </div>
            </div>
        </div>
    </div>

    <div class="new-ad-form-group">
        <div class="form-title">
            Стоимость:
        </div>
        <div class="form-line">
            <div class="form-line-name">
                <div class="form-line-title">
                    Укажите стоимость:*
                </div>
                <div class="form-line-description">
                    Назначьте оптимальную стоимость аренды.
                </div>
            </div>
            <div class="input-group">
                <input type="text" class="form-control" id="ad-price" placeholder="Цена аренды за сутки, руб.">
            </div>
        </div>
        <div class="form-line">
            <div class="form-line-name">
                <div class="form-line-title">
                    Залог:
                </div>
                <div class="form-line-description">
                    Сколько денег вы попросите с Арендатора если вещь сломают?
                    Укажите эту цену в поле ниже
                </div>
            </div>
            <div class="input-group">
                <input type="text" class="form-control" id="ad-deposit" placeholder="Цена в рублях">
                <div class="input-group-description">
                    Вы можете не устанавливать залог, количество откликов на аренду будет намного больше
                </div>
            </div>
        </div>
        <div class="form-line">
            <div class="form-line-name">
                <div class="form-line-title">
                    Стоимость новой вещи: *
                </div>
            </div>
            <div class="input-group">
                <input type="text" class="form-control" id="ad-product-price" placeholder="Цена в рублях">
                <div class="input-group-description">
                    Оценочная стоимость это сколько стоит новая вещь, это значение пойдет в акт приема-передачи вещи
                </div>
            </div>
        </div>

    </div>

    <div class="new-ad-form-group">
        <div class="form-title">
            Способы доставки:
        </div>
        <div class="form-line">
            <div class="form-line-name">
                <div class="form-line-title">
                    Выберите способы доставки:*
                </div>
            </div>
            <div class="input-group">
                <div class="customSelect">
                    <select name="ad-delivery">
                        <option value selected disabled>Выбрать</option>
                        <option value="Giraffe">Giraffe</option>
                        <option value="Lion">Lion</option>
                        <option value="Cow">Cow</option>
                        <option value="Dog">Dog</option>
                        <option value="Tiger">Tiger</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-line">
            <div class="form-line-name">
                <div class="form-line-title">
                    Укажите адрес и место
                    самовывоза:*
                </div>
            </div>
            <div class="input-group">
                <input type="text" class="form-control" id="ad-address" placeholder="Начните вводить адрес">
                <div class="input-group-description">
                    Точный адрес, поможет привлечь арендатора
                </div>
            </div>
        </div>
        <div class="form-line">
            <div class="form-line-name">
                <div class="form-line-title">
                    Стоимость новой вещи: *
                </div>
            </div>
            <div class="input-group">
                <input type="text" class="form-control" id="ad-product-price" placeholder="Цена в рублях">
                <div class="input-group-description">
                    Оценочная стоимость это сколько стоит новая вещь, это значение пойдет в акт приема-передачи вещи
                </div>
            </div>
        </div>

    </div>

    <div class="new-ad-form-group">
        <div class="form-title">
            Контакты:
        </div>
        <div class="form-line">
            <div class="form-line-name">
                <div class="form-line-title">
                    Ваш номер телефона для связи и уведомлений *
                </div>
            </div>
            <div class="input-group">
                <input type="text" class="form-control" id="ad-phone" placeholder="+7 (999) 456-78-90">
                <div class="input-group-description">
                    На этот номер телефона мы также будем высылать СМС уведомления
                    когда найдем арендатора
                </div>
            </div>
        </div>
        <div class="form-line">
            <div class="form-line-name">
                <div class="form-line-title">
                    Как к вам обращаться? *
                </div>
            </div>
            <div class="input-group">
                <input type="text" class="form-control" id="ad-name" placeholder="Ваше имя и фамилия">
            </div>
        </div>
        <div class="form-line">
            <div class="form-line-name">
                <div class="form-line-title">
                    Моментальное подтверждение:
                </div>
            </div>
            <div class="input-group">
                <div class="form-check">
                    <input class="form-check-input" type="radio" value="1" checked name="ad-confirm" id="ad-confirm">
                    <label class="form-check-label" for="ad-confirm">
                        Без моментального подтверждения
                    </label>
                </div>
                <div class="input-group-description">
                    Вам будут приходить уведомления об арендаторах на эту вещь, вы сами будете принимать решение сдавать ли арендатору вещь или нет
                </div>
            </div>
        </div>
        <div class="form-line">
            <div class="form-line-name">
                <div class="form-line-title">
                    Примерка вещи:
                </div>
            </div>
            <div class="input-group">
                <div class="form-check">
                    <input class="form-check-input" type="radio" value="1" checked name="ad-fitting" id="ad-fitting">
                    <label class="form-check-label" for="ad-fitting">
                        Не готов(а) дать вещь на примерку
                    </label>
                </div>
            </div>
        </div>

    </div>
</form>

