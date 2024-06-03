<?php

namespace App\Http\Responses;

use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Request;

class HtmxResponse extends Response {
    protected array $fragments = [];
    protected array $triggers = [];

    public function addFragment(string $view, string $fragment, array $model = [], bool $include = true) {
        if ($include) {
            $this->fragments[] = view($view, $model)->fragment($fragment);
        }

        return $this;
    }

    public function addFragments(string $view, array $fragments, array $model = [], bool $include = true) {
        if ($include) {
            $this->fragments[] = view($view, $model)->fragments($fragments);
        }

        return $this;
    }

    public function addTrigger(string $name, array $data = null) {
        $this->triggers[$name] = $data;

        return $this;
    }

    public function prepare(Request $request): static
    {
        $this->header('HX-Trigger', json_encode($this->triggers));

        $this->setContent(implode('', $this->fragments));

        return parent::prepare($request);
    }
}