@twillBlockTitle('Title')
@twillBlockIcon('star-feature')
@twillBlockGroup('app')

@formField('input', [
'name' => 'text',
'label' => 'Text',
'required' => true,
'maxlength' => 80,
])

{{-- @formField('checkboxes', [
'name' => 'last',
'label' => 'Is this the last title?',
'note' => 'Used for styling the last title block',
'inline' => true,
'options' => [
[
'value' => true,
'label' => 'Yes'
],
]
]) --}}
