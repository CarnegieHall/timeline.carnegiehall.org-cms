<?php

namespace App\View\Components\Twill\Blocks;


use A17\Twill\Services\Forms\Form;
use A17\Twill\Services\Forms\Fields\Input;
use A17\Twill\Services\Forms\Fields\Files;
use A17\Twill\Services\Forms\Fields\Wysiwyg;
use A17\Twill\View\Components\Blocks\TwillBlockComponent;
use Illuminate\Contracts\View\View;

class TimelineFilter extends TwillBlockComponent
{
    public function render(): View
    {
        return view('components.twill.blocks.timelinefilter');
    }

    public function getForm(): Form
    {
        return Form::make([
            Input::make()->name('title'),
            Wysiwyg::make()
                ->name('description')
                ->toolbarOptions([['header' => [2, 3, 4, false]], 'bold', 'italic', 'ordered', 'bullet']),
            Files::make()
                ->name('demo_video')
                ->label('Demo Video')
                ->max(1),
        ]);
    }
    public static function getBlockTitle(?Block $block = null): string
    {
        return "Timeline Filter";
    }
    public static function getBlockIcon(): string
    {
        return 'b-date';
    }

}
