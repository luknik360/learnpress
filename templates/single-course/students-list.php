<?php
/**
 * Template for displaying the students of a course
 *
 * @author  ThimPress
 * @package LearnPress/Templates
 * @version 1.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

global $course;

$students_list_heading = apply_filters('learn_press_students_list_heading', __('Students Enrolled', 'leanpress'));
$student_limit = apply_filters('learn_press_students_list_limit', -1);
$show_avatar = apply_filters('learn_press_students_list_avatar', true);
$students_list_avatar_size = apply_filters('learn_press_students_list_avatar_size', 32);
?>
<?php do_action('learn_press_before_student-list') ?>
    <div class="course-students-list">
        <?php if ($students_list_heading): ?>
            <h3 class="students-list-title"><?php echo $students_list_heading ?></h3>
        <?php endif; ?>


        <?php if ($students = $course->get_students_list(true, $student_limit)): ?>
            <ul class="students">
                <?php foreach ($students as $student): ?>
                    <li>
                        <?php if ($show_avatar): ?>
                            <?php echo get_avatar(
                                $student->user_id,
                                $students_list_avatar_size,
                                'Mystery Man',
                                $student->display_name,
                                array(
                                    'class' => 'students_list_avatar'
                                )
                            ); ?>
                        <? endif; ?>
                        <a
                            class="name"
                            href="<?php echo learn_press_user_profile_link($student->user_id) ?>"
                            title="<?php echo $student->display_name . ' profile' ?>"
                        >
                            <?php echo $student->display_name ?>
                        </a>
                    </li>
                <? endforeach; ?>
            </ul>
        <?php else: ?>
            <div class="students empty">
                <?php echo apply_filters('learn_press_course_no_student', __('No student enrolled.', 'learnpress')) ?>
            </div>
        <?php endif; ?>
    </div>
<?php do_action('learn_press_after_student-list') ?>