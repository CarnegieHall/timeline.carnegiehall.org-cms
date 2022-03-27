@twillBlockTitle('Collaborator Collection')
@twillBlockIcon('media-list')

@formField('input', [
'name' => 'title',
'label' => 'Heading',
'type' => 'text'
])

@formField('repeater', ['type' => 'collaborator-collection-item'])
