<?php

namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\Validator;

class Todo extends Eloquent
{
    // Laravel auto update timestamp feature.
    public $timestamps = true;

    // Set database for this model.
    protected $table = 'todos';

    // Set primary key.
    protected $primaryKey = 'id';

    // Set fillable fields.
    protected $fillable = ['todo'];

    // Set validator.
    private $validator = null;

    // Validation rules.
    private $rules
        = [
            'todo' => 'required',
        ];

    // Set hidden fields.
    protected $hidden
        = [
            'deleted_at',
        ];

    /**
     * This will strip out "required" rule from each validation rule.
     * This means a field is not supposed to be required when validating data.
     *
     * @return array
     */
    public function noRequiredValidationRules()
    {
        $newRules = array();

        // Let's get each validation rule.
        foreach ($this->rules as $key => $value) {

            if (is_array($value)) {

                $value = array_filter($value, function ($val) {

                    if (is_string($val) AND $val == 'required') {

                        return false;
                    }

                    return true;
                });
            } else {

                // Let's replace some required strings here.
                $value = str_replace('required|', '', $value);
                $value = str_replace('required', '', $value);
            }

            // Set new validation rule.
            $newRules[$key] = $value;
        }

        $this->rules = $newRules;

        return $this->rules;
    }

    /**
     * This will allow you to customize or update the $rules
     * on the fly before validating a data.
     *
     * @param $field
     * @param $rule
     */
    public function setValidationRule($field, $rule)
    {
        $this->rules[$field] = $rule;
    }

    /**
     * Remove validation rule for a given field.
     *
     * @param $field
     */
    public function removeValidationRule($field)
    {
        if (isset($this->rules[$field])) {

            unset($this->rules[$field]);
        }
    }

    /**
     * This will validate $data.
     *
     * @param array $data
     *
     * @return bool
     */
    public function valid($data = array())
    {
        $this->validator = Validator::make($data, $this->rules);

        if ($this->validator->fails()) {

            return false;
        }

        return true;
    }

    /**
     * Get validation errors.
     *
     * @return mixed
     */
    public function errors()
    {
        return $this->validator->messages();
    }

    /**
     * Get validator instance.
     *
     * @return null
     */
    public function validator()
    {
        return $this->validator;
    }
}

#END OF PHP