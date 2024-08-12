<?php

namespace AdminExtConfig\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\Model;

class ConfigValue extends Model
{
    use HasDateTimeFormatter;

    protected $table = 'admin_config_value';

    public static function saveAll(array $data)
    {
        foreach ($data as $key => $value) {
            self::edit($key, $value);
        }
    }

    public static function edit($key, $value)
    {
        $config = self::query()->where('key', $key)->first();
        if($config) {
            if($config->value == $value) return true;
        } else {
            $config = new self();
            $config->key = $key;
        }
        $config->value = $value;
        return $config->saveOrFail();
    }
}
