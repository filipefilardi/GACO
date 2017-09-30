<div style="margin:0;padding:0;width:100%;background-color:#f2f4f6">
	<table width="100%" cellpadding="0" cellspacing="0">
		<tbody><tr>
			<td style="width:100%;margin:0;padding:0;background-color:#385169" align="center">
				<table width="100%" cellpadding="0" cellspacing="0">

					<tbody>
						<tr>
							<td style="padding:30px 0;text-align:center">
							<a style="font-family:Arial,'Helvetica Neue',Helvetica,sans-serif;font-size:16px;font-weight:bold;color:#fff;text-decoration:none" href="{{ url('/home') }}" target="_blank">
									{{config('app.name')}}
								</a>
							</td>
						</tr>

						<tr>
							<td style="width:100%;margin:0;padding:0;border-top:1px solid #edeff2;border-bottom:1px solid #edeff2;background-color:#fff" width="100%">
								<table style="width:auto;max-width:570px;margin:0 auto;padding:0" align="center" width="570" cellpadding="0" cellspacing="0">
									<tbody>
										<tr>
											<td style="font-family:Arial,'Helvetica Neue',Helvetica,sans-serif;padding:35px">

												<h1 style="margin-top:0;color:#2f3133;font-size:19px;font-weight:bold;text-align:left">
													@lang('email.greetings')
												</h1>
												<p style="margin-top:0;color:#575a5f;font-size:16px;line-height:1.5em;line-height:1.5em; text-align: justify;">
													Você está recebendo este e-mail porque seu pedido de coleta foi <b>confirmado para o dia {{$date}} no periodo da {{$period}}</b>.
												</p>


												<table style="width:100%;margin:30px auto;padding:0;text-align:center" align="center" width="100%" cellpadding="0" cellspacing="0">
													<tbody><tr>
														<td align="center">

															<a href="{{ url('/login') }}" style="font-family:Arial,'Helvetica Neue',Helvetica,sans-serif;display:block;display:inline-block;width:200px;min-height:20px;padding:20px;background-color:#385169;border-radius:3px;color:#ffffff;font-size:15px;line-height:25px;text-align:center;text-decoration:none;background-color:#385169" target="_blank">
																Confirmar data de coleta
															</a>
														</td>
													</tr>
												</tbody></table>


												<p style="margin-top:0;color:#575a5f;font-size:16px;line-height:1.5em; text-align: justify;">
													Confirme através do botão "Confirmar data de coleta" se deseja continuar com a coleta ou <a style="color:#385169" href="{{ url('/home') }}" target="_blank">entre na plataforma</a> para adiar.
												</p>


												<p style="margin-top:0;color:#575a5f;font-size:16px;line-height:1.5em">
													@lang('email.regards')<br>{{config('app.name')}}
												</p>


												<table style="margin-top:25px;padding-top:25px;border-top:1px solid #edeff2">
													<tbody>
														<tr>
															<td style="font-family:Arial,'Helvetica Neue',Helvetica,sans-serif">
																<p style="margin-top:0;color:#575a5f;font-size:12px;line-height:1.5em">
																	Se você está com problemas ao clicar no botão "Confirmar" , copie e cole a URL no seu navegador web:
																</p>

																<p style="margin-top:0;color:#575a5f;font-size:12px;line-height:1.5em">
																	<a style="color:#385169" href="http://localhost:8000/password/reset/0723866e36fbe5482f65b8eb92ab86b412dda53cafdaf4bbef232895d20f1c56" target="_blank">
																		http://localhost:8000/<wbr>password/reset/<wbr>0723866e36fbe5482f65b8eb92ab86<wbr>b412dda53cafdaf4bbef232895d20f<wbr>1c56
																	</a>
																</p>
															</td>
														</tr>
													</tbody>
												</table>
											</td>
										</tr>
									</tbody>
								</table>
							</td>
						</tr>
					</tbody>
				</table>
			</td>
		</tr>
		</tbody>
	</table>
</div>