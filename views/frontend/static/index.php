<!-- experience/view/frontend/static/index.php -->

<!-- первая страница с испытаниями -->
<div class="base-page contact__page tests">
    <div class="container">
        <!-- хлебные крошки обычные, которые везде есть подключить сюда -->
        <div class="breadcrumbs wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
            <ul class="">
                <li><a href="#">Главная</a></li>
                <li><a href="#">Продукция</a></li>
                <li><a href="#">Список испытаний</a></li>
            </ul>
        </div>
        <!-- -- -->
        <div class="tests__in">
            <div class="tests__headline">
                <h1 class="tests__title page-title">
                    Список испытаний
                </h1>
                <div class="tests__tabs">
                    <div class="tests__tab active" data-tab="1">
                        поиск по продукту
                    </div>
                    <div class="tests__tab" data-tab="2">
                        марке/модели <span>автомобиля</span>
                    </div>
                </div>
            </div>
            <div class="tests__search">
                <div class="tests__search-tabs">
                    <!-- блок tests__search-tab можно сделать form если нужно -->
                    <div class="tests__search-tab active" data-tab="1">
                        <div class="tests__search-tab-headline">
                            <div class="tests__search-tab-title">
                                Поиск испытаний
                            </div>
                        </div>
                        <div class="tests__search-tab-content">
                            <div class="tests__search-tab-content-item">
                                <select class="tests__search-tab-content-select" name="state" data-placeholder="Тип продукта">
                                    <option></option>
                                    <option value="1">Моторные масла</option>
                                    <option value="2">Трансмиссионные масла</option>
                                    <option value="3">Промывочные масла</option>
                                </select>
                                <div class="tests__search-tab-content-parent">

                                </div>
                            </div>
                            <div class="tests__search-tab-content-item">
                                <select class="tests__search-tab-content-select" name="state" data-placeholder="Выберите продукт">
                                    <option></option>
                                    <option value="1">Моторные масла</option>
                                    <option value="2">Трансмиссионные масла</option>
                                    <option value="3">Промывочные масла</option>
                                </select>
                                <div class="tests__search-tab-content-parent">

                                </div>
                            </div>
                        </div>
                        <div class="tests__search-tab-footer">
                            <div class="tests__search-tab-footer-writeus">
                                <span>Не нашли испытания для своего авто?</span>
                                <a href="#">Напишите нам</a>
                            </div>
                            <a href="#" class="tests__search-tab-show">
                                Показать
                            </a>
                        </div>
                        <div class="tests__search-tab-clear">
                            <span>Очистить фильтр</span>
                            <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 1L9.48528 9.48528" stroke="currentColor" stroke-linecap="round"/>
                                <path d="M9.48535 1L1.00007 9.48528" stroke="currentColor" stroke-linecap="round"/>
                            </svg>
                        </div>
                    </div>
                    <!-- блок tests__search-tab можно сделать form если нужно -->
                    <div class="tests__search-tab" data-tab="2">
                        <div class="tests__search-tab-headline">
                            <div class="tests__search-tab-title">
                                Поиск испытаний (Вкладка 2)
                            </div>
                        </div>
                        <div class="tests__search-tab-content">
                            <div class="tests__search-tab-content-item">
                                <select class="tests__search-tab-content-select" name="state" data-placeholder="Марка">
                                    <option></option>
                                    <option value="1">Моторные масла</option>
                                    <option value="2">Трансмиссионные масла</option>
                                    <option value="3">Промывочные масла</option>
                                </select>
                                <div class="tests__search-tab-content-parent">

                                </div>
                            </div>
                            <div class="tests__search-tab-content-item">
                                <select class="tests__search-tab-content-select" name="state" data-placeholder="Модель">
                                    <option></option>
                                    <option value="1">Моторные масла</option>
                                    <option value="2">Трансмиссионные масла</option>
                                    <option value="3">Промывочные масла</option>
                                </select>
                                <div class="tests__search-tab-content-parent">

                                </div>
                            </div>
                        </div>
                        <div class="tests__search-tab-footer">
                            <div class="tests__search-tab-footer-writeus">
                                <span>Не нашли испытания для своего авто?</span>
                                <a href="#">Напишите нам</a>
                            </div>
                            <a href="#" class="tests__search-tab-show">
                                Показать
                            </a>
                        </div>
                        <div class="tests__search-tab-clear">
                            <span>Очистить фильтр</span>
                            <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 1L9.48528 9.48528" stroke="currentColor" stroke-linecap="round"/>
                                <path d="M9.48535 1L1.00007 9.48528" stroke="currentColor" stroke-linecap="round"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tests__list">
                <!-- первый -->
                <div class="tests__item">
                    <div class="tests__item-headline">
                        <div class="tests__item-picture">
                            <img src="static/default/img/tests/tests-oil.png" alt="">
                        </div>
                        <div class="tests__item-descr">
                            <div class="tests__item-title">
                                G-Energy Racing 15W-50
                            </div>
                            <div class="tests__item-subtitle">
                                15W-50
                            </div>
                            <div class="tests__item-text">
                                Испытание двигателя
                            </div>
                        </div>
                    </div>
                    <div class="tests__item-list">
                        <div class="tests__item-list-target">
                            <div class="tests__item-list-target-title">
                                Audi
                            </div>
                            <div class="tests__item-list-target-subtitle">
                                A4 V (B9) 1.8 gasoline 2018
                            </div>
                            <div class="tests__item-list-target-text">
                                Год испытания 2023
                            </div>
                            <div class="tests__item-list-target-ico">
                                <img src="static/default/img/tests/cup-ico.png" alt="">
                            </div>
                        </div>
                        <div class="tests__item-list-target">
                            <div class="tests__item-list-target-title">
                                Audi
                            </div>
                            <div class="tests__item-list-target-subtitle">
                                A4 V (B9) 1.8 gasoline 2018
                            </div>
                            <div class="tests__item-list-target-text">
                                Год испытания 2023
                            </div>
                            <div class="tests__item-list-target-ico">
                                <img src="static/default/img/tests/time-ico.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- второй -->
                <div class="tests__item">
                    <div class="tests__item-headline">
                        <div class="tests__item-picture">
                            <img src="static/default/img/tests/tests-oil.png" alt="">
                        </div>
                        <div class="tests__item-descr">
                            <div class="tests__item-title">
                                G-Energy Racing 15W-50
                            </div>
                            <div class="tests__item-subtitle">
                                15W-50
                            </div>
                            <div class="tests__item-text">
                                Испытание двигателя
                            </div>
                        </div>
                    </div>
                    <div class="tests__item-list">
                        <div class="tests__item-list-target">
                            <div class="tests__item-list-target-title">
                                Audi
                            </div>
                            <div class="tests__item-list-target-subtitle">
                                A4 V (B9) 1.8 gasoline 2018
                            </div>
                            <div class="tests__item-list-target-text">
                                Год испытания 2023
                            </div>
                            <div class="tests__item-list-target-ico">
                                <img src="static/default/img/tests/cup-ico.png" alt="">
                            </div>
                        </div>
                        <div class="tests__item-list-target">
                            <div class="tests__item-list-target-title">
                                Audi
                            </div>
                            <div class="tests__item-list-target-subtitle">
                                A4 V (B9) 1.8 gasoline 2018
                            </div>
                            <div class="tests__item-list-target-text">
                                Год испытания 2023
                            </div>
                            <div class="tests__item-list-target-ico">
                                <img src="static/default/img/tests/time-ico.png" alt="">
                            </div>
                        </div>
                        <div class="tests__item-list-target">
                            <div class="tests__item-list-target-title">
                                Audi
                            </div>
                            <div class="tests__item-list-target-subtitle">
                                A4 V (B9) 1.8 gasoline 2018
                            </div>
                            <div class="tests__item-list-target-text">
                                Год испытания 2023
                            </div>
                            <div class="tests__item-list-target-ico">
                                <img src="static/default/img/tests/time-ico.png" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="tests__item-more">
                        + ЕЩЕ 3
                    </div>
                </div>

                <!-- третий -- баннер -->
                <div class="tests__item tests__item-banner">
                    <div class="tests__item-banner-in">
                        <div class="tests__item-banner-title">
                            Как мы проводим испытания?
                        </div>
                        <div class="tests__item-banner-numbers">
                            <div class="tests__item-banner-number">
                                <div class="tests__item-banner-number-big">
                                    12
                                </div>
                                <div class="tests__item-banner-number-small">
                                    Марок
                                </div>
                            </div>
                            <div class="tests__item-banner-number">
                                <div class="tests__item-banner-number-big">
                                    87
                                </div>
                                <div class="tests__item-banner-number-small">
                                    испытаний
                                </div>
                            </div>
                        </div>
                        <a href="#" class="tests__item-banner-btn">
                            Узнать больше
                        </a>
                    </div>
                </div>

                <!-- четвертый -->
                <div class="tests__item">
                    <div class="tests__item-headline">
                        <div class="tests__item-picture">
                            <img src="static/default/img/tests/tests-oil.png" alt="">
                        </div>
                        <div class="tests__item-descr">
                            <div class="tests__item-title">
                                G-Energy Racing 15W-50
                            </div>
                            <div class="tests__item-subtitle">
                                15W-50
                            </div>
                            <div class="tests__item-text">
                                Испытание двигателя
                            </div>
                        </div>
                    </div>
                    <div class="tests__item-list">
                        <div class="tests__item-list-target">
                            <div class="tests__item-list-target-title">
                                Audi
                            </div>
                            <div class="tests__item-list-target-subtitle">
                                A4 V (B9) 1.8 gasoline 2018
                            </div>
                            <div class="tests__item-list-target-text">
                                Год испытания 2023
                            </div>
                            <div class="tests__item-list-target-ico">
                                <img src="static/default/img/tests/cup-ico.png" alt="">
                            </div>
                        </div>
                        <div class="tests__item-list-target">
                            <div class="tests__item-list-target-title">
                                Audi
                            </div>
                            <div class="tests__item-list-target-subtitle">
                                A4 V (B9) 1.8 gasoline 2018
                            </div>
                            <div class="tests__item-list-target-text">
                                Год испытания 2023
                            </div>
                            <div class="tests__item-list-target-ico">
                                <img src="static/default/img/tests/time-ico.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- пятый -->
                <div class="tests__item">
                    <div class="tests__item-headline">
                        <div class="tests__item-picture">
                            <img src="static/default/img/tests/tests-oil.png" alt="">
                        </div>
                        <div class="tests__item-descr">
                            <div class="tests__item-title">
                                G-Energy Racing 15W-50
                            </div>
                            <div class="tests__item-subtitle">
                                15W-50
                            </div>
                            <div class="tests__item-text">
                                Испытание двигателя
                            </div>
                        </div>
                    </div>
                    <div class="tests__item-list">
                        <div class="tests__item-list-target">
                            <div class="tests__item-list-target-title">
                                Audi
                            </div>
                            <div class="tests__item-list-target-subtitle">
                                A4 V (B9) 1.8 gasoline 2018
                            </div>
                            <div class="tests__item-list-target-text">
                                Год испытания 2023
                            </div>
                            <div class="tests__item-list-target-ico">
                                <img src="static/default/img/tests/cup-ico.png" alt="">
                            </div>
                        </div>
                        <div class="tests__item-list-target">
                            <div class="tests__item-list-target-title">
                                Audi
                            </div>
                            <div class="tests__item-list-target-subtitle">
                                A4 V (B9) 1.8 gasoline 2018
                            </div>
                            <div class="tests__item-list-target-text">
                                Год испытания 2023
                            </div>
                            <div class="tests__item-list-target-ico">
                                <img src="static/default/img/tests/time-ico.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="tests__loadmore">
                <a href="" class="tests__loadmore-btn">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5.5 4.4C7.3 2.9 9.6 2 12 2C17.5 2 22 6.5 22 12C22 14.1 21.3 16.1 20.2 17.7L17 12H20C20 7.6 16.4 4 12 4C9.9 4 7.9 4.8 6.5 6.2L5.5 4.4ZM18.5 19.6C16.7 21.1 14.4 22 12 22C6.5 22 2 17.5 2 12C2 9.9 2.7 7.9 3.8 6.3L7 12H4C4 16.4 7.6 20 12 20C14.1 20 16.1 19.2 17.5 17.8L18.5 19.6Z" fill="currentColor"/>
                    </svg>
                    <span>Загрузить еще</span>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Карта сайта -->
