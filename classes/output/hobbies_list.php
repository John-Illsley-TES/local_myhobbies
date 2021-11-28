<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Lists all the users hobbies.
 *
 * @package   local_myhobbies
 */

namespace local_myhobbies\output;

use renderer_base;
use stdClass;
use function array_values;

defined('MOODLE_INTERNAL') || die();

class hobbies_list implements \renderable, \templatable {

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
