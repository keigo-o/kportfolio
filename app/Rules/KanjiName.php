<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class KanjiName implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        mb_regex_encoding('UTF-8');
        $unicode_kanji_hira = '[ぁ-ん\x{2E80}-\x{2FDF}々〇〻\x{3400}-\x{4DBF}\x{4E00}-\x{9FFF}\x{F900}-\x{FAFF}\x{20000}-\x{2FFFF}]';
        $pattern = '^' . $unicode_kanji_hira . '+[ 　]' . $unicode_kanji_hira . '+$';
        return mb_ereg($pattern, $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '氏名は「姓1文字以上＋空白＋名1文字以上」の形式である必要があります。';
    }
}
