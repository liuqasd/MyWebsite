<?php

if ( ! class_exists( 'WP_Customize_Control' ) ) {
    return NULL;
}

/**
 * Simple Notice Custom Control
 */
class PridMag_Info_Control extends WP_Customize_Control {

   /**
    * The type of control being rendered
    */
   public $type = 'pridmag-info';

   /**
    * Render the control in the customizer
    */
   public function render_content() { ?>
    <div class="th-info-control">
        <?php if( ! empty( $this->label ) ) { ?>
            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
        <?php } ?>
        <?php if( ! empty( $this->description ) ) { ?>
            <span class="customize-control-description"><?php echo wp_kses_post( $this->description ); ?></span>
        <?php } ?>
    </div>
   <?php
   }
}