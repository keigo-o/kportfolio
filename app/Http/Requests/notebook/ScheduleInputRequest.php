<?php

namespace App\Http\Requests\notebook;

use Illuminate\Foundation\Http\FormRequest;

class ScheduleInputRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'users_id'=>'required|integer',
            'select'=>'required|min:1',
            'project'=>'min:0|max:30',
            'title'=>'required|space|min:0|max:30',
            'start_day'=>'required|date_format:Y-m-d|required_with:end_day',
            'start_time'=>'nullable|required_with:end_time',
            'serialnum'=>'required',
            'end_day'=>'required|date_format:Y-m-d|after_or_equal:start_day|required_with:start_day',
            'end_time'=>'nullable|after_or_equal:start_time|required_with:start_time',
            'alarm'=>'nullable',
            'importance'=>'required|min:1',
            'schedule'=>'space|min:0|max:500',
            'memo'=>'space|min:0|max:500',
        ];
    }

    public function attributes()
    {
        return[
            'title' => 'タイトル入力',
            'start_day' => '開始日付',
            'end_day' => '終了日付',
            'start_time' => '開始時間',
            'end_time' => '終了時間',
            'select' => '管理選択',
            'alarm' => 'アラーム',
            'schedule' => '予定内容',
            'memo' => 'メモ',
        ];
    }

    /**
     * 独自処理を追加 alarm設定時にstart_timeに値があれば、alarmはstart_time以前の値であること.
     *
     * @param $validator
     */
    public function withValidator(\Illuminate\Contracts\Validation\Validator $validator)
    // public function withValidator($validator) ドキュメントはこっちの表記
    {
        $validator->sometimes('alarm', 'before_or_equal:start_time', function ($input) {
            return $input->start_time != null;
        });
    }
}