<?php
/**
 * Boss section template (О компании)
 *
 * @package RAMNET
 */
?>

<section class="boss" id="boss">
    <div class="boss__container">
        <h4 class="title__boss"><?php echo esc_html__( 'О компании', 'ramnet' ); ?></h4>

        <div class="boss__lines">

            <!-- Фото основателя -->
            <img src="<?php echo esc_url( RAMNET_THEME_URI . '/assets/images/boss.png' ); ?>"
                alt="<?php esc_attr_e( 'Павел Бахаев - основатель компании', 'ramnet' ); ?>">

            <div class="boss__card">
                <h1 class="boss__title">
                    <?php echo esc_html__( 'Павел Бахаев – основатель компании РАМ.НЕТ', 'ramnet' ); ?>
                </h1>

                <div class="boss__text__flex">
                    <p class="boss__text">
                        <?php echo esc_html__( 'Производственная компания РАМ.НЕТ специализируется на установке систем панорамного остекления под ключ: от проекта до изготовления и монтажа конструкций различного типа и конфигурации. Можем изготовить все, что связано с закаленным стеклом. Монтаж также производят специалисты, которые знают особенности этого материала.', 'ramnet' ); ?>
                    </p>

                    <p class="boss__text">
                        <?php echo esc_html__( 'Свое дело мы с любовью развиваем уже более 15 лет. Нас знают как надежного и ответственного подрядчика не только в Воронеже, но и в регионах России: от Москвы до Сочи.', 'ramnet' ); ?>
                    </p>

                    <p class="boss__text">
                        <?php echo esc_html__( 'Сейчас в штате компании трудится 10 человек. Личный опыт работы каждого сотрудника от 5 лет.', 'ramnet' ); ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>