<!-- Обертка шаблона -->
<div class="base-page type-page">
    <div class="container">
        <!-- Все остальное -->
        <?= $this->render('//parts/common/breadcrumbs'); ?>
        <div class="sitemap__in">
            <h1 class="page-title">
                    Карта сайта
            </h1>
        </div>
        <div class="sitemap__content">
            <!-- Бренд -->
            <div class="sitemap__content-in">
                <div class="sitemap__content-headline">
                    <div class="sitemap__content-title">
                        <svg width="37" height="36" viewBox="0 0 37 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M17.6896 9C12.8401 9 10.6951 10.648 9.57597 13.1684L7.1512 18.9847C3.88709 26.2551 8.27033 28 11.5344 28H21.8863L27.1089 15.301H21.3268L15.4514 19.5663H19.8346L17.8761 24.4133H12.3738C12.3738 24.4133 10.4153 24.4133 11.3479 22.1837L14.612 14.3316C15.1716 12.9745 16.1042 12.6837 17.4098 12.6837H24.8707L30 9H17.6896Z" fill="#F15E21"/>
                        </svg>
                        <span>Бренд</span>
                    </div>
                    <a href="#">
                        <span>Перейти в раздел</span>
                        <i class="icon-arrow-r"></i>
                    </a>
                </div>
                <ul class="sitemap__content-list">
                    <li>
                        <a href="#">G-Energy</a>
                    </li>
                    <li>
                        <a href="#">Контакты</a>
                    </li>
                    <li>
                        <a href="#">Где используют</a>
                    </li>
                    <li>
                        <a href="#">G-Lab</a>
                    </li>
                    <li>
                        <a href="#">Новости</a>
                    </li>
                </ul>
            </div>
            <!-- Где купить -->
            <div class="sitemap__content-in">
                <div class="sitemap__content-headline">
                    <div class="sitemap__content-title">
                        <svg width="37" height="36" viewBox="0 0 37 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M18.5 6C12.9286 6 8.5 10.3765 8.5 15.8824C8.5 18.9882 9.92857 21.6706 12.2143 23.5059C13.2143 24.3529 15.7857 26.6118 16.7857 27.8824C17.6429 28.8706 18.5 30 18.5 30C18.5 30 19.3571 28.8706 20.2143 27.7412C21.2143 26.6118 23.7857 24.2118 24.7857 23.3647C27.0714 21.6706 28.5 18.8471 28.5 15.8824C28.5 10.3765 24.0714 6 18.5 6ZM18.5 19.9765C16.0714 19.9765 14.2143 18.1412 14.2143 15.7412C14.2143 13.3412 16.0714 11.5059 18.5 11.5059C20.9286 11.5059 22.7857 13.3412 22.7857 15.7412C22.7857 18.1412 20.9286 19.9765 18.5 19.9765Z" fill="#F15E21"/>
                        </svg>
                        <span>Где купить</span>
                    </div>
                    <a href="#">
                        <span>Перейти в раздел</span>
                        <i class="icon-arrow-r"></i>
                    </a>
                </div>
                <ul class="sitemap__content-list">
                    <li>
                        <a href="#">Физическое лицо</a>
                    </li>
                    <li>
                        <a href="#">Юридическое лицо</a>
                    </li>
                </ul>
            </div>
            <!-- Заменить масло -->
            <div class="sitemap__content-in">
                <div class="sitemap__content-headline">
                    <div class="sitemap__content-title">
                        <svg width="37" height="36" viewBox="0 0 37 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M19.7165 6.66142L18.9488 6L18.1811 6.66142C17.7677 6.9685 9.5 14.1732 9.5 20.5512C9.5 23.0572 10.4955 25.4605 12.2675 27.2325C14.0395 29.0045 16.4428 30 18.9488 30C21.4548 30 23.8581 29.0045 25.6301 27.2325C27.4021 25.4605 28.3976 23.0572 28.3976 20.5512C28.3976 14.1732 20.1299 6.9685 19.7165 6.66142ZM21.5827 25.8307L20.5315 23.7165C21.1198 23.4228 21.6148 22.9712 21.9611 22.4121C22.3074 21.8531 22.4912 21.2088 22.4921 20.5512H24.8543C24.8532 21.6482 24.5465 22.7233 23.9686 23.6558C23.3908 24.5883 22.5646 25.3414 21.5827 25.8307Z" fill="#F15E21"/>
                        </svg>
                        <span>Заменить масло</span>
                    </div>
                    <a href="#">
                        <span>Перейти в раздел</span>
                        <i class="icon-arrow-r"></i>
                    </a>
                </div>
                <ul class="sitemap__content-list">
                    <li>
                        <a href="#">Заменить масло в Саяногорске</a>
                    </li>
                    <li>
                        <a href="#">Заменить масло в Волгограде</a>
                    </li>
                    <li>
                        <a href="#">Заменить масло в Уфе</a>
                    </li>
                </ul>
            </div>
            <!-- Продукция -->
            <div class="sitemap__content-in">
                <div class="sitemap__content-headline">
                    <div class="sitemap__content-title">
                        <svg width="37" height="36" viewBox="0 0 37 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M23 10.5714H10.625C10.3266 10.5714 10.0405 10.6918 9.8295 10.9062C9.61853 11.1205 9.5 11.4112 9.5 11.7143V28.8571C9.5 29.1602 9.61853 29.4509 9.8295 29.6653C10.0405 29.8796 10.3266 30 10.625 30H26.375C26.6734 30 26.9595 29.8796 27.1705 29.6653C27.3815 29.4509 27.5 29.1602 27.5 28.8571V17.4286L23 10.5714ZM17.375 6H11.75C11.4516 6 11.1655 6.12041 10.9545 6.33474C10.7435 6.54906 10.625 6.83975 10.625 7.14286V9.42857H18.5V7.14286C18.5 6.83975 18.3815 6.54906 18.1705 6.33474C17.9595 6.12041 17.6734 6 17.375 6ZM25.25 18.5714V26.5714H23V18.5714H25.25Z" fill="#F15E21"/>
                        </svg>
                        <span>Продукция</span>
                    </div>
                    <a href="#">
                        <span>Перейти в раздел</span>
                        <i class="icon-arrow-r"></i>
                    </a>
                </div>
                <ul class="sitemap__content-list">
                    <li>
                        <a href="#">Ассортимент</a>
                        <ul>
                            <li><a href="#">Масла для легковых автомобилей</a></li>
                            <li><a href="#">Масла для мотоциклов, квадроциклов, скутеров</a></li>
                            <li><a href="#">Тормозные жидкости</a></li>
                            <li><a href="#">Охлаждающие жидкости</a></li>
                            <li><a href="#">Масла для коммерческого транспорта и специальной техники</a></li>
                            <li><a href="#">Масла для садовой техники</a></li>
                            <li><a href="#">Пластичные смазки</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">Маркетинговые материалы</a>
                    </li>
                </ul>
            </div>
            <!-- Подобрать продукты -->
            <div class="sitemap__content-in">
                <div class="sitemap__content-headline">
                    <div class="sitemap__content-title">
                        <svg width="37" height="36" viewBox="0 0 37 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_31_97)">
                                <path d="M17.7186 20.6855C19.6333 20.6855 21.1855 19.1333 21.1855 17.2186C21.1855 15.3039 19.6333 13.7517 17.7186 13.7517C15.8039 13.7517 14.2517 15.3039 14.2517 17.2186C14.2517 19.1333 15.8039 20.6855 17.7186 20.6855Z" fill="#F15E21"/>
                                <path d="M18.5 6C11.8728 6 6.5 11.3728 6.5 18C6.5 24.6272 11.8728 30 18.5 30C25.1272 30 30.5 24.6272 30.5 18C30.5 11.3728 25.1272 6 18.5 6ZM24.4972 23.4539L23.9539 23.9972C23.8843 24.0668 23.8016 24.1221 23.7106 24.1598C23.6196 24.1975 23.522 24.2169 23.4235 24.2169C23.325 24.2169 23.2275 24.1975 23.1365 24.1598C23.0455 24.1221 22.9628 24.0668 22.8931 23.9972L20.6764 21.78C19.5493 22.511 18.1914 22.7988 16.8647 22.588C15.5379 22.3772 14.3361 21.6827 13.491 20.6384C12.6459 19.5941 12.2173 18.274 12.2878 16.9324C12.3584 15.5908 12.923 14.3229 13.8729 13.3729C14.8229 12.423 16.0908 11.8584 17.4324 11.7878C18.774 11.7173 20.0941 12.1459 21.1384 12.991C22.1827 13.8361 22.8772 15.0379 23.088 16.3647C23.2988 17.6914 23.011 19.0493 22.28 20.1764L24.4972 22.3931C24.5668 22.4628 24.6221 22.5455 24.6598 22.6365C24.6975 22.7275 24.7169 22.825 24.7169 22.9235C24.7169 23.022 24.6975 23.1196 24.6598 23.2106C24.6221 23.3016 24.5668 23.3843 24.4972 23.4539Z" fill="#F15E21"/>
                            </g>
                            <defs>
                                <clipPath id="clip0_31_97">
                                    <rect width="24" height="24" fill="white" transform="translate(6.5 6)"/>
                                </clipPath>
                            </defs>
                        </svg>
                        <span>Подобрать продукты</span>
                    </div>
                    <a href="#">
                        <span>Перейти в раздел</span>
                        <i class="icon-arrow-r"></i>
                    </a>
                </div>
                <ul class="sitemap__content-list">
                    <li>
                        <a href="#">Поиск смазочных материалов по марке и модели</a>
                    </li>
                    <li>
                        <a href="#">Поиск смазочных материалов по вязкости и требованию автопроизводителя</a>
                    </li>
                    <li>
                        <a href="#">Поиск смазочных материалов по названию используемого продукта</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>