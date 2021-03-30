<?php

namespace school\data;

interface ISchoolData{

    public const DEFAULT_RESULT = "Unknown";

    public const SCHOOL_NAME = "name";

    public const SCHOOL_DIVISION = "estDivision";

    public const SCHOOL_WEBSITE = "website";

    public const SCHOOL_PHONE = "phone";

    public const SCHOOL_ADDRESS = "address";

    public const SCHOOL_TYPE = "estType";

    public const SCHOOL_CODE = "code";

    public const SCHOOL_DATE = "estDate";


    public function getSchoolName(): string;

    public function getSchoolCode(): string;

    public function getSchoolDivision(): string;

    public function getSchoolWebsite(): string;

    public function getSchoolPhone(): string;

    public function getSchoolAddress(): string;

    public function getSchoolType(): string;

    public function getSchoolDate(string $schematic): string;
}