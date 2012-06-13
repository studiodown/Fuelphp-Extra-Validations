<?php

namespace Extra_Validation;

class Validation extends \Fuel\Core\Validation {

    
    public function _validation_text_plain($string) {
        \Config::load('extra_validation');
        if (\FilterSet::instance('text_plain') == NULL) {
            \FilterSet::factory('text_plain')
            ->append('acronym',\Config::get('acronym'))
            ->append('censor',\Config::get('censor'))
            ->append('stripper', \Config::get('stripper.plain'));
        }
    return \FilterSet::instance('text_plain')->process_all($string);
    }

    public function _validation_text_html($string) {
        \Config::load('extra_validation');
        if (\FilterSet::instance('text_html') == NULL) {
            \FilterSet::factory('text_html')->append('acronym',\Config::get('acronym'))->append('censor',\Config::get('censor'))->append('stripper', \Config::get('stripper.html'));
        }
        return \FilterSet::instance('text_html')->process_all($string);
    }
    
    public function _validation_db_unique($val, $options) {
        list($table, $field) = explode('.', $options);
        $result = \DB::select("LOWER (\"$field\")")
            ->where($field, '=', \Str::lower($val))
            ->from($table)->execute();
        return ! ($result->count() > 0);
    }
    
    public function _validation_db_exists($val, $options) {
        if(is_null($val)) {
           return true;
        }elseif (is_array($val) && count($val) > 0){
            return true;
        }elseif (is_array($val)){
            foreach($val as $v){
                $val_array[] = \Str::lower($v);
            }
        }else{
            $val_array[] = \Str::lower($val);
        }
        list($table, $field) = explode('.', $options);
        $result = \DB::select("LOWER (\"$field\")")
        ->where($field, 'IN', $val_array)
        ->from($table)->execute();
        return ($result->count() > 0);
    }

    public function _validation_related_model($val, $options = FALSE){
        if ($options) {
            if( strpos($options,'.') != FALSE){
                list ($model, $field) = explode('.', $options);
            }else{
                $model = $options;
                $field = 'id';
            }
            
            $model = '\Model_' . \Inflector::words_to_upper($model);
            if (!is_array($val)) {
                if(empty($val)){
                    $val = array();
                }else{
                    $val = array($val);
                }
            }
            $return = array();
            foreach ($val as $v) {
                $return[] = $model::find()->where($field,$v)->get_one();
            }
            return $return;
        }
        return FALSE;
    }
    
    public function _validation_datetime_timestamp($val, $options = 'Y-m-d') {
        try {
            $dateTime = \DateTime::createFromFormat($options, $val);
            if(is_object($dateTime)){
                return $dateTime->format('U');
            }else{
                return FALSE;
            }
        }
        catch (Exception $e) {
            return FALSE;
        }
    }
    
}
