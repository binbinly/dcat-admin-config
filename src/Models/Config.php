<?php

namespace AdminExtConfig\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    const FIELD_TYPE_TEXT = 1;
    const FIELD_TYPE_SWITCH = 2;

    use HasDateTimeFormatter;

    protected $table = 'admin_config';

    public static array $fieldTypes = [
        self::FIELD_TYPE_TEXT => 'text',
        self::FIELD_TYPE_SWITCH => 'switch'
    ];

    public static array $fieldNames = [
        self::FIELD_TYPE_TEXT => '文本框',
        self::FIELD_TYPE_SWITCH => '开关'
    ];

    public function value()
    {
        return $this->hasOne(ConfigValue::class, 'key', 'key');
    }
}
