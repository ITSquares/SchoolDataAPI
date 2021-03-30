<?php

namespace school;

use school\data\SchoolData;
use school\meal\SchoolMealData;

final class SchoolExample{

    public function __construct() {
        $schoolData = new SchoolData("서울아이티고등학교");
        echo "학교 코드: " . $schoolData->getSchoolCode();

        $schoolMeal = new SchoolMealData("서울아이티고등학교", "점심");
        echo "학교 점심: " . $schoolMeal->getSchoolMeals(true);
    }
}