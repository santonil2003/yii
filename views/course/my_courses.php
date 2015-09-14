<?php
$this->title = 'My Courses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="course-index">

    <?php
    $items = array();
    foreach ($myCourses as $course):
        $item = [
            'label' => $course->code,
            'content' => $this->render('_course_tab', ['course' => $course]),
        ];

        array_push($items, $item);

    endforeach;
    echo yii\bootstrap\Tabs::widget(['items'=>$items]);
    ?>
</div>
