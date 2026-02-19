<?php
/**
 * Quietion section template (Вопрос-ответ)
 *
 * @package RAMNET
 */
?>

<section class="quietion">
    <div class="quietion__container">

        <h4 class="title__quietion"><?php echo esc_html__( 'Вопрос-ответ', 'ramnet' ); ?></h4>

        <!-- Вопрос 1: Порядок оплаты -->
        <div class="quietion__card">
            <div class="quietion_flex">
                <img src="<?php echo esc_url( RAMNET_THEME_URI . '/assets/images/icon/cross_q.svg' ); ?>" alt="">
                <p class="quietion__quietion"><?php echo esc_html__( 'Какой порядок оплаты?', 'ramnet' ); ?></p>
            </div>
            <p class="quietion__answer active">
                <?php echo esc_html__( 'Как правило, 70 % аванс, 30 % оплата после монтажа. Возможно разделить оплату на 3-4 этапа.', 'ramnet' ); ?>
            </p>
        </div>

        <!-- Вопрос 2: Стоимость замера -->
        <div class="quietion__card">
            <div class="quietion_flex">
                <img src="<?php echo esc_url( RAMNET_THEME_URI . '/assets/images/icon/cross_q.svg' ); ?>" alt="">
                <p class="quietion__quietion"><?php echo esc_html__( 'Сколько стоит выезд на замер?', 'ramnet' ); ?></p>
            </div>
            <p class="quietion__answer">
                <?php echo esc_html__( 'Выезд на замер по городу – бесплатный.', 'ramnet' ); ?>
            </p>
        </div>

        <!-- Вопрос 3: Скидки -->
        <div class="quietion__card">
            <div class="quietion_flex">
                <img src="<?php echo esc_url( RAMNET_THEME_URI . '/assets/images/icon/cross_q.svg' ); ?>" alt="">
                <p class="quietion__quietion"><?php echo esc_html__( 'Сделаете ли скидку?', 'ramnet' ); ?></p>
            </div>
            <p class="quietion__answer">
                <?php echo esc_html__( 'Как правило, 70 % аванс, 30 % оплата после монтажа. Возможно разделить оплату на 3-4 этапа.', 'ramnet' ); ?>
            </p>
        </div>

        <!-- Вопрос 4: Сроки -->
        <div class="quietion__card">
            <div class="quietion_flex">
                <img src="<?php echo esc_url( RAMNET_THEME_URI . '/assets/images/icon/cross_q.svg' ); ?>" alt="">
                <p class="quietion__quietion"><?php echo esc_html__( 'Какие сроки?', 'ramnet' ); ?></p>
            </div>
            <p class="quietion__answer">
                <?php echo esc_html__( 'Как правило, 70 % аванс, 30 % оплата после монтажа. Возможно разделить оплату на 3-4 этапа.', 'ramnet' ); ?>
            </p>
        </div>

        <!-- Вопрос 5: Гарантии -->
        <div class="quietion__card">
            <div class="quietion_flex">
                <img src="<?php echo esc_url( RAMNET_THEME_URI . '/assets/images/icon/cross_q.svg' ); ?>" alt="">
                <p class="quietion__quietion"><?php echo esc_html__( 'Есть ли гарантии?', 'ramnet' ); ?></p>
            </div>
            <p class="quietion__answer">
                <?php echo esc_html__( 'Как правило, 70 % аванс, 30 % оплата после монтажа. Возможно разделить оплату на 3-4 этапа.', 'ramnet' ); ?>
            </p>
        </div>

        <!-- Вопрос 6: Производство -->
        <div class="quietion__card">
            <div class="quietion_flex">
                <img src="<?php echo esc_url( RAMNET_THEME_URI . '/assets/images/icon/cross_q.svg' ); ?>" alt="">
                <p class="quietion__quietion"><?php echo esc_html__( 'Чье производство?', 'ramnet' ); ?></p>
            </div>
            <p class="quietion__answer">
                <?php echo esc_html__( 'Как правило, 70 % аванс, 30 % оплата после монтажа. Возможно разделить оплату на 3-4 этапа.', 'ramnet' ); ?>
            </p>
        </div>

    </div>
</section>