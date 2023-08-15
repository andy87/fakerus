<?php

/**
 * ФэйкДата
 * 
 * FakeData::getName(FakeData::GENDER_MAN) => Андрей
 * 
 * FakeData::getLastName(FakeData::GENDER_WOMAN) => Берёзкинa
 * 
 * FakeData::getSecondName(FakeData::GENDER_MAN) => Трофимович
 * 
 * FakeData::getFullName(FakeData::GENDER_WOMAN) => Кулаковa Валентина Валентиновна
 * 
 * FakeData::getShortName(FakeData::GENDER_MAN) => Мамкин Юрий
 *
 * FakeData::getBirthday() => 04.12.1944
 * 
 * FakeData::getCity() => Омск
 * 
 * FakeData::getAddress() => 482317, Новоросийск, ул. Миронова, д.43, кв. 185
 * 
 */
class Fakerus
{
    public const GENDER_MAN = 1;
    public const GENDER_WOMAN = 2;


    private const LAST_NAME = 1;

    private const NAME = 2;
    private const CITY = 3;
    private const STREET = 4;


    private static array $list = [
        self::NAME => [
            self::GENDER_MAN => [
                'Андрей',
                'Евгений',
                'Генадий',
                'Евгений',
                'Аркадий',
                'Николай',
                'Юрий',
                'Трофим',
                'Алекстандр',
                'Кирил',
                'Михаил',
                'Максим',
                'Валентин',
                'Тимофей',
                'Дмитрий',
                'Антон',
                'Олег',
            ],
            self::GENDER_WOMAN => [
                'Алёна',
                'Максим',
                'Екатерина',
                'Валентина',
                'Мария',
                'Марина',
                'Анна',
                'Милена',
                'Ирина',
                'Кристина',
                'Юлия',
                'Евгения',
                'Светлана',
                'Лидия',
                'Марина',
            ],
        ],
        self::LAST_NAME => [
            'Пирожков',
            'Мясков',
            'Жоров',
            'Кулаков',
            'Мамкин',
            'Баринов',
            'Блинов',
            'Ёлочкин',
            'Берёзкин',
            'Побегов',
            'Бестыжников',
            'Бестыжников',
            'Бодберёзов',
            'Лежебоков',
            'Лужков',
        ],
        self::CITY => [
            'Москва',
            'Питер',
            'Саратов',
            'Сызрань',
            'Камышов',
            'Воронеж',
            'Новоросийск',
            'Владивосток',
            'Омск',
        ],
        self::STREET => [
            'ул. Главная',
            'пр-и Маршала Жукова',
            'ул. Миронова',
            'Бульвар Ушакова',
            'Перулок Киндзаза',
            'ул. Парковая 2я',
            'ул. Задняя',
            'ул. Старая',
            'ул. Левосторонняя',
        ]
    ];

    /**
     * @param int $gender
     *
     * @return string
     */
    public static function getName( int $gender ): string
    {
        $library = self::$list[self::NAME][$gender];

        return $library[array_rand($library)];
    }

    /**
     * @param int $gender
     *
     * @return string
     */
    public static function getLastName( int $gender ): string
    {
        $library = self::$list[self::LAST_NAME];

        return ( $library[array_rand($library)] . (($gender === self::GENDER_WOMAN) ? 'a' : '') );
    }

    /**
     * @param int $gender
     *
     * @return string
     */
    public static function getSecondName( int $gender ): string
    {
        $library = self::$list[self::NAME][self::GENDER_MAN];

        $second_name = $library[array_rand($library)];

        $is_prepare = str_ends_with($second_name, 'й');

        $suffix = ( $is_prepare )
            ? ( ($gender == self::GENDER_MAN ) ? 'евич' : 'eвна' )
            : ( ($gender == self::GENDER_MAN ) ? 'ович' : 'овна' );

        if ($is_prepare) $second_name = str_replace('й','', $second_name);

        return ( $second_name . $suffix );
    }

    /**
     * @param int $gender
     *
     * @return string
     */
    public static function getFullName( int $gender ): string
    {
        return sprintf(
            '%s %s %s',
            self::getLastName($gender),
            self::getName($gender),
            self::getSecondName($gender)
        );
    }

    /**
     * @param int $gender
     *
     * @return string
     */
    public static function getShortName( int $gender ): string
    {
        return sprintf(
            '%s %s',
            self::getLastName($gender),
            self::getName($gender),
        );
    }

    /**
     * @return string
     */
    public static function getCity(): string
    {
        $library = self::$list[self::CITY];

        return $library[array_rand($library)];
    }

    /**
     * @return string
     */
    public static function getAddress(): string
    {
        $library = self::$list[self::STREET];

        return sprintf(
            '%s, %s, %s, д.%d, кв. %d',
            ( rand(11,670) . rand(110,670) ), // Индеккс
            self::getCity(), // Город
            $library[array_rand($library)], // Улица
            rand(1,125), // Дом
            rand(1,300) // Квартира
        );
    }

    /**
     * @param string $format
     * @param int $min
     * @param int $max
     *
     * @return string
     */
    public static function getBirthday(string $format = 'd.m.Y', int $min = 6, int $max = 90): string
    {
        $year = rand($min, $max);

        $date = new DateTime();
        $date->modify("-$year year");

        $days = rand(1,360);
        $date->modify("+$days day");

        return $date->format($format);
    }


    /**
     * Fix `PhpStorm`: Unused element: '***'
     *
     *
     * @return array
     */
    public function __actions(): array
    {
        return [
            self::getFullName(self::GENDER_MAN),
            self::getShortName(self::GENDER_WOMAN),
            self::getAddress(),
            self::getBirthday()
        ];
    }
}
