<?php

namespace App\Helpers;

class HtmxHelper {
    public static function isHtmxRequest(): bool {
        return request()->hasHeader('HX-Request');
    }

    public static function isCurrentUrl(string $url): bool {
        // TODO: normalize the URLs
        return request()->header('HX-Current-URL') == $url;
    }
}