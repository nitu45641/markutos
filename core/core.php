<?php

namespace Markutos\Core;

use Markutos\Utils\Singleton as Singleton;

/**
 * Base Class
 *
 * @since 1.0.0
 */
class Core {

    use Singleton;

    /**
     * Initialize all modules.
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function init() {
      if ( is_admin() ) {
        // Load admin menus
        \Markutos\Core\Admin\Menus::instance()->init();
      }

      \Markutos\Core\Frontend\Shortcodes::instance()->init();


    }

}
