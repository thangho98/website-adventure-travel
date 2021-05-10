<font face="Arial">
	<div id=":1rt" class="ii gt">
		<div id=":1on" class="a3s aXjCH "><u></u>
			<div style="margin:0;padding:0">
				<table width="100%" height="100%" cellspacing="0" cellpadding="0" border="0" align="center"
					style="border-collapse:collapse!important;background-color:#fff;min-height:100%;margin:0;padding:0;width:100%;font-family:Arial,Helvetica,sans-serif;font-size:14px;color:#444;line-height:18px">
					<tbody>

						<tr>
							<td style="background:#efefef;padding:10px 0" valign="top" align="center">

								<table width="600" cellspacing="0" cellpadding="0" border="0"
									style="border-collapse:collapse!important">
									<tbody>
										<tr>
											<td width="40"><a style="text-decoration:none"><img
														src="https://ci4.googleusercontent.com/proxy/LXu1Yt_1NtfsoBvS8j885YNxXv8ZbnrPx9Ol1UFzYsnSRhT2Ez-rtfTlrettqmzIr4r8QXNCpbFsnyN5ZMKBnzFod7JrvcQBxB-T4ZXaCfIGJnphoCfWIk7qfQ=s0-d-e1-ft#https://tkbvn-tokyo.s3.amazonaws.com/static/email-template/ticketbox.png"
														alt="" class="CToWUd"></a></td>
											<td><a href="#" style="text-decoration:none;color:#9a9a9a"
													target="_blank">www.y2t.vn</a></td>
										</tr>
									</tbody>
								</table>
							</td>
						</tr>

						<tr>
							<td style="background:#fff;padding:20px 0" valign="top" align="center">

								<table width="600" cellspacing="0" cellpadding="0" border="0">
									<tbody>
										<tr>
											<td>
												<div style="font-size:22px;line-height:120%;margin:20px 0 25px">Xác nhận
													đơn hàng</div>
												<table>
													<tbody>
														<tr>
															<td><img src="https://transviet.com.vn/images/Khuyen-Mai/Pictures/cam_nang_du_lich/LUU-Y-KHI-DI-DU-LICH/dulichtheotour-transviet00.jpg"
																	style="max-width:180px" class="CToWUd"></td>
															<td style="padding-left:40px">
																<p
																	style="font-size:18px;line-height:110%;margin:0 0 5px 0;padding:0;font-weight:bold">
																	{{$tour_detail->tr_name}}</p>
																<table>
																	<tbody>
																		<tr>
																			<td style="width:20px;text-align:center">
																				<img src="https://ci4.googleusercontent.com/proxy/zHKzweaSV4W7xms0JEQdfRIgFL1r00UNQWRLyjgxl6h_PDNuvrVD9FoG_99xqNdo9cyLIYPbQG-CXcGKkwC8OAlceOPB11ot74V3mmQNL0WZphhazlNdYnztq5yK6is2pw=s0-d-e1-ft#https://tkbvn-tokyo.s3.amazonaws.com/static/email-template/org-email/clock.png"
																					class="CToWUd"></td>
																			<td style="text-align:left">
																				<p
																					style="line-height:150%;margin:0;padding:0">{{date("d/m/Y", strtotime($tour_detail->tour_time_start))}}</p>
																			</td>
																		</tr>
																		<tr>
																			<td style="width:20px;text-align:center">
																				<img src="https://ci5.googleusercontent.com/proxy/2ok-hFc0LinARRRWKhkgELoQgHS6OB7zHge5Z1nLFeRileO56ihexuSD13SS_uRNUXpDEuNP5bUbkGK4UsJmLaf0FW0kYFtkwJs2ZVYNJtRv46RLx4VV9tbt60340XoDNH2STg=s0-d-e1-ft#https://tkbvn-tokyo.s3.amazonaws.com/static/email-template/org-email/location.png"
																					class="CToWUd"></td>
																			<td style="text-align:left">
																				<p
																					style="line-height:150%;margin:0;padding:0">{{$tour_detail->loca_name}}</p>
																			</td>
																		</tr>
																	</tbody>
																</table>
															</td>
														</tr>
													</tbody>
												</table>
												<div
													style="margin:20px 0;width:100%;border-top:1px solid #ccc;height:1px">
												</div>
												<br>
												<p style="line-height:150%;margin:0;padding:0">Chào <b>{{$profile->user_name}}</b>!</p>
												<br>
												<p style="line-height:150%;margin:0;padding:0">Bạn đã đặt vé thành công.
													Vui lòng nhận vé tại
													<strong></strong>

												</p>
												<p style="margin-left:25px"><strong>Công ty Y2T Tour, phường Linh Trung,
														quận Thủ Đức, Hồ Chí
														Minh</strong></p>
												<p style="margin:0;padding-top:15px">Cảm ơn bạn đã đặt vé với Y2T Tour.
												</p><br><br>
												<table style="border-collapse:collapse!important;width:100%"
													cellspacing="0" cellpadding="0" border="0">
													<tbody>
														<tr>
															<td style="padding:0 0 10px 0">
																<h3
																	style="color:rgb(96,96,96)!important;font-family:Helvetica,Arial,sans-serif;font-size:18px;font-weight:bold;letter-spacing:-0.5px;line-height:20px;margin-top:0px;margin-right:0px;margin-bottom:0px;margin-left:0px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px;text-align:left">
																	Chi tiết đặt tour</h3>
															</td>
														</tr>
														<tr>
															<td width="33%" valign="top" align="left"
																style="border-collapse:collapse!important;background-color:#efefef;border-top:1px solid #d4d4d4;padding:15px 0 15px 15px">
																<strong>Mã vé</strong></td>
															<td valign="top" align="left"
																style="border-collapse:collapse!important;border-top:1px solid #d4d4d4;padding:15px 0 15px 15px">
																{{$info->bt_id}}</td>
														</tr>
														<tr>
															<td width="33%" valign="top" align="left"
																style="border-collapse:collapse!important;background-color:#efefef;border-top:1px solid #d4d4d4;padding:15px 0 15px 15px">
																<strong>Ngày đặt vé</strong></td>
															<td valign="top" align="left"
																style="border-collapse:collapse!important;border-top:1px solid #d4d4d4;padding:15px 0 15px 15px">
																{{date("d/m/Y", strtotime($info->bt_date))}}</td>
														</tr>
														<tr>
															<td width="33%" valign="top" align="left"
																style="border-collapse:collapse!important;background-color:#efefef;border-top:1px solid #d4d4d4;padding:15px 0 15px 15px">
																<strong>Giá trị đơn hàng</strong></td>
															<td valign="top" align="left"
																style="border-collapse:collapse!important;border-top:1px solid #d4d4d4;padding:15px 0 15px 15px">
																{{number_format($info->bt_total_price,0,',','.')}} VND</td>
														</tr>
														<tr>
															<td width="33%" valign="top" align="left"
																style="border-collapse:collapse!important;background-color:#efefef;border-top:1px solid #d4d4d4;padding:15px 0 15px 15px">
																<strong>Phương thức thanh toán</strong></td>
															<td valign="middle" align="left"
																style="border-collapse:collapse!important;border-top:1px solid #d4d4d4;padding:0px 0 0px 15px">
																<table
																	style="border-collapse:collapse!important;width:100%"
																	cellspacing="0" cellpadding="0" border="0">
																	<tbody>
																		<tr>
																			<td>Nhận vé tại văn phòng Y2T Tour<br>Hạn
																				chót nhận vé : 19:30 ngày {{date("d/m/Y", strtotime($tour_detail->tour_time_start.' -3 days'))}}
																			</td>
																		</tr>
																	</tbody>
																</table>
															</td>
														</tr>
														<tr>
															<td width="33%" valign="top" align="left"
																style="border-collapse:collapse!important;background-color:#efefef;border-top:1px solid #d4d4d4;padding:15px 0 15px 15px">
																<strong>Chi tiết vé</strong></td>
															<td valign="top" align="left"
																style="border-collapse:collapse!important;border-top:1px solid #d4d4d4;padding:15px 0 15px 15px">
																<ul style="list-style:none;padding:0;margin:0"><span>{{$info->bt_num_adult}} x
																		Người lớn, {{$info->bt_num_child}} x Trẻ
																		em</span><br></ul>
															</td>
														</tr>
													</tbody>
												</table><br> <br><br>

												<p style="line-height:150%;margin:20px 0 0 0;padding:0"><b>Điều khoản và
														điều kiện:</b></p><br>
												<p style="line-height:150%;margin:0;padding:0">- Không hoàn tiền cho vé
													đã thanh toán.</p>
												<p style="line-height:150%;margin:0;padding:0">- Người mua phải trình vé
													trước khi tham gia
													tour.</p>
												<p style="line-height:150%;margin:0;padding:0">- Người mua chịu trách
													nhiệm bảo mật thông tin mã
													vé.</p>
												<p style="line-height:150%;margin:0;padding:0">- Khi mua vé, tức là
													người mua đã đồng ý với các
													điều khoản và điều kiện trên.</p>
												<div
													style="margin:20px 0;width:100%;border-top:1px solid #ccc;height:1px">
												</div>

												<p style="line-height:150%;margin:0;padding:0"><b>Nếu bạn có câu hỏi?
														Xin hãy liên hệ:</b></p>
												<br>
												<p style="line-height:150%;margin:0;padding:0">
												</p>
												<table cellpadding="0" border="0" cellspacing="0"
													style="border-collapse:collapse">
													<tbody>
														<tr>
															<td style="padding-right:20px">0123456789 </td>
														</tr>
													</tbody>
												</table>
												<p></p><br>
												<p style="line-height:150%;margin:0;padding:0">Đại diện Y2T Tour</p>
												<p style="line-height:150%;margin:0;padding:0"><a href="#"
														style="text-decoration:none" target="_blank">support@y2t.vn</a>
												</p>
												<p style="line-height:150%;margin:0;padding:0">Hotline:
													0123456789<br>(8:30am - 7:30pm)</p>
											</td>
										</tr>
										<tr>
											<td height="40"></td>
										</tr>
									</tbody>
								</table>
							</td>
						</tr>

						<tr>
							<td style="padding:20px 0 0;color:#a4a4a4" valign="top" align="center">

								<table width="100%" cellspacing="0" cellpadding="0" border="0"
									style="border-collapse:collapse!important">
									<tbody>
										<tr style="background-color:#444444">
											<td
												style="text-align:center;font-size:12px;color:#ddd;line-height:1.3em;padding:20px 0">
												<p style="margin-bottom:5px;margin-top:5px">Y2T Tour Co. Ltd. © 2019</p>
												<p style="margin-bottom:5px;margin-top:5px">Hệ thống quản lý và phân
													phối vé đặt tour hàng đầu
													Việt Nam.</p>
												<p style="margin-bottom:5px;margin-top:5px">Email: <a
														href="mailto:support@ticketbox.vn"
														style="color:#ddd;text-decoration:none"
														target="_blank">support@y2t.vn</a> - Hotline:
													0123456789 (TP.HCM)</p>
												<p style="margin-bottom:0">

											</td>
										</tr>
									</tbody>
								</table>
							</td>
						</tr>
					</tbody>
				</table>
				<img src="https://ci6.googleusercontent.com/proxy/Hbv-LvlPPrS-YVb-Wk2UxZt4rq3VPZR5mBOySCDrB3sxMpomKS_BgGgLO1jL0YdK0CWDyVhobSdSfIR5na6UBUKMR2uIi6zB0GZ39E4YYD_67fybx2Q4wEacUamgFrdJ6CkwnBSXU_cngraQFg=s0-d-e1-ft#http://tracking.ticketbox.vn/track/open.php?u=30009005&amp;id=0a78e1d3d1ab452bb95948ceae713e9e"
					height="1" width="1" class="CToWUd">
			</div>
			<div class="yj6qo"></div>
			<div class="adL"></div>
		</div>
	</div>
</font>