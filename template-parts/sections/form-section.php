<?php
/**
 * Form section template (Форма обратной связи)
 *
 * @package RAMNET
 */
?>

<section class="form">
    <div class="form__container">
        <div class="form__inner">

            <h1 class="form__title"><?php echo esc_html__( 'НАС ВЫБИРАЮТ ЛЮДИ, КОТОРЫЕ', 'ramnet' ); ?></h1>

            <div class="form__flex__container">
                <div class="form__flex__item">
                    <img src="<?php echo esc_url( RAMNET_THEME_URI . '/assets/images/icon/divider.svg' ); ?>" alt="">
                    <p class="form__text"><?php echo esc_html__( 'ценят профессионализм', 'ramnet' ); ?></p>
                </div>
                <div class="form__flex__item">
                    <img src="<?php echo esc_url( RAMNET_THEME_URI . '/assets/images/icon/divider.svg' ); ?>" alt="">
                    <p class="form__text"><?php echo esc_html__( 'берегут свои нервы и время', 'ramnet' ); ?></p>
                </div>
                <div class="form__flex__item">
                    <img src="<?php echo esc_url( RAMNET_THEME_URI . '/assets/images/icon/divider.svg' ); ?>" alt="">
                    <p class="form__text">
                        <?php echo esc_html__( 'хотят получить лучшее в рамках своего бюджета', 'ramnet' ); ?></p>
                </div>
            </div>

            <h1 class="form__title__second">
                <?php echo esc_html__( 'Вы в одном шаге ', 'ramnet' ); ?><br>
                <?php echo esc_html__( 'от правильного решения', 'ramnet' ); ?><br>
                <?php echo esc_html__( 'о выборе подрядчика', 'ramnet' ); ?>
            </h1>

            <form id="form" novalidate>
                <input type="text" name="username" class="form__input"
                    placeholder="<?php echo esc_attr__( 'Имя', 'ramnet' ); ?>">
                <input name="phone" type="text" class="form__input" placeholder="+7">

                <div class="button__container__project">
                    <button id="form__submit" class="button__main">
                        <p class="button__text"><?php echo esc_html__( 'НАЧАТЬ ПРОЕКТ', 'ramnet' ); ?></p>
                    </button>
                </div>
            </form>

        </div>

        <img class="form__images" src="<?php echo esc_url( RAMNET_THEME_URI . '/assets/images/form.png' ); ?>" alt="">
    </div>
</section>