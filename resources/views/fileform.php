			<h1>Przesyłanie pliku</h1>
				<?= Form::open(array('files' => TRUE)) ?>
				<?= Form::label('myfile', 'Mój plik') ?>
				<br>			
				<?= Form::file('myfile') ?>
				<br>
				<?= Form::submit('Wyślij') ?>
				<?= Form::close() ?>