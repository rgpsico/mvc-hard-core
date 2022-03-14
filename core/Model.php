<?php

namespace app\core;

abstract class Model
{
    public const RULE_REQUIRED = 'required';
    public const RULE_EMAIL = 'email';
    public const RULE_MIN = 'min';
    public const RULE_MAX = 'max';
    public const RULE_MATCH = 'match';
    public const RULE_UNIQUE = 'unique';

    public function loadData($data)
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }

    abstract public function rules(): array;

    public function labels(): array
    {
        return [];
    }


    public function getLabels($atribbute)
    {
        return $this->labels()[$atribbute] ?? $atribbute;
    }

    public array $errors = [];


    public function validate()
    {

        foreach ($this->rules() as $atribbute => $rules) {

            $value = $this->{$atribbute};
            foreach ($rules as $rule) {

                $ruleName = $rule;

                if (!is_string($ruleName)) {
                    $ruleName = $rule[0];
                }

                if ($ruleName === self::RULE_REQUIRED && !$value) {
                    $this->addErrorForRule($atribbute, self::RULE_REQUIRED);
                }

                if ($ruleName === self::RULE_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->addErrorForRule($atribbute, self::RULE_EMAIL);
                }

                if ($ruleName === self::RULE_MIN && strlen($value) < $rule['min']) {
                    $this->addErrorForRule($atribbute, self::RULE_MIN, $rule);
                }

                if ($ruleName === self::RULE_MAX && strlen($value) > $rule['max']) {
                    $this->addErrorForRule($atribbute, self::RULE_MAX, $rule);
                }

                if ($ruleName === self::RULE_MATCH && $value !== $this->{$rule['match']}) {
                    $rule['match'] = $this->getLabels($rule['match']);
                    $this->addErrorForRule($atribbute, self::RULE_MATCH, $rule);
                }

                if ($ruleName === self::RULE_UNIQUE) {
                    $className = $rule['class'];
                    $uniqueAttr = $rule['attribute'] ?? $atribbute;
                    $tableName =  $className::tableName();
                    $statement = Application::$app->db->prepare("SELECT * FROM $tableName WHERE $uniqueAttr = :attr");
                    $statement->bindValue(":attr", $value);
                    $statement->execute();

                    $record = $statement->fetchObject();

                    if ($record) {
                        $this->addErrorForRule($atribbute, self::RULE_UNIQUE, $rule, ['field' => $this->getLabels($atribbute)]);
                    }
                }
            }
        }

        return empty($this->errors);
    }

    private function addErrorForRule($atribbute, $rule, $params = [])
    {
        $message = $this->errorMessages()[$rule] ?? '';
        foreach ($params as $key => $value) {
            $message  = str_replace("{{$key}}", $value, $message);
        }
        $this->errors[$atribbute][] = $message;
    }

    public function addError($atribbute, $message)
    {
        $this->errors[$atribbute][] = $message;
    }

    public function errorMessages()
    {
        return [
            self::RULE_REQUIRED => 'This field is required',
            self::RULE_EMAIL => 'email invalid',
            self::RULE_MIN => 'the minim digits is {min}',
            self::RULE_MAX => 'the max digits is {max} ',
            self::RULE_MATCH => 'This field must be the same as {match}',
            self::RULE_UNIQUE => "Record with this {field} already exists",

        ];
    }

    public function hasError($atribbute)
    {
        return $this->errors[$atribbute] ?? false;
    }

    public function getFirstError($atribbute)
    {
        return $this->errors[$atribbute][0] ?? false;
    }
}
