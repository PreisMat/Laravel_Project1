
   <h1>Logowanie do Laravela z wykorzystaniem mechanizmu OpenID</h1>
        <?= Form::open(array('url'=>'openid', 'method' =>'POST')) ?>
        <?= Form::label('openid_identity', 'OpenID') ?>
        <?= Form::text('openid_identity', Input::old('openid_identity')) ?>
        <br>
        <?= Form::submit('Zaloguj') ?>
        <?= Form::close() ?>
