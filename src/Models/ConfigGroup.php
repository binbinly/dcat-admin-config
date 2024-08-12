<?php

namespace AdminExtConfig\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\Model;
use Dcat\Admin\Traits\ModelTree;

class ConfigGroup extends Model
{
    use HasDateTimeFormatter;
    use ModelTree;

    protected $table = 'admin_config_group';

    protected string $titleColumn = 'name';

    protected string $parentColumn = 'pid';

    protected string $orderColumn = 'id';

    public function fields()
    {
        return $this->hasMany(Config::class, 'group_id');
    }
}
