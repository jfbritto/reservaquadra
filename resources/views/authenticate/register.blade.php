@extends('base.external_base')

@section('title', 'Registrar')

@section('content_header')

@stop

@section('content')

<div class="auth-page">

	<div class="login-box">
		<div class="card card-outline card-primary">
			<div class="card-header text-center">
				<a href="../../index2.html" class="h1"><b>Vini</b>Tennis</a>
			</div>
			<div class="card-body">

				<form action="../../index3.html" id="formStoreUser">
					<div class="input-group mb-3">
						<input type="text" class="form-control" id="name" placeholder="Nome">
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-user"></span>
							</div>
						</div>
					</div>
					<div class="input-group mb-3">
						<input type="email" class="form-control" id="email" placeholder="Email">
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-envelope"></span>
							</div>
						</div>
					</div>
					<div class="input-group mb-3">
						<input type="password" class="form-control" id="password" placeholder="Senha">
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-lock"></span>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-12">
							<button type="submit" class="btn btn-primary btn-block" form="formStoreUser">Cadastrar</button>
						</div>
					</div>
				</form>

				<p class="mb-1 mt-3 text-center"><a href="/">Logar</a></p>
			</div>
		</div>
	</div>

</div>

@stop

@section('js')
    <script src="/js/authenticate/login.js"></script>
@stop