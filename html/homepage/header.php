<div class="header">
	<table style="margin-left: auto; margin-right: auto; width: 100%;">
		<tbody>
			<tr>
				<td style="width: 30%;">&nbsp;</td>
				<td style="width: 100px; text-align: center;">Kegelclub Homepage</td>
				<td style="width: 30%; text-align: right;">
							<?php
								//Includes von Funktionen
								include_once("functions.php");
								if (nutzer_angemeldet()) {
                							echo ("<p>Angemeldet: " . $_SESSION['username'] . "</p>");
        							} else {
                							echo ("<p>Nicht angemeldet. <a href='/html/registrationAndLogin/login.php'>Anmelden</a></p>");
        							}
							?>
				</td>
			</tr>
		</tbody>
	</table>
</div>
