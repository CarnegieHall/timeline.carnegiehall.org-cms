@twillRepeaterTitle('Hero Featured Content')
@twillRepeaterIcon('image')
@twillRepeaterTitleField('title', ['hidePrefix' => true])
@twillRepeaterTrigger('Add Featured Content')
@twillRepeaterGroup('app')


<div class="flex-row">
    <div class="flex-col flex-col--full">
        @formField('radios', [
            'label' => 'Link Type',
            'name' => 'destination',
            'inline' => true,
            'options' => [
                [
                    'value' => 'page',
                    'label' => 'Pages',
                ],
                [
                    'value' => 'story',
                    'label' => 'Stories',
                ],
                [
                    'value' => 'genre',
                    'label' => 'Genres',
                ],
                [
                    'value' => 'notablePerformer',
                    'label' => 'Performers',
                ],
                [
                    'value' => 'external',
                    'label' => 'External',
                ],
            ],
        ])
    </div>
    <div class="flex-col">
        <x-formConnectedFields fieldName="destination" fieldValues="page" renderForBlocks="true" keepAlive="false">
            @formField('browser', [
                'label' => 'Linked Page',
                'max' => 1,
                'name' => 'related_page',
                'moduleName' => 'pages',
            ])
        </x-formConnectedFields>

        <x-formConnectedFields fieldName="destination" fieldValues="story" renderForBlocks="true" keepAlive="false">
            @formField('browser', [
                'label' => 'Linked Story',
                'max' => 1,
                'name' => 'related_story',
                'moduleName' => 'stories',
            ])
        </x-formConnectedFields>
        <x-formConnectedFields fieldName="destination" fieldValues="genre" renderForBlocks="true" keepAlive="false">
            @formField('browser', [
                'label' => 'Linked Genre',
                'max' => 1,
                'name' => 'related_genre',
                'moduleName' => 'genres',
            ])
        </x-formConnectedFields>
        <x-formConnectedFields fieldName="destination" fieldValues="notablePerformer" renderForBlocks="true"
            keepAlive="false">
            @formField('browser', [
                'label' => 'Linked Performer',
                'max' => 1,
                'name' => 'related_notablePerformer',
                'moduleName' => 'notablePerformers',
            ])
        </x-formConnectedFields>
        <x-formConnectedFields fieldName="destination" fieldValues="external" renderForBlocks="true" keepAlive="false">
            @formField('input', [
                'name' => 'external_link',
                'label' => 'External Link',
                'maxlength' => 200,
                'placeholder' => 'e.g. https://www.example.com',
                'required' => false,
            ])
        </x-formConnectedFields>
    </div>
    <div class="flex-col">
        @formField('medias', [
            'name' => 'hero_image',
            'label' => 'Image',
            'max' => 1,
            'note' => 'Minimum image width 600px',
        ])
    </div>
    <div class="flex-col">
        @formField('input', [
            'name' => 'title',
            'label' => 'Title',
            'required' => true,
        ])
    </div>
    <div class="flex-col">
        @formField('input', [
            'name' => 'subtitle',
            'label' => 'Subtitle',
        ])
    </div>
    <div class="flex-col">
        @formField('color', [
            'name' => 'main_color',
            'label' => 'Hero color',
        ])
    </div>

</div>
