<?php

namespace school\data;

use school\exception\SchoolDataPassingException;

final class SchoolData implements ISchoolData{

    private string $name;

    private bool $connection = true;

    private array $schoolData = [];

    public function __construct(string $name) {
        $this->name = $name;

        $schoolData = json_decode(file_get_contents("https://schoolmenukr.ml/code/api?q=" . $this->name), true);
        try {
            if (isset($schoolData["오류"])) {
                throw new SchoolDataPassingException($schoolData["오류"]);
            }

        } catch (\Exception $exception) {
            echo $exception->getMessage();
            $this->connection = false;
        }

        if ($this->connection) {
            foreach ($schoolData as $datum) {
                foreach ($datum as $key => $value)
                    $this->schoolData[$key] = $value;
            }
        }
    }

    /**
     * 학교 이름을 불러올 수 있습니다.
     *
     * @return string
     */
    public function getSchoolName(): string{
        return $this->name;
    }

    /**
     * 학교 코드를 불러올 수 있습니다.
     *
     * @return string
     */
    public function getSchoolCode(): string{
        return $this->schoolData[self::SCHOOL_CODE] ?? self::DEFAULT_RESULT;
    }

    /**
     * 학교 정보를 불러올 수 있습니다.
     * ex) 사립, 공립
     *
     * @return string
     */
    public function getSchoolDivision(): string{
        return $this->schoolData[self::SCHOOL_DIVISION] ?? self::DEFAULT_RESULT;
    }

    /**
     * 학교 웹사이트 주소를 불러올 수 있습니다.
     *
     * @return string
     */
    public function getSchoolWebsite(): string{
        return $this->schoolData[self::SCHOOL_WEBSITE] ?? self::DEFAULT_RESULT;
    }

    /**
     * 학교 위치 주소를 불러올 수 있습니다.
     *
     * @return string
     */
    public function getSchoolAddress(): string{
        return $this->schoolData[self::SCHOOL_ADDRESS] ?? self::DEFAULT_RESULT;
    }

    /**
     * 학교 정보를 불러올 수 있습니다.
     * ex) 단설
     *
     * @return string
     */
    public function getSchoolType(): string{
        return $this->schoolData[self::SCHOOL_TYPE] ?? self::DEFAULT_RESULT;
    }

    /**
     * 학교 전화번호를 불러올 수 있습니다.
     *
     * @return string
     */
    public function getSchoolPhone(): string{
        return $this->schoolData[self::SCHOOL_PHONE] ?? self::DEFAULT_RESULT;
    }

    /**
     * 스케마틱 변수로 원하는 문자열로 학교 설립일자를 불러올 수 있습니다.
     * ex) $schematic => "y-m-d" -> $result => "1999-01-01"
     *
     * @param string $schematic
     * @return string
     */
    public function getSchoolDate(string $schematic): string{
        $date = $this->schoolData[self::SCHOOL_DATE];
        $result = self::DEFAULT_RESULT;
        if (is_array($date)) {
            $result = $schematic;
            foreach ($date as $dateSplit => $value)
                $result = str_replace($dateSplit, $value, $result);
        }

        return $result;
    }
}