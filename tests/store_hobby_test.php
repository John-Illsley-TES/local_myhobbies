<?php
/**
 * Tests functionality of methods in \local_myhobbies\store\hobby.php
 *
 * @package   local_hobbies
 * @author    John Illsley 2021
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