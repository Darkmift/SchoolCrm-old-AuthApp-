-- --------------------------------------------------------

--
-- data for users
--

INSERT INTO `users`(
    `email`,
    `name`,
    `phone`,
    `password`,
    `role`,
    `created_at`,
    `updated_at`,
    `is_active`,
    `user_id`
)
VALUES(
    'test1@ts.ts',
    'Test One User',
    '0505566447',
    '123456789',
    '1',
    CURRENT_TIMESTAMP,
    CURRENT_TIMESTAMP,
    '1',
    '1'
),(
    'test2@ts.ts',
    'Test two User',
    '0505566447',
    '123456789',
    '2',
    CURRENT_TIMESTAMP,
    CURRENT_TIMESTAMP,
    '1',
    '1'
),(
    'test3@ts.ts',
    'Test three User',
    '0505566447',
    '123456789',
    '1',
    CURRENT_TIMESTAMP,
    CURRENT_TIMESTAMP,
    '1',
    '1'
),(
    'test4@ts.ts',
    'Test four User',
    '0505566447',
    '123456789',
    '1',
    CURRENT_TIMESTAMP,
    CURRENT_TIMESTAMP,
    '1',
    '1'
);

-- --------------------------------------------------------

--
-- user data END
-- student data
INSERT INTO `students`(
    `email`,
    `name`,
    `phone`,
    `password`,
    `created_at`,
    `updated_at`,
    `is_active`,
    `user_id`
)
VALUES(
    'test1Student@tst.ts',
    'test one student',
    '0506699887',
    '123456789',
    CURRENT_TIMESTAMP,
    CURRENT_TIMESTAMP,
    '1',
    '1'
),(
    'test2Student@tst.ts',
    'test two student',
    '0506699887',
    '123456789',
    CURRENT_TIMESTAMP,
    CURRENT_TIMESTAMP,
    '1',
    '1'
),(
    'test3Student@tst.ts',
    'test three student',
    '0506699887',
    '123456789',
    CURRENT_TIMESTAMP,
    CURRENT_TIMESTAMP,
    '1',
    '1'
),(
    'test4Student@tst.ts',
    'test four student',
    '0506699887',
    '123456789',
    CURRENT_TIMESTAMP,
    CURRENT_TIMESTAMP,
    '1',
    '1'
);
-- student data END
-- course data
INSERT INTO `courses`(
    `name`,
    `description`,
    `start_date`,
    `end_date`,
    `created_at`,
    `updated_at`,
    `is_active`,
    `user_id`
)
VALUES(
    'Course one test',
    'Course one test description text',
    '2018-04-24',
    '2018-04-30',
    CURRENT_TIMESTAMP,
    CURRENT_TIMESTAMP,
    '1',
    '1'
),(
    'Course two test',
    'Course two test description text',
    '2018-04-24',
    '2018-04-30',
    CURRENT_TIMESTAMP,
    CURRENT_TIMESTAMP,
    '1',
    '1'
),(
    'Course three test',
    'Course three test description text',
    '2018-04-24',
    '2018-04-30',
    CURRENT_TIMESTAMP,
    CURRENT_TIMESTAMP,
    '1',
    '1'
),(
    'Course four test',
    'Course four test description text',
    '2018-04-24',
    '2018-04-30',
    CURRENT_TIMESTAMP,
    CURRENT_TIMESTAMP,
    '1',
    '1'
);

-- INSERT INTO enrollments (students.id, enrollments.student_id,courses.id,enrollments.course_id,users.id,enrollments.user_id,)
-- SELECT students.id, 2 FROM students WHERE students.id = 100,
-- SELECT courses.id, 2 FROM courses WHERE courses.id = 100,
-- SELECT users.id, 2 FROM users WHERE users.id = 100;

-- SELECT enrollments.student_id, students.name
-- FROM enrollments
-- LEFT JOIN enrollments ON enrollments.student_id = students.id
-- ORDER BY students.name;
