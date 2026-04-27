<?php
class CalculatorForm extends CFormModel
{
    public $area;         // Площадь
    public $material;     // Материал
    public $color;        // Цвет
    public $texture;      // Фактура
    public $angles;       // Углов
    public $lamps;        // Светильники
    public $pipe;         // Труба
    public $curtains;     // Гардин
    public $niche_open;   // Ниша открытая
    public $niche_closed; // Ниша закрытая

    const MATERIAL_CLASSIC   = 1; // msd classic
    const MATERIAL_PREMIUM   = 2; // msd premium
    const MATERIAL_EVOLUTION = 3; // msd evolution
    const MATERIAL_DESCOR    = 4; // Тканевый Descor

    const COLOR_WHITE = 1; // Белый
    const COLOR_COLOR = 2; // Цветной

    const TEXTURE_MAT   = 1; // Мат
    const TEXTURE_GLOSS = 2; // Глянец
    const TEXTURE_SATIN = 3; // Сатин


    public function rules()
    {
        return [
            ['area,material', 'required'],
            ['area,angles,lamps,pipe,curtains,niche_open,niche_closed', 'numerical'],
            ['area,material,color,texture,angles,lamps,pipe,curtains,niche_open,niche_closed', 'safe']
        ];
    }

    public function attributeLabels()
    {
        return [
            'area'         => 'Площадь потолка (м2)',
            'material'     => 'Материал',
            'color'        => 'Цвет',
            'texture'      => 'Фактура',
            'angles'       => 'Кол-во углов (шт.)',
            'lamps'        => 'Кол-во светильников (шт.)',
            'pipe'         => 'Кол-во труб (шт.)',
            'curtains'     => 'Закладная под гардину (м.п)',
            'niche_open'   => 'Ниша открытая (м.п)',
            'niche_closed' => 'Ниша закрытая (м.п)',
        ];
    }

    public function getNestedFields()
    {
        return [
            self::MATERIAL_CLASSIC   => [
                'value' => 'Msd classic',
                'items' => [
                    self::COLOR_WHITE => [
                        'value' => "Белый",
                        'items' => [
                            self::TEXTURE_MAT   => ['value' => 'Мат'],
                            self::TEXTURE_GLOSS => ['value' => 'Глянец'],
                            self::TEXTURE_SATIN => ['value' => 'Сатин'],
                        ],
                    ],
                    self::COLOR_COLOR => [
                        'value' => "Цветной",
                        'items' => [
                            self::TEXTURE_MAT   => ['value' => 'Мат'],
                            self::TEXTURE_GLOSS => ['value' => 'Глянец'],
                            self::TEXTURE_SATIN => ['value' => 'Сатин'],
                        ],
                    ],
                ],
            ],
            self::MATERIAL_PREMIUM   => [
                'value' => 'Msd premium',
                'items' => [
                    self::COLOR_WHITE => [
                        'value' => "Белый",
                        'items' => [
                            self::TEXTURE_MAT   => ['value' => 'Мат'],
                            self::TEXTURE_GLOSS => ['value' => 'Глянец'],
                            self::TEXTURE_SATIN => ['value' => 'Сатин'],
                        ],
                    ],
                    self::COLOR_COLOR => [
                        'value' => "Цветной",
                        'items' => [
                            self::TEXTURE_MAT   => ['value' => 'Мат'],
                            self::TEXTURE_GLOSS => ['value' => 'Глянец'],
                            self::TEXTURE_SATIN => ['value' => 'Сатин'],
                        ],
                    ],
                ],
            ],
            self::MATERIAL_EVOLUTION => [
                'value' => 'Msd evolution',
                'items' => [
                    self::COLOR_WHITE => [
                        'value' => "Белый",
                        'items' => [
                            self::TEXTURE_MAT   => ['value' => 'Мат'],
                            self::TEXTURE_GLOSS => ['value' => 'Глянец'],
                            self::TEXTURE_SATIN => ['value' => 'Сатин'],
                        ],
                    ],
                ],
            ],
            self::MATERIAL_DESCOR    => [
                'value' => 'Тканевый Descor',
            ],
        ];
    }

    public function getMaterialList()
    {
        $sourceData = $this->getNestedFields();
        $data = [];
        foreach ($sourceData as $key => $item) {
            $data[$key] = $item['value'];
        }

        return $data;
    }

    public function getColorList()
    {
        $sourceData = $this->getNestedFields();
        $sourceData = isset($sourceData[$this->material]) ? $sourceData[$this->material] : [];

        $data = [];
        if (isset($sourceData['items'])) {
            foreach ($sourceData['items'] as $key => $item) {
                $data[$key] = $item['value'];
            }
        }

        return $data;
    }

    public function getTextureList()
    {
        $sourceData = $this->getNestedFields();
        $sourceData = isset($sourceData[$this->material]) ? $sourceData[$this->material] : [];
        $sourceData = isset($sourceData['items'][$this->color]) ? $sourceData['items'][$this->color] : [];

        $data = [];
        if (isset($sourceData['items'])) {
            foreach ($sourceData['items'] as $key => $item) {
                $data[$key] = $item['value'];
            }
        }

        return $data;
    }

