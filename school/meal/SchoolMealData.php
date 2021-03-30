<?php

namespace school\meal;

use school\data\SchoolData;

final class SchoolMealData{

    public const TYPE_ELEMENTARY = "elementary";
    public const TYPE_MIDDLE = "middle";
    public const TYPE_HIGH = "high";
    public const TYPE_HORIZONTAL = [
        "초등학교" => self::TYPE_ELEMENTARY,
        "중학교" => self::TYPE_MIDDLE,
        "고등학교" => self::TYPE_HIGH
    ];

    private string $name;

    private string $searchType;

    private int $year;

    private int $month;

    private int $date;

    private SchoolData $schoolData;

    public function __construct(string $name, string $searchType, ?int $year = null, ?int $month = null, ?int $date = null) {
        $this->name = $name;
        $this->searchType = $searchType;
        $this->year = $year ?? date("Y", time());
        $this->month = $month ?? date("m", time());
        $this->date = $date ?? date("d", time());
        $this->schoolData = new SchoolData($this->name);
    }

    public function getSchoolName(): string{
        return $this->name;
    }

    public function getSchoolType(): string{
        foreach (self::TYPE_HORIZONTAL as $key => $value) {
            if (strpos($this->name, $key) !== false)
                return $value;
        }

        return "Unknown";
    }

    public function toSearchType(string $name): string{
        static $types = [
            "아침" => "breakfast",
            "점심" => "lunch",
            "저녁" => "dinner"
        ];
        return $types[$name] ?? "breakfast";
    }

    private function getVerifyURL(): string{
        return "https://schoolmenukr.ml/api/" . $this->getSchoolType() . "/" . $this->schoolData->getSchoolCode() . "?year=" . $this->year . "&month=" . $this->month . "&date=" . $this->date;
    }

    /**
     * 학교의 원하는 시간대의 학식을 불러올 수 있습니다.
     * 메게변수 hideNutrition 는 영양정보를 숨기거나 그대로 내보낼 수 있습니다.
     *
     * @param bool $hideNutrition
     * @return array
     */
    public function getSchoolMeals(bool $hideNutrition = false): array{
        $json = json_decode(file_get_contents($this->getVerifyURL()), true);
        $menus = [];
        foreach ($json["menu"] as $menu) {
            foreach ($menu as $type => $result)
                if ($this->searchType !== $type)
                    continue;

                $menus[] = $result;
                break;
        }

        //영양 분석을 삭제처리함
        if ($hideNutrition and count($menus) > 0) {
            $menus = array_map(function (string $menu): string{
                return str_replace([range(0, 9), "."], "", $menu);
            }, $menus);
        }

        return $menus;
    }
}