@twillRepeaterTitle('Menu Item')
@twillRepeaterTitleField('title', ['hidePrefix' => false])
@twillRepeaterGroup('app')

@formField('input', [
'name' => 'title',
'label' => 'Title',
'translated' => true,
])

@formField('radios', [
'label' => 'Link Type',
'name' => 'destination',
'inline' => true,
'options' => [
[
'value' => 'internal',
'label' => 'Internal'
],
[
'value' => 'external',
'label' => 'External'
]
]
])
{{-- Show Browser field to select internal item --}}
<x-formConnectedFields fieldName="destination" fieldValues="internal" renderForBlocks="true" keepAlive="false">
    @formField('browser', [
    'label' => 'Link',
    'max' => 1,
    'name' => 'linkables',
    'moduleName' => 'pages'
    ])
</x-formConnectedFields>

{{-- Show text field to enter url if an external link is selected --}}
<x-formConnectedFields fieldName="destination" fieldValues="external" renderForBlocks="true" keepAlive="false">
    @formField('input', [
    'name' => 'url',
    'label' => 'Url',
    'translated' => true,
    ])
</x-formConnectedFields>


<x-formCollapsedFields label="View Advanced Settings" :open="false">
    @formField('input', [
    'name' => 'anchor',
    'label' => 'Anchor',
    'prefix' => '#'
    ])
    @formField('input', [
    'name' => 'query_string',
    'label' => 'Query String',
    'prefix' => '?'
    ])
    @formField('input', [
    'name' => 'id_attribute',
    'label' => 'HTML ID'
    ])
    @formField('input', [
    'name' => 'class_attribute',
    'label' => 'CSS Class(es)',
    'note' => 'A space separated list of classes to be added to the item'
    ])
    @formField('checkbox', [
    'name' => 'new_window',
    'label' => 'Open link in a new tab/window'
    ])
</x-formCollapsedFields>
