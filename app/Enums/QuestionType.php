<?php
namespace App\Enums;
Enum QuestionType:string
{
    case Text='text';
    case Textarea='textarea';
    case Checkbox='checkbox';
    case Radio='radio';
    case Select='select';

//    public function types():string
//    {
//        return match ($this){
//            self::Text=>'text',
//            self::Textarea=>'textarea',
//            self::Checkbox=>'checkbox',
//            self::Radio=>'radio',
//            self::Select=>'select'
//        };
//    }
}
