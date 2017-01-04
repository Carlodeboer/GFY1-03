<?php
    include "../toegang.php";
?>
<br><br>
<div id="contentwrapper">
    <table>
        <form method="post" action="beheerpaneel.php?beheer=Nieuw+account">
			<div class="form-group label-static is-empty">
				<label for="i5i" class="control-label">Gebruikersnaam</label>
				<input type="text" name="naam" class="form-control" id="i5i">
				<span class="help-block">Kies een gebruikersnaam</span>
			</div>
			<div class="form-group label-static is-empty">
				<label for="i5i" class="control-label">Wachtwoord</label>
				<input type="password" name="wachtwoord" class="form-control" id="i5i">
				<span class="help-block">Kies een wachtwoord</span>
			</div>
			<div class="form-group label-static is-empty">
				<label for="i5i" class="control-label">Herhaal wachtwoord</label>
				<input type="password" name="wachtwoord2" class="form-control" id="i5i">
				<span class="help-block">Herhaal het wachtwoord</span>
			</div>
			<div class="form-group label-static is-empty">
				<input type="submit" name="nieuwaccount" value="Login" class="btn btn-raised btn-primary">
			</div>
        </form>
    </table>
	<?php
		if (isset($succes)){
			print "<p>{$succes[1]}</p>";
		}
	?>
</div>
