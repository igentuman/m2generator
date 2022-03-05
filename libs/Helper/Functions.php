<?php

namespace libs\Helper;

class Functions
{
    public static function get($key,$app)
    {
        if(!isset($app[$key])) {
            return null;
        }
        if(is_array($app[$key])) {
            return $app[$key];
        }

        return preg_replace('/[^A-Za-z\_]/', '', $app[$key]);
    }

    public static function prepareRequestData($request)
    {
        //Fix module name
        $app = self::get('APP',$request);
        $appName = explode('_',get('name',$app));
        if(count($appName) < 2) return false;
        $appNamespace = ucfirst(get(0,$appName));
        $appModule = ucfirst(get(1,$appName));
        if(strlen($appNamespace) < 2 || strlen($appModule) < 2) return false;
        $app['name'] = $appNamespace.'_'.$appModule;
        $request['APP'] = $app;
        $models = (array)get('MODELS',$request);


        foreach ($models as &$model) {
            if(!isset($model['name'])) continue;
            $model['name'] = ucfirst(strtolower(preg_replace('/[^A-Za-z]/', '', (string)get('name',$model))));
            $fields = get('fields',$model);
            foreach ($fields as &$field) {
                if(!isset($field['name'])) continue;
                $field['name'] = strtolower(preg_replace('/[^A-Za-z\_]/', '', (string)get('name',$field)));
                if($field['name'] == 'content' && $field['type'] == 'wysiwyg') {
                    $field['name'] = strtolower($model['name'] . '_' . $field['name']);
                }
            }
            $model['fields'] = $fields;
        }
        array_pop($models);
        array_pop($models);

        $request['MODELS'] = $models;
        return $request;
    }

    public static function getEventList()
    {
        return [
            '',
            'customer_account_login'
        ];
    }
}