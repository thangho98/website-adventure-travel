<font face="Arial">
<div>
	<div>
		<h2><font color="#000">ABCStore đã nhận đơn hàng {{$carts->cart_id}}</font></h2>
		<p>Kính chào quý khách</p>
		<p>Cảm ơn quý khách đã đặt hàng tại ABCStore</p>
		<p>ABCStore vừa nhận được đơn hàng của quý khách và đang tiến hành xác thực thông tin. Sau đây là thông chi tiết đơn hàng {{$carts->cart_id}}:</p>
	</div>
	<div>
		<div></div>
		<h3><font color="#FF9600">Thông tin khách hàng</font></h3>
		<p>
			<strong class="info">Khách hàng: </strong>
			{{$info['cus_name']}}
		</p>
		<p>
			<strong class="info">Email: </strong>
			{{$info['cus_email']}}
		</p>
		<p>
			<strong class="info">Điện thoại: </strong>
			{{$info['cus_phone']}}
		</p>
		<p>
			<strong class="info">Được đặt lúc: </strong>
			{{$carts->created_at}}
		</p>
	</div>						
	<div id="hoa-don">
		<h3><font color="#FF9600">Hóa đơn mua hàng</font></h3>							
		<table border="1" cellspacing="0">
			<tr>
				<td width="30%"><strong>Tên sản phẩm</strong></td>
				<td width="5%"><strong>Màu</strong></td>
				<td width="15%"><strong>Bộ nhớ</strong></td>
				<td width="25%"><strong>Giá</strong></td>
				<td width="15%"><strong>Số lượng</strong></td>
				<td width="25%"><strong>Thành tiền</strong></td>
			</tr>
			@foreach ($content as $item)
			<tr>
				<td>{{$item->name}}</td>
				<td>{{$item->attributes['propt_color']}}</td>
				<td>Ram: {{$item->attributes['propt_ram']}} gb, Rom: {{$item->attributes['propt_rom']}} </td>
				<td>{{number_format($item->price,0,',','.')}} VNĐ</td>
				<td>{{$item->quantity}}</td>
				<td>{{number_format($item->price*$item->quantity,0,',','.')}} VNĐ</td>
			</tr>
			@endforeach
			<tr>
				<td colspan="3" align="left">Tổng tiền:</td>
				<td colspan="3" align="right">{{number_format($total_carts,0,',','.')}} VNĐ</td>
			</tr>
		</table>
	</div>
	<div id="xac-nhan">
		<br>
		<p align="justify">
			<h3><font color="#FF9600">Quý khách vui lòng kiểm tra lại thông tin đơn hàng</font></h3><br />
			<p>Quý khách nhấn vào <a href="{{asset('cart/confirm/'.$carts->cart_remember_token.'/'.$carts->cart_id)}}" color="#FF9600">đây</a> xác nhận đơn hàng thành công.</p><br />
			<p>Nếu quý khách muốn thay đổi thông tin đơn hàng vui lòng gọi đến hotline: 0123456789 để được tư vấn.</p><br />
			<b><br />Cám ơn Quý khách đã sử dụng Sản phẩm của Công ty chúng Tôi!</b>
		</p>
	</div>
</div>
</font>				
