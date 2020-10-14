<?php


namespace app\models;


use yii\db\ActiveRecord;

class Contact extends ActiveRecord
{
    public function getComment()
    {
        return $this->hasMany(Comment::className(), ['contact_id' => 'id']);
    }

    public function rules()
    {
        return [
            [['email'], 'required'],
            ['email', 'email'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'email' => 'E-mail',
        ];
    }

}