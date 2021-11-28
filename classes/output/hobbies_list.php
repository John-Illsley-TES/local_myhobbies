<?php
/**
 * Lists all the users hobbies.
 *
 * @package   local_hobbies
 * @author    John Illsley 2021
 */

namespace local_myhobbies\output;

use renderer_base;
use stdClass;
use function array_values;

defined('MOODLE_INTERNAL') || die();

class hobbies_list implements \renderable, \templatable {

    /**
     * @param stdClass[]
     */
    protected $hobbies;

    public function __construct(array $hobbies) {

        $this->hobbies = $hobbies;
    }

    public function export_for_template(renderer_base $output) {

        $data = new stdClass();
        $data->hobbies = array_values($this->hobbies);
        $data->hashobbies = (count($this->hobbies) > 0) ? 1 : 0;
        return $data;
    }
}
