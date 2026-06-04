@twillBlockTitle('Title Module')
@twillBlockIcon('text')
@twillBlockGroup('home')


@formField('input', [
    'name' => 'heading',
    'label' => 'Heading',
])

@formField('wysiwyg', [
    'name' => 'text',
    'label' => 'Text',
    'toolbarOptions' => [['header' => [2, 3, 4, 5, 6, false]], 'bold', 'italic', 'link', 'clean'],
])



<div class="flex-row">
    <div class="flex-col flex-col--full">
        @formField('radios', [
            'label' => 'Link Type',
            'name' => 'destination',
            'inline' => true,
            'options' => [
                [
                    'value' => 'pages',
                    'label' => 'Pages',
                ],
                [
                    'value' => 'stories',
                    'label' => 'Stories',
                ],
                [
                    'value' => 'genres',
                    'label' => 'Genres',
                ],
                [
                    'value' => 'notablePerformers',
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
        <x-formConnectedFields fieldName="destination" fieldValues="pages" renderForBlocks="true" keepAlive="false">
            @formField('browser', [
                'label' => 'Linked Page',
                'max' => 1,
                'name' => 'related_page',
                'moduleName' => 'pages',
            ])
        </x-formConnectedFields>

        <x-formConnectedFields fieldName="destination" fieldValues="stories" renderForBlocks="true" keepAlive="false">
            @formField('browser', [
                'label' => 'Linked Story',
                'max' => 1,
                'name' => 'related_story',
                'moduleName' => 'stories',
            ])
        </x-formConnectedFields>
        <x-formConnectedFields fieldName="destination" fieldValues="genres" renderForBlocks="true" keepAlive="false">
            @formField('browser', [
                'label' => 'Linked Genre',
                'max' => 1,
                'name' => 'related_genre',
                'moduleName' => 'genres',
            ])
        </x-formConnectedFields>
        <x-formConnectedFields fieldName="destination" fieldValues="notablePerformers" renderForBlocks="true"
            keepAlive="false">
            @formField('browser', [
                'label' => 'Linked Performer',
                'max' => 1,
                'name' => 'related_notablePerformers',
                'moduleName' => 'notablePerformers',
            ])
        </x-formConnectedFields>
        <x-formConnectedFields fieldName="destination" fieldValues="external" renderForBlocks="true" keepAlive="false">
            @formField('input', [
                'name' => 'external_link',
                'label' => 'External Link',
                'maxlength' => 250,
                'placeholder' => 'e.g. https://www.example.com',
                'required' => false,
            ])
        </x-formConnectedFields>
    </div>
</div>

@formField('input', [
    'name' => 'button_text',
    'label' => 'Button Text',
    'maxlength' => 50,
    'placeholder' => 'Call to action',
    'default' => 'Read more',
    'required' => true,
])
