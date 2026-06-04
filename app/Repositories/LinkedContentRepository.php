<?php

namespace App\Repositories;

use A17\Twill\Repositories\Behaviors\HandleMedias;
use A17\Twill\Models\Behaviors\HasRelated;
use A17\Twill\Repositories\ModuleRepository;
use App\Models\LinkedContent;
use Illuminate\Support\Arr;

class LinkedContentRepository extends ModuleRepository
{
    use HandleMedias, HasRelated;


    protected $relatedBrowsers = [
        'related_page',
        'related_story',
        'related_notablePerformer',
        'related_genre',
    ];
    public function __construct(LinkedContent $model)
    {
        $this->model = $model;
    }

    function getBrowserFields(): array
    {
        return [
            'related_page',
            'related_story',
            'related_notablePerformer',
            'related_genre',
        ];
    }
    public function prepareFieldsBeforeCreate($fields): array
    {
        $fields = parent::prepareFieldsBeforeCreate($fields);
        $browserFields = $this->getBrowserFields();
        foreach ($browserFields as $browserField) {
            $fields[$browserField . '_id'] = Arr::get($fields, 'browsers.' . $browserField . '.0.id', null);
            $fields[$browserField . '_type'] = Arr::get($fields, 'browsers.' . $browserField . '.0.endpointType', null);
        }

        return $fields;
    }

    // On save we set the linkable id and type.
    public function prepareFieldsBeforeSave($object, $fields): array
    {
        $fields = parent::prepareFieldsBeforeSave($object, $fields);
        $browserFields = $this->getBrowserFields();

        foreach ($browserFields as $browserField) {
            $id = Arr::get($fields, 'browsers.' . $browserField . '.0.id', null);
            $type = Arr::get($fields, 'browsers.' . $browserField . '.0.endpointType', null);
            if ($id) {
                $fields[$browserField . '_id'] = $id;
            }
            if ($type) {
                $fields[$browserField . '_type'] = $type;
            }
        }
        return $fields;
    }

    // Set the browser value to our morphed data.
    public function getFormFields($object): array
    {
        echo "fuck";

        $fields = parent::getFormFields($object);

        $browserFields = $this->getBrowserFields();

        foreach ($browserFields as $browserField) {

            $related_content = $object[$browserField];
            if ($related_content) {
                $title = "No Title";
                if ($related_content->title) {
                    $title = $related_content->title;
                }
                if ($related_content->name) {
                    $title = $related_content->name;
                }

                $fields['browsers'][$browserField] = collect([
                    [
                        'id' => $object[$browserField]->id,
                        'name' => $title,
                        'edit' => moduleRoute($object[$browserField]->getTable(), '', 'edit', $object[$browserField]->id),
                        'endpointType' => $object[$browserField . '_type'],
                        'thumbnail' => $object[$browserField]->defaultCmsImage(['w' => 100, 'h' => 100]),
                    ],
                ])->toArray();
            }

        }

        return $fields;
    }
}
