<?php

namespace Voyager\Admin\Formfields;

use Voyager\Admin\Contracts\Formfields\Features;
use Voyager\Admin\Contracts\Formfields\Formfield;

class Password implements Formfield, Features\NotTranslatable, Features\ManipulateData\Store, Features\ManipulateData\Edit, Features\ManipulateData\Update
{
    public function type(): string
    {
        return 'password';
    }

    public function name(): string
    {
        return __('voyager::formfields.password.name');
    }

    public function getComponentName(): string
    {
        return 'formfield-password';
    }

    public function getBuilderComponentName(): string
    {
        return 'formfield-password-builder';
    }

    public function edit($value)
    {
        return null;
    }

    public function update($model, $value, $old)
    {
        if (empty($value)) {
            return $old;
        }

        return $this->store($value);
    }

    public function store($value)
    {
        return bcrypt($value);
    }
}
