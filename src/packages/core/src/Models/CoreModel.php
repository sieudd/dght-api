<?php

namespace GGPHP\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Presentable;
use Prettus\Repository\Traits\PresentableTrait;
use GGPHP\Core\Traits\CastDatetimeFormatTrait;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Traits\CausesActivity;


class CoreModel extends Model implements Presentable
{
    use PresentableTrait, CastDatetimeFormatTrait, LogsActivity, CausesActivity;

    protected static $logFillable = true;
}
