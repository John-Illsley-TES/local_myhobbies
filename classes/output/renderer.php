<?php
/**
 * Renderer class for local myhobbies.
 *
 * @package   local_hobbies
 * @author    John Illsley 2021
 */

namespace local_myhobbies\output;

use plugin_renderer_base;

defined('MOODLE_INTERNAL') || die();

class renderer extends plugin_renderer_base {

    public function hobbies_list(array $list) {

        $hobbieslist = new hobbies_list($list);
        return $this->render_from_template('local_myhobbies/hobbies_list', $hobbieslist->export_for_template($this));
    }
}