    /**
     * Рассчетная таблица
     * @return array
     */
    public function getCheckingTable($path = null)
    {
        $data = [
            'area' => [
                [
                    self::MATERIAL_CLASSIC   => [
                        self::COLOR_WHITE => [
                            self::TEXTURE_MAT   => 230,
                            self::TEXTURE_GLOSS => 240,
                            self::TEXTURE_SATIN => 250,
                        ],
                        self::COLOR_COLOR => [
                            self::TEXTURE_MAT   => 270,
                            self::TEXTURE_GLOSS => 280,
                            self::TEXTURE_SATIN => 290,
                        ],
                    ],
                    self::MATERIAL_PREMIUM   => [
                        self::COLOR_WHITE => [
                            self::TEXTURE_MAT   => 280,
                            self::TEXTURE_GLOSS => 290,
                            self::TEXTURE_SATIN => 300,
                        ],
                        self::COLOR_COLOR => [
                            self::TEXTURE_MAT   => 360,
                            self::TEXTURE_GLOSS => 370,
                            self::TEXTURE_SATIN => 380,
                        ],
                    ],
                    self::MATERIAL_EVOLUTION => [
                        self::COLOR_WHITE => [
                            self::TEXTURE_MAT   => 330,
                            self::TEXTURE_GLOSS => 340,
                            self::TEXTURE_SATIN => 350,
                        ],
                    ],
                ],
                [
                    self::MATERIAL_CLASSIC   => [
                        self::COLOR_WHITE => [
                            self::TEXTURE_MAT   => 340,
                            self::TEXTURE_GLOSS => 350,
                            self::TEXTURE_SATIN => 360,
                        ],
                        self::COLOR_COLOR => [
                            self::TEXTURE_MAT   => 430,
                            self::TEXTURE_GLOSS => 440,
                            self::TEXTURE_SATIN => 450,
                        ],
                    ],
                    self::MATERIAL_PREMIUM   => [
                        self::COLOR_WHITE => [
                            self::TEXTURE_MAT   => 380,
                            self::TEXTURE_GLOSS => 390,
                            self::TEXTURE_SATIN => 400,
                        ],
                        self::COLOR_COLOR => [
                            self::TEXTURE_MAT   => 480,
                            self::TEXTURE_GLOSS => 490,
                            self::TEXTURE_SATIN => 500,
                        ],
                    ],
                    self::MATERIAL_EVOLUTION => [
                        self::COLOR_WHITE => [
                            self::TEXTURE_MAT   => 420,
                            self::TEXTURE_GLOSS => 430,
                            self::TEXTURE_SATIN => 440,
                        ],
                    ],
                ]
            ],
        ];

        if ($path===null) {
            return $data;
        }
        return self::getValue($data, $path);
    }

    public function getMath()
    {
        return [
            'area' => [
                'condition' => [
                    'return ($area <= 3.2);',
                    'return ($area > 3.2);',
                ],
                'action' => 'return $area * $this->getCheckingTable("area.{$conditionResult}.{$material}.{$color}.{$texture}");',
            ],
            'angles' =>  [
                'condition' => 'return ($angles > 4);',
                'action' => 'return ($angles) ? ($angles - 4) * 200 : 0;'
            ],
            'lamps' =>  [
                'action' => 'return ($lamps) ? $lamps * 300 : 0;'
            ],
            'pipe' =>  [
                'action' => 'return ($pipe) ? $pipe * 300 : 0;'
            ],
            'curtains' =>  [
                'action' => 'return ($curtains) ? $curtains * 300 : 0;'
            ],
            'niche_open' =>  [
                'action' => 'return ($niche_open) ? $niche_open * 300 : 0;'
            ],
            'niche_closed' =>  [
                'action' => 'return ($niche_closed) ? $niche_closed * 700 : 0;'
            ],
        ];
    }

    public function calculate($condition, $attributes)
    {
        extract($attributes);
        $number = 0;
        $conditionResult = null;

        if (isset($condition['condition']) && is_array($condition['condition'])) {
            foreach ($condition['condition'] as $key => $value) {
                if (eval($value)) {
                    $conditionResult = $key;
                }
            }
        }

        if (isset($condition['action'])) {
            if (isset($condition['condition']) && is_string($condition['condition'])) {
                if (eval($condition['condition'])) {
                    $number = eval($condition['action']);
                }
            } else {
                $number = eval($condition['action']);
            }
        }

        return $number;
    }

    public function getCost()
    {
        $cost = 0;
        if ($this->hasErrors()) {
            return $cost;
        }
        foreach ($this->attributes as $attributeName => $attributeValue) {
            $conditions = $this->getMath();
            $condition = isset($conditions[$attributeName]) ? $conditions[$attributeName] : [];
            $attributes = $this->attributes;
            $cost += $this->calculate($condition, $attributes);
        }
        return $cost;
    }

    public static function getValue($array, $key, $default = null)
    {
        if ($key instanceof \Closure) {
            return $key($array, $default);
        }

        if (is_array($key)) {
            $lastKey = array_pop($key);
            foreach ($key as $keyPart) {
                $array = static::getValue($array, $keyPart);
            }
            $key = $lastKey;
        }

        if (is_array($array) && (isset($array[$key]) || array_key_exists($key, $array))) {
            return $array[$key];
        }

        if (($pos = strrpos($key, '.')) !== false) {
            $array = static::getValue($array, substr($key, 0, $pos), $default);
            $key = substr($key, $pos + 1);
        }

        if (is_object($array)) {
            // this is expected to fail if the property does not exist, or __get() is not implemented
            // it is not reliably possible to check whether a property is accessible beforehand
            return $array->$key;
        } elseif (is_array($array)) {
            return (isset($array[$key]) || array_key_exists($key, $array)) ? $array[$key] : $default;
        }

        return $default;
    }
}
