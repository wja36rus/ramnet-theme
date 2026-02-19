<?php
/**
 * People section template (Отзывы)
 *
 * @package RAMNET
 */
?>

<section class="people">
    <div class="people__container">

        <h4 class="title__people"><?php echo esc_html__( 'Отзывы', 'ramnet' ); ?></h4>

        <div class="people__card__wrapper">

            <!-- Отзыв 1: Евгений -->
            <div class="people__card">
                <div class="people__card__logo_line">
                    <div class="people__card__logo"></div>
                    <div class="people__card__starline">
                        <div class="people__card__title__and__start">
                            <h1 class="people__card__title"><?php echo esc_html__( 'Евгений', 'ramnet' ); ?></h1>
                            <img src="<?php echo esc_url( RAMNET_THEME_URI . '/assets/images/icon/star.svg' ); ?>"
                                alt="">
                        </div>
                        <p class="people__card__boss">
                            <?php echo esc_html__( 'директор Природного парка «Олений»', 'ramnet' ); ?></p>
                        <p class="people__card__place"><?php echo esc_html__( 'Липецкая обл.', 'ramnet' ); ?></p>
                    </div>
                </div>
                <div class="people__card__text">
                    <?php echo esc_html__( 'Отличная компания с первоклассными специалистами. Подходят к заказу очень грамотно, прорабатывая каждую мелочь', 'ramnet' ); ?>
                </div>
            </div>

            <!-- Отзыв 2: Компания -->
            <div class="people__card">
                <div class="people__card__logo_line">
                    <div class="people__card__logo"></div>
                    <div class="people__card__starline">
                        <div class="people__card__title__and__start">
                            <h1 class="people__card__title"><?php echo esc_html__( 'Компания', 'ramnet' ); ?></h1>
                            <img src="<?php echo esc_url( RAMNET_THEME_URI . '/assets/images/icon/star.svg' ); ?>"
                                alt="">
                        </div>
                        <p class="people__card__boss"></p>
                        <p class="people__card__place"></p>
                    </div>
                </div>
                <div class="people__card__text">
                    <?php echo esc_html__( 'Грамотно проконсультировали. Сориентировали по цене. Помогли проработать ТЗ и сэкономить около 20% за счет оптимизации конструкции. Оперативно давали обратную связь. Работа по договору с четкими сроками.', 'ramnet' ); ?>
                </div>
            </div>

            <!-- Отзыв 3: Илья -->
            <div class="people__card">
                <div class="people__card__logo_line">
                    <div class="people__card__logo"></div>
                    <div class="people__card__starline">
                        <div class="people__card__title__and__start">
                            <h1 class="people__card__title"><?php echo esc_html__( 'Илья', 'ramnet' ); ?></h1>
                            <img src="<?php echo esc_url( RAMNET_THEME_URI . '/assets/images/icon/star.svg' ); ?>"
                                alt="">
                        </div>
                        <p class="people__card__boss">
                            <?php echo esc_html__( 'директор Природного парка «Олений»', 'ramnet' ); ?></p>
                        <p class="people__card__place"><?php echo esc_html__( 'частный дом', 'ramnet' ); ?></p>
                    </div>
                </div>
                <div class="people__card__text">
                    <?php echo esc_html__( 'Компания знает своё дело на все 100%. Заказ выполнен точно в срок, качество супер, работой доволен. Никаких подводных камней, цена адекватная.', 'ramnet' ); ?>
                </div>
            </div>

            <!-- Отзыв 4: Евгений (дубль для примера) -->
            <div class="people__card">
                <div class="people__card__logo_line">
                    <div class="people__card__logo"></div>
                    <div class="people__card__starline">
                        <div class="people__card__title__and__start">
                            <h1 class="people__card__title"><?php echo esc_html__( 'Евгений', 'ramnet' ); ?></h1>
                            <img src="<?php echo esc_url( RAMNET_THEME_URI . '/assets/images/icon/star.svg' ); ?>"
                                alt="">
                        </div>
                        <p class="people__card__boss">
                            <?php echo esc_html__( 'директор Природного парка «Олений»', 'ramnet' ); ?></p>
                        <p class="people__card__place"><?php echo esc_html__( 'Липецкая обл.', 'ramnet' ); ?></p>
                    </div>
                </div>
                <div class="people__card__text">
                    <?php echo esc_html__( 'Отличная компания с первоклассными специалистами. Подходят к заказу очень грамотно, прорабатывая каждую мелочь', 'ramnet' ); ?>
                </div>
            </div>

            <!-- Отзыв 5: Компания (дубль для примера) -->
            <div class="people__card">
                <div class="people__card__logo_line">
                    <div class="people__card__logo"></div>
                    <div class="people__card__starline">
                        <div class="people__card__title__and__start">
                            <h1 class="people__card__title"><?php echo esc_html__( 'Компания', 'ramnet' ); ?></h1>
                            <img src="<?php echo esc_url( RAMNET_THEME_URI . '/assets/images/icon/star.svg' ); ?>"
                                alt="">
                        </div>
                        <p class="people__card__boss"></p>
                        <p class="people__card__place"></p>
                    </div>
                </div>
                <div class="people__card__text">
                    <?php echo esc_html__( 'Грамотно проконсультировали. Сориентировали по цене. Помогли проработать ТЗ и сэкономить около 20% за счет оптимизации конструкции. Оперативно давали обратную связь. Работа по договору с четкими сроками.', 'ramnet' ); ?>
                </div>
            </div>

            <!-- Отзыв 6: Илья (дубль для примера) -->
            <div class="people__card">
                <div class="people__card__logo_line">
                    <div class="people__card__logo"></div>
                    <div class="people__card__starline">
                        <div class="people__card__title__and__start">
                            <h1 class="people__card__title"><?php echo esc_html__( 'Илья', 'ramnet' ); ?></h1>
                            <img src="<?php echo esc_url( RAMNET_THEME_URI . '/assets/images/icon/star.svg' ); ?>"
                                alt="">
                        </div>
                        <p class="people__card__boss">
                            <?php echo esc_html__( 'директор Природного парка «Олений»', 'ramnet' ); ?></p>
                        <p class="people__card__place"><?php echo esc_html__( 'частный дом', 'ramnet' ); ?></p>
                    </div>
                </div>
                <div class="people__card__text">
                    <?php echo esc_html__( 'Компания знает своё дело на все 100%. Заказ выполнен точно в срок, качество супер, работой доволен. Никаких подводных камней, цена адекватная.', 'ramnet' ); ?>
                </div>
            </div>

        </div>

        <!-- Кнопка "Читать все отзывы" -->
        <div class="button__container__people" id="show__people">
            <button class="button__main__black">
                <p class="button__text"><?php echo esc_html__( 'ЧИТАТЬ ВСЕ ОТЗЫВЫ', 'ramnet' ); ?></p>
            </button>
        </div>

    </div>
</section>