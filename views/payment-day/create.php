<?php

use yii\helpers\Html;
use \yii\widgets\ActiveForm;
use \app\models\User;
use \yii\helpers\ArrayHelper;
use \app\models\PaymentDay;


/* @var $this yii\web\View */
/* @var $model app\models\PaymentDay */

$this->title = 'Create Payment Day';
$this->params['breadcrumbs'][] = ['label' => 'Payment Days', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
$form = ActiveForm::begin();
$model=new User();
$authors = User::find()->all();
$items = ArrayHelper::map($authors,'id','username');
$params = [
    'prompt' => 'Укажите администратора'
];
echo $form->field($model, 'username')->dropDownList($items,$params);
$model=new PaymentDay();
 echo $form->field($model, 'begin_saldo')->textInput(['value'=>0]);
ActiveForm::end();
?>

<?php \yii\widgets\Pjax::begin(); ?>

<?= Html::Button('Добавить', ['class' => 'btn btn-primary','id'=>'add', 'name' => 'save-button']) ?>
<p></p>
<div class="payment-day-index">
<table id="myTable" class="table table-striped table-bordered">
    <thead>
    <th>Клиент</th>
    <th>Сумма оплаты</th>
    </thead>
    <tbody>

    </tbody>
</table>
</div>
<?php
\yii\widgets\Pjax::end();
?>
<?php

$form=ActiveForm::begin();
 echo $form->field($model, 'turnover')->textInput(['readOnly'=> true])->label('Итоги поступлений');
echo $form->field($model, 'end_saldo')->textInput(['readOnly'=> true]);
 ActiveForm::end();

?>
<?= Html::Button('Сохранить', ['class' => 'btn btn-primary','id'=>'save', 'name' => 'save-button']) ?>

<script type="text/javascript">
    $('#w0').submit(function () {
      return false;
    });
  var i=0;
  $('#add').on('click', function () {
    i++;
    $('#myTable > tbody:last').append('<tr><td class="edit"><input id="edit'+i+'"/></td><td class="edit"><input class="sum" id="edit1'+i+'"/></td></tr>');
  });

  $('input').on('focus', function () {
      var k = 0;
      for (var j = 0; j < i;) {
        j++;
        k += parseFloat($('#edit1' + j).val())
      }
      $('#paymentday-turnover').val(k);
      $('#paymentday-end_saldo').val(k+parseFloat($('#paymentday-begin_saldo').val()))

  });
  $('#save').on('click',function () {
    var mass1=[];
    var k=0;
    for (var j = 0; j < i;) {
      j++;
      k += parseFloat($('#edit1' + j).val())
    }
    $('#paymentday-turnover').val(k);
    $('#paymentday-end_saldo').val(k+parseFloat($('#paymentday-begin_saldo').val()))
    k=0;
    for(j=1;j<=i;j++){
      mass1[k]=$('#edit'+j).val();
      k++;
    }
    var mass2=[];
    k=0;
    for(j=1;j<=i;j++){
      mass2[k]=parseFloat($('#edit1'+j).val());
      k++;
    }
    var data=[mass1,mass2];
    var data2=[$('#user-username option:selected').val(),parseFloat($('#paymentday-begin_saldo').val()),parseFloat( $('#paymentday-turnover').val()),parseFloat( $('#paymentday-end_saldo').val())]
    $.ajax({
      url:'create',
      data:{data1:data,data2:data2,size:i, _csrf: yii.getCsrfToken()},
      dataType: 'json',
      type:'POST',
    });
    $(location).attr("href", '/');
  });
</script>


