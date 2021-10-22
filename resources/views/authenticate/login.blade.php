@extends('base.external_base')

@section('title', 'Login')

@section('content_header')

@stop

@section('content')

<div class="auth-page">

	<div class="login-box">
		<div class="card card-outline card-primary" style="border-top: 3px solid #76c04e;">
			<div class="card-header text-center">
				<span style="color: #01668a;" class="h1"><b>Vini</b>Tennis</span>
			</div>
			<div class="card-body">

				<form action="../../index3.html" id="formAuthenticate">
					<div class="input-group mb-3">
						<input type="email" class="form-control" id="email" placeholder="Email">
						<div class="input-group-append">
							<div class="input-group-text">
								<span style="color: #01668a;" class="fas fa-envelope"></span>
							</div>
						</div>
					</div>
					<div class="input-group mb-3">
						<input type="password" class="form-control" id="password" placeholder="Senha">
						<div class="input-group-append">
							<div class="input-group-text">
								<span style="color: #01668a;" class="fas fa-lock"></span>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-12">
							<button type="submit" class="btn btn-primary btn-block" style="background-color: #76c04e; border-color: #76c04e" form="formAuthenticate">Entrar</button>
						</div>
					</div>
				</form>

				<!-- <p class="mb-1 mt-3 text-center"><a href="#">Esqueci a senha</a></p>
				<p class="mb-1 mt-3 text-center"><a href="/register">Registrar</a></p> -->
			</div>
		</div>
	</div>

</div>

@stop

@section('js')
    <script src="/js/authenticate/login.js"></script>
@stop