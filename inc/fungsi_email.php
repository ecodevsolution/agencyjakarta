<?php
	function EmailRegister($email, $first, $last, $user, $password){
		Yii::$app->mailer->compose()
			->setFrom('noreply@agencyjakarta.co.id')
			->setTo($email)
			->setSubject('Registration')
			->setHtmlBody('<p>Hallo <strong>"'.$first.' '.$last.'"</strong>,</p>
						   <p>Terima Kasih sudah mendaftar di Agencyjakarta. Silahkan Lengkapi data diri kamu, Upload Foto, dan</p>
						   <p>Curriculum Vitae. Tunggu informasi Walk Interviewnya ya. Walk Interview bisa melalui telephone atau bertemu</p>
						   <p>Jadi Langsung Lengkapi Data diri kamu ya , Berikut data kamu agar dapat melakukan Login :</p>
						   <p><strong>Username : "'.$user.'"</strong></p>
						   <p><strong>Password : "'.$password.'"</strong></p>
						   <br/>
						   <p>Untuk Pertanyaan bisa melalui kontak di bawah ini:</p>
						   <p><strong>Email : spg@agencyjakarta.co.id</strong></p>
						   <p><strong>LINE@ : @jobforspg</strong></p>')
			->send();
	}

	
	function EmailApproveRegister($email, $first, $last){
		Yii::$app->mailer->compose()
			->setFrom('noreply@agencyjakarta.co.id')
			->setTo($email)
			->setSubject('Approval Registration')
			->setHtmlBody('<p>Hallo<strong> "'.$first.' '.$last.'"</strong>,</p>
						   <p>Selamat Berkas anda sudah lengkap di terima Agencyjakarta.</p>
						   <p>Kamu sudah bisa menggunakan Sistem Online Kami.</p>
						   <p>Nantikan Informasi Job untuk SPG dan Usher.</p>
						   <p>Untuk Pertanyaan bisa melalui kontak di bawah ini:</p>
						   <p><strong>Email : spg@agencyjakarta.co.id</strong></p>
						   <p><strong>LINE@ : @jobforspg</strong></p>')
			->send();
	}
	
	function EmailApproveApply($email, $first, $last){
		Yii::$app->mailer->compose()
			->setFrom('noreply@agencyjakarta.co.id')
			->setTo($email)
			->setSubject('Approval Apply')
			->setHtmlBody('<p>Hallo<strong> "'.$first.' '.$last.'"</strong>,</p>
						   <p>Selamat Kamu di Rekomendasikan, Tunggu Informasi Jadwal Kerja Kamu ya</p>
						   <p>Untuk Pertanyaan bisa melalui kontak di bawah ini:</p>
						   <p><strong>Email : spg@agencyjakarta.co.id</strong></p>
						   <p><strong>LINE@ : @jobforspg</strong></p>')
			->send();
	}
	
	function EmailJadwal($email, $first, $last){
		Yii::$app->mailer->compose()
			->setFrom('noreply@agencyjakarta.co.id')
			->setTo($email)
			->setSubject('Jadwal')
			->setHtmlBody('<p>Hallo<strong> "'.$first.' '.$last.'"</strong>,</p>
						   <pJadwal kerja kamu sudah ada nih, bisa kamu lihat ya di website kami</p>
						   <p>silahkan login untuk melihat jadwal kamu. Yuk Login!! </p>
						   <p><strong>Website</strong>: <a href="http://portal.agencyjakarta.co.id" title="Login">Login ke Website</a></p>
						   <p>Untuk Pertanyaan bisa melalui kontak di bawah ini:</p>
						   <p><strong>Email : spg@agencyjakarta.co.id</strong></p>
						   <p><strong>LINE@ : @jobforspg</strong></p>')
			->send();
	}
	
	function EmailGaji($email, $first, $last){
		Yii::$app->mailer->compose()
			->setFrom('noreply@agencyjakarta.co.id')
			->setTo($email)
			->setSubject('Status Gaji')
			->setHtmlBody('<p>Hallo<strong> "'.$first.' '.$last.'"</strong>,</p>
						   <p>Ada kabar Gembira nih, Gaji kamu sudah di transfer ke rekening kamu. Coba cek Ke Rekening kamu ya</p>
						   <p>Untuk Pertanyaan bisa melalui kontak di bawah ini:</p>
						   <p><strong>Email : spg@agencyjakarta.co.id</strong></p>
						   <p><strong>LINE@ : @jobforspg</strong></p>')
			->send();
	}
	
	function EmailRegistrationClient($email, $first, $last){
		Yii::$app->mailer->compose()
			->setFrom('noreply@agencyjakarta.co.id')
			->setTo($email)
			->setSubject('Approval Registration')
			->setHtmlBody('<p>Hallo<strong> "'.$first.' '.$last.'"</strong>,</p>
						   <p>Terima Kasih sudah menghubungi kami, silahkan login untuk melihat pesanan anda dan melakukan pesanan selanjutnya</p>
						   <p>Silahkan Login melalui website kami,</p>
						   <p><strong>Website</strong>: <a href="http://portal.agencyjakarta.co.id" title="Login">Login ke Website</a></p>
						   <p>Petunjuk Penggunaan Sistem: <a href="http://agencyjakarta.co.id/cara-penggunaan-sistem-klien/" title="Panduan">Panduan Penggunaan</a></p>
						   <p>Untuk Pertanyaan bisa melalui kontak di bawah ini:</p>
						   <p><strong>Email : cs@agencyjakarta.co.id</strong></p>
						   <p><strong>Whatsapp : +6283874444357</strong></p>')
			->send();
	}
	
	function EmailKontrak($email, $first, $last){
		Yii::$app->mailer->compose()
			->setFrom('noreply@agencyjakarta.co.id')
			->setTo($email)
			->setSubject('Pemesanan / Kontrak')
			->setHtmlBody('<p>Hallo<strong> "'.$first.' '.$last.'"</strong>,</p>
						   <p>Kami sudah membuatkan kontrak pemesanan anda, silahkan anda cek akun anda di website kami</p>
						   <p>dengan cara login. Silahkan baca kontrak pemesanan anda terlebih dahulu sebelum proses selanjutnya</p>
						   <p><strong>Website</strong>: <a href="http://portal.agencyjakarta.co.id" title="Login">Login ke Website</a></p>
						   <p>Petunjuk Penggunaan Sistem: <a href="http://agencyjakarta.co.id/cara-penggunaan-sistem-klien/" title="Panduan">Panduan Penggunaan</a></p>
						   <p>Untuk Pertanyaan bisa melalui kontak di bawah ini:</p>
						   <p><strong>Email : cs@agencyjakarta.co.id</strong></p>
						   <p><strong>Whatsapp : +6283874444357</strong></p>')
			->send();
	}
	
	function EmailInvoice($email, $first, $last){
		Yii::$app->mailer->compose()
			->setFrom('noreply@agencyjakarta.co.id')
			->setTo($email)
			->setSubject('Email invoice')
			->setHtmlBody('<p>Hallo<strong> "'.$first.' '.$last.'"</strong>,</p>
						   <p>Berikut Invoice yang harus anda bayar kan. silahkan Login untuk melihat invoice</p>
						   <p>Silahkan Login melalui website kami,</p>
						   <p><strong>Website</strong>: <a href="http://portal.agencyjakarta.co.id" title="Login">Login ke Website</a></p>
						   <p>Petunjuk Penggunaan Sistem: <a href="http://agencyjakarta.co.id/cara-penggunaan-sistem-klien/" title="Panduan">Panduan Penggunaan</a></p>
						   <p>Untuk Pertanyaan bisa melalui kontak di bawah ini:</p>
						   <p><strong>Email : cs@agencyjakarta.co.id</strong></p>
						   <p><strong>Whatsapp : +6283874444357</strong></p>')
			->send();
	}
	
	
	function EmailConfirmPay($email, $first, $last){
		Yii::$app->mailer->compose()
			->setFrom('noreply@agencyjakarta.co.id')
			->setTo($email)
			->setSubject('Confirmation Payment')
			->setHtmlBody('<p>Hai, <strong> "'.$first.' '.$last.'"</strong></p>
						   <p>Mohon Tunggu untuk verifikasi pembayaran ya.</p>')
			->send();
	}
	
	function EmailForgotPasssword($email, $first, $last, $username, $password){
		Yii::$app->mailer->compose()
			->setFrom('noreply@agencyjakarta.co.id')
			->setTo($email)
			->setSubject('Forgot Password')
			->setHtmlBody('<p>Hallo<strong> "'.$first.' '.$last.'"</strong>,</p>
							<p>Kamu lupa Password kamu ya? Berikut informasi terbaru kamu:&nbsp;</p>
							<table style="width: 282px; height: 65px;" border="0" cellspacing="0" cellpadding="0">
								<tbody>
									<tr>
										<td><strong>Username</strong></td>
										<td><strong>:</strong></td>
										<td><strong>'.$username.'</strong></td>
									</tr>
									<tr>
										<td><strong>Password</strong></td>
										<td><strong>:</strong></td>
										<td><strong>'.$password.'</strong></td>
									</tr>
								</tbody>
							</table>
							<p>Untuk Pertanyaan bisa melalui kontak di bawah ini:</p>
							<p><strong>Email : support@agencyjakarta.co.id</strong></p>
							<p><strong>Whatsapp : +6283874444357</strong></p>
							<p><strong>Terima kasih,</strong></p>
							<p><strong>Regards,</strong></p>
							<p><strong>Agencyjakarta</strong></p>')
						->send();
	}

?>