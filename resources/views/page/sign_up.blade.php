@extends('master')

@section('content')
    <div class="inner-header">
		<div class="container">
			<div class="pull-left">
				<h6 class="inner-title">Đăng kí</h6>
			</div>
			<div class="pull-right">
				<div class="beta-breadcrumb">
					<a href="index.html">Home</a> / <span>Đăng kí</span>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	<div class="container">
		<div id="content">
			<form action="{{route('SignUp')}}" method="post" class="beta-form-checkout">
				{{ csrf_field() }}
                <input type="hidden" name="_token" value="{{csrf_token()}}" />
				<div class="row">
					<div class="col-sm-3"></div>
					<div class="col-sm-6">
						@if(count($errors) > 0)
							<div class="alert alert-danger">
								@foreach($errors->all() as $item)
									{{$item}} <br />
								@endforeach
							</div>
						@endif
						@if(Session::has('thanhcong'))
							<div class="alert alert-success">{{Session::get('thanhcong')}}</div>
						@endif
					</div>
				</div>
				<div class="row">
					<div class="col-sm-3"></div>
					<div class="col-sm-6">
						<h4>Đăng kí</h4>
						<div class="space20">&nbsp;</div>
						<div class="form-block">
							<label for="email">Email address*</label>
							<input class="form-control" type="email" id="email" name="email" required>
						</div>
						<div class="form-block">
							<label for="fullName">Fullname*</label>
							<input class="form-control" type="text" id="fullName" name="fullName" required>
						</div>
						<div class="form-block">
							<label for="address">Address*</label>
							<input class="form-control" type="text" id="address" name="address" placeholder="Street Address" required>
						</div>
						<div class="form-block">
							<label for="phone">Phone*</label>
							<input class="form-control" type="text" id="phone" name="phone" required>
						</div>
						<div class="form-block">
							<label for="password">Password*</label>
							<input class="form-control" type="password" id="password" name="password" required>
						</div>
						<div class="form-block">
							<label for="rePassword">Re password*</label>
							<input class="form-control" type="password" id="rePassword" name="rePassword" required>
						</div>
						<div class="form-block">
							<button type="submit" class="btn btn-primary">Register</button>
						</div>
					</div>
					<div class="col-sm-3"></div>
				</div>
			</form>
		</div> <!-- #content -->
	</div>
@endsection