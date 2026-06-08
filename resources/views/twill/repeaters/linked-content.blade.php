@twillRepeaterTitle('Linked Content')
@twillRepeaterIcon('media-grid')
@twillRepeaterTitleField('button_text', ['hidePrefix' => true])
@twillRepeaterGroup('app')

<br />

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
                    'value' => 'nav',
                    'label' => 'Navigation',
                ],
                [
                    'value' => 'external',
                    'label' => 'External',
                ],
            ],
        ])
    </div>
    <div class="flex-col">
        <x-formConnectedFields fieldName="destination" fieldValues="nav" renderForBlocks="true" keepAlive="false">
            @formField('select', [
                'name' => 'nav_reference',
                'label' => 'Navigation Group',
                'placeholder' => 'Select a navigation group',
                'unpack' => true,
                'options' => [
                    [
                        'value' => 'explore',
                        'label' => 'Explorations',
                    ],
                    [
                        'value' => 'genres',
                        'label' => 'Genres',
                    ],
                    [
                        'value' => 'stories',
                        'label' => 'Stories',
                    ],
                    [
                        'value' => 'performers',
                        'label' => 'Performers',
                    ],
                ],
            ])
        </x-formConnectedFields>
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
</div>

@formField('medias', [
    'name' => 'reference_image',
    'label' => 'Reference Image',
    'max' => 1,
])

@formField('input', [
    'name' => 'button_text',
    'label' => 'Button Text',
    'maxlength' => 50,
    'placeholder' => 'Call to action',
    'default' => 'Read more',
    'note' => 'If related content is set, button text will default to page title.',
    'required' => true,
])
