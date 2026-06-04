@twillBlockTitle('Index Module')
@twillBlockIcon('media-list')
@twillBlockGroup('app')

@formField('input', [
    'name' => 'heading',
    'label' => 'Heading',
])

@formField('input', [
    'name' => 'link',
    'label' => 'Link',
    'maxlength' => 200,
    'placeholder' => 'e.g. https://www.example.com',
    'required' => false,
])
@formField('input', [
    'name' => 'button_text',
    'label' => 'Button Text',
    'maxlength' => 50,
    'placeholder' => 'Call to action',
    'default' => 'Read more',
    'required' => true,
])

@formField('repeater', [
    'type' => 'linked-content',
    'max' => 3,
])
