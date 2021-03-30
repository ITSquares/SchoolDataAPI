# SchoolDataAPI
> 학교 모든 정보를 불러올 수 있습니다. `학교 급식`, `학교 데이터` 를 쉽게 출력할 수 있습니다.

<br>

# 👨‍💻 Contributors
> [송기호(GodVas)](https://github.com/GodVas)

<br>

# 💬 소스 분석 
## 학교 데이터 (SchoolData)
- 학교 데이터 정보 확인을 위해 아래와 같은 변수를 선언해주세요.
```php
$schoolData = new SchoolData("학교 이름");
```

<br>

- 학교 코드를 불러올 수 있습니다.
```php
$schoolData->getSchoolCode();
```

<br>

- 학교 정보를 불러올 수 있습니다. `사립`, `공립`
```php
$schoolData->getSchoolDivision();
```

<br>

- 학교 웹사이트 정보를 불러올 수 있습니다.
```php
$schoolData->getSchoolWebsite();
```

<br>

- 학교 설립일을 원하는 문자열로 불러올 수 있습니다.
```php
$schoolData->getSchoolDate("y-m-d"); //result: 1999-01-01
$schoolData->getSchoolDate("d-m-y"); //result: 01-01-1999
```

<br>

- 학교 전화번호를 불러올 수 있습니다.
```php
$schoolData->getSchoolPhone();
```

<br>

## 학교 급식 (SchoolMeal)
- 학교 급식 확인을 위해 아래와 같은 변수를 선언해주세요.
```php
$schoolMeal = new SchoolMealData("학교 이름", "아침 or 점심 or 저녁", 년, 월, 일);
```
- 아침, 점심, 저녁은 자동으로 breakfast, lunch, dinner로 변환됩니다.
- 학교 이름에서 초등학교, 중학교, 고등학교가 검사되면 자동으로 학교 타입을 변환해줍니다.
- 날짜를 비워두면 현재 날짜로 검색합니다.

<br>

- 학교 급식을 불러올 수 있습니다.
```php
$schoolMeal->getSchoolMeals(bool $hideNutrition);
```
- $hideNutrition은 영양정보 표시 여부 입니다. false로 하면 음식 영양 정보 번호도 같이 표기되며, true로 허용시 영양 정보 번호를 표기하지 않습니다.

<br>

# 😄 만들게 된 계기
> PHP 언어로 간단하게 학교 정보를 표시할 수 있으면 좋을것 같아서 제작하게 되었습니다.

<br>

# ⚡ 만든 소감
> 다른 개발자들이 이 소스를 사용할때 쉽고 빠르게 접근이 가능할것 같아서 뿌듯합니다.
