<?php
/**
 * Jobs section template (Как остекляем)
 *
 * @package RAMNET
 */
?>

<section class="jobs" id="jobs">
    <div class="jobs__container">
        <h4 class="title__job"><?php echo esc_html__( 'Как остекляем', 'ramnet' ); ?></h4>

        <!-- Левая колонка с названиями технологий -->
        <div class="jobs__wrapper">
            <div data-attribute="1" class="jobs__items active">
                <?php echo esc_html__( 'Подъемное гильотинное остекление', 'ramnet' ); ?></div>
            <div data-attribute="2" class="jobs__items">
                <?php echo esc_html__( 'Раздвижное безрамное остекление', 'ramnet' ); ?></div>
            <div data-attribute="3" class="jobs__items">
                <?php echo esc_html__( 'Раздвижное остекление со стеклопакетом', 'ramnet' ); ?></div>
            <div data-attribute="4" class="jobs__items">
                <?php echo esc_html__( 'Безрамное остекление «книжка», «гармошка»', 'ramnet' ); ?></div>
            <div data-attribute="5" class="jobs__items">
                <?php echo esc_html__( 'Панорамные раздвижные двери HS, LS (порталы)', 'ramnet' ); ?></div>
            <div data-attribute="6" class="jobs__items">
                <?php echo esc_html__( 'Панорамные складные двери «гармошка»', 'ramnet' ); ?></div>
            <div data-attribute="7" class="jobs__items">
                <?php echo esc_html__( 'Алюминиевые окна и двери', 'ramnet' ); ?></div>
            <div data-attribute="8" class="jobs__items"><?php echo esc_html__( 'Стеклянные ограждения', 'ramnet' ); ?>
            </div>
            <div data-attribute="9" class="jobs__items">
                <?php echo esc_html__( 'Стеклянные крыши и фасады', 'ramnet' ); ?></div>
        </div>

        <!-- Правая колонка с карточками (динамически меняются) -->
        <div id="jobs1" class="jobs__item__card active">
            <div class="jobs__cards">
                <div class="cards__title"><?php echo esc_html__( 'Подъемное гильотинное остекление', 'ramnet' ); ?>
                </div>
                <hr class="jobs__hr">
                <p class="cards__text">
                    <?php echo esc_html__( 'универсальное решение для открытых террас и веранд. Система элегантно зонирует пространство, создавая ощущение легкости', 'ramnet' ); ?>
                </p>
                <div class="button__container__jobs">
                    <button class="button__main">
                        <p class="button__text"><?php echo esc_html__( 'ПОДРОБНЕЕ', 'ramnet' ); ?></p>
                    </button>
                </div>
            </div>
        </div>

        <div id="jobs2" class="jobs__item__card">
            <div class="jobs__cards">
                <div class="cards__title"><?php echo esc_html__( 'Раздвижное безрамное остекление', 'ramnet' ); ?></div>
                <hr class="jobs__hr">
                <p class="cards__text">
                    <?php echo esc_html__( 'универсальное решение для открытых террас и веранд. Система элегантно зонирует пространство, создавая ощущение легкости', 'ramnet' ); ?>
                </p>
                <div class="button__container__jobs">
                    <button class="button__main">
                        <p class="button__text"><?php echo esc_html__( 'ПОДРОБНЕЕ', 'ramnet' ); ?></p>
                    </button>
                </div>
            </div>
        </div>

        <!-- Здесь должны быть остальные карточки (jobs3 - jobs9) с соответствующими фоновыми изображениями -->
        <!-- Для краткости добавлю шаблон для остальных -->

        <div id="jobs3" class="jobs__item__card">
            <div class="jobs__cards">
                <div class="cards__title">
                    <?php echo esc_html__( 'Раздвижное остекление со стеклопакетом', 'ramnet' ); ?></div>
                <hr class="jobs__hr">
                <p class="cards__text">
                    <?php echo esc_html__( 'универсальное решение для открытых террас и веранд. Система элегантно зонирует пространство, создавая ощущение легкости', 'ramnet' ); ?>
                </p>
                <div class="button__container__jobs">
                    <button class="button__main">
                        <p class="button__text"><?php echo esc_html__( 'ПОДРОБНЕЕ', 'ramnet' ); ?></p>
                    </button>
                </div>
            </div>
        </div>

        <div id="jobs4" class="jobs__item__card">
            <div class="jobs__cards">
                <div class="cards__title">
                    <?php echo esc_html__( 'Безрамное остекление «книжка», «гармошка»', 'ramnet' ); ?></div>
                <hr class="jobs__hr">
                <p class="cards__text">
                    <?php echo esc_html__( 'универсальное решение для открытых террас и веранд. Система элегантно зонирует пространство, создавая ощущение легкости', 'ramnet' ); ?>
                </p>
                <div class="button__container__jobs">
                    <button class="button__main">
                        <p class="button__text"><?php echo esc_html__( 'ПОДРОБНЕЕ', 'ramnet' ); ?></p>
                    </button>
                </div>
            </div>
        </div>

        <div id="jobs5" class="jobs__item__card">
            <div class="jobs__cards">
                <div class="cards__title">
                    <?php echo esc_html__( 'Панорамные раздвижные двери HS, LS (порталы)', 'ramnet' ); ?></div>
                <hr class="jobs__hr">
                <p class="cards__text">
                    <?php echo esc_html__( 'универсальное решение для открытых террас и веранд. Система элегантно зонирует пространство, создавая ощущение легкости', 'ramnet' ); ?>
                </p>
                <div class="button__container__jobs">
                    <button class="button__main">
                        <p class="button__text"><?php echo esc_html__( 'ПОДРОБНЕЕ', 'ramnet' ); ?></p>
                    </button>
                </div>
            </div>
        </div>

        <div id="jobs6" class="jobs__item__card">
            <div class="jobs__cards">
                <div class="cards__title"><?php echo esc_html__( 'Панорамные складные двери «гармошка»', 'ramnet' ); ?>
                </div>
                <hr class="jobs__hr">
                <p class="cards__text">
                    <?php echo esc_html__( 'универсальное решение для открытых террас и веранд. Система элегантно зонирует пространство, создавая ощущение легкости', 'ramnet' ); ?>
                </p>
                <div class="button__container__jobs">
                    <button class="button__main">
                        <p class="button__text"><?php echo esc_html__( 'ПОДРОБНЕЕ', 'ramnet' ); ?></p>
                    </button>
                </div>
            </div>
        </div>

        <div id="jobs7" class="jobs__item__card">
            <div class="jobs__cards">
                <div class="cards__title"><?php echo esc_html__( 'Алюминиевые окна и двери', 'ramnet' ); ?></div>
                <hr class="jobs__hr">
                <p class="cards__text">
                    <?php echo esc_html__( 'универсальное решение для открытых террас и веранд. Система элегантно зонирует пространство, создавая ощущение легкости', 'ramnet' ); ?>
                </p>
                <div class="button__container__jobs">
                    <button class="button__main">
                        <p class="button__text"><?php echo esc_html__( 'ПОДРОБНЕЕ', 'ramnet' ); ?></p>
                    </button>
                </div>
            </div>
        </div>

        <div id="jobs8" class="jobs__item__card">
            <div class="jobs__cards">
                <div class="cards__title"><?php echo esc_html__( 'Стеклянные ограждения', 'ramnet' ); ?></div>
                <hr class="jobs__hr">
                <p class="cards__text">
                    <?php echo esc_html__( 'универсальное решение для открытых террас и веранд. Система элегантно зонирует пространство, создавая ощущение легкости', 'ramnet' ); ?>
                </p>
                <div class="button__container__jobs">
                    <button class="button__main">
                        <p class="button__text"><?php echo esc_html__( 'ПОДРОБНЕЕ', 'ramnet' ); ?></p>
                    </button>
                </div>
            </div>
        </div>

        <div id="jobs9" class="jobs__item__card">
            <div class="jobs__cards">
                <div class="cards__title"><?php echo esc_html__( 'Стеклянные крыши и фасады', 'ramnet' ); ?></div>
                <hr class="jobs__hr">
                <p class="cards__text">
                    <?php echo esc_html__( 'универсальное решение для открытых террас и веранд. Система элегантно зонирует пространство, создавая ощущение легкости', 'ramnet' ); ?>
                </p>
                <div class="button__container__jobs">
                    <button class="button__main">
                        <p class="button__text"><?php echo esc_html__( 'ПОДРОБНЕЕ', 'ramnet' ); ?></p>
                    </button>
                </div>
            </div>
        </div>

    </div>
</section>