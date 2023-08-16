<?php
namespace frontend\models;

use Yii;
use yii\base\Model;

class Calculatorform extends Model
{
    public $plan_code;
    public $issue_date;
    public $illustration_date;
    public $death_benefit_option;
    public $current_cash_value;
    
    /*
    public $issue_date;
    public $face_amount;
    public $issue_age;
    public $gender; //sex;
    public $prem_class;
    public $tbl_rated;
    public $rated_yrs;
    public $flat_extra;
    public $flex_yrs;
    public $waiver;
    */
    
    public $issue_date_1st;
    public $face_amount_1st;
    public $issue_age_1st;
    public $gender_1st; //sex;
    public $prem_class_1st;
    public $tbl_rated_1st;
    public $rated_yrs_1st;
    public $flat_extra_1st;
    public $flex_yrs_1st;
    public $waiver_1st;
    
    public $issue_date_2nd;
    public $face_amount_2nd;
    public $issue_age_2nd;
    public $gender_2nd; //sex;
    public $prem_class_2nd;
    public $tbl_rated_2nd;
    public $rated_yrs_2nd;
    public $flat_extra_2nd;
    public $flex_yrs_2nd;
    public $waiver_2nd;
    
    public $issue_date_oir;
    public $face_amount_oir;
    public $issue_age_oir;
    public $gender_oir; //sex;
    public $prem_class_oir;
    public $tbl_rated_oir;
    public $rated_yrs_oir;
    public $flat_extra_oir;
    public $flex_yrs_oir;
    public $waiver_oir;
        
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['issue_age_1st', 'issue_age_2nd', 'issue_age_oir', 'tbl_rated_1st', 'tbl_rated_2nd', 'tbl_rated_oir', 'rated_yrs_1st', 'rated_yrs_2nd', 'rated_yrs_oir',
              'flex_yrs_1st', 'flex_yrs_2nd', 'flex_yrs_oir'], 'integer'],
            [['current_cash_value', 'face_amount_1st', 'face_amount_2nd', 'face_amount_oir', 'flat_extra_1st', 'flat_extra_2nd', 'flat_extra_oir'], 'number'],
                    
            [['plan_code', 'death_benefit_option', 'issue_date', 'illustration_date', 'issue_date_1st', 'issue_date_2nd', 'issue_date_oir', 'gender_1st', 'gender_2nd', 'gender_oir',
              'prem_class_1st', 'prem_class_2nd', 'prem_class_oir', 'waiver_1st', 'waiver_2nd', 'waiver_oir'], 'string', 'max' => 10],          
        ];
    }
    
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'plan_code' => 'Plan Code',
            'issue_date' => 'Issue Date',
            'illustration_date' => 'Illustration Date',
            'death_benefit_option' => 'Dth Ben Opt',
            'current_cash_value' => 'CURR CV/1035',
            /*            
            'issue_date_1st' => '';
            'face_amount_1st' => '';
            'issue_age_1st' => '';
            'gender_1st' => ''; 
            'prem_class_1st' => '';
            'tbl_rated_1st' => '';
            'rated_yrs_1st' => '';
            'flat_extra_1st' => '';
            'flex_yrs_1st' => '';
            'waiver_1st' => '';
            
            'issue_date_2nd' => '';
            'face_amount_2nd' => '';
            'issue_age_2nd' => '';
            'gender_2nd' => ''; //sex;
            'prem_class_2nd' => '';
            'tbl_rated_2nd' => '';
            'rated_yrs_2nd' => '';
            'flat_extra_2nd' => '';
            'flex_yrs_2nd' => '';
            'waiver_2nd' => '';
            
            'issue_date_oir' => '';
            'face_amount_oir' => '';
            'issue_age_oir' => '';
            'gender_oir' => ''; //sex;
            'prem_class_oir' => '';
            'tbl_rated_oir' => '';
            'rated_yrs_oir' => '';
            'flat_extra_oir' => '';
            'flex_yrs_oir' => '';
            'waiver_oir' => '';
        */
        ];
    }
    


    
///////////////////////////////////////////////////////////////  
    public function sendEmail($email,$subject, $body)
    {
        return Yii::$app->mailer->compose('layouts/html', ['content'=>$body])
            ->setTo($email)
            ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
            //->setReplyTo([$this->email => $this->name])
            ->setSubject($subject)
            //->setTextBody($body)
            ->setHtmlBody($body)
            ->send();
    }
}