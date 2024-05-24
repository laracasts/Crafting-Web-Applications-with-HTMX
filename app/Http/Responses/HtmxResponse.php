<?php

namespace App\Http\Responses;

use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Request;

class HtmxResponse extends Response {
    protected array $fragments = [];

    public function addFragment(string $view, string $fragment, array $model = [], bool $include = true) {
        if ($include) {
            $this->fragments[] = view($view, $model)->fragment($fragment);
        }

        return $this;
    }

    public function prepare(Request $request): static
    {
        $this->setContent(implode('', $this->fragments));

        return parent::prepare($request);
    }
}