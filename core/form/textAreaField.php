<?php

namespace app\core\form;

use app\core\Model;

class textAreaField extends BaseField
{

    public function renderInput(): string
    {
        return sprintf(
            '<textarea  name="%s" class="form-control %s">%s</textarea>',
            $this->attribute,
            $this->model->hasError($this->attribute) ? 'is-invalid' : '',
            $this->model->{$this->attribute},

        );
    }
}
