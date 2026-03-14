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


            <h1 class="form__title__second">
                <?php echo esc_html__( 'Закажите подъемное гильотинное', 'ramnet' ); ?><br>
                <?php echo esc_html__( 'остекление под ключ прямо сейчас!', 'ramnet' ); ?><br>
            </h1>

            <form id="form" novalidate>
                <input type="text" name="username" class="form__input"
                    placeholder="<?php echo esc_attr__( 'Имя', 'ramnet' ); ?>">
                <input name="phone" type="text" class="form__input phone-mask" placeholder="+7">
                <span>
                    <?php echo esc_html__('Нажимая на кнопку, Вы даете согласие ');?><br>
                    <?php echo esc_html__('на обработку персональных данных');?>
                </span>
                <div class="button__container__project">
                    <button id="form__submit" class="button__main">
                        <p class="button__text"><?php echo esc_html__( 'РАССЧИТАТЬ СТОИМОСТЬ', 'ramnet' ); ?></p>
                    </button>
                </div>
            </form>

        </div>

        <img class="form__images" src="<?php echo esc_url( RAMNET_THEME_URI . '/assets/images/form.png' ); ?>" alt="">
    </div>
</section>