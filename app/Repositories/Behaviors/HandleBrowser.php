<?php

namespace App\Repositories\Behaviors;

trait HandleBrowser
{
  public function updateBelongsTo($object, $fields, $relationship)
  {
    $fieldsHasElements = isset($fields['browsers'][$relationship]) && !empty($fields['browsers'][$relationship]);
    $relatedElement = $fieldsHasElements ? $fields['browsers'][$relationship][0] : null;
    if (!$relatedElement) $object->$relationship()->dissociate();
    else $object->$relationship()->associate($relatedElement['id']);
    $object->save();
  }
}
