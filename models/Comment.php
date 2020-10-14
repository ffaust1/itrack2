<?php


namespace app\models;


use yii\db\ActiveRecord;

class Comment extends ActiveRecord
{
    public function getContact()
    {
        return $this->hasOne(Contact::className(), ['id' => 'contact_id']);
    }

    public function rules()
    {
        return [
            [['text'], 'required'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'text' => 'Комментарий',
        ];
    }

}