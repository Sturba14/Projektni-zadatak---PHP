<?php
print '
		<div class="kontakt">
			<h1>PRONAĐI BUTIK</h1>
			<br>
			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5562.127155860524!2d15.974095319821632!3d45.80998508609023!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4765d6fce094b4df%3A0x5829d300b82a83a5!2sKrona%20Exclusive!5e0!3m2!1sen!2ssi!4v1641637913940!5m2!1sen!2ssi" width="800" height="600" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
			<hr>
			<h1>Za više informacija ispunite osobne podatke kako bi vas mogli kontaktirati</h1>
			<br>
			<form action="http://work2.eburza.hr/pwa/responzive-page/send-contact.php" id="contact_form" name="contact_form" method="post">
				<div class="form-group">
					<label for="productionyear">Model Hublot sata</label>
					<select id="productionyear" name="productionyear" class="form-control">
					<option value="">Odaberite jedno</option>
					<option value="Classic Fusion Aerofusion Aspen Snowmass Limited Edition">Classic Fusion Aerofusion Aspen Snowmass Limited Edition</option>
					<option value="Big Bang All Black Zermatt">Big Bang All Black Zermatt</option>
					<option value="Classic Fusion Takashi Murakami Sapphire Rainbow">Classic Fusion Takashi Murakami Sapphire Rainbow</option>
					<option value="Big Bang Unico Berluti Aluminio">Big Bang Unico Berluti Aluminio</option>
					<option value="Big Bang Unico Rainbow King Gold">Big Bang Unico Rainbow King Gold</option>
					<option value="Classic Fusion Aerofusion Chrongraph Orlinski King Gold Blue">Classic Fusion Aerofusion Chrongraph Orlinski King Gold Blue</option>
					<option value="Spirit of Big Bang Full Magic Gold">Spirit of Big Bang Full Magic Gold</option>
					<option value="Spirit of Big Bang Tourbillion Sapphire">Spirit of Big Bang Tourbillion Sapphire</option>
					</select>
				</div>

				<div class="form-group">
					<label for="firstname">Ime *</label>
					<input type="text" id="firstname" name="firstname" placeholder="Vaše ime .." class="form-control" required>
				</div>

				<div class="form-group">
					<label for="lastname">Prezime *</label>
					<input type="text" id="lastname" name="lastname" placeholder="Vaše prezime .." class="form-control" required>
				</div>

				<div class="form-group">	
					<label for="email">Vaš email *</label>
					<input type="email" id="email" name="email" placeholder="Vaš email .." class="form-control" required>
				</div>

				<div class="form-group">
					<label for="country">Država</label>
					<select id="country" name="country" class="form-control">
					<option value="">Odaberite jedno</option>
					<option value="Croatia" selected>Hrvatska</option>
					<option value="Bosnia and Herzegovina">Bosna i Hercegovina</option>
					<option value="Serbia">Srbija</option>
					<option value="Slovenia">Slovenija</option>
					<option value="Macedonia">Makedonija</option>
					<option value="Switzerland">Švicarska</option>
					<option value="Montenegro">Crna Gora</option>
                    <option value="Sweden">Švedska</option>
                    <option value="Norway">Norveška</option>
                    <option value="Iceland">Island</option>
					</select>
				</div>

				<div class="form-group">
					<label for="message">Poruka</label>
					<textarea id="message" name="message" placeholder="Napiši nešto .." class="form-control"></textarea>
				</div>

				<div class="form-group">
					<input type="submit" class="btn btn-default" value="Pošalji"> 
					<input type="reset" class="btn btn-default" value="Ponovi">
				</div>
			</form>
		</div>';
?>
