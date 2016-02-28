<?php

namespace Longkyanh\Mailer;

use Illuminate\Support\Facades\Facade;

/**
 * @author Long Nguyen <nguyentienlong88@gmail.com>
 */
class OptivoMailer extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'optivo';
    }
}
