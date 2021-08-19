@extends('layouts.app')

@section('content')

  <!-- Page Header -->
  <!-- Page Header -->
  <header class="masthead" style="background-image: url('/img/contact-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="page-heading">
            <h1>Contáctame</h1>
            <span class="subheading">¿Tiene Preguntas? Tengo respuestas.</span>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <p>¿Quieres ponerte en contacto? Complete el siguiente formulario para enviarme un mensaje y me pondré en contacto con usted lo antes posible.</p>
        <!-- Contact Form - Enter your email address on line 19 of the mail/contact_me.php file to make this form work. -->
        <!-- WARNING: Some web hosts do not allow emails to be sent through forms to common mail hosts like Gmail or Yahoo. It's recommended that you use a private domain email address! -->
        <!-- To use the contact form, your site must be on a live web host with PHP! The form will not work locally! -->
        <form method="POST" action="/regconsulta">
            @csrf
            <div class="control-group">
                <div class="form-group floating-label-form-group controls">
                <label>Nombre</label>
                <input type="text" class="form-control" name="nombre" placeholder="Nombre" id="nombre" required data-validation-required-message="Please enter your name.">
                <p class="help-block text-danger"></p>
                </div>
            </div>
            <input type="integer" class="form-control" name="publicacion_id" placeholder="Direccion de correo electronico" id="publicacion_id" value="{{$publicacion->id}}" hidden>
            <div class="control-group">
                <div class="form-group floating-label-form-group controls">
                <label>Direccion de Correo Electronico</label>
                <input type="email" class="form-control" name="email" placeholder="Direccion de correo electronico" id="email" required data-validation-required-message="Please enter your email address.">
                <p class="help-block text-danger"></p>
                </div>
            </div>
            <div class="control-group">
                <div class="form-group col-xs-12 floating-label-form-group controls">
                <label>Número de teléfono</label>
                <input type="tel" class="form-control" name="telefono" placeholder="Numero de telefono" id="telefono" required data-validation-required-message="Please enter your phone number.">
                <p class="help-block text-danger"></p>
                </div>
            </div>
            <div class="control-group">
                <div class="form-group floating-label-form-group controls">
                <label>Mensaje</label>
                <textarea rows="5" class="form-control" name="mensaje" placeholder="Mensaje" id="mensaje" required data-validation-required-message="Please enter a message."></textarea>
                <p class="help-block text-danger"></p>
                </div>
            </div>
            <br>
            <div id="success"></div>
            <button type="submit" class="btn btn-primary" id="sendMessageButton">Enviar</button>
            <a href="{{ url()->previous() }}" class="btn btn-danger float-right" id="sendMessageButton">Cancelar</a>
        </form>
      </div>
    </div>
  </div>

  <hr>
@endsection
