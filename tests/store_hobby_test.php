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
 * Tests functionality of methods in \local_myhobbies\store\hobby.php
 *
 * @package   local_myhobbies
 */

use local_myhobbies\store\hobby;

defined('MOODLE_INTERNAL') || die();

/**
 * @group     local_myhobbies
 */
class local_hobbies_store_hobby_testcase extends advanced_testcase {

    /**
     * @var local_myhobbies\store\hobby
     */
    protected $store;
    /**
     * @var array
     */
    protected $users;

    protected function tearDown() {

        $this->store = null;
        $this->users = null;

        parent::tearDown();
    }

    /**
     * Test set up.
     */
    protected function setUp() {
        global $DB;

        $this->store = new hobby();

        $this->users = array();

        // Create two users.
        for ($i = 0; $i <= 1; $i++) {
            $this->users[$i] = self::getDataGenerator()->create_user();
            // Each user has 3 existing hobbies.
            $this->users[$i]->hobbies = array();
            for ($j = 0; $j <= 2; $j++) {
                $id = $DB->insert_record('local_myhobbies',
                    (object) array(
                        'userid'        => $this->users[$i]->id,
                        'title'         => 'Test title ' . ($i * $j),
                        'description'   => 'Test description ' . ($i * $j),
                        'timecreated'   => time(),
                        'timeupdated'   => time()
                    )
                );
                $this->users[$i]->hobbies[$j] = $DB->get_record('local_myhobbies', array('id' => $id));
            }
        }
    }

    public function test_save() {
        global $DB;

        // TODO.
    }

    public function test_get() {
        global $DB;

        // TODO.
    }

    public function test_get_all() {
        global $DB;

        // TODO.
    }

    public function test_delete() {
        global $DB;

        // TODO.
    }
}