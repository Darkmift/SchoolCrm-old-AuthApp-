
select *
from courses
	inner join enrollments on courses.id = enrollments.course_id
	inner join students on students.id = enrollments.student_id
	inner join users c_user on courses.user_id = c_user.id
	inner join users s_user on students.user_id = s_user.id
	inner join users e_user on enrollments.user_id = e_user.id
where students.is_active = 1 and courses.is_active = 1;

ALTER TABLE `blog` CHANGE COLUMN `read-more` `read_more` VARCHAR
(255) NOT NULL;

ALTER TABLE courses DROP COLUMN `added_by`;
ALTER TABLE tbl_Country DROP COLUMN IsDeleted;

ALTER TABLE courses
ADD user_id int(11);

ALTER TABLE users
ADD user_id int(11);

ALTER TABLE students
ADD user_id int(11);

UPDATE `courses`
SET
`user_id` = 1;
UPDATE `users`
SET
`user_id` = 1;
UPDATE `students`
SET
`user_id` = 1;


select enrollments.id, courses.name, students.name
from courses
	inner join enrollments on courses.id = enrollments.course_id
	inner join students on students.id = enrollments.student_id
	inner join users c_user on courses.user_id = c_user.id
	inner join users s_user on students.user_id = s_user.id
	inner join users e_user on enrollments.user_id = e_user.id
where students.active = 1 and courses.active = 1;

show enrolled for student id
select enrollments.id, courses.name, students.name
from courses
	inner join enrollments on courses.id = enrollments.course_id
	inner join students on students.id = enrollments.student_id
	inner join users c_user on courses.user_id = c_user.id
	inner join users s_user on students.user_id = s_user.id
	inner join users e_user on enrollments.user_id = e_user.id
where students.active = 1 and courses.active = 1 and students.id=2;

show enrolled for course id
select enrollments.id, courses.name, students.name
from courses
	inner join enrollments on courses.id = enrollments.course_id
	inner join students on students.id = enrollments.student_id
	inner join users c_user on courses.user_id = c_user.id
	inner join users s_user on students.user_id = s_user.id
	inner join users e_user on enrollments.user_id = e_user.id
where students.active = 1 and courses.active = 1 and courses.id=2;

show enrollments by user id
select enrollments.id, courses.name, students.name
from courses
	inner join enrollments on courses.id = enrollments.course_id
	inner join students on students.id = enrollments.student_id
	inner join users c_user on courses.user_id = c_user.id
	inner join users s_user on students.user_id = s_user.id
	inner join users e_user on enrollments.user_id = e_user.id
where students.active = 1 and courses.active = 1 and c_user.id=1;






select concat('[',
group_concat(concat(
	'{
"id": "',
enrollments.id,
'", "courseName": "',
courses.name,
'", "studentName": "',
students.name,
'"}'
) separator
','),
']')
FROM courses
        INNER JOIN enrollments ON courses.id = enrollments.course_id
                    INNER JOIN students ON students.id = enrollments.student_id
                    INNER JOIN users c_user ON
                        courses.user_id = c_user.id
                    INNER JOIN users s_user ON
                        students.user_id = s_user.id
                    INNER JOIN users e_user ON
                        enrollments.user_id = e_user.id
                    WHERE
                        students.active = 1 AND courses.active = 1 AND students.id = 1
