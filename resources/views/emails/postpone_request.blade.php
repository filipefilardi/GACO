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
													Você está recebendo este e-mail porque seu pedido de coleta foi <b>adiado para o dia {{$date}} no periodo da {{$period}}.
												</p>

												<p style="margin-top:0;color:#575a5f;font-size:16px;line-height:1.5em;line-height:1.5em; text-align: justify;">
													<b>Mensagem da cooperativa:</b> <i>"{{$justification}}"</i>
												</p>


												<table style="width:100%;margin:30px auto;padding:0;text-align:center" align="center" width="100%" cellpadding="0" cellspacing="0">
													<tbody><tr>
														<td align="center">
															<form class="form-horizontal" role="form" method="POST" action="{{ url('/mailconfirm') }}">
																{{ csrf_field() }}

																<input type="hidden" name="id_req_master" value="{{$id_req_master}}"/>

																<button type='submit' style="font-family:Arial,'Helvetica Neue',Helvetica,sans-serif;display:block;display:inline-block;width:200px;min-height:20px;padding:20px;background-color:#385169;border-radius:3px;color:#ffffff;font-size:14px;line-height:25px;text-align:center;text-decoration:none;background-color:#385169; border-radius:10px;">Confirmar data de coleta</button>
															</form>
														</td>
													</tr>
												</tbody></table>


												<p style="margin-top:0;color:#575a5f;font-size:16px;line-height:1.5em; text-align: justify;">
													Confirme através do botão "Confirmar data de coleta" se deseja continuar com a coleta nesta nova data solicitada ou <a style="color:#385169" href="{{ url('/home') }}" target="_blank">entre na plataforma</a> para adiar.
												</p>


												<p style="margin-top:0;color:#575a5f;font-size:16px;line-height:1.5em">
													@lang('email.regards')<br>GACO
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
</